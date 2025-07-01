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
    public function testMethods()
    {
        $da = new DataAccess();
        $messageService = new MessageService($da);

        //define chatRoomKey
        $sendingUserKey = 1;
        $recipientUserKey = 2;
        $chatRoomKey = 1;
        $content = "hello";

        
        $messageService->InsertMessage($content, $sendingUserKey, $recipientUserKey, $chatRoomKey);
        
        $this->assertIsArray($messageService->GetMessages($chatRoomKey));
    }

    // public function testInsertMessage()
    // {
    //     $da = new DataAccess();
    //     $messageService = new MessageService($da);

    //     /
    // }
}

?>