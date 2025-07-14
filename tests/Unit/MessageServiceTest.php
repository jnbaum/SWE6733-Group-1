<?php
require_once __DIR__ . '/../../DataAccess/DataAccess.php';
require_once(__DIR__ . "/../../Models/Message.php");
require_once __DIR__ . '/../../BusinessLogic/Services/MessageService.php';

use PHPUnit\Framework\TestCase;

class MessageServiceTest extends TestCase
{
    public $da;
    public MessageService $messageService; 

    /**
     * Test get messages method
     */
    public function testGetMessagesReturnsArray()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);

        //define chatRoomKey
        $sendingUserKey = 1;
        $recipientUserKey = 2;
        $content = "hello";
        $chatRoomKey = $messageService->GetChatRoomKey($sendingUserKey, $recipientUserKey);
        
        //insert a message
        $messageService->InsertMessage($content, $sendingUserKey, $recipientUserKey, $chatRoomKey);
        
        //assert that GetMessages() returns an array
        $this->assertIsArray($messageService->GetMessages($chatRoomKey));
    }

    public function testGetMessagesNotNull()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);

        //define chatRoomKey
        $sendingUserKey = 1;
        $recipientUserKey = 2;
        $content = "hello";
        $chatRoomKey = $messageService->GetChatRoomKey($sendingUserKey, $recipientUserKey);

        //insert a message
        $messageService->InsertMessage($content, $sendingUserKey, $recipientUserKey, $chatRoomKey);
        
        //assert that GetMessages() returns is not null
        $this->assertNotNull($messageService->GetMessages($chatRoomKey));
    }

/*************************************** TESTING ******************************************************* */
    // test GetChatRoomKey returns an integer.
    public function testGetChatRoomKeyReturnsInteger()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);

        $chatRoomKey = $messageService->GetChatRoomKey(1, 2);
        $this->assertIsInt($chatRoomKey);
    }// testGetChatRoomKeyReturnsInteger

    // test GetChatRoomKey returns the same key regardless of user order.
    public function testGetChatRoomKeyIsConsistent()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);
        $key1 = $messageService->GetChatRoomKey(1, 2);
        $key2 = $messageService->GetChatRoomKey(2, 1);
        $this->assertEquals($key1, $key2);
    }// testGetChatRoomKeyIsConsistent

    public function testGetChatRoomKey()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);

        $user1 = 1;
        $user2 = 2;

        // get chat room key for user1 and user2
        $chatRoomKey1 = $messageService->GetChatRoomKey($user1, $user2);
        
        // get chat room key for user2 and user1 (should be the same)
        $chatRoomKey2 = $messageService->GetChatRoomKey($user2, $user1);

        // assert that a key is returned and it's an integer
        $this->assertIsInt($chatRoomKey1);
        $this->assertGreaterThan(0, $chatRoomKey1);

        // assert that the keys are the same regardless of user order
        $this->assertEquals($chatRoomKey1, $chatRoomKey2);
    }// testGetChatRoomKey

    
    // test inserting a message and then retrieving it.
    public function testInsertAndRetrieveMessage()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);
        $chatRoomKey = $messageService->GetChatRoomKey(3, 4);
        $content = "Hello there!";
        $messageService->InsertMessage($content, 3, 4, $chatRoomKey);
        $messages = $messageService->GetMessages($chatRoomKey);
        $this->assertNotEmpty($messages);
        $this->assertEquals($content, end($messages)->GetContent());
    }// testInsertAndRetrieveMessage

    public function testGetMessagesEmptyChatRoom()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);

        // use a unique chat room key that is unlikely to have messages
        $chatRoomKey = -1; // Assuming -1 won't exist

        $messages = $messageService->GetMessages($chatRoomKey);

        // assert that an empty array is returned for an empty chat room
        $this->assertIsArray($messages);
        $this->assertEmpty($messages);
    }// testGetMessagesEmptyChatRoom

    public function testGetMessagesReturnsEmptyForNewRoom()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);
        $this->assertEmpty($messageService->GetMessages(99999)); // highly unlikely
    }// testGetMessagesReturnsEmptyForNewRoom
/*************************************** TESTING ******************************************************* */

}

?>