<?php
class AdventureDetails implements \JsonSerializable {
    private int $adventureKey;
    private string $activityName;
    private string $preferencesString;

    
    function __construct($activityName, $preferencesString) {
        $this->activityName = $activityName;
        $this->preferencesString = $preferencesString;
    }
    
    public function SetAdventureKey(int $adventureKey) {
        $this->adventureKey = $adventureKey;
    }

      public function GetActivityName(): string {
        return $this->activityName;
    }


    public function GetPreferencesString(): string {
        return $this->preferencesString;
    }

    public function jsonSerialize(): array {
        // https://stackoverflow.com/questions/7005860/php-json-encode-class-private-members
        $vars = get_object_vars($this);
        return $vars;
    }
}