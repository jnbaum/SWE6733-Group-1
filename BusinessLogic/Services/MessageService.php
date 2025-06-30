<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../QueryHelper.php");
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

    public function InsertMessage(string $content, int $sendingUserKey, int $recipientUserKey, int $chatRoomKey) {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->da->ExecuteQuery("INSERT INTO message (Content, SendingUserKey, RecipientUserKey, SentTime, ChatRoomKey) VALUES("
        . QueryHelper::SurroundWithQuotes($content) . ","
        . $sendingUserKey . ","
        . $recipientUserKey . ","
        . QueryHelper::SurroundWithQuotes($now) . ","
        . $chatRoomKey . ")", QueryType::INSERT);
    }
}
?>