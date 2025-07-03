<?php 
require_once(__DIR__ . "/../../Models/MatchDetails.php");
class MatchesManager {
    private AdventureService $adventureService;
    private ProfileService $profileService;

    public function __construct($adventureService, $profileService) {
        $this->adventureService = $adventureService;
        $this->profileService = $profileService;
    }
    // Return details of a matched user that should be displayed on the matches page
    public function GetMatchDetails(int $userKey): MatchDetails {
        $mileRange = $this->profileService->GetMileRangePreference($userKey);
        $adventureDetailsArray = $this->adventureService->GetAdventureDetailsArray($userKey);
        $profilePhotoUrl = $this->profileService->GetProfilePictureUrl($userKey);
        $userDetails = $this->profileService->GetUserDetails($userKey);
        $fullName = $userDetails->GetFullName();
        return new MatchDetails($mileRange, $adventureDetailsArray, $profilePhotoUrl, $fullName);
    }
}
?>