<?php 
require_once(__DIR__ . "/../../Models/MatchDetails.php");
class MatchesManager {
    private AdventureService $adventureService;
    private ProfileService $profileService;
    private ?MatchingService $matchingService;

    public function __construct($adventureService, $profileService, $matchingService = null) {
        $this->adventureService = $adventureService;
        $this->profileService = $profileService;
        $this->matchingService = $matchingService;
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

    public function GetRovers(int $userKey): array {
        $mileRangePreference = $this->profileService->GetMileRangePreference($userKey);
        $rovers = $this->matchingService->GetPotentialMatches($userKey, $mileRangePreference, 0); // TODO: Replace 0 with actual % likes for the user (from interactions table where ActingUserKey = $currentUserKey)
        return $rovers;
    }
}
?>