<?php
require_once(__DIR__ . '/../../Packages/vendor/autoload.php');

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
use Dotenv\Dotenv;


class PhotoService {
    private $s3;
    private $bucket = 'rovaly-uploads';

    public function __construct() {
        // Load .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $this->s3 = new S3Client([
            'region' => $_ENV['AWS_REGION'],
            'version' => 'latest',
            'credentials' => new Credentials(
                $_ENV['AWS_ACCESS_KEY_ID'],
                $_ENV['AWS_SECRET_ACCESS_KEY']
            )
        ]);
    }

    public function GetPresignedPhotoUrl($key) {
        try {
            $cmd = $this->s3->getCommand('GetObject', [
                'Bucket' => $this->bucket,
                'Key'    => $key,
            ]);

            $request = $this->s3->createPresignedRequest($cmd, '+10 minutes');
            return (string) $request->getUri();
        } catch (Exception $e) {
            error_log("S3 Error: " . $e->getMessage());
            return null;
        }
        //return 'https://rovaly-assets.s3.us-east-2.amazonaws.com/UserDefault.png'; 
    }
     
    public function UploadPhoto(string $key, string $filePath, string $contentType): ?string {
        try {
            $result = $this->s3->putObject([
                'Bucket'     => $this->bucket, // 'rovaly-uploads'
                'Key'        => $key,          // The desired S3 object key 
                'SourceFile' => $filePath,     // The temporary path of the uploaded file on your server
                'ContentType' => $contentType // The MIME type, e.g., 'image/jpeg'
                // 'ACL'        => 'public-read'  // Makes the object publicly readable via its URL
            ]);
            // Return the URL of the uploaded object
            return (string) $result->get('ObjectURL');
        } catch (Exception $e) {
            // return $e->getMessage();
            error_log("S3 Upload Error: " . $e->getMessage());
            return null;
        }
    }  
}