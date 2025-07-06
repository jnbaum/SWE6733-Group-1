<?php
session_start();
require_once(__DIR__ . "/../../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../../BusinessLogic/Managers/MatchesManager.php");
require_once(__DIR__ . "/../../Models/Rover.php");
$userKey = $_SESSION["user_id"];
$adventureService = $allServices->GetAdventureService();
$profileService = $allServices->GetProfileService();
$matchingService = $allServices->GetMatchingService();
$matchingManager = new MatchesManager($adventureService, $profileService, $matchingService);

$roverUserKeys = $matchingManager->GetRovers($userKey);

$mileRange = $profileService->GetMileRangePreference($userKey);
$adventureDetailsArray = $adventureService->GetAdventureDetailsArray($userKey);
$profilePhotoUrl = $profileService->GetProfilePictureUrl($userKey);
$userDetails = $profileService->GetUserDetails($userKey);
$fullName = $userDetails->GetFullName();
$bio = $userDetails->GetBio();

$rovers = [];
foreach($roverUserKeys as $roverUserKey) {
    $rovers[$roverUserKey] = new Rover($mileRange, $adventureDetailsArray, $profilePhotoUrl, $fullName, $bio); // todo: json_encode only shows properties that are public 
}

echo json_encode($rovers); // https://stackoverflow.com/questions/14081312/send-array-from-php-to-javascript
?>