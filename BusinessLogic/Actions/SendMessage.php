<?php 
    require_once(__DIR__ . "/../AllServices.php");

    // Insert a new message into database
    $data = json_decode($_POST["messageData"]);
    $messageContent = $data->content;
    $sendingUserKey = $data->sendingUserKey;
    $recipientUserKey = $data->recipientUserKey;
    $chatRoomKey = $data->chatRoomKey;

    $messageService = $allServices->GetMessageService();
    $messageService->InsertMessage(htmlspecialchars($messageContent), $sendingUserKey, $recipientUserKey, $chatRoomKey);
    
    // echo json_last_error_msg();
    // No need to redirect anywhere because this is called inside an Ajax call on ChatRoom.php, which stays on the same page.
?>