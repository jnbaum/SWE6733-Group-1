<?php

require_once(__DIR__ . '/../../BusinessLogic/AllServices.php'); 
require_once(__DIR__ . '/../../Models/Adventure.php'); 
require_once(__DIR__ . '/../../Models/Message.php');   
require_once(__DIR__ . '/../../Models/UserDetails.php'); 

echo "--- Mutual Match and Chat Simulation ---" . PHP_EOL;
echo "This script simulates two users (User A and User B) performing actions that lead to a mutual match and a subsequent chat." . PHP_EOL;

// Instantiate the service container
$allServices = new AllServices(); 
$userService = $allServices->GetUserService();
$adventureService = $allServices->GetAdventureService();
$matchingService = $allServices->GetMatchingService();
$messageService = $allServices->GetMessageService();
$profileService = $allServices->GetProfileService();

// Define test user credentials
$usernameA = "user_a_test@example.com";
$passwordA = "passwordA123";
$usernameB = "user_b_test@example.com";
$passwordB = "passwordB456";

// Create or Retrieve Test Users ---
echo PHP_EOL . "-------------------------------------------" . PHP_EOL;
echo "1. Creating or retrieving two test users..." . PHP_EOL;
echo "-------------------------------------------" . PHP_EOL;

// User A
// Attempt to create a new user. If user exists, IsValidUser will return the UserKey.
$userKeyA = $userService->CreateNewUser($usernameA, $passwordA);
if ($userKeyA === null) {
    $userKeyA = $userService->IsValidUser($usernameA, $passwordA);
    echo "User A ('$usernameA') already exists. Using existing **UserKey: " . $userKeyA . "**." . PHP_EOL;
} else {
    echo "User A ('$usernameA') created with **UserKey: " . $userKeyA . "**." . PHP_EOL;
}

// User B
$userKeyB = $userService->CreateNewUser($usernameB, $passwordB);
if ($userKeyB === null) {
    $userKeyB = $userService->IsValidUser($usernameB, $passwordB);
    echo "User B ('$usernameB') already exists. Using existing **UserKey: " . $userKeyB . "**." . PHP_EOL;
} else {
    echo "User B ('$usernameB') created with **UserKey: " . $userKeyB . "**." . PHP_EOL;
}

if ($userKeyA === null || $userKeyB === null) {
    echo "ERROR: Failed to create or retrieve both test users. Aborting simulation." . PHP_EOL;
    // Attempt to clean up any partially created users before exiting
    if ($userKeyA !== null) $profileService->DeleteUserProfile($userKeyA);
    if ($userKeyB !== null) $profileService->DeleteUserProfile($userKeyB);
    exit(1);
}

// Set Up Profiles and Adventures for Both Users ---
echo PHP_EOL . "--------------------------------------------------------" . PHP_EOL;
echo "Setting up profiles and adventures for both users..." . PHP_EOL;
echo "   (Ensuring they have some matching preferences for the algorithm)" . PHP_EOL;
echo "--------------------------------------------------------" . PHP_EOL;


// Profile setup for User A
$profileService->UpdateUserInfo($userKeyA, "Alice Wonderland", "Loves exploring trails and finding hidden gems.");
$profileService->AddSocialMediaLink($userKeyA, "https://instagram.com/alice_trails");
$profileService->AddMileRangePreferencesToUser($userKeyA, 3); // MileRangeTypeKey 3 = 15 miles
echo "User " . $userKeyA . " (Alice) profile updated with bio, social link, and 15-mile preference." . PHP_EOL;

// Add an adventure for User A
$adventureA = new Adventure(1, $userKeyA); 
$adventureKeyA = $adventureService->CreateAdventure($adventureA); 
$preferencesA = [126, 127]; 
$adventureService->AddPreferencesToAdventure($adventureKeyA, $preferencesA);
echo "User " . $userKeyA . " created an adventure: Hiking (Intermediate, Casual)." . PHP_EOL;

// Profile setup for User B
$profileService->UpdateUserInfo($userKeyB, "Bob The Builder", "Enjoys outdoor activities and building new connections.");
$profileService->AddSocialMediaLink($userKeyB, "https://instagram.com/bob_adventures");
$profileService->AddMileRangePreferencesToUser($userKeyB, 3); // MileRangeTypeKey 3 = 15 miles
echo "User " . $userKeyB . " (Bob) profile updated with bio, social link, and 15-mile preference." . PHP_EOL;

// Add a matching adventure for User B
$adventureB = new Adventure(1, $userKeyB); // Hiking 
$adventureKeyB = $adventureService->CreateAdventure($adventureB);
$preferencesB = [126, 127]; // Intermediate, Casual
$adventureService->AddPreferencesToAdventure($adventureKeyB, $preferencesB);
echo "User " . $userKeyB . " created a matching adventure: Hiking (Intermediate, Casual)." . PHP_EOL;

// Simulate Mutual Likes ---
echo PHP_EOL . "---------------------------------" . PHP_EOL;
echo "3. Simulating mutual 'Like' interactions..." . PHP_EOL;
echo "---------------------------------" . PHP_EOL;

