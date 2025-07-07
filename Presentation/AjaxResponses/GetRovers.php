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

$rovers = [];
foreach($roverUserKeys as $roverUserKey) {
    // Calling database calls inside of a loop like this is bad practice for real production apps (for performance), but it will suffice for this project.
    $mileRange = $profileService->GetMileRangePreference($roverUserKey);
    $adventureDetailsArray = $adventureService->GetAdventureDetailsArray($roverUserKey);
    $profilePhotoUrl = $profileService->GetProfilePictureUrl($roverUserKey);
    $userDetails = $profileService->GetUserDetails($roverUserKey);
    $fullName = htmlspecialchars($userDetails->GetFullName());
    $bio = htmlspecialchars($userDetails->GetBio());
    $socialMediaUrl = $profileService->GetSocialMediaLink($roverUserKey);

    $rovers[$roverUserKey] = new Rover($mileRange, $adventureDetailsArray, $profilePhotoUrl, $fullName, $bio, $socialMediaUrl); // todo: json_encode only shows properties that are public 
}

// Send array of objects as a json back to client (rover.php Javascript section)
echo json_encode($rovers); // https://stackoverflow.com/questions/14081312/send-array-from-php-to-javascript
?>