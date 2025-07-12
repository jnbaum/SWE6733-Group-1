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
    public function testCurrentValidUser() //can a user be created and then log in successfully?
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

    public function testCurrentInvalidUser() //can a current user log in with invalid credentials?
    {
        $da = new DataAccess();
        $userService = new UserService($da);

        $this->assertNull($userService->IsValidUser("fake@example.com", "wrongPassword"));
    }

    public function testNewInvalidUser() // duplicate new user creation triggers error
    {
        $da = new DataAccess();
        $userService = new UserService($da);

        $username = "faketestuser@email.com";
        $password = "fakepassword";

        $userService->CreateNewUser($username, $password);

        $result = $userService->CreateNewUser($username, $password);

        $this->assertNull($result);
    }

}

?>