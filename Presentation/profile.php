<?php
session_start();

// Show PHP errors (for development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bodyClass = 'profile';
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../Models/UserDetails.php");
require_once(__DIR__ . "/../Models/AdventureType.php");
require_once(__DIR__ . "/../Models/PreferenceTypeEnum.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}


$userKey = $_SESSION['user_id'];

$da = new DataAccess();
$profileService = new ProfileService($da);
$adventureService = new AdventureService($da);

$userDetails = $profileService->GetUserDetails($userKey);
$socialMediaUrl = $profileService->GetSocialMediaLink($userKey);
$mileRange = $profileService->GetMileRangePreference($userKey);
$adventureDetailsArray = $adventureService->GetAdventureDetailsArray($userKey);
$profilePhotoUrl = $profileService->GetProfilePictureUrl($userKey);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {

  if ($profileService->DeleteUserProfile($userKey)) {
      // Destroy session and redirect to homepage or goodbye page
      session_destroy();
      header("Location: index.php"); 
      exit();
  } else {
      echo "<p style='color:red;'>Error deleting your profile. Please try again.</p>";
  }
}


?>

<main class="profile-container">
  <h2 class="profile-section-heading">Profile</h2>
  <div class="profile-view-row">
    <div class="profile-left-column">
      <div class="profile-photo">
        <div class="polaroid mx-auto">
          <img  src="<?php echo htmlspecialchars($profilePhotoUrl ?? 'default.jpg'); ?>" alt="Profile Photo" />
        </div>
      </div>
      <div class="text-center">
        <form method="POST" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
          <button type="submit" name="delete" class="btn btn-brand mt-5">Delete Profile</button>
        </form>
      </div>
    </div>
    
    <div class="profile-right-column">
      <div class="profile-text">
        <h3><?php echo htmlspecialchars($userDetails?->GetFullName() ?? 'User'); ?></h3>
        <p>Instagram
          <a href="<?php echo htmlspecialchars($socialMediaUrl ?? '#'); ?>" target="_blank">
            <?php echo htmlspecialchars($socialMediaUrl ?? 'Not provided'); ?>
          </a>
        </p>
        <p>Hey, I'm <?php echo htmlspecialchars($userDetails?->GetFullName() ?? 'Please enter a name'); ?></p>
        <p><?php echo htmlspecialchars($userDetails?->GetBio() ?? 'No bio yet.'); ?></p>

        <p>Adventure Types <?php foreach($adventureDetailsArray as $adventureDetails) {
                      echo '<span>' . $adventureDetails->GetActivityName() . '-' . $adventureDetails->GetPreferencesString() . '</span> ';
        }?></p>
        <p>Match Range <span><?php echo $mileRange !== null ? htmlspecialchars($mileRange). ' miles' : 'Not set';?></span></p>
      </div>
    </div>
  </div>
</main>
<?php include("footer.php"); ?>
