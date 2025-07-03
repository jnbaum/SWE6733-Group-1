<?php
session_start();
$currentUserKey = $_SESSION["user_id"];
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");


$messageService = $allServices->GetMessageService();
$profileService = $allServices->GetProfileService();
$chatRooms = $messageService->GetStartedChatRooms($currentUserKey);

foreach($chatRooms as $chatRoom) {
    $latestMessage = $messageService->GetLatestMessage($chatRoom->GetChatRoomKey());

    $otherUserKey = ($chatRoom->GetFirstUserKey() === $currentUserKey) ? $chatRoom->GetSecondUserKey() : $chatRoom->GetFirstUserKey();
    $profilePictureUrl = $profileService->GetProfilePictureUrl($otherUserKey);

    echo '<img src=' . $profilePictureUrl . '>';
    echo $latestMessage->GetContent();
    echo $latestMessage->GetSentTime();
    echo '<br>';
}
?>