<?php
session_start();
$bodyClass = 'rover';
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../BusinessLogic/Managers/MatchesManager.php");


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();

}

$userKey = $_SESSION['user_id'];
$adventureService = $allServices->GetAdventureService();
$profileService = $allServices->GetProfileService();
$matchingService = $allServices->GetMatchingService();
$matchingManager = new MatchesManager($adventureService, $profileService, $matchingService);

?>

<main class="profile-container">
<div class="dashboard-container">
    <!-- LEFT COLUMN -->
    <div class="dashboard-left">
      <h2 class="section-heading">Find A Rover</h2>
      <div id="roverContents">
      <div class="profile-photo">
            <div class="polaroid">
              <img id="profilePicture" src="" alt="Profile Photo"/>
            </div>
      </div>
        <h3 id="fullName"></h3>
        <div id="instagramUrl"></div>
        <div id="bio"></div>
        <!-- Note to front-end: I've added a class "adventure" to each adventure <span> element in DisplayRoverDetails below ... to adjust styling, simply add a .adventure CSS class and adjust spacing -->
        <div id="adventures">Adventures: </div> 
        <div id="mileRangePreference"></div>
        <!-- IMPORTANT: DO NOT PUT THESE BUTTONS IN A FORM OR MAKE THEM SUBMIT BUTTONS! We do not want to reload page on button click because then the GetRovers function will be called every time -->
        <button class="btn btn-success" id="swipeLeftButton" value="" onclick="SwipeLeft()">Swipe Left</button> 
        <button class="btn btn-danger" id="swipeRightButton" value="" onclick="SwipeRight()">Swipe Right</button>
      </div> <!-- id roverContents -->
    </div>
</div>
</main>

<script>
  var rovers = [];
  var index = 0; // current index within rovers array
  var currentRover = null;

  ResetCardDeck(); // fetch rovers and display first rover on page load

  function DisplayRoverDetails(rover) {
    // console.log(rover);
    if(rover !== undefined) {
        var roverDetails = rover[1];
        $("#profilePicture").attr("src", roverDetails.profilePictureUrl);
        $("#fullName").html(roverDetails.fullName);
        $("#bio").html(roverDetails.bio);
        $("#instagramUrl").html("Instagram: " + roverDetails.socialMediaUrl);
        console.log(roverDetails.adventureDetailsArray);
        console.log(typeof(roverDetails.adventureDetailsArray));
        
        for(let i = 0; i < roverDetails.adventureDetailsArray.length; i++) {
          var adventure = roverDetails.adventureDetailsArray[i];
          var currentValue = $("#adventures").html();
          $("#adventures").html(currentValue + '<span class="adventure">' + adventure.activityName + "-" + adventure.preferencesString + '</span> ');
        }

        $("#mileRangePreference").html("Match Range: " + roverDetails.mileRangePreferenceInMiles + " miles");
        // Set value of swipe buttons to be the user key of the current rover displayed. This will be used in SwipeLeft and SwipeRight functions
        $("#swipeLeftButton").val(rover[0]);
        $("#swipeRightButton").val(rover[0]);
    }
    
  }

  function ResetCardDeck() {
    index = 0;
    rovers = [];

    $.ajax({
     url:'./AjaxResponses/GetRovers.php',
     type:'get',
     dataType:'json',
     success: function(data) {
      // Convert json to array
      for(var i in data)
       rovers.push([i, data[i]]); // Array of arrays: each element of the first array is an array with two elements: [UserKey, Obj containing data for that user key]
 
      if(rovers.length > 0) {
          currentRover = rovers[index];
          console.log(currentRover);
          DisplayRoverDetails(currentRover); // display first Rover
      }
      else {
        $("#roverContents").html("No more rovers were found that match your profile's preferences.");
      }

     }
    });
  }

  function Swipe() {
    // Increment index and show the next card. If at the end of fetched rovers, fetch rovers again. 
    index++;
    $("#adventures").html(""); // Reset adventures element to prepare it for next rover
    if(index == rovers.length) {
      ResetCardDeck();
    }
    else {
      DisplayRoverDetails(rovers[index]);
    }
  }

  function SwipeLeft() {
    Swipe();
    console.log("Swipe Left button value: " + $("#swipeLeftButton").val());
    // TODO: Make an ajax call to insert an interaction record with IsLiked = 1. OtherUserKey should be the value attribute of either swipe button (set in DisplayRoverDetails)
    // Insert code here
  }
  function SwipeRight() {
    Swipe();
    console.log("Swipe Right button value: " + $("#swipeRightButton").val());

    // TODO: Make an ajax call to insert an interaction record with IsLiked = 0 OtherUserKey should be the value attribute of either swipe button (set in DisplayRoverDetails)
    // Insert code here
  }


</script>
</body>
</html>