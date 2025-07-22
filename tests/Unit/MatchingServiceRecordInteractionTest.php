<?php

require_once(__DIR__ . '/../../BusinessLogic/Services/MatchingService.php'); 
require_once(__DIR__ . '/../../DataAccess/DataAccess.php');     
require_once(__DIR__ . '/../../Models/QueryType.php');         

use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection; 

/**
 * Test class for the MatchingService's RecordInteraction method.
 * This is an integration test, as it interacts with the database.
 */
class MatchingServiceRecordInteractionTest extends TestCase {

    private $matchingService;
    private $dataAccess;
    private $testActingUserKey = 1; 
    private $testOtherUserKey1 = 2; 
    private $testOtherUserKey2 = 3; 

    protected function setUp(): void {
        
        //$this->matchingService = $allServices->GetMatchingService(); 
        $this->dataAccess = new DataAccess();
        $matchingService = new MatchingService($this->dataAccess);


        $query = "DELETE FROM interaction WHERE ActingUserKey = ? OR OtherUserKey = ?";
        $connection = $this->dataAccess->GetConnection(); 
        $connection->executeQuery($query, [$this->testActingUserKey, $this->testOtherUserKey1]);
        $connection->executeQuery($query, [$this->testActingUserKey, $this->testOtherUserKey2]);
        $connection->close(); 
    }

   
    protected function tearDown(): void {

        $query = "DELETE FROM interaction WHERE ActingUserKey = ? OR OtherUserKey = ?";
        $connection = $this->dataAccess->GetConnection();
        $connection->executeQuery($query, [$this->testActingUserKey, $this->testOtherUserKey1]);
        $connection->executeQuery($query, [$this->testActingUserKey, $this->testOtherUserKey2]);
        $connection->close();
    }

    /**
     * Test that RecordInteraction successfully adds a 'Like' interaction to the database.
     */
    public function testRecordInteraction_SuccessfullyAddsLike() {
        $isLiked = true; // Represents a 'Like' action
        $dataAccess = new DataAccess();
        $matchingService = new MatchingService($dataAccess);
        $success = $matchingService->RecordInteraction($this->testActingUserKey, $this->testOtherUserKey1, $isLiked);

        // Verify that the method reported success.
        $this->assertTrue($success, "The RecordInteraction method should return true on success.");

        // Verify the record exists in the database.
        // We use DataAccess directly to query the database.
        $connection = $dataAccess->GetConnection(); 
        $stmt = $connection->executeQuery(
            "SELECT COUNT(*) AS count, IsLiked FROM interaction WHERE ActingUserKey = ? AND OtherUserKey = ?",
            [$this->testActingUserKey, $this->testOtherUserKey1]
        );
        $result = $stmt->fetchAssociative();
        $connection->close();

        // Ensure exactly one record was inserted for this specific interaction.
        $this->assertEquals(1, $result['count'], "There should be exactly one interaction record for the 'Like'.");
        // Ensure the 'IsLiked' field matches the input.
        // BIT(1) in MySQL might return '0' or '1' as a string or integer; boolval() normalizes.
        $this->assertEquals($isLiked, boolval($result['IsLiked']), "The 'IsLiked' status in the database should be true.");
    }

    /**
     * Test that RecordInteraction successfully adds a 'Dislike' interaction to the database.
     */
    public function testRecordInteraction_SuccessfullyAddsDislike() {
        // Arrange
        $isLiked = false; // Represents a 'Dislike' (Skip) action
        $dataAccess = new DataAccess();
        $matchingService = new MatchingService($dataAccess);
        // Call the RecordInteraction method with the test data 
        $success = $matchingService->RecordInteraction($this->testActingUserKey, $this->testOtherUserKey2, $isLiked);

        // Verify that the method reported success.
        $this->assertTrue($success, "The RecordInteraction method should return true on success for a 'Dislike'.");

        // Verify the record exists in the database.
        $connection = $dataAccess->GetConnection();
        $stmt = $connection->executeQuery(
            "SELECT COUNT(*) AS count, IsLiked FROM interaction WHERE ActingUserKey = ? AND OtherUserKey = ?",
            [$this->testActingUserKey, $this->testOtherUserKey2]
        );
        $result = $stmt->fetchAssociative();
        $connection->close();

        // Ensure exactly one record was inserted for this specific interaction.
        $this->assertEquals(1, $result['count'], "There should be exactly one interaction record for the 'Dislike'.");
        // Ensure the 'IsLiked' field matches the input.
        $this->assertEquals($isLiked, boolval($result['IsLiked']), "The 'IsLiked' status in the database should be false.");
    }

}