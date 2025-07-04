<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../QueryHelper.php");
require_once(__DIR__ . "/../../Models/ChatRoom.php");
require_once(__DIR__ . "/../../Models/Message.php");

class MessageService {
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    public function ping() {
        echo "Test";
    }

    public function GetMessages(int $chatRoomKey): array {
        $stmt = $this->da->ExecuteQuery("SELECT * FROM message 
            INNER JOIN chatroom ON message.ChatRoomKey = chatroom.ChatRoomKey 
            WHERE message.ChatRoomKey=" . $chatRoomKey . " ORDER BY SentTime ASC", QueryType::SELECT);

        $messages = [];
        //https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/reference/data-retrieval-and-manipulation.html
        while($row = $stmt->fetchAssociative()) {
            $message = new Message($row['SendingUserKey'], $row['RecipientUserKey'], $row['ChatRoomKey'], $row['Content'], $row['SentTime']);
            $messages[] = $message;
        }
        return $messages;
    }

    public function GetLatestMessage(int $chatRoomKey): Message {
        $stmt = $this->da->ExecuteQuery("SELECT * FROM message 
            INNER JOIN chatroom ON message.ChatRoomKey = chatroom.ChatRoomKey 
            WHERE message.ChatRoomKey=" . $chatRoomKey . " ORDER BY SentTime DESC LIMIT 1", QueryType::SELECT);
        
        $row = $stmt->fetchAssociative();
        return new Message($row['SendingUserKey'], $row['RecipientUserKey'], $row['ChatRoomKey'], $row['Content'], $row['SentTime']);
    }

    public function InsertMessage(string $content, int $sendingUserKey, int $recipientUserKey, int $chatRoomKey) {
        date_default_timezone_set('America/New_York');
        $now = date('Y-m-d H:i:s');
        $stmt = $this->da->ExecuteQuery("INSERT INTO message (Content, SendingUserKey, RecipientUserKey, SentTime, ChatRoomKey) VALUES("
        . QueryHelper::SurroundWithQuotes($content) . ","
        . $sendingUserKey . ","
        . $recipientUserKey . ","
        . QueryHelper::SurroundWithQuotes($now) . ","
        . $chatRoomKey . ")", QueryType::INSERT);
    }

    // Get chat rooms that the user is involved in
    public function GetStartedChatRooms(int $userKey): array {
         $stmt = $this->da->ExecuteQuery("SELECT * FROM chatroom 
            INNER JOIN message ON message.chatroomKey = chatroom.ChatRoomKey
            WHERE chatroom.FirstUserKey = " . $userKey .
            " OR chatroom.SecondUserKey = " . $userKey .
            " GROUP BY chatroom.ChatRoomKey", QueryType::SELECT);
       
        $chatRooms = [];
         while($row = $stmt->fetchAssociative()) {
            $chatRoom = new ChatRoom($row['FirstUserKey'], $row['SecondUserKey']);
            $chatRoom->SetChatRoomKey($row['ChatRoomKey']);
            $chatRooms[] = $chatRoom;
        }
        return $chatRooms;
    }

    public function GetChatRoomByKey(int $chatRoomKey): ChatRoom {
        $stmt = $this->da->ExecuteQuery("SELECT * FROM chatroom WHERE ChatRoomKey = " . $chatRoomKey, QueryType::SELECT);
        $row = $stmt->fetchAssociative();
        $chatRoom = new ChatRoom($row['FirstUserKey'], $row['SecondUserKey']);
        $chatRoom->SetChatRoomKey($row['ChatRoomKey']);
        return $chatRoom;
    }

    public function GetChatRoomKey(int $currentUserKey, int $otherUserKey): int {
         $stmt = $this->da->ExecuteQuery("SELECT ChatRoomKey FROM chatroom 
            WHERE FirstUserKey = " . $currentUserKey . " AND SecondUserKey = " . $otherUserKey . 
            " OR FirstUserKey = " . $otherUserKey . " AND SecondUserKey = " . $currentUserKey . " LIMIT 1", 
            QueryType::SELECT);

        $row = $stmt->fetchAssociative();
        if($row) {
            return (int)$row['ChatRoomKey'];
        }
        
        $insertedKey = $this->da->ExecuteQuery("INSERT INTO chatroom (FirstUserKey, SecondUserKey) VALUES ("
            . $currentUserKey . "," . $otherUserKey . ")", QueryType::INSERT);

        return $insertedKey; 
    }
}
?>