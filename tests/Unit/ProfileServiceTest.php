<?php

require_once __DIR__ . '/../../BusinessLogic/Services/ProfileService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/AdventureService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/UserService.php';
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
    1. create a user record across X tables (X is TBD)
    2. Verify that the user record exists
    3. Perform deletion function call(s)
    4. Verify that the user record(s) do not exits anymore 
        [assertFalse($userService->IsValidUser($userKey))]
    */
    public function verifyUserIsDeleted(){
        $profileService = new ProfileService();
        $advenutreService = new AdventureService();
        $userService = new UserService();

        // 1. create a user record across X tables (X is TBD)
        $userKey = 999;
        $fullName = "Test User";
        $bio = "This is my test user bio.";
        $socialMediaUrl = "www.thisisaurl.com";
        $mileRangeTypeKey = 2;

        // create test user record.
        $profileService->createNewUserProfile($userKey, $fullName, $bio, $socialMediaUrl, $mileRangeTypeKey);

        // create adventure, chatroom, messages, interactions for user

        // WIP 2. Verify that the user record exists based on userKey; select record from DB to return FullName for the given userKey
        $query = "SELECT FullName FROM user WHERE UserKey=" . QueryHelper::SurroundWithQuotes($userKey);
        $this->assertEquals($query, $fullName); // should return true


        // WIP 3. Perform deletion function call(s)
        $profileService->DeleteUserProfile($userKey);

        
        // WIP 4. Verify that the user record(s) do not exits anymore 
        
        // assert AdventureDetailsArray 
        $this->assertEmpty($advenutreService->GetAdventureDetailsArray($userKey));

        // assert User
        $query = "SELECT FullName FROM user WHERE UserKey=" . QueryHelper::SurroundWithQuotes($userKey);
        $this->assertNotEquals($query, $fullName);

    }
}