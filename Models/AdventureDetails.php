<?php
class AdventureDetails {
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


}