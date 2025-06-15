<?php
class Preference {
    private int $preferenceKey;
    private int $preferenceTypeKey;
    private string $name;
    
    function __construct($preferenceTypeKey, $name) {
        $this->preferenceTypeKey = $preferenceTypeKey;
        $this->name = $name;
    }
    
      public function SetPreferenceKey(int $preferenceKey) {
        $this->preferenceKey = $preferenceKey;
    }

    public function GetPreferenceKey(): int {
        return $this->preferenceKey;
    }
    public function GetPreferenceTypeKey(): int {
        return $this->preferenceTypeKey;
    }
  
    public function GetName(): string {
        return $this->name;
    }

}