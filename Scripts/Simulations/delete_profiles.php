<?php
require_once(__DIR__ . '/../../BusinessLogic/AllServices.php'); 
$allServices = new AllServices(); 
$profileService = $allServices->GetProfileService();

$userKeys = [20, 24, 25, 26];

foreach($userKeys as $userKey) {
    $profileService->DeleteUserProfile($userKey);
}

?>