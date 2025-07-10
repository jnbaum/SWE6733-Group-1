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

<head>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.0.0/css/mdb.min.css"
    rel="stylesheet"
    />

   <link rel="stylesheet" href="../Presentation/Assets/styles/matches.css?v14">
</head>

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
        
        // FRONT-END: To change styling, modify the html/css in matchComponent.php. 
        // Do not remove the chatBubble class from the img element. It is necessary to link to a chat room (via the jQuery code below)
        echo createMatchElement($profilePictureUrl, $fullName, $adventureDetailsArray, $distanceMiles, $matchedUserKey); // from matchComponent.php
        echo "<hr>";
    }
    ?>
</main>
<footer>
    <!-- Do not remove this; it's legally required if we choose to use the animated icons -->
    <a href="https://www.flaticon.com/free-animated-icons/conversation" title="conversation animated icons">Conversation animated icons created by Freepik - Flaticon</a>
</footer>
<script>
    $(".chatBubble").on("click", function() {
        var otherUserKey = $(this).attr("value");
        console.log("Clicked on chat bubble for user with user key: " + otherUserKey);

        var data = {
            otherUserKey: otherUserKey
        }

        var json = JSON.stringify(data);

        // Whatever is echoed inside of OpenChatRoom.php is stored in the parameter to the callback function (AKA in the chatRoomKey variable)
        // https://stackoverflow.com/questions/23807411/redirect-with-php-after-ajax-call
        $.get("./AjaxResponses/OpenChatRoom.php", {chatRoomData: json}, function(chatRoomKey) {
           console.log("Chat Room Key created or fetched: " + chatRoomKey);
           window.location.href = "./ChatRoom.php?chatRoomKey=" + chatRoomKey + "&otherUserKey=" + otherUserKey;
        });
    });
        
</script>