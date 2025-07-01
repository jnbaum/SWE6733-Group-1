<?php

// Adjust the path below based on your actual project structure.
// Assuming UserDetails.php is in 'models/' and this test file is in 'test/Unit/'
require_once __DIR__ . '/../../Models/UserDetails.php';

use PHPUnit\Framework\TestCase;

class UserDetailsTest extends TestCase
{
    /**
     * Test the constructor and GetFullName/GetBio methods.
     */
    public function testConstructorAndGetters()
    {
        $fullName = "John Doe";
        $bio = "Software Developer at Example Corp.";
        $userDetails = new UserDetails($fullName, $bio);

        $this->assertEquals($fullName, $userDetails->GetFullName());
        $this->assertEquals($bio, $userDetails->GetBio());
    }

    /**
     * Test the SetFullName method.
     */
    public function testSetFullName()
    {
        $userDetails = new UserDetails("Old Name", "Some Bio");
        $newFullName = "Jane Smith";
        $userDetails->SetFullName($newFullName);

        $this->assertEquals($newFullName, $userDetails->GetFullName());
    }

    /**
     * Test the SetBio method.
     */
    public function testSetBio()
    {
        $userDetails = new UserDetails("Test User", "Old Bio");
        $newBio = "New and improved biography.";
        $userDetails->SetBio($newBio);

        $this->assertEquals($newBio, $userDetails->GetBio());
    }

    /**
     * Test edge cases for full name (e.g., empty string).
     */
    public function testEmptyFullName()
    {
        $userDetails = new UserDetails("", "No Name Provided");
        $this->assertEquals("", $userDetails->GetFullName());
    }

    /**
     * Test edge cases for bio (e.g., empty string).
     */
    public function testEmptyBio()
    {
        $userDetails = new UserDetails("Full Name", "");
        $this->assertEquals("", $userDetails->GetBio());
    }
}

?>