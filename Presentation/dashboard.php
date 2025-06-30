<?php
session_start();

$bodyClass = 'dashboard';
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../Models/UserDetails.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();

}


$userKey = $_SESSION['user_id'];

$da = new DataAccess();
$profileService = new ProfileService($da);
$userDetails = $profileService->GetUserDetails($userKey);

?>

<main class="profile-container">
<div class="dashboard-container">
    <!-- LEFT COLUMN -->
    <div class="dashboard-left">
      <h2 class="section-heading">DASHBOARD</h2>
      <p class="subhead">HEY <?php echo htmlspecialchars($userDetails?->GetFullName() ?? 'User'); ?>!</p>
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
