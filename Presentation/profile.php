<?php
session_start();
$bodyClass = 'profile';
include("head.php");
include("header.php");


?>

<main class="profile-container">
  <h2 class="section-heading">PROFILE</h2>
  <div class="profile-view-row">
    <div class="profile-photo">
      <div class="polaroid">
        <img src="<?php echo $imageUrl; ?>" alt="Profile Picture" />
      </div>
    </div>

    <div class="profile-text">
      <h3><?php echo "$firstName $lastName"; ?></h3>
      <p>Hey, I'm <?php echo $firstName; ?></p>
      <p><?php echo $bio; ?></p>

      <p>Adventure Types<?php echo $adventures; ?></p>
      <p>Match Range<?php echo $matchRange; ?> miles</p>
    </div>
  </div>
</main>