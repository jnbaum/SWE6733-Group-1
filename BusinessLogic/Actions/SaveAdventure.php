<?php
require_once(__DIR__ . "/../../Models/Adventure.php");
require_once(__DIR__ . "/../AllServices.php");

$adventureService = $allServices->GetAdventureService();

$userKey = 1; // after we implement login, change this to $_SESSION['currentUserKey']
$adventure = new Adventure((int)$_POST["adventureTypeKey"], $userKey); // $_POST gets the value of element with name "adventureTypeKey" from the form that made this post request (form submission)

// Add adventure to database
$adventureKey = $adventureService->CreateAdventure($adventure);

// Add preferences to the newly inserted adventure using this adventureKey (lastInsertedId)
$preferenceKeys = [];
$preferenceKeys[] = (int)$_POST["skillLevelPreferenceKey"];
$preferenceKeys[] = (int)$_POST["attitudePreferenceKey"];
$adventureService->AddPreferencesToAdventure($adventureKey, $preferenceKeys);

// Redirect back to original page where the form submission took place
// Query string is one way to return data back to original page, but if it's sensitive info, use PHP SESSION variables instead
header("Location: ../../Presentation/createProfile.php");
?>