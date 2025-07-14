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


/************************************** TESTING ******************************************/
    public function testGetFullNameReturnsCorrectValue()
    {
        $userDetails = new UserDetails("Alice Smith", "Bio text.");
        $this->assertEquals("Alice Smith", $userDetails->GetFullName());
    }
    
    public function testLongFullName()
    {
        $longName = str_repeat("A", 255);
        $userDetails = new UserDetails($longName, "Bio");
        $this->assertEquals($longName, $userDetails->GetFullName());
    }

    public function testLongBio()
    {
        $longBio = str_repeat("B", 1000);
        $userDetails = new UserDetails("Name", $longBio);
        $this->assertEquals($longBio, $userDetails->GetBio());
    }

    public function testSetBioUpdatesValue()
    {
        $userDetails = new UserDetails("Name", "Initial Bio.");
        $userDetails->SetBio("Updated Bio.");
        $this->assertEquals("Updated Bio.", $userDetails->GetBio());
    }

    public function testEmptyConstructorValues()
    {
        $userDetails = new UserDetails("", "");
        $this->assertEquals("", $userDetails->GetFullName());
        $this->assertEquals("", $userDetails->GetBio());
    }

    public function testSettersUpdateValuesCorrectly()
    {
        $userDetails = new UserDetails("Initial Name", "Initial Bio");

        // First update
        $userDetails->SetFullName("First Updated Name");
        $userDetails->SetBio("First Updated Bio");
        $this->assertEquals("First Updated Name", $userDetails->GetFullName());
        $this->assertEquals("First Updated Bio", $userDetails->GetBio());

        // Second update
        $userDetails->SetFullName("Second Updated Name");
        $userDetails->SetBio("Second Updated Bio");
        $this->assertEquals("Second Updated Name", $userDetails->GetFullName());
        $this->assertEquals("Second Updated Bio", $userDetails->GetBio());
    }
/************************************** TESTING ******************************************/

}

?>