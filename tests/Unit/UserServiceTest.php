<?php
require_once __DIR__ . '/../../DataAccess/DataAccess.php';
require_once __DIR__ . '/../../BusinessLogic/Services/UserService.php';

use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public $da;
    public UserService $userService;
    

    /**
     * Test user validation method
     */
    public function testCurrentValidUser()
    {
        $da = new DataAccess();
        $userService = new UserService($da);

        //defining username and password for user in database
        $username = "d.brooks@rootspark.ga";
        $password = "FireMaker78";
        
        // since IsValidUser returns a userKey integer, assert that an integer is returned
        // any failure means a user is not recorded in the database
        $this->assertIsInt($userService->IsValidUser($username, $password));
    }

    public function testNewValidUser()
    {
        $da = new DataAccess();
        $userService = new UserService($da);

        //defining username and password for user in database
        $username = "TestUser@mail.com";
        $password = "plaintext";


        $userService->CreateNewUser($username, $password);
        // since IsValidUser returns a userKey integer, assert that an integer is returned
        // any failure means a user is not recorded in the database
        $this->assertIsInt($userService->IsValidUser($username, $password));
    }

/************************************************* TESTING *********************************************************************/
    public function testInvalidCredentials()
    {
        $da = new DataAccess();
        $userService = new UserService($da);

        $invalidUsername = "nonexistent@example.com";
        $invalidPassword = "wrongpassword";

        // IsValidUser should return null or false if the user does not exist or credentials are wrong.
        $result = $userService->IsValidUser($invalidUsername, $invalidPassword);

        $this->assertNull($result, "IsValidUser should return null for invalid credentials.");
    }


    public function testNonExistentUser()
    {
        $da = new DataAccess();
        $userService = new UserService($da);

        // password no matter if the user doesn't exist
        $nonExistentUsername = "definitely_not_a_user@example.com";
        $anyPassword = "anypassword";

        $result = $userService->IsValidUser($nonExistentUsername, $anyPassword);

        // null because the user does not exist in the DB
        $this->assertNull($result, "IsValidUser should return null for a non-existent user.");
    }
/*************************************************** TESTING ******************************************************************/
}

?>