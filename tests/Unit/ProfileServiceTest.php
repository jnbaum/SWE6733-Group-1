<?php

require_once __DIR__ . '/../../BusinessLogic/Services/ProfileService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/AdventureService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/ProfileService.php';
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

        // 1. create a user record across X tables (X is TBD)
        $profileService = $allServices->GetProfileService();

        $userKey = 999;
        $fullName = "Test User";
        $bio = "This is my test user bio.";
        $socialMediaUrl = "www.thisisaurl.com";
        $mileRangeTypeKey = 2;

        // create test user record.
        $profileService->createNewUserProfile($userKey, $fullName, $bio, $socialMediaUrl, $mileRangeTypeKey);

        //NeedToTest: add user adventure(s)
        $advenutreService = $allServices->GetAdventureService();

        $adventureTypeKey = 2;
        // get adventure name
        $adventure = new Adventure($adventureTypeKey, $userKey);

        // add adventure to databse
        $adventureKey = $advenutreService->CreateAdventure($adventure);
        
        //add preferences to new adventure
        $preferenceKeys = [2 => 2]; // not sure if this is the write varaiable assignment
        
        // add preferences to Adventure for User
        $advenutreService->AddPreferencestoAdventure($adventureKey, $preferenceKeys);

        // WIP 2. Verify that the user record exists
        $userService = $allServices->GetUserService();

        // WIP 3. Perform deletion function call(s)
        $profileService->DeleteUser($userKey);

        // WIP 4. Verify that the user record(s) do not exits anymore 
        $this->assertFalse($userService->UserExists($userKey));

    }
}