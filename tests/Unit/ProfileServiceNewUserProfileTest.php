<?php

// Include necessary files to set up the environment and services
//require_once(__DIR__ . '/../../../BusinessLogic/Services/AllServices.php'); 
require_once(__DIR__ . '/../../../DataAccess/DataAccess.php');
require_once(__DIR__ . '/../../../Models/QueryType.php');
require_once(__DIR__ . '/../../../BusinessLogic/Services/UserService.php'); 
require_once(__DIR__ . '/../../../BusinessLogic/Services/ProfileService.php'); 
require_once(__DIR__ . '/../../../BusinessLogic/Services/AdventureService.php');
require_once(__DIR__ . '/../../../BusinessLogic/Services/MessageService.php'); 
require_once(__DIR__ . '/../../../BusinessLogic/Services/MatchingService.php'); 

use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection; // Used for direct database manipulation in setup/teardown 
/**
 * Integration test class for the ProfileService's createNewUserProfile method.
 * This test verifies the end-to-end functionality including database interactions.
 */
class ProfileServiceNewUserProfileTest extends TestCase {
    private $dataAccess;
    private $profileService;
    private $userService;
    private $adventureService;
    private $messageService;
    private $matchingService;

    private $testUserKey;
    private $testUsername = "newtestuser@example.com";
    private $testPassword = "password123";
    private $testFullName = "Jane Doe";
    private $testBio = "A new user's interesting bio for their profile.";
    private $testSocialMediaUrl = "https://instagram.com/janedoe";
    private $testMileRangeTypeKey = 3; // Corresponds to 15 miles based on milerangetype data 

    /**
     * Set up the test environment before each test method runs.
     * This ensures a clean slate by creating a temporary user and then cleaning up if it already exists.
     */
    protected function setUp(): void {
        parent::setUp();
        $this->dataAccess = new DataAccess(); 
        $this->userService = new UserService($this->dataAccess); 
        $this->profileService = new ProfileService($this->dataAccess); 
        $this->adventureService = new AdventureService($this->dataAccess); 
        $this->messageService = new MessageService($this->dataAccess); 
        $this->matchingService = new MatchingService($this->dataAccess);

        // Ensure a clean slate for the test user by attempting to delete any existing records
        $this->cleanUpUser($this->testUsername); // Custom helper for cleanup

        // Create a user for the test to ensure a valid UserKey exists before populating profile.
        $this->testUserKey = $this->userService->CreateNewUser($this->testUsername, $this->testPassword); 
        $this->assertIsInt($this->testUserKey, "User should be created successfully for setup.");
        $this->assertGreaterThan(0, $this->testUserKey, "UserKey should be greater than 0.");
    }

    
    protected function tearDown(): void {
        // Clean up all data associated with the test user to ensure test isolation
        $this->cleanUpUser($this->testUsername); // Custom helper for cleanup
        parent::tearDown();
    }

    /**
     * Helper method to clean up all data related to a test user from the database.
     * This is crucial for integration tests to maintain a consistent state.
     * It manually deletes from dependent tables first, then the user table,
     * as `ProfileService::DeleteUserProfile`  is noted in sources to have `.env` file dependencies 
     */
    private function cleanUpUser(string $username): void {
        $conn = $this->dataAccess->GetConnection(); // 
        // Get user key first if user exists
        $stmt = $conn->executeQuery("SELECT UserKey FROM user WHERE Username = ?", [$username]); 
        $userRow = $stmt->fetchAssociative();
        $userKey = $userRow ? $userRow['UserKey'] : null;

        if ($userKey) {
            // Delete related records in dependent tables first to satisfy foreign key constraints
            // Adventure-related tables:
            $conn->executeStatement("DELETE FROM adventurepreference WHERE AdventureKey IN (SELECT AdventureKey FROM adventure WHERE UserKey = ?)", [$userKey]); 
            $conn->executeStatement("DELETE FROM adventure WHERE UserKey = ?", [$userKey]); 
            // Interaction table:
            $conn->executeStatement("DELETE FROM interaction WHERE ActingUserKey = ? OR OtherUserKey = ?", [$userKey, $userKey]);
            // Message and Chatroom tables:
            $conn->executeStatement("DELETE FROM message WHERE SendingUserKey = ? OR RecipientUserKey = ?", [$userKey, $userKey]); 
            $conn->executeStatement("DELETE FROM chatroom WHERE FirstUserKey = ? OR SecondUserKey = ?", [$userKey, $userKey]); 
            // Profile-related tables:
            $conn->executeStatement("DELETE FROM milerange WHERE UserKey = ?", [$userKey]); 
            $conn->executeStatement("DELETE FROM profilephoto WHERE UserKey = ?", [$userKey]); 
            $conn->executeStatement("DELETE FROM socialmedialink WHERE UserKey = ?", [$userKey]); 
            // Finally, delete the user itself
            $conn->executeStatement("DELETE FROM user WHERE UserKey = ?", [$userKey]); 
        }
        $conn->close();
    }

