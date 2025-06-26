<?php
session_start();
$bodyClass = 'rover';
include("head.php");
include("header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();

}

$userKey = $_SESSION['user_id'];

?>

<main class="profile-container">
<div class="dashboard-container">
    <!-- LEFT COLUMN -->
    <div class="dashboard-left">
      <h2 class="section-headingg">Find A Rover</h2>
      
    </div>
   
</div>
</main>
</body>
</html>
