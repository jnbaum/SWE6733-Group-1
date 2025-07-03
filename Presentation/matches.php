<?php
session_start();
$currentUserKey = $_SESSION["user_id"];
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../BusinessLogic/Managers/MatchesManager.php");
include "matchComponent.php";

$profileService = $allServices->GetProfileService();
$adventureService = $allServices->GetAdventureService();
?>

<main>
    <h1>Matches</h1>
    <?php
    $matchedUserKeys = [1, 2, 3, 4]; // TODO: Replace this with a call to MatchingService->GetMatches, which will return a list of user keys that the current user has matched with 
    
    $matchManager = new MatchesManager($adventureService, $profileService);
    // The GetMatchDetails method makes a database call each time it is called, i.e. each time the loop iterates.
    // Ideally, we would call bulk fetch queries (i.e. fetch info from all user keys in one query) in a real production app to avoid making multiple database calls inside a loop
    foreach($matchedUserKeys as $matchedUserKey) {
        $matchDetails = $matchManager->GetMatchDetails($matchedUserKey);
        $profilePictureUrl = $matchDetails->GetProfilePictureUrl();
        $fullName = $matchDetails->GetFullName();
        $adventureDetailsArray = $matchDetails->GetAdventureDetailsArray();
        $distanceMiles = $matchDetails->GetMileRangePreferenceInMiles();
        
        echo createMatchElement($profilePictureUrl, $fullName, $adventureDetailsArray, $distanceMiles); // from matchComponent.php
        echo "<hr>";
    }
    ?>
</main>