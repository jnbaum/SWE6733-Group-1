<?php
require_once __DIR__ . '/../../DataAccess/DataAccess.php';
require_once __DIR__ . '/../../BusinessLogic/Services/PhotoService.php';

use PHPUnit\Framework\TestCase;

class PhotoServiceTest extends TestCase
{
    public $da;
    public PhotoService $photoService;
    

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