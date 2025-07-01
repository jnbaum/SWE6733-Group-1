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

  
   <link rel="stylesheet" href="../Presentation/Assets/styles/ChatRoom.css?v14">
   
</head>

<?php 
    include("head.php");
    include("header.php");
    $chatRoomKey = $_GET["chatRoomKey"]; // Replace with $_GET["chatRoomKey"] when each link to chat room in chat room selection list has ?chatRoomKey=... appended to it 
        require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
?>
<body class="main flex-centered">
    <h1>Chat with User</h1>
    <div class="flex-centered chatContainer">
        <div class="messagesSectionWrapper">
        <div id="messagesSection" class="messagesSection">
        </div>
        </div>
        <?php $actionUrl = "../BusinessLogic/Actions/SendMessage.php?chatRoomKey=" . $chatRoomKey ?>
        <form action=<?php echo $actionUrl?> class="sendMessageForm">
            <input id="sendMessageInput" class="sendMessageInput" type="text">
            <button class="btn btn-info sendMessageButton" onclick="sendMessage()" type="button">Send</button> 
        </form>
    </div>
    
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.0.0/js/mdb.umd.min.js"
></script>

<script>
    var messagesSection = document.getElementById("messagesSection");
    function scrollToBottom() {
        messagesSection.scrollTop = messagesSection.scrollHeight;
    }

    // Load the content inside MessagesSection.php into the messagesSection element.
    // Putting this in its own method will allow us to reload this element's content every 5 seconds (see below)
    function loadMessages() {
        $("#messagesSection").load("../Presentation/AjaxResponses/MessagesSection.php?chatRoomKey=" + <?php echo $chatRoomKey ?>);  
    }

    function reloadMessagesSection() {
        loadMessages();
        scrollToBottom();
    }

    function sendMessage() {
        var content = $("#sendMessageInput").val();
        var data = {
            content: content,
            sendingUserKey: 1, // TODO: Replace with php echo currentUserKey
            recipientUserKey: 2, // TODO: Replace with php echo user key of person in chat room that isn't current user
            chatRoomKey: <?php echo $chatRoomKey ?>
        }

        var json = JSON.stringify(data); // Akhan's answer on https://stackoverflow.com/questions/10955017/sending-json-to-php-using-ajax

        // Execute the code inside SendMessage.php, sending message data to it. On success, reload the page's messages (which will include the newly inserted message)
        $.post("../BusinessLogic/Actions/SendMessage.php", {messageData: json}, function() {
            reloadMessagesSection();
        })

        // Clear message input box
        $("#sendMessageInput").val("");
    }
    
    // Start by loading messsages on page load, and then continue reloading them every 5 seconds to detect incoming messages from other user
    loadMessages();
    setInterval(function(){
        loadMessages() // this will run after every 5 seconds
    }, 5000);
    
    
</script>
</body>


</html>