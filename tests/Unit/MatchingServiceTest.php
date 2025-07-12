<?php
require_once __DIR__ . '/../../DataAccess/DataAccess.php';
require_once(__DIR__ . "/../../Models/Message.php");
require_once __DIR__ . '/../../BusinessLogic/Services/MatchingService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/UserService.php';
require_once __DIR__ . '/../../BusinessLogic/Services/AdventureService.php';

use PHPUnit\Framework\TestCase;

class MatchingServiceTest extends TestCase
{
    public $da;
    public MatchingService $matchingService; 
    public UserService $userService;
    public AdventureService $adventureService;

    // When 0-50% of interactions are like, get users whose AdventureType plus 2 preferences are the same as the current user.
    // Test with a new user who has not liked anyone
    public function testGetPotentialMatchestTestTakePreferencesSeriouslyWhenMatching()
    {
        // TODO: remove this assertion and replace with code below
        $this->assertNull(null);

        // $da = new DataAccess();
        // $matchingService = new MatchingService($da);
        // $userService = new UserService($da);

        // $userKey = $userService->CreateNewUser("test", "test");
        // TODO: Create adventures for this user

        // $roverUserKeys = $matchingService->GetPotentialMatches($userKey, 5);

        // $userAdventures = $adventureService->GetAdventureDetailsArray($userKey);
        // TODO: compare user's adventures with found rover's adventures and ensure that adventure type and its two preferences are the same as the user created in this method
    }

    public function testGetPotentialMatchesReturnsNoResultsWhenNoPreferences()
    {
        $da = new DataAccess();
        $matchingService = new MatchingService($da);
        $userService = new UserService($da);

        $userKey = $userService->CreateNewUser("test@gmail.com", "test");
        if($userKey === null) {
            $userKey = $userService->IsValidUser("test@gmail.com", "test");
        }
        $roverUserKeys = $matchingService->GetPotentialMatches($userKey, 5, 0); // userKey, mileRange, current % of swipes that are likes for the user

        $this->assertIsArray($roverUserKeys);
        $this->assertEmpty($roverUserKeys);
    }
    
/************************************************* TESTING *********************************************************************/
    public function testGetPotentialMatchesInvalidUser()
    {
        $da = new DataAccess();
        $matchingService = new MatchingService($da);

        $invalidUserKey = -1; // a user key that does not exist
        $roverUserKeys = $matchingService->GetPotentialMatches($invalidUserKey, 5, 0);

        $this->assertIsArray($roverUserKeys);
        $this->assertEmpty($roverUserKeys);
    }// testGetPotentialMatchesInvalidUser
/************************************************* TESTING *********************************************************************/

}
?>