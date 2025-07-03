<?php
function createMatchElement($profilePictureUrl, $fullName, $adventureDetailsArray, $distanceMiles) {
return '<div class="profile-photo">
            <div class="polaroid">
                <img src="' . htmlspecialchars($profilePictureUrl ?? "default.jpg") . '" alt="Profile Photo" />
            </div>
        </div>
        <p>' . htmlspecialchars($fullName)  . '</p>
        <p>Adventure Types: ' 
            . createAdventures($adventureDetailsArray) .
        '</p>
        <p>Match Range: ' . $distanceMiles . ' miles</p>';

        // HERE - Create a button that executes a PHP action to insert a new chat room record between two users if it doesn't already exist. Otherwise, return existing chatRoomKey
        // And navigate to ChatRoom.php using that returned chatRoomKey and otherUserKey in url
        // ^ do TDD for this 
       
}

function createAdventures($adventureDetailsArray): string {
    $string = "";
    foreach($adventureDetailsArray as $adventureDetails) {
         $string = $string . '<span>' . $adventureDetails->GetActivityName() . '-' . $adventureDetails->GetPreferencesString() . '</span> ';
    }
    return $string;
}
?>