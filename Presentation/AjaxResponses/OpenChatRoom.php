<?php
session_start();
require_once(__DIR__ . "/../../BusinessLogic/AllServices.php");

$messagingService = $allServices->GetMessageService();
$currentUserKey = $_SESSION["user_id"];

$data = json_decode($_GET["chatRoomData"]);
$otherUserKey= $data->otherUserKey;

$newOrExistingChatRoomKey = $messagingService->GetChatRoomKey($currentUserKey, $otherUserKey);

echo $newOrExistingChatRoomKey;
?>