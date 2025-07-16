<?php
require_once __DIR__ . '/../../DataAccess/DataAccess.php';
require_once(__DIR__ . "/../../Models/Message.php");
require_once __DIR__ . '/../../BusinessLogic/Services/MatchingService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/UserService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/AdventureService.php';

use PHPUnit\Framework\TestCase;

class AdventureServiceTest extends TestCase
{
    public $da;
    public UserService $userService;
    public AdventureService $adventureService;

    public function testBulkGetAdventurePreferencesArray()
    {
        $da = new DataAccess();
        $userService = new UserService($da);
        $adventureService = new AdventureService($da);

        $userName1 = "test@test.com";
        $password1 = "test";
        $userName2 = "test2@test2.com";
        $password2 = "test2";
        $userKey1 = $userService->CreateUser($userName1, $password1);
        $userKey2 = $userService->CreateUser($userName1, $password1);

        $adventureTypeKey = 2;
        $adventure1 = new Adventure($adventureTypeKey, $userKey1);
        $adventureKey1 = $adventureService->CreateAdventure($adventure1);
        $adventure2 = new Adventure($adventureTypeKey, $userKey2);
        $adventureKey2 = $adventureService->CreateAdventure($adventure2);
        $preferenceKeys = [];
        $preferenceKeys[] = 2;
        $preferenceKeys[] = 3;
        $adventureService->AddPreferencesToAdventure($adventureKey1, $preferenceKeys);
        $adventureService->AddPreferencesToAdventure($adventureKey2, $preferenceKeys);

        $userKeys = [];
        $userKeys[] = $userKey1;
        $userKeys[] = $userKey2;
        $arrays = $adventureService->GetBulkAdventureDetailsArray($userKeys);

        print $arrays[(string)$userKey1];
        $this->assertEquals($arrays[(string)$userKey1], $arrays[(string)$userKey2]);
    }
}
?>