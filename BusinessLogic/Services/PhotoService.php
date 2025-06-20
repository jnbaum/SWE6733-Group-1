
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
    }
}

