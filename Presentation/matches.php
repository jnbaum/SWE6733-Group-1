<?php
session_start();
$currentUserKey = $_SESSION["user_id"];
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../BusinessLogic/Managers/MatchesManager.php");

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
        
        echo '<div class="profile-photo">
            <div class="polaroid">
            <img src="' . htmlspecialchars($profilePictureUrl ?? "default.jpg") . '" alt="Profile Photo" />
            </div>
        </div>
        <div>';

        echo "<p>" . htmlspecialchars($fullName)  . "</p>";
        // HERE - Create a button that executes a PHP action to insert a new chat room record between two users if it doesn't already exist. Otherwise, return existing chatRoomKey
        // And navigate to ChatRoom.php using that returned chatRoomKey and otherUserKey in url
        ?>
        <p>Adventure Types: <?php foreach($adventureDetailsArray as $adventureDetails) {
                      echo '<span>' . $adventureDetails->GetActivityName() . '-' . $adventureDetails->GetPreferencesString() . '</span> ';
        }?></p>

        <p>Match Range: <?php echo $distanceMiles?> miles</p>
        <hr>
    <?php
    }
    ?>  
</main>