<?php
session_start();

require_once(__DIR__ . "/../../Models/Adventure.php");
require_once(__DIR__ . "/../AllServices.php");
require_once(__DIR__ . "/../Managers/ProfilePhotoManager.php");

//instantiate $allServices
$allServices = new AllServices();

$array = json_decode($_POST["pendingAdventures"]);
$adventureService = $allServices->GetAdventureService();
$profileService = $allServices->GetProfileService();
$photoService = $allServices->GetPhotoService();    // This getter for PhotoService needs to be added to AllServices (see Part 4.1)
  
// Save name
$fullName = $_POST["first-name"] . " " . $_POST["last-name"];
$bio = $_POST["bio"];
$socialMediaUrl = $_POST["instagramUrl"];
$mileRangeTypeKey = $_POST["myDropdown"];
$profileService->createNewUserProfile($_SESSION['user_id'], $fullName, $bio, $socialMediaUrl, $mileRangeTypeKey);

// Save adventures
foreach ($array as $adventureToAdd) {
    $userKey = $_SESSION["user_id"]; // after we implement login, change this to $_SESSION['currentUserKey']
    $adventure = new Adventure((int)$adventureToAdd->{"adventureTypeKey"}, $userKey); // $_POST gets the value of element with name "adventureTypeKey" from the form that made this post request (form submission)

    // Add adventure to database
    $adventureKey = $adventureService->CreateAdventure($adventure);

    // Add preferences to the newly inserted adventure using this adventureKey (lastInsertedId)
    $preferenceKeys = [];
    $preferenceKeys[] = (int)$adventureToAdd->{"skillLevelPreferenceKey"};
    $preferenceKeys[] = (int)$adventureToAdd->{"attitudePreferenceKey"};
    $adventureService->AddPreferencesToAdventure($adventureKey, $preferenceKeys);
}

    $userKey = $_SESSION["user_id"];
    $photoManager = new ProfilePhotoManager();
    $photoManager->UploadProfilePhotoAndSaveS3Url($userKey, $photoService, $profileService);
    // var_dump($_FILES);

// Redirect back to original page where the form submission took place
// Query string is one way to return data back to original page, but if it's sensitive info, use PHP SESSION variables instead
header("Location: ../../Presentation/dashboard.php");
exit;