<?php
class Rover implements \JsonSerializable {
    private int $mileRangePreferenceInMiles;
    private array $adventureDetailsArray;
    private string $profilePictureUrl;
    private string $fullName;
    private string $bio;
    private string $socialMediaUrl;
    
    function __construct($mileRangePreferenceInMiles, $adventureDetailsArray, $profilePictureUrl, $fullName, $bio, $socialMediaUrl) {
        $this->mileRangePreferenceInMiles = $mileRangePreferenceInMiles;
        $this->adventureDetailsArray = $adventureDetailsArray;
        $this->profilePictureUrl = $profilePictureUrl;
        $this->fullName = $fullName;
        $this->bio = $bio;
        $this->socialMediaUrl = $socialMediaUrl;
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

    public function GetSocialMediaUrl(): string {
        return $this->socialMediaUrl;
    }

    public function jsonSerialize() {
        // https://stackoverflow.com/questions/7005860/php-json-encode-class-private-members
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>