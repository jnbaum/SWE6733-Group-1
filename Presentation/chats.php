<?php
session_start();
$currentUserKey = $_SESSION["user_id"];
include("head.php");
include("header.php");
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
?>

<head>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.0.0/css/mdb.min.css"
    rel="stylesheet"
    />

   <link rel="stylesheet" href="../Presentation/Assets/styles/chats.css?v14">
</head>

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
                echo '<a href="ChatRoom.php?chatRoomKey=' . $chatRoomKey . '&otherUserKey=' . $otherUserKey .'" class="open-chat-link">Open Chat</a>';
            echo '</div>'; // end chat-details

        echo '</div>'; // end chat-entry-container
        echo '<hr>'; // horizontal rule separating chat entries
    }
    ?>
        
</main>