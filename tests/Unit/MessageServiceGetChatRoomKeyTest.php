<?php
require_once __DIR__ . '/../../DataAccess/DataAccess.php';
require_once(__DIR__ . "/../../Models/Message.php"); 
require_once __DIR__ . '/../../BusinessLogic/Services/MessageService.php';

use PHPUnit\Framework\TestCase; 

class MessageServiceGetChatRoomKeyTest extends TestCase
{
    public DataAccess $da;
    public MessageService $messageService;
    protected function setUp(): void
    {
        $this->da = new DataAccess();
        $this->messageService = new MessageService($this->da);
    }
    protected function tearDown(): void
    {
    }
    public function testGetChatRoomKeyConsistencyAndCreation()
    {
        $userKeyA = 1; // Hypothetical user key
        $userKeyB = 2; // Hypothetical user key

        
        $chatRoomKey1 = $this->messageService->GetChatRoomKey($userKeyA, $userKeyB);

        $chatRoomKey2 = $this->messageService->GetChatRoomKey($userKeyB, $userKeyA);


        $this->assertIsInt($chatRoomKey1, "The chat room key for user A and B should be an integer.");

        $this->assertGreaterThan(0, $chatRoomKey1, "The chat room key should be a positive integer.");

    
        $this->assertIsInt($chatRoomKey2, "The chat room key for user B and A should also be an integer.");

    
        $this->assertEquals($chatRoomKey1, $chatRoomKey2, "Chat room key should be consistent regardless of user order.");


    }

    /**
     * Test behavior with an invalid or non-existent user key, ensuring graceful handling.
     * This follows the pattern of testing invalid inputs seen in MatchingServiceTest 
     * or UserServiceTest 
     */
    public function testGetChatRoomKeyWithInvalidUser()
    {
        $invalidUserKey = -1; // An invalid user key
        $validUserKey = 1; // A hypothetical valid user key

        $chatRoomKey = $this->messageService->GetChatRoomKey($invalidUserKey, $validUserKey);
        $this->assertFalse($chatRoomKey > 0, "Chat room key should not be valid for an invalid user.");
    }
}