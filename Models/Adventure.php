<?php
class Adventure {
    private int $adventureKey;
    private int $adventureTypeKey;
    private int $userKey;
    
    function __construct($adventureTypeKey, $userKey) {
        $this->adventureTypeKey = $adventureTypeKey;
        $this->userKey = $userKey;
    }
    
    public function GetAdventureTypeKey(): int {
        return $this->adventureTypeKey;
    }

    public function SetAdventureKey(int $adventureKey) {
        $this->adventureKey = $adventureKey;
    }

    public function GetAdventureKey(): int {
        return $this->adventureKey;
    }

    public function GetUserKey(): int {
        return $this->userKey;
    }

}