<?php
$bodyClass = 'dashboard';
include("head.php");
include("header.php");
?>

<main class="profile-container">
<div class="dashboard-container">
    <!-- LEFT COLUMN -->
    <div class="dashboard-left">
      <h2 class="section-headingg">DASHBOARD</h2>
      <p class="subhead">HEY!</p> <!--<?php echo strtoupper($userName); ?>!</p>-->
    </div>
    <div class="dashboard-right">
        <div class="dashboard-buttons">
            <a href="profile.php" class="dash-btn">
            <img src="https://rovaly-assets.s3.us-east-2.amazonaws.com/Rovaly+Icons/Profile.png" alt="Profile" />
            <span>View Your Profile</span>
            </a>
            <a href="rover.php" class="dash-btn">
            <img src="https://rovaly-assets.s3.us-east-2.amazonaws.com/Rovaly+Icons/Hiker.png" alt="Find a Rover" />
            <span>Find a Rover</span>
            </a>
            <a href="matches" class="dash-btn wide">
            <img src="https://rovaly-assets.s3.us-east-2.amazonaws.com/Rovaly+Icons/Match.png" alt="Matches" />
            <span>View Your Matches</span>
            </a>
            <a href="chats.php" class="dash-btn wide">
            <img src="https://rovaly-assets.s3.us-east-2.amazonaws.com/Rovaly+Icons/Chat.png" alt="Chats" />
            <span>Chats</span>
            </a>
        </div>
    </div>
</div>
</main>
</body>
</html>
