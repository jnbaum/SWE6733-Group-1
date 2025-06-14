<?php
class AdventureType {
    private int $adventureTypeKey;
    private string $name;
    
    function __construct($name) {
        $this->name = $name;
    }
    
    public function GetAdventureTypeKey(): int {
        return $this->adventureTypeKey;
    }

    public function SetAdventureTypeKey(int $adventureTypeKey) {
        $this->adventureTypeKey = $adventureTypeKey;
    }

    public function GetName(): string {
        return $this->name;
    }

}