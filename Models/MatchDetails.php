<?php
class MatchDetails {
    private int $mileRangePreferenceInMiles;
    private array $adventureDetailsArray;
    private string $profilePictureUrl;
    private string $fullName;
    
    function __construct($mileRangePreferenceInMiles, $adventureDetailsArray, $profilePictureUrl, $fullName) {
        $this->mileRangePreferenceInMiles = $mileRangePreferenceInMiles;
        $this->adventureDetailsArray = $adventureDetailsArray;
        $this->profilePictureUrl = $profilePictureUrl;
        $this->fullName = $fullName;
    }
    
    public function GetMileRangePreferenceInMiles() {
        return $this->mileRangePreferenceInMiles;
    }

    public function GetAdventureDetailsArray(): array {
        return $this->adventureDetailsArray;
    }

    public function GetProfilePictureUrl(): string {
        return $this->profilePictureUrl;
    }

    public function GetFullName(): string {
        return $this->fullName;
    }
}
?>