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
}

?>