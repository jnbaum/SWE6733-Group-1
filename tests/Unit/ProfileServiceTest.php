<?php

require_once __DIR__ . '/../../BusinessLogic/Services/ProfileService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/AdventureService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/UserService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/MacthingService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/MessageService.php';
require_once(__DIR__ . "/../../DataAccess/DataAccess.php"); 
require_once(__DIR__ . "/../../Models/QueryType.php"); 
require_once(__DIR__ . "/../QueryHelper.php"); 
use PHPUnit\Framework\TestCase;
class ProfileServiceTest extends TestCase{


    /*
    Assert true that a user record is deleted when DeleteUserProfile() is called
    The deletion must be performed on tables with a Foreign Key before deletion on
    the `user` table can be completed.

    PseudoFlow:
    1. create a TOTAL user record    
    2. Verify that the user record exists
    3. Verify that the user record(s) do not exits anymore 
        [$this->assertTrue($profileService->DeleteUserProfile($userKey));]
    */
    public function verifyUserIsDeleted(){
        $profileService = new ProfileService();
        $advenutreService = new AdventureService();
        $userService = new UserService();
        $messageService = new MessageService();
        $matchingService = new MatchingService();

        // 1. create a user record across X tables (X is TBD)
        $userKey = 999;
        $fullName = "Test User";
        $bio = "This is my test user bio.";
        $socialMediaUrl = "www.thisisaurl.com";
        $mileRangeTypeKey = 2;

        // create test user record.
        $profileService->createNewUserProfile($userKey, $fullName, $bio, $socialMediaUrl, $mileRangeTypeKey);

        // create adventure for user

        // create chatroom and messages for user
        $content = "Hello";
        $chatRoomKey = 77;
        $recipientUserKey = 888;
        $messageService->InsertMessage($content, $userKey, $recipientUserKey, $chatRoomKey);
 
        // create interactions for user
        $isLIked = true;
        $matchingService->RecordInteraction($userKey, $recipientUserKey, $isLIked);

        // WIP 2. Verify that the user record exists based on userKey; select record from DB to return FullName for the given userKey
        $query = "SELECT FullName FROM user WHERE UserKey=" . QueryHelper::SurroundWithQuotes($userKey);
        $this->assertEquals($query, $fullName); // should return true

        
        // WIP 3. Verify that the user data do not exits anymore 
        
        // assert User deletion is true
        $this->assertTrue($profileService->DeleteUserProfile($userKey));

        // assert AdventureDetailsArray 
        $this->assertEmpty($advenutreService->GetAdventureDetailsArray($userKey));

    }
}