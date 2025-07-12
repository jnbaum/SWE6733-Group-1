<?php
session_start();
$userKey = $_SESSION["user_id"];
require_once(__DIR__ . "/../../BusinessLogic/AllServices.php");

$matchingService = $allServices->GetMatchingService();

$isLiked = false;
if($_POST["isLiked"] == 'true') {
    $isLiked = true;
}

$matchingService->RecordInteraction($userKey, $_POST["otherUserKey"], $isLiked);
?>