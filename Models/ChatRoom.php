<?php
class ChatRoom {
    private int $chatRoomKey;
    private int $firstUserKey;
    private int $secondUserKey;
    
    function __construct($firstUserKey, $secondUserKey) {
        $this->firstUserKey = $firstUserKey;
        $this->secondUserKey = $secondUserKey;
    }
    
    public function SetChatRoomKey(int $chatRoomKey) {
        $this->chatRoomKey = $chatRoomKey;
    }

    public function GetChatRoomKey(): int {
        return $this->chatRoomKey;
    }

    public function GetFirstUserKey(): int {
        return $this->firstUserKey;
    }

    public function GetSecondUserKey(): int {
        return $this->secondUserKey;
    }

    public function SetFirstUserKey(int $firstUserKey) {
        $this->firstUserKey = $firstUserKey;
    }

    public function SetSecondUserKey(int $secondUserKey) {
        $this->secondUserKey = $secondUserKey;
    }
}