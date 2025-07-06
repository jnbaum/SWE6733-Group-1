<?php
class Rover {
    private int $mileRangePreferenceInMiles;
    private array $adventureDetailsArray;
    private string $profilePictureUrl;
    private string $fullName;
    private string $bio;
    
    function __construct($mileRangePreferenceInMiles, $adventureDetailsArray, $profilePictureUrl, $fullName, $bio) {
        $this->mileRangePreferenceInMiles = $mileRangePreferenceInMiles;
        $this->adventureDetailsArray = $adventureDetailsArray;
        $this->profilePictureUrl = $profilePictureUrl;
        $this->fullName = $fullName;
        $this->bio = $bio;
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

    public function GetBio(): string {
        return $this->bio;
    }
}
?>