<?php
session_start();
$currentUserKey = $_SESSION["user_id"];
$bodyClass = 'chats';
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");

?>



<main class="profile-container">
<h2 class="profile-section-heading">Chats</h2>
    <?php
    $messageService = $allServices->GetMessageService();
    $profileService = $allServices->GetProfileService();
    // $userService = $allServices->GetUserService();
    $chatRooms = $messageService->GetStartedChatRooms($currentUserKey);

    foreach($chatRooms as $chatRoom) {
        $chatRoomKey = $chatRoom->GetChatRoomKey();
        $latestMessage = $messageService->GetLatestMessage($chatRoomKey);
    
        $otherUserKey = ($chatRoom->GetFirstUserKey() === $currentUserKey) ? $chatRoom->GetSecondUserKey() : $chatRoom->GetFirstUserKey();
        $profilePictureUrl = $profileService->GetProfilePictureUrl($otherUserKey);
        $otherUserDetails = $profileService->GetUserDetails($otherUserKey);

        // start of the new chat-entry-container for each chat room
        echo '<div class="chat-entry-container">';

            // image block
            echo '<div class="profile-photo">
                <div class="polaroid">
                <img src="' . htmlspecialchars($profilePictureUrl ?? "default.jpg") . '" alt="Profile Photo" />
                </div>
            </div>';

            // details block for name, message, and time
            echo '<div class="chat-details">';
                // name
                echo '<p class="chat-name">' . htmlspecialchars($otherUserDetails->GetFullName()) . '</p>';
                
                // message and time row
                echo '<div class="message-time-row">';
                    echo '<p class="chat-last-message">' . htmlspecialchars($latestMessage->GetContent())  . '</p>'; // message content
                    echo '<p class="chat-time">' . htmlspecialchars($latestMessage->GetSentTime()) . '</p>'; // sent time
                echo '</div>'; // end message-time-row
                
                // open chat link
                echo '<a href="ChatRoom.php?chatRoomKey=' . $chatRoomKey . '&otherUserKey=' . $otherUserKey .'" class="btn-brand w-auto align-self-start">Open Chat</a>';
            echo '</div>'; // end chat-details

        echo '</div>'; // end chat-entry-container
        echo '<hr>'; // horizontal rule separating chat entries
    }
    ?>
        
</main>
<?php include("footer.php"); ?>
