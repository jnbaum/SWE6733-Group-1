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
return '<div class="match-container">
            <div class="profile-photo">
                <div class="polaroid">
                    <img src="' . htmlspecialchars($profilePictureUrl ?? "default.jpg") . '" alt="Profile Photo" />
                </div>
            </div>
            <div class="match-details">
                <img type="image" class="chatBubble" value="' . $otherUserKey . '" src="./Assets/chat.gif" alt="Chat Bubble" />
                <p class="match-name">' . htmlspecialchars($fullName)  . '</p>
                <p><span class="detail-label">Adventure Types:</span> '
                    . createAdventures($adventureDetailsArray) .
                '</p>
                <p><span class="detail-label">Match Range:</span> ' . htmlspecialchars($distanceMiles) . ' miles</p>
            </div>
        </div>';
}

function createAdventures($adventureDetailsArray): string {
    $string = "";
    foreach($adventureDetailsArray as $adventureDetails) {
         $string = $string . '<span class="adventure-type">' . htmlspecialchars($adventureDetails->GetActivityName()) . '-' . htmlspecialchars($adventureDetails->GetPreferencesString()) . '</span>';
    }
    return $string;
}
?>