// User A likes User B
$successA_likes_B = $matchingService->RecordInteraction($userKeyA, $userKeyB, true); 
if ($successA_likes_B) {
    echo "User " . $userKeyA . " **LIKED** User " . $userKeyB . ". Success: true." . PHP_EOL;
} else {
    echo "User " . $userKeyA . " **LIKED** User " . $userKeyB . ". Success: false (might already exist)." . PHP_EOL;
}

// User B likes User A
$successB_likes_A = $matchingService->RecordInteraction($userKeyB, $userKeyA, true); 
if ($successB_likes_A) {
    echo "User " . $userKeyB . " **LIKED** User " . $userKeyA . ". Success: true." . PHP_EOL;
} else {
    echo "User " . $userKeyB . " **LIKED** User " . $userKeyA . ". Success: false (might already exist)." . PHP_EOL;
}

// --- Step 4: Verify Mutual Match ---
echo PHP_EOL . "---------------------------------" . PHP_EOL;
echo "Verifying mutual match..." . PHP_EOL;
echo "---------------------------------" . PHP_EOL;

// Get matches for User A
$matchesForUserA = $matchingService->GetMatches($userKeyA); 
echo "Matches found for User " . $userKeyA . ": " . implode(", ", $matchesForUserA) . PHP_EOL;

// Get matches for User B
$matchesForUserB = $matchingService->GetMatches($userKeyB); 
echo "Matches found for User " . $userKeyB . ": " . implode(", ", $matchesForUserB) . PHP_EOL;

// Check if User B is in User A's matches and vice-versa
if (in_array($userKeyB, $matchesForUserA) && in_array($userKeyA, $matchesForUserB)) {
    echo "STATUS: **SUCCESS!** Users " . $userKeyA . " and " . $userKeyB . " are confirmed as a **mutual match**." . PHP_EOL;
} else {
    echo "STATUS: **FAILURE!** Mutual match not detected." . PHP_EOL;
}

// Establish a Chat Room ---
echo PHP_EOL . "---------------------------------------------" . PHP_EOL;
echo "5. Establishing a chat room between the matched users..." . PHP_EOL;
echo "---------------------------------------------" . PHP_EOL;

// GetChatRoomKey will create a new chat room if one doesn't exist, or return the existing one.
$chatRoomKey = $messageService->GetChatRoomKey($userKeyA, $userKeyB);
echo "Chat Room Key established for User " . $userKeyA . " and User " . $userKeyB . ": **" . $chatRoomKey . "**." . PHP_EOL;

// Simulate Sending Messages 
echo PHP_EOL . "------------------------------------------" . PHP_EOL;
echo "Simulating sending messages in the chat room..." . PHP_EOL;
echo "------------------------------------------" . PHP_EOL;

$messageService->InsertMessage(htmlspecialchars("Hi User B, glad we matched! Let's chat."), $userKeyA, $userKeyB, $chatRoomKey); 
echo "User " . $userKeyA . " sent a message." . PHP_EOL;

$messageService->InsertMessage(htmlspecialchars("Hey User A! Yes, great to connect. What kind of hiking are you into?"), $userKeyB, $userKeyA, $chatRoomKey);
echo "User " . $userKeyB . " sent a message." . PHP_EOL;

// Retrieve and Display Messages 
echo PHP_EOL . "----------------------------------------------------" . PHP_EOL;
echo "Retrieving and displaying messages from the chat room..." . PHP_EOL;
echo "----------------------------------------------------" . PHP_EOL;

$messages = $messageService->GetMessages($chatRoomKey);

if (!empty($messages)) {
    echo "Messages in Chat Room " . $chatRoomKey . ":" . PHP_EOL;
    foreach ($messages as $message) {
        // Content retrieved here is already HTML-escaped if inserted that way
        echo "  [" . $message->GetSentTime() . "] From User " . $message->GetSendingUserKey() . " (to User " . $message->GetRecipientUserKey() . "): **" . $message->GetContent() . "**" . PHP_EOL;
    }
} else {
    echo "No messages found in chat room " . $chatRoomKey . "." . PHP_EOL;
}

echo PHP_EOL . "--- Simulation Complete ---" . PHP_EOL;

// --- Cleanup: Delete Test Data (Highly Recommended) ---
echo PHP_EOL . "---------------------------------------" . PHP_EOL;
echo "Cleaning up all data created for test users..." . PHP_EOL;
echo "---------------------------------------" . PHP_EOL;

// The `DeleteUserProfile` method in `ProfileService` provides comprehensive deletion 
// It handles profile photos, mile ranges, social media links, messages, chatrooms, interactions, adventures, and the user record itself.
if ($profileService->DeleteUserProfile($userKeyA)) { 
    echo "Successfully cleaned up all data for **User " . $userKeyA . "**." . PHP_EOL;
} else {
    echo "ERROR: Failed to clean up data for User " . $userKeyA . "." . PHP_EOL;
}

if ($profileService->DeleteUserProfile($userKeyB)) { 
    echo "Successfully cleaned up all data for **User " . $userKeyB . "**." . PHP_EOL;
} else {
    echo "ERROR: Failed to clean up data for User " . $userKeyB . "." . PHP_EOL;
}

echo PHP_EOL . "Cleanup complete." . PHP_EOL;

?>