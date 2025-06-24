<html>
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

   
   <link rel="stylesheet" href="../Presentation/Assets/styles/ChatRoom.css">
   
</head>

<?php 
    require_once(__DIR__ . "/../Models/Message.php"); // TODO: eventually, we will create a PROJECT ROOT path to use because relative paths in PHP get complicated
    require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
?>
<body class="main flex-centered">
    <h1>Chat with User</h1>
    <div class="flex-centered chatContainer">
        
        <div class="messagesSection">
        <?php
        $currentUserKey = 1; // Replace with $_SESSION["currentUserKey"] after login is implemented
        $chatRoomKey = 1; // Replace with $_GET["chatRoomKey"] when each link to chat room in chat room selection list has ?chatRoomKey=... appended to it 

        // Get messages for the chat room key - make the query order by sentTime ASC, and union messages sent by current user + other user
        $messageService = $allServices->GetMessageService();
        $messages = $messageService->GetMessages($chatRoomKey); // Replace with GetMessages

        // $message1 = new Message(1, 2, $chatRoomKey, "Hello", "6-7-2025 17:04:00"); // This timeStamp follows MySQL date format conventions
        // $message2 = new Message(2, 1, $chatRoomKey, "Hey!", "6-7-2025 17:04:00");
        // $message3 = new Message(1, 2, $chatRoomKey, "How was your day?", "6-7-2025 17:05:00");
        // $message4 = new Message(1, 2, $chatRoomKey, "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).", "6-7-2025 17:05:00");
        // $messages = [];
        // array_push($messages, $message1, $message2, $message3, $message4);

        foreach($messages as $message) {
            if($message->GetSendingUserKey() == $currentUserKey) {
                echo '<div class="gradient right bubble"><p>' . $message->GetContent() . '</p></div>';  
            }
            else {
                echo '<div class="gray left bubble"><p>' . $message->GetContent() . '</p></div>';
            }
        }
        ?>
        </div>
     
        <form action="./BusinessLogic/Actions/SendMessage.php" class="sendMessageForm">
            <input class="sendMessageInput" type="text">
            <button class="btn btn-info sendMessageButton" type="submit">Send</button> 
        </form>
       
    </div>
   
   


    
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.0.0/js/mdb.umd.min.js"
></script>
</body>


</html>