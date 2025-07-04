<head>
    <style>
     .chatBubble {
            width: 70px;
            height: 70px;
        }

        .chatBubble:hover {
            cursor: pointer;
        }
    </style>
</head>
<?php
function createMatchElement($profilePictureUrl, $fullName, $adventureDetailsArray, $distanceMiles, $otherUserKey) {
    // IMPORTANT - DO NOT REMOVE chatBubble class ... there is a click handler for this class on matches.php
return '<div class="profile-photo">
            <div class="polaroid">
                <img src="' . htmlspecialchars($profilePictureUrl ?? "default.jpg") . '" alt="Profile Photo" />
            </div>
        </div>
        <img type="image" class="chatBubble" value="' . $otherUserKey . '" src="./Assets/chat.gif" alt="Chat Bubble" />
        <p>' . htmlspecialchars($fullName)  . '</p>
        <p>Adventure Types: ' 
            . createAdventures($adventureDetailsArray) .
        '</p>
        <p>Match Range: ' . $distanceMiles . ' miles</p>';  
}

function createAdventures($adventureDetailsArray): string {
    $string = "";
    foreach($adventureDetailsArray as $adventureDetails) {
         $string = $string . '<span>' . $adventureDetails->GetActivityName() . '-' . $adventureDetails->GetPreferencesString() . '</span> ';
    }
    return $string;
}
?>