    /**
     * Test that createNewUserProfile successfully populates a new user's profile details
     * by inserting/updating records in the database.
     */
    public function testCreateNewUserProfile_SuccessfullyPopulatesDetails() {
        // Arrange: Define the input and expected outcome.
        $fullName = $this->testFullName;
        $bio = $this->testBio;
        $socialMediaUrl = $this->testSocialMediaUrl;
        $mileRangeTypeKey = $this->testMileRangeTypeKey;

        // Call the method being tested.
        $returnedUserKey = $this->profileService->createNewUserProfile(
            $this->testUserKey,
            $fullName,
            $bio,
            $socialMediaUrl,
            $mileRangeTypeKey
        ); 
        // Assert: Verify the method's return value.
        $this->assertEquals($this->testUserKey, $returnedUserKey, "The method should return the UserKey of the updated profile."); 

        // Assert: Verify the data in the database by directly querying it.
        $connection = $this->dataAccess->GetConnection(); // 

        // 1. Verify FullName and Bio in the 'user' table.
        $userStmt = $connection->executeQuery(
            "SELECT FullName, Bio FROM user WHERE UserKey = ?",
            [$this->testUserKey]
        );
        $userData = $userStmt->fetchAssociative();
        $this->assertNotNull($userData, "User data should exist after profile creation.");
        $this->assertEquals($fullName, $userData['FullName'], "FullName should be updated correctly in the 'user' table."); 
        $this->assertEquals($bio, $userData['Bio'], "Bio should be updated correctly in the 'user' table."); 

        // 2. Verify SocialMediaLinkUrl in the 'socialmedialink' table.
        $socialMediaStmt = $connection->executeQuery(
            "SELECT SocialMediaLinkUrl FROM socialmedialink WHERE UserKey = ?",
            [$this->testUserKey]
        );
        $socialMediaData = $socialMediaStmt->fetchAssociative();
        $this->assertNotNull($socialMediaData, "Social media link record should exist.");
        $this->assertEquals($socialMediaUrl, $socialMediaData['SocialMediaLinkUrl'], "SocialMediaLinkUrl should be added correctly."); 

        // 3. Verify MileRangeTypeKey in the 'milerange' table.
        $mileRangeStmt = $connection->executeQuery(
            "SELECT MileRangeTypeKey FROM milerange WHERE UserKey = ?",
            [$this->testUserKey]
        );
        $mileRangeData = $mileRangeStmt->fetchAssociative();
        $this->assertNotNull($mileRangeData, "Mile range preference record should exist.");
        $this->assertEquals($mileRangeTypeKey, $mileRangeData['MileRangeTypeKey'], "MileRangeTypeKey should be added correctly."); 

        $connection->close();
    }

    public function testCreateNewUserProfile_UpdatesExistingProfile() {
        // Arrange: Populate the profile initially with some data.
        $initialFullName = "Initial Name";
        $initialBio = "Initial Bio content.";
        $initialSocialMediaUrl = "https://initial.instagram.com";
        $initialMileRangeTypeKey = 1; // 5 miles 

        $this->profileService->createNewUserProfile(
            $this->testUserKey,
            $initialFullName,
            $initialBio,
            $initialSocialMediaUrl,
            $initialMileRangeTypeKey
        );

        // Arrange: Define new values for the update.
        $updatedFullName = "Updated Jane Doe";
        $updatedBio = "This is Jane's updated and more exciting bio.";
        $updatedSocialMediaUrl = "https://updated.instagram.com/janedoe_new";
        $updatedMileRangeTypeKey = 5; // 25 miles 

        // Act: Call createNewUserProfile again with the updated details.
        $returnedUserKey = $this->profileService->createNewUserProfile(
            $this->testUserKey,
            $updatedFullName,
            $updatedBio,
            $updatedSocialMediaUrl,
            $updatedMileRangeTypeKey
        ); 

        // Assert: Verify the method's return value.
        $this->assertEquals($this->testUserKey, $returnedUserKey, "The method should return the UserKey of the updated profile on subsequent calls."); 

        $connection = $this->dataAccess->GetConnection(); // 

        // 1. Verify FullName and Bio in 'user' table (should be updated).
        $userStmt = $connection->executeQuery(
            "SELECT FullName, Bio FROM user WHERE UserKey = ?",
            [$this->testUserKey]
        );
        $userData = $userStmt->fetchAssociative();
        $this->assertNotNull($userData, "User data should exist after update.");
        $this->assertEquals($updatedFullName, $userData['FullName'], "FullName should be correctly updated on subsequent call."); 
        $this->assertEquals($updatedBio, $userData['Bio'], "Bio should be correctly updated on subsequent call."); 

        // 2. Verify SocialMediaLinkUrl in 'socialmedialink' table.
        // As per source `AddSocialMediaLink` is an INSERT, so we expect multiple records if no prior deletion/update.
        $socialMediaStmt = $connection->executeQuery(
            "SELECT SocialMediaLinkUrl FROM socialmedialink WHERE UserKey = ? ORDER BY SocialMediaLinkKey DESC",
            [$this->testUserKey]
        );
        $socialMediaLinks = $socialMediaStmt->fetchAllAssociative();
        $this->assertCount(2, $socialMediaLinks, "There should be two social media links for the user due to repeated inserts."); // Demonstrates the current behavior
        $this->assertEquals($updatedSocialMediaUrl, $socialMediaLinks['SocialMediaLinkUrl'], "The latest social media link should be the updated one."); 


        // 3. Verify MileRangeTypeKey in 'milerange' table.
        // Similarly, `AddMileRangePreferencesToUser` is an INSERT, so we expect multiple records.
        $mileRangeStmt = $connection->executeQuery(
            "SELECT MileRangeTypeKey FROM milerange WHERE UserKey = ? ORDER BY MileRangeKey DESC",
            [$this->testUserKey]
        );
        $mileRangeTypes = $mileRangeStmt->fetchAllAssociative();
        $this->assertCount(2, $mileRangeTypes, "There should be two mile range preferences for the user due to repeated inserts."); // Demonstrates the current behavior
        $this->assertEquals($updatedMileRangeTypeKey, $mileRangeTypes['MileRangeTypeKey'], "The latest mile range preference should be the updated one."); 
        $connection->close();
    }

    /**
     * Test createNewUserProfile with empty string values for optional fields (bio, social media URL).
     */
    public function testCreateNewUserProfile_WithEmptyOptionalFields() {
        // Arrange
        $fullName = "Minimal User";
        $bio = ""; // Empty bio
        $socialMediaUrl = ""; // Empty social media URL
        $mileRangeTypeKey = 2; // A valid mile range type key 

        // Act
        $returnedUserKey = $this->profileService->createNewUserProfile(
            $this->testUserKey,
            $fullName,
            $bio,
            $socialMediaUrl,
            $mileRangeTypeKey
        ); 

        // Assert
        $this->assertEquals($this->testUserKey, $returnedUserKey, "The method should return the UserKey."); 

        $connection = $this->dataAccess->GetConnection(); // 

        // 1. Verify FullName and Bio in 'user' table.
        $userStmt = $connection->executeQuery(
            "SELECT FullName, Bio FROM user WHERE UserKey = ?",
            [$this->testUserKey]
        );
        $userData = $userStmt->fetchAssociative();
        $this->assertNotNull($userData, "User data should exist with empty fields.");
        $this->assertEquals($fullName, $userData['FullName'], "FullName should be set correctly."); 
        $this->assertEquals($bio, $userData['Bio'], "Bio should be an empty string."); 

        // 2. Verify SocialMediaLinkUrl in 'socialmedialink' table.
        $socialMediaStmt = $connection->executeQuery(
            "SELECT SocialMediaLinkUrl FROM socialmedialink WHERE UserKey = ?",
            [$this->testUserKey]
        );
        $socialMediaData = $socialMediaStmt->fetchAssociative();
        $this->assertNotNull($socialMediaData, "Social media link record should exist even if empty.");
        $this->assertEquals($socialMediaUrl, $socialMediaData['SocialMediaLinkUrl'], "SocialMediaLinkUrl should be an empty string.");
        // 3. Verify MileRangeTypeKey in 'milerange' table.
        $mileRangeStmt = $connection->executeQuery(
            "SELECT MileRangeTypeKey FROM milerange WHERE UserKey = ?",
            [$this->testUserKey]
        );
        $mileRangeData = $mileRangeStmt->fetchAssociative();
        $this->assertNotNull($mileRangeData, "Mile range preference record should exist.");
        $this->assertEquals($mileRangeTypeKey, $mileRangeData['MileRangeTypeKey'], "MileRangeTypeKey should be set correctly."); 

        $connection->close();
    }
}