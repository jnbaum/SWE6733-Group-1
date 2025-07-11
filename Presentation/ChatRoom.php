<?php 
    session_start();
    $currentUserKey = $_SESSION["user_id"];
    $bodyClass = 'chatroom';
    $pageStyles = '
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.0.0/css/mdb.min.css">
    <link rel="stylesheet" href="Assets/styles/ChatRoom.css?v14">
    ';
    include("head.php");
    include("header.php");
    require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
    $profileService = $allServices->GetProfileService();
    $chatRoomKey = $_GET["chatRoomKey"]; // Replace with $_GET["chatRoomKey"] when each link to chat room in chat room selection list has ?chatRoomKey=... appended to it 
    $otherUserKey = $_GET["otherUserKey"];
    $otherUserDetails = $profileService->GetUserDetails($otherUserKey);
    $profilePhotoUrl = $profileService->GetProfilePictureUrl($otherUserKey);

  
    $pageScripts = '
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@9.0.0/js/mdb.umd.min.js"></script>
    <script>
        const messagesSection = document.getElementById("messagesSection");
        const currentUserKey = ' . json_encode($currentUserKey) . ';
        const otherUserKey = ' . json_encode($otherUserKey) . ';
        const chatRoomKey = ' . json_encode($chatRoomKey) . ';

        function scrollToBottom() {
        messagesSection.scrollTop = messagesSection.scrollHeight;
        }

        function loadMessages() {
        $("#messagesSection").load("AjaxResponses/MessagesSection.php?chatRoomKey=" + chatRoomKey);
        }

        function reloadMessagesSection() {
        loadMessages();
        scrollToBottom();
        }

        function sendMessage() {
        const content = $("#sendMessageInput").val();
        if (content.trim() === "") return;

        const data = {
            content: content,
            sendingUserKey: currentUserKey,
            recipientUserKey: otherUserKey,
            chatRoomKey: chatRoomKey
        };

        $.post("../../BusinessLogic/Actions/SendMessage.php", { messageData: JSON.stringify(data) }, function() {
            reloadMessagesSection();
        });

        $("#sendMessageInput").val("");
        }

        loadMessages();
        setInterval(loadMessages, 5000);
    </script>
    ';
?>


<main class="profile-container">
    <h2 class="profile-section-heading">Chat with <?= htmlspecialchars($otherUserDetails->GetFullName()) ?></h2>
    <div class="profile-view-row">
    <div class="profile-left-column">
        <div class="profile-photo mt-5 mx-auto">
            <div class="polaroid">
            <img src="<?= htmlspecialchars($profilePhotoUrl ?? '/SWE6733-Group-1/Presentation/Assets/images/default.jpg') ?>" alt="Profile photo of <?= htmlspecialchars($otherUserDetails->GetFullName()) ?>">
            </div>
        </div>
    </div>
  <div class="profile-right-column">
    <div class="chatContainer">
      <div class="messagesSectionWrapper">
        <div id="messagesSection" class="messagesSection"></div>
      </div>
        <?php $actionUrl = "../BusinessLogic/Actions/SendMessage.php?chatRoomKey=" . $chatRoomKey ?>
        <form action="<?php echo $actionUrl?>" class="sendMessageForm">
            <input id="sendMessageInput" class="sendMessageInput" type="text">
            <button class="btn btn-primary sendMessageButton" onclick="sendMessage()" type="button">Send</button> 
        </form>
    </div>
    </div>
    </div>
</main>


<?php include("footer.php"); ?>

