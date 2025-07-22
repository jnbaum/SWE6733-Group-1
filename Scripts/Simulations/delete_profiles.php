<?php
require_once(__DIR__ . '/../../BusinessLogic/AllServices.php'); 
$allServices = new AllServices(); 
$profileService = $allServices->GetProfileService();

$userKeys = [21, 22, 23, 27, 28, 29, 30, 31];

foreach($userKeys as $userKey) {
    $profileService->DeleteUserProfile($userKey);
}

?>