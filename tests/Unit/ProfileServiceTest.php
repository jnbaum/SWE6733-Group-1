<?php

require_once __DIR__ . '/../../BusinessLogic/Services/ProfileService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/AdventureService.php';
require_once(__DIR__ . "/../../Models/Adventure.php");
require_once __DIR__ . '/../../BusinessLogic/Services/UserService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/MatchingService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/MessageService.php';
require_once(__DIR__ . "/../../DataAccess/DataAccess.php"); 
require_once(__DIR__ . "/../../Models/QueryType.php"); 
require_once(__DIR__ . "/../../BusinessLogic/QueryHelper.php"); 
use PHPUnit\Framework\TestCase;

class ProfileServiceTest extends TestCase{


    /*
    Assert true that a user record is deleted when DeleteUserProfile() is called
    The deletion must be performed on tables with a Foreign Key before deletion on
    the `user` table can be completed.

    PseudoFlow:
    1. create 2 TOTAL user record    
    2. Verify that the user record(s) do not exits anymore 
        [$this->assertTrue($profileService->DeleteUser($userKey));] 

    Because AllServices.php inlcudes PhotoService.php, the test will fail but to lack of '.env' file EVEN IF YOU ARENT USING PhotoService.php

    So the CreateNewUser() and DeleteUserProfile() methods cannot be called and we have to use the list of methods inside those methods.
    */
    public function testUserIsDeleted(){
        // services
        $da = new DataAccess();
        $profileService = new ProfileService($da);
        $adventureService = new AdventureService($da);
        $userService = new UserService($da);
        $messageService = new MessageService($da);
        $matchingService = new MatchingService($da);


        // 1. create a user1 and 2 records for DB
        $userName1 = "test@test.com";
        $password1 = "test";
        $userName2 = "test2@test2.com";
        $password2 = "test2";
        $userKey1 = $userService->CreateUser($userName1, $password1);
        $userKey2 = $userService->CreateUser($userName1, $password1);
        $fullName = "Test User";
        $bio = "This is my test user bio.";
        $socialMediaUrl = "www.thisisaurl.com";
        $mileRangeTypeKey = 2;

        // create test user1 record.
        $profileService->UpdateUserInfo($userKey1, $fullName, $bio);
        $profileService->AddSocialMediaLink($userKey1, $socialMediaUrl);
        $profileService->AddMileRangePreferencesToUser($userKey1, $mileRangeTypeKey);
        $adventureTypeKey = 2;
        $adventure = new Adventure($adventureTypeKey, $userKey1);
        $adventureKey1 = $adventureService->CreateAdventure($adventure);
        $preferenceKeys = [];
        $preferenceKeys[] = 2;
        $preferenceKeys[] = 3;
        $adventureService->AddPreferencesToAdventure($adventureKey1, $preferenceKeys);

        // create test user2 record.
        $profileService->UpdateUserInfo($userKey2, $fullName, $bio);
        $profileService->AddSocialMediaLink($userKey2, $socialMediaUrl);
        $profileService->AddMileRangePreferencesToUser($userKey2, $mileRangeTypeKey);
        $adventureTypeKey = 2;
        $adventure = new Adventure($adventureTypeKey, $userKey2);
        $adventureKey2 = $adventureService->CreateAdventure($adventure);
        $preferenceKeys = [];
        $preferenceKeys[] = 2;
        $preferenceKeys[] = 3;
        $adventureService->AddPreferencesToAdventure($adventureKey2, $preferenceKeys);

        // create chatroom and messages for users
        $content = "Hello";
        $chatRoomKey = $messageService->GetChatRoomKey($userKey1, $userKey2);;
        $messageService->InsertMessage($content, $userKey1, $userKey2, $chatRoomKey);
 
        // create interactions for users
        $isLIked = true;
        $matchingService->RecordInteraction($userKey1, $userKey2, $isLIked);

        
        // WIP 2. Verify that the user data do not exits anymore 
    
        $adventureDetailsArray = [];

        // delete user 1
        $profileService->DeleteUserProfilePicture($userKey1);
        $profileService->DeleteUserMileRangePreference($userKey1);
        $profileService->DeleteUserSocialMediaLinkUrl($userKey1);
        $profileService->DeleteUserMessages($userKey1);
        $profileService->DeleteUserChatrooms($userKey1);
        $profileService->DeleteUserInteractions($userKey1);
        $profileService->DeleteAdventures($userKey1);
        // assert AdventureDetailsArray  is empty
        $adventureDetailsArray = $adventureService->GetAdventureDetailsArray($userKey1);
        $this->assertEmpty($adventureDetailsArray);
        $this->assertTrue($profileService->DeleteUser($userKey1));
        


        // delete user 2
        $profileService->DeleteUserProfilePicture($userKey2);
        $profileService->DeleteUserMileRangePreference($userKey2);
        $profileService->DeleteUserSocialMediaLinkUrl($userKey2);
        $profileService->DeleteUserMessages($userKey2);
        $profileService->DeleteUserChatrooms($userKey2);
        $profileService->DeleteUserInteractions($userKey2);
        $profileService->DeleteAdventures($userKey2);
        // // assert AdventureDetailsArray  is empty
        $adventureDetailsArray = $adventureService->GetAdventureDetailsArray($userKey2);
        $this->assertEmpty($adventureDetailsArray);
        $this->assertTrue($profileService->DeleteUser($userKey2));
    

        
        
        

    }
}