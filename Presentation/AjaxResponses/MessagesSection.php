<?php
    require_once(__DIR__ . "/../../Models/Message.php"); 
    require_once(__DIR__ . "/../../BusinessLogic/AllServices.php");

    session_start();
    $currentUserKey = $_SESSION["user_id"]; // Replace with $_SESSION["currentUserKey"] after login is implemented
    $chatRoomKey = $_GET["chatRoomKey"]; 

    // Get messages for the chat room key - make the query order by sentTime ASC, and union messages sent by current user + other user
    $messageService = $allServices->GetMessageService();
    $messages = $messageService->GetMessages($chatRoomKey); // Replace with GetMessages

    $isLeft = false; // This variable will be used to keep track of what side of the page (right or left) the last message is on so that we know where to put timestamp
    foreach($messages as $message) {
        if($message->GetSendingUserKey() == $currentUserKey) {
            echo '<div class="gradient right bubble"><p>' . $message->GetContent() . '</p></div>';  
            $isLeft = false;
        }
        else {
            echo '<div class="gray left bubble"><p>' . $message->GetContent() . '</p></div>';
            $isLeft = true;
        }
        // If last message in array, display time stamp below it
        if($message === end($messages)) {
            $className = $isLeft ? "left" : "right";
            echo "<span class='timeStamp " . $className . "'>" . $message->GetSentTime() . "</span>";
        }
    }
?>
