<?php
class Message {
    private int $messageKey;
    private int $sendingUserKey;
    private int $recipientUserKey;
    private int $chatRoomKey;
    private string $content;
    // dates in MySQL are passed as a string in PHP
    // https://stackoverflow.com/questions/1477125/how-can-i-store-a-date-in-a-mysql-database-using-php
    private string $sentTime; 

    function __construct($sendingUserKey, $recipientUserKey, $chatRoomKey, $content, $sentTime) {
        $this->sendingUserKey = $sendingUserKey;
        $this->recipientUserKey = $recipientUserKey;
        $this->chatRoomKey = $chatRoomKey;
        $this->content = $content;
        $this->sentTime = $sentTime;
    }
    
    public function GetMessageKey(): int {
        return $this->messageKey;
    }

    public function SetMessageKey(int $messageKey) {
        $this->messageKey = $messageKey;
    }

    public function GetSendingUserKey(): int {
        return $this->sendingUserKey;
    }

    public function GetRecipientUserKey(): int {
        return $this->recipientUserKey;
    }

    public function GetContent(): string {
        return $this->content;
    }

    public function GetChatRoomKey(): int {
        return $this->chatRoomKey;
    }

    public function SetChatRoomKey(int $chatRoomKey) {
        $this->chatRoomKey = $chatRoomKey;
    }

    public function GetSentTime(): string {
        return $this->sentTime;
    }
}