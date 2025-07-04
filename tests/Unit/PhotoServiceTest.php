<?php
require_once(__DIR__ . '/../../Packages/vendor/autoload.php');
use Aws\Credentials\Credentials;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

$dotenv = Dotenv::createImmutable(getcwd()); // Make sure to run this test script in root directory via: Packages/vendor/bin/phpunit tests/Unit/PhotoServiceTest.php

// PHPUnit does not load environment variables from .env into the $_ENV variable ... it only loads it into getenv() and $_SERVER
// Manually copy over all variables from $_SERVER into $_ENV so that PhotoService can access.
// foreach ($_SERVER as $key => $value) {
//     $_ENV[$key] = $value;
// }
// Update: I created a bootstrap.php file locally that set $_ENV variables to AWS keys. DO NOT MERGE IT.

require_once __DIR__ . '/../../DataAccess/DataAccess.php';
require_once __DIR__ . '/../../BusinessLogic/Services/PhotoService.php';


class PhotoServiceTest extends TestCase
{
    public $da;
    public PhotoService $photoService;
    
    public function setUp(): void
    {
        // Turn on error reporting in case there are warnings
        error_reporting(E_ALL);
    }

    /**
     * Test user validation method
     */
    public function testGetPresignedPhotoUrlIsNotNull()
    {
        $da = new DataAccess();
        $photoService = new PhotoService($da);

        //defining photokey
        $key = "1";
        
        // validate the url string is not null
        $this->assertNotNull($photoService->GetPresignedPhotoUrl($key));
        
    }

    public function testGetProfilePictureUrlIsNotDefault(){
        $da = new DataAccess();
        $photoService = new PhotoService($da);

        //defining photokey
        $key = "10";

        // validate that returned string is not default url
        $this->assertNotEquals($photoService->GetPresignedPhotoUrl($key), 'https://rovaly-assets.s3.us-east-2.amazonaws.com/UserDefault.png');
    }
}

?>