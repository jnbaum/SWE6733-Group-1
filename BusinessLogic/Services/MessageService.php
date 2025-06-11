<?php
require_once("../DataAccess/DataAccess.php");
class MessageService {
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    public function ping() {
        echo "Test";
    }

    public function GetMessages(): array {
        $stmt = $da->ExecuteQuery("SELECT * FROM Message");
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