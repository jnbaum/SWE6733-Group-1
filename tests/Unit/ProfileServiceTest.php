<?php

require_once __DIR__ . '/../../BusinessLogic/Services/ProfileService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/AdventureService.php';
require_once(__DIR__ . "/../../Models/Adventure.php");
require_once __DIR__ . '/../../BusinessLogic/Services/UserService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/MatchingService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/MessageService.php';
require_once(__DIR__ . "/../../DataAccess/DataAccess.php"); 
require_once(__DIR__ . "/../../Models/QueryType.php"); 
require_once(__DIR__ . "/../../BusinessLogic/QueryHelper.php"); 
use PHPUnit\Framework\TestCase;

class ProfileServiceTest extends TestCase{


    /*
    Assert true that a user record is deleted when DeleteUserProfile() is called
    The deletion must be performed on tables with a Foreign Key before deletion on
    the `user` table can be completed.

    PseudoFlow:
    1. create 2 TOTAL user record    
    2. Verify that the user record(s) do not exits anymore 
        [$this->assertTrue($profileService->DeleteUser($userKey));] 

    Because AllServices.php inlcudes PhotoService.php, the test will fail but to lack of '.env' file EVEN IF YOU ARENT USING PhotoService.php

    So the CreateNewUser() and DeleteUserProfile() methods cannot be called and we have to use the list of methods inside those methods.
    */
    public function testUserIsDeleted(){
        // services
        $da = new DataAccess();
        $profileService = new ProfileService($da);
        $adventureService = new AdventureService($da);
        $userService = new UserService($da);
        $messageService = new MessageService($da);
        $matchingService = new MatchingService($da);


        // 1. create a user1 and 2 records for DB
        $userName1 = "test@test.com";
        $password1 = "test";
        $userName2 = "test2@test2.com";
        $password2 = "test2";
        $userKey1 = $userService->CreateUser($userName1, $password1);
        $userKey2 = $userService->CreateUser($userName1, $password1);
        $fullName = "Test User";
        $bio = "This is my test user bio.";
        $socialMediaUrl = "www.thisisaurl.com";
        $mileRangeTypeKey = 2;

        // create test user1 record.
        $profileService->UpdateUserInfo($userKey1, $fullName, $bio);
        $profileService->AddSocialMediaLink($userKey1, $socialMediaUrl);
        $profileService->AddMileRangePreferencesToUser($userKey1, $mileRangeTypeKey);
        $adventureTypeKey = 2;
        $adventure = new Adventure($adventureTypeKey, $userKey1);
        $adventureKey1 = $adventureService->CreateAdventure($adventure);
        $preferenceKeys = [];
        $preferenceKeys[] = 2;
        $preferenceKeys[] = 3;
        $adventureService->AddPreferencesToAdventure($adventureKey1, $preferenceKeys);

        // create test user2 record.
        $profileService->UpdateUserInfo($userKey2, $fullName, $bio);
        $profileService->AddSocialMediaLink($userKey2, $socialMediaUrl);
        $profileService->AddMileRangePreferencesToUser($userKey2, $mileRangeTypeKey);
        $adventureTypeKey = 2;
        $adventure = new Adventure($adventureTypeKey, $userKey2);
        $adventureKey2 = $adventureService->CreateAdventure($adventure);
        $preferenceKeys = [];
        $preferenceKeys[] = 2;
        $preferenceKeys[] = 3;
        $adventureService->AddPreferencesToAdventure($adventureKey2, $preferenceKeys);

        // create chatroom and messages for users
        $content = "Hello";
        $chatRoomKey = $messageService->GetChatRoomKey($userKey1, $userKey2);;
        $messageService->InsertMessage($content, $userKey1, $userKey2, $chatRoomKey);
 
        // create interactions for users
        $isLIked = true;
        $matchingService->RecordInteraction($userKey1, $userKey2, $isLIked);

        // 2. Verify that the user data do not exits anymore     
        $adventureDetailsArray = [];

        // delete user 1
        $profileService->DeleteUserProfilePicture($userKey1);
        $profileService->DeleteUserMileRangePreference($userKey1);
        $profileService->DeleteUserSocialMediaLinkUrl($userKey1);
        $profileService->DeleteUserMessages($userKey1);
        $profileService->DeleteUserChatrooms($userKey1);
        $profileService->DeleteUserInteractions($userKey1);
        $profileService->DeleteAdventures($userKey1);
        // assert AdventureDetailsArray  is empty
        $adventureDetailsArray = $adventureService->GetAdventureDetailsArray($userKey1);
        $this->assertEmpty($adventureDetailsArray);
        $this->assertTrue($profileService->DeleteUser($userKey1));

        // delete user 2
        $profileService->DeleteUserProfilePicture($userKey2);
        $profileService->DeleteUserMileRangePreference($userKey2);
        $profileService->DeleteUserSocialMediaLinkUrl($userKey2);
        $profileService->DeleteUserMessages($userKey2);
        $profileService->DeleteUserChatrooms($userKey2);
        $profileService->DeleteUserInteractions($userKey2);
        $profileService->DeleteAdventures($userKey2);
        // // assert AdventureDetailsArray  is empty
        $adventureDetailsArray = $adventureService->GetAdventureDetailsArray($userKey2);
        $this->assertEmpty($adventureDetailsArray);
        $this->assertTrue($profileService->DeleteUser($userKey2));
    }

    public function testDeletionOfUserFails(){
        // create new user
        $da = new DataAccess();
        $profileService = new ProfileService($da);
        $userService = new UserService($da);


        $userName = "test@test.com";
        $password = "test";
        $userKey = $userService->CreateUser($userName, $password);
        $fullName = "Test User";
        $bio = "This is my test user bio.";
        $socialMediaUrl = "www.thisisaurl.com";

        $profileService->UpdateUserInfo($userKey, $fullName, $bio);
        $profileService->AddSocialMediaLink($userKey, $socialMediaUrl);
        
        $this->assertFalse($profileService->DeleteUser($userKey));
        $this->assertTrue($profileService->DeleteUserSocialMediaLinkUrl($userKey));
        
    }

    public function testGetSocialMediaLinksReturnsAllLinksForUser()
    {
     $testUserKeySocialMedia = null;
     $testUserKeyNoSocialMedia = null;


        $da = new DataAccess();
    $userService = new UserService($da);
$profileService = new ProfileService($da);

$usernameSocial = "social";  
$usernameNoSocial = "nosocial"; 
$password = "testpass";

// --- Setup for testUserKeySocialMedia ---
$testUserKeySocialMedia = $userService->CreateNewUser($usernameSocial, $password); 
if ($testUserKeySocialMedia === null) {
    $testUserKeySocialMedia = $userService->IsValidUser($usernameSocial, $password); 
    $profileService->DeleteUserSocialMediaLinkUrl($testUserKeySocialMedia); 
}

// --- Setup for testUserKeyNoSocialMedia ---
$testUserKeyNoSocialMedia = $userService->CreateNewUser($usernameNoSocial, $password); 
if ($testUserKeyNoSocialMedia === null) {
    $testUserKeyNoSocialMedia = $userService->IsValidUser($usernameNoSocial, $password); 
    $profileService->DeleteUserSocialMediaLinkUrl($testUserKeyNoSocialMedia); 
}
        // Arrange
        $userKey = $testUserKeySocialMedia;
        $link1 = "https://instagram.com/johndoe";
        $link2 = "https://twitter.com/johndoe";
        $link3 = "https://facebook.com/johndoe";

        // Add multiple links for the user using the existing AddSocialMediaLink method
        $profileService->AddSocialMediaLink($userKey, $link1);
        $profileService->AddSocialMediaLink($userKey, $link2);
        $profileService->AddSocialMediaLink($userKey, $link3);

        // This is the new method we are about to implement.
        $actualLinks = $profileService->GetSocialMediaLinks($userKey);

        // Assert
        $this->assertIsArray($actualLinks, "Should return an array of social media links."); 
        $this->assertCount(3, $actualLinks, "Should return all 3 added social media links.");
        $this->assertContains($link1, $actualLinks, "The first link should be present."); 
        $this->assertContains($link2, $actualLinks, "The second link should be present."); 
        $this->assertContains($link3, $actualLinks, "The third link should be present."); 

        if ($testUserKeySocialMedia !== null) {
            $profileService->DeleteUserProfile($testUserKeySocialMedia); 
        }
        if ($testUserKeyNoSocialMedia !== null) {
            $profileService->DeleteUserProfile($testUserKeyNoSocialMedia); 
        }
        // $this->assertEquals([$link1, $link2, $link3], $actualLinks);
    }
}