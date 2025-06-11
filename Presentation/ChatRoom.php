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

    <style>
        .flex-centered {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
         
        }

        .main {
            height: 100vh; /* main container must have 100vh if using flex to center vertically */
        }

        .chatContainer {
            min-height: 80vh;
            width: 80%;
            /* https://www.w3schools.com/css/css3_shadows_box.asp */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            position: relative;
            
        }

        .sendMessageForm {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            display: flex;
            flex-direction: row;
            width: 90%;
            margin-top: auto; /* equivalent to floating to bottom when direct parent is a flex container (flex-centered chatContainer) */
        }
        
        .sendMessageInput {
           min-width: 0; /* override because inputs have default width */
           width: 100%;
           border: white;
        }
        .sendMessageButton {
            float: right;
            width: 100px;
        }


        .messagesSection {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            overflow-y: auto; /* todo: test this */
            padding: 1%;
            margin-bottom: 1%;
        }

        .bubble {
            width: 46%;
            display: inline-block;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: rgb(0 0 0 / 25%) 0px 2px 5px 2px;  /* shadow taken from https://www.scaler.com/topics/chat-interface-project-css/ */
            margin-top: 1%;
            padding: 5px 10px 5px 12px;
        }

        .left {
            margin-right: auto; /* equivalent to float left when inside a flex container */
        }

        .right {
            margin-left: auto;
        }

        .gray {
            /* color taken from https://www.scaler.com/topics/chat-interface-project-css/ */
            background: #efefef none repeat scroll 0 0;
            color: #646464;
            
        }
        .gradient {
            /* background-image: linear-gradient(45deg,rgb(44, 153, 97) 0%,rgb(42, 221, 75) 100%); */
            background-image: linear-gradient(45deg,rgb(30, 105, 219) 0%,rgb(95, 155, 246) 100%);
            color: #fff;
        }
    </style>
</head>

<?php 
    require_once("../Models/Message.php"); // TODO: eventually, we will create a PROJECT ROOT path to use because relative paths in PHP get complicated
?>
<body class="main flex-centered">
    <h1>Chat with User</h1>
    <div class="flex-centered chatContainer">
        
        <div class="messagesSection">
        <?php
        $currentUserKey = 1;
        $chatRoomKey = 1;
        // Get messages for the chat room key - make the query order by sentTime DESC, and union messages sent by current user + other user
        $message1 = new Message(1, 2, $chatRoomKey, "Hello", "6-7-2025 17:04:00"); // This timeStamp follows MySQL date format conventions
        $message2 = new Message(2, 1, $chatRoomKey, "Hey!", "6-7-2025 17:04:00");
        $message3 = new Message(1, 2, $chatRoomKey, "How was your day?", "6-7-2025 17:05:00");
        $message4 = new Message(1, 2, $chatRoomKey, "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).", "6-7-2025 17:05:00");
        $messages = [];
        array_push($messages, $message1, $message2, $message3, $message4);

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