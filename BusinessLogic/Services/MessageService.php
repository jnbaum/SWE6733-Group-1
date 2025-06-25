<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
class MessageService {
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    public function ping() {
        echo "Test";
    }

    public function GetMessages(int $chatRoomKey): array {
        $stmt = $this->da->ExecuteQuery("SELECT * FROM Message 
            INNER JOIN ChatRoom ON Message.ChatRoomKey = ChatRoom.ChatRoomKey 
            WHERE Message.ChatRoomKey=" . $chatRoomKey . " ORDER BY SentTime ASC", QueryType::SELECT);

        $messages = [];
        //https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/reference/data-retrieval-and-manipulation.html
        while($row = $stmt->fetchAssociative()) {
            $message = new Message($row['SendingUserKey'], $row['RecipientUserKey'], $row['ChatRoomKey'], $row['Content'], $row['SentTime']);
            $messages[] = $message;
        }
        return $messages;
    }
}
?>