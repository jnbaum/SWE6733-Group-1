<?php
session_start();

// Show PHP errors (for development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bodyClass = 'profile';
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/Services/ProfileService.php");
require_once(__DIR__ . "/../Models/UserDetails.php");
$userKey = '1';

// if (!isset($_SESSION['UserKey'])) {
//   echo "<p>Error: No user is logged in.</p>";
//   exit;
// }

$da = new DataAccess();
$profileService = new ProfileService($da);

$userDetails = $profileService->GetUserDetails($userKey);
$profilePhotoUrl = $profileService->GetProfilePictureUrl($userKey);
$socialMediaUrl = $profileService->GetSocialMediaLink($userKey);
$mileRange = $profileService->GetMileRangePreference($userKey);

$adventures = " (coming soon)";

?>

<main class="profile-container">
  <h2 class="section-heading">PROFILE</h2>
  <div class="profile-view-row">
    <div class="profile-photo">
      <div class="polaroid">
        <img src="<?php echo htmlspecialchars($profilePhotoUrl ?? 'default.jpg'); ?>" alt="Profile Photo" />
      </div>
    </div>

    <div class="profile-text">
      <h3><?php echo htmlspecialchars($userDetails?->GetFullName() ?? 'User'); ?></h3>
      <p>Instagram:
        <a href="<?php echo htmlspecialchars($socialMediaUrl ?? '#'); ?>" target="_blank">
          <?php echo htmlspecialchars($socialMediaUrl ?? 'Not provided'); ?>
        </a>
      </p>
      <p>Hey, I'm <?php echo htmlspecialchars($userDetails?->GetFullName() ?? 'someone'); ?></p>
      <p><?php echo htmlspecialchars($userDetails?->GetBio() ?? 'No bio yet.'); ?></p>

      <p><strong>Adventure Types:</strong> <?php echo $adventures; ?></p>
      <p><strong>Match Range:</strong> <?php echo $mileRange !== null ? htmlspecialchars($mileRange). ' miles' : 'Not set';?></p>
    </div>
  </div>
</main>
