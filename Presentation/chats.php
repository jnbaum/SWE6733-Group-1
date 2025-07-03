<?php
session_start();
$currentUserKey = $_SESSION["user_id"];
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
?>

<main>
    <h1>Chats</h1>
    <?php
    $messageService = $allServices->GetMessageService();
    $profileService = $allServices->GetProfileService();
    // $userService = $allServices->GetUserService();
    $chatRooms = $messageService->GetStartedChatRooms($currentUserKey);

    foreach($chatRooms as $chatRoom) {
        $chatRoomKey = $chatRoom->GetChatRoomKey();
        $latestMessage = $messageService->GetLatestMessage($chatRoomKey);
    
        // Get other user information
        $otherUserKey = ($chatRoom->GetFirstUserKey() === $currentUserKey) ? $chatRoom->GetSecondUserKey() : $chatRoom->GetFirstUserKey();
        $profilePictureUrl = $profileService->GetProfilePictureUrl($otherUserKey);
        $otherUserDetails = $profileService->GetUserDetails($otherUserKey);

        // Display latest message and other user information
        // TODO: style image so that all images are the same size
        echo '<div class="profile-photo">
            <div class="polaroid">
            <img src="' . htmlspecialchars($profilePictureUrl ?? "default.jpg") . '" alt="Profile Photo" />
            </div>
        </div>
        <div>';

        echo "<p>" . htmlspecialchars($otherUserDetails->GetFullName())  . "</p>";
        echo "<p>Last Message: '" . htmlspecialchars($latestMessage->GetContent())  . "'</p>";
        echo "<p>" . htmlspecialchars($latestMessage->GetSentTime()) . "</p>";
        echo '<a href="ChatRoom.php?chatRoomKey=' . $chatRoomKey . '&otherUserKey=' . $otherUserKey .'">Open Chat</a>';
        echo '<hr>';
    }
    ?>
        
</main>