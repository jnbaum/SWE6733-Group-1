<?php
session_start();
$userKey = $_SESSION['user_id'];
$bodyClass = 'rover';
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../BusinessLogic/Managers/MatchesManager.php");


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();

}

$adventureService = $allServices->GetAdventureService();
$profileService = $allServices->GetProfileService();
$matchingService = $allServices->GetMatchingService();
$matchingManager = new MatchesManager($adventureService, $profileService, $matchingService);

 // Uncomment for testing ... display percentage of times that the user has swiped left 
 // (this reloads when the potential matches pool is swiped through ... AKA after 10 users, or less if GetRovers in MatchingManager.php returns less than 10 users)
//  echo $matchingService->GetPercentageLikes($userKey);
?>

<main class="profile-container">
<div class="dashboard-container">
    <!-- LEFT COLUMN -->
    <div class="dashboard-left">
      <h2 class="profile-section-heading">Find A Rover</h2>
      <div class="swipe-card" id="swipeCard">
      <div id="likeLabel" class="swipe-label like-label"><i class="fas fa-heart"></i></div>
        <div id="skipLabel" class="swipe-label skip-label"><i class="fas fa-xmark"></i></div>
      <div id="roverContents" class="profile-view-row">
        <div class="profile-left-column">
          <div class="profile-photo mx-auto">
            <div class="polaroid">
              <img id="profilePicture" src="" alt="Profile Photo"/>
            </div>
          </div>
        </div>
        <div class="profile-right-column profile-text">
          <h3 id="fullName"></h3>
          <p id="instagramUrl"></p>
          <p id="bio"></p>
          <p id="adventures">Adventures </p> 
          <p id="mileRangePreference" class="match-range-value"></p>
          <div class="profile-buttons">
            <button class="btn btn-brand" id="swipeLeftButton" value="" onclick="SwipeLeft()">+ Like</button> 
            <button class="btn btn-brand" id="swipeRightButton" value="" onclick="SwipeRight()">Skip →</button>
          </div>
        </div>
      </div> <!-- id roverContents -->
</div>
    </div>
</div>
</main>

<script>
  var rovers = [];
  var index = 0; // current index within rovers array
  var currentRover = null;
  let startX = 0;
  let currentX = 0;
  let offsetX = 0;
  let isDragging = false;
  const swipeCard = document.getElementById("swipeCard");
  const likeLabel = document.getElementById("likeLabel");
  const skipLabel = document.getElementById("skipLabel");

  ResetCardDeck(); // fetch rovers and display first rover on page load

  function DisplayRoverDetails(rover) {
    // console.log(rover);
    likeLabel.style.opacity = 0;
    skipLabel.style.opacity = 0;

    if(rover !== undefined) {
        var roverDetails = rover[1];
        $("#profilePicture").attr("src", roverDetails.profilePictureUrl);
        $("#fullName").html(roverDetails.fullName);
        $("#bio").html(roverDetails.bio);
        $("#instagramUrl").html('Instagram: <a href="' + roverDetails.socialMediaUrl + '" target="_blank">' + roverDetails.socialMediaUrl + '</a>');
        console.log(roverDetails.adventureDetailsArray);
        console.log(typeof(roverDetails.adventureDetailsArray));
        
        for(let i = 0; i < roverDetails.adventureDetailsArray.length; i++) {
          var adventure = roverDetails.adventureDetailsArray[i];
          var currentValue = $("#adventures").html();
          $("#adventures").html(currentValue + '<span class="adventure">' + adventure.activityName + "-" + adventure.preferencesString + '</span> ');
        }

        $("#mileRangePreference").html("Match Range " + roverDetails.mileRangePreferenceInMiles + " miles");
        // Set value of swipe buttons to be the user key of the current rover displayed. This will be used in SwipeLeft and SwipeRight functions
        $("#swipeLeftButton").val(rover[0]);
        $("#swipeRightButton").val(rover[0]);
    }
    
  }

  function ResetCardDeck() {
    index = 0;
    rovers = [];
    likeLabel.style.opacity = 0;
    skipLabel.style.opacity = 0;

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
    $("#adventures").html("Adventures "); // Reset adventures element to prepare it for next rover
    if(index == rovers.length) {
      ResetCardDeck();
    }
    else {
      DisplayRoverDetails(rovers[index]);
    }
    
  }

  function SwipeLeft() {
    // TODO: Make an ajax call to insert an interaction record with IsLiked = 1. OtherUserKey should be the value attribute of either swipe button (set in DisplayRoverDetails)
    // Insert code here
    var otherUserKey = $("#swipeLeftButton").val();
    $.post('./AjaxResponses/Swipe.php', {otherUserKey: otherUserKey, isLiked: true});
    console.log("Swipe Left button value: " + otherUserKey);

    Swipe();
  }

  function SwipeRight() {
    var otherUserKey = $("#swipeRightButton").val();
    $.post('./AjaxResponses/Swipe.php', {otherUserKey: otherUserKey, isLiked: false});
    console.log("Swipe Right button value: " + otherUserKey);

    Swipe();
  }



  swipeCard.addEventListener("touchstart", (e) => {
    startX = e.touches[0].clientX;
    isDragging = true;
    swipeCard.classList.add("dragging");
  });

  swipeCard.addEventListener("touchmove", (e) => {
    if (!isDragging) return;
    currentX = e.touches[0].clientX;
    offsetX = currentX - startX;
    swipeCard.style.transform = `translateX(${offsetX}px) rotate(${offsetX * 0.05}deg)`;
    if (offsetX > 30) {
      skipLabel.style.opacity = Math.min(offsetX / 100, 1);
      likeLabel.style.opacity = 0;
    } else if (offsetX < -30) {
      likeLabel.style.opacity = Math.min(-offsetX / 100, 1);
      skipLabel.style.opacity = 0;
    } else {
      likeLabel.style.opacity = 0;
      skipLabel.style.opacity = 0;
    }
  });

  swipeCard.addEventListener("touchend", () => {
    isDragging = false;
    swipeCard.classList.remove("dragging");
    if (offsetX > 100) {
      swipeCard.classList.add("animate");
      swipeCard.style.transform = "translateX(100vw) rotate(10deg)";
      setTimeout(() => {
        SwipeRight();
        resetCardPosition();
      }, 400);
    } else if (offsetX < -100) {
      swipeCard.classList.add("animate");
      swipeCard.style.transform = "translateX(-100vw) rotate(-10deg)";
      setTimeout(() => {
        SwipeLeft();
        resetCardPosition();
      }, 400);
    } else {
      swipeCard.classList.add("animate");
      swipeCard.style.transform = "translateX(0) rotate(0)";
      setTimeout(() => swipeCard.classList.remove("animate"), 400);
    }
    offsetX = 0;
  });

  function resetCardPosition() {
    swipeCard.classList.remove("animate");
    swipeCard.style.transform = "translateX(0) rotate(0)";
  }


</script>
<?php include("footer.php"); ?>
