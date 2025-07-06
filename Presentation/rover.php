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
        <img id="profilePicture" src="" alt="Profile Photo"/>
        <div id="fullName"></div>
        <div id="bio"></div>
        <div id="adventures"></div>
        <!-- IMPORTANT: DO NOT PUT THESE BUTTONS IN A FORM OR MAKE THEM SUBMIT BUTTONS! We do not want to reload page on button click because then the GetRovers function will be called every time -->
        <button class="btn btn-success" id="swipeLeftButton" value="" onclick="SwipeLeft()">Swipe Left</button> 
        <button class="btn btn-danger" id="swipeRightButton" value="" onclick="SwipeRight()">Swipe Right</button>
    </div>
</div>
</main>

<script>
  var rovers = [];
  var index = 0; // current index within rovers array
  var currentRover = null;

  // Fetch top 10 rovers 
  $.ajax({
     url:'./AjaxResponses/GetRovers.php',
     type:'post',
     dataType:'json',
     success: function(data) {
      alert("Hello");
      rovers = data;
      console.log(rovers);
     }
    });

  if(rovers.length != 0) {
      currentRover = rovers[index];
      index++;
      DisplayRoverDetails(currentRover);
  }


  function DisplayRoverDetails(rover) {
    console.log(rover);
    // $("#profilePicture").attr("src", rover.profilePicture);
  }

  function ResetCardDeck() {
    index = 0;

    // Make ajax call to get rovers on a php page, and return those user keys (GET)
    $.ajax({
     url:'./AjaxResponses/GetRovers.php',
     type:'post',
     dataType:'json',
     success: function(data) {
      rovers = data;
     }
    });

    if(rovers.length != 0) {
      currentRover = rovers[index];
      index++;
      DisplayRoverDetails(currentRover);
    }
  }

  function Swipe() {
    // Show the next card and increment index
  }

  function SwipeLeft() {
    Swipe();
    // Make an ajax call to insert an interaction record
  }
  function SwipeRight() {
    Swipe();

    // Make an ajax call to insert an interaction record
  }


</script>
</body>
</html>