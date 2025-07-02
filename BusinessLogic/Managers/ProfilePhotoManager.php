    <?php
    require_once(__DIR__ . "/../Services/PhotoService.php");
    require_once(__DIR__ . "/../Services/ProfileService.php");
    // It's good practice to create a manager class when you want to create a method that uses multiple services (rather than making a service call another service)
    class ProfilePhotoManager {
        public function UploadProfilePhotoAndSaveS3Url(int $userKey, PhotoService $photoService, ProfileService $profileService) {
            $uploadMessage = "";
            if ($userKey === null) {
                $uploadMessage = "Error: User not logged in.";
            } elseif (isset($_FILES["profile_picture"]) && isset($_FILES["profile_picture"]["tmp_name"])) {
             

                $fileTmpPath = $_FILES["profile_picture"]["tmp_name"];
                $fileName = $_FILES["profile_picture"]["name"];
                $fileSize = $_FILES["profile_picture"]["size"];
                $fileType = $_FILES["profile_picture"]["type"];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Define allowed file types and max size
                $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
                $maxFileSize = 5 * 1024 * 1024; // 5 MB

                if (in_array($fileExtension, $allowedFileTypes)) { // && $fileSize <= $maxFileSize
                    // Generate a unique file name for S3 to avoid conflicts
                    // Using UserKey ensures each user has a distinct profile photo name.
                    $s3Key = "profile_pictures/user_" . $userKey . "." . $fileExtension;

                    // Call the new UploadPhoto method in PhotoService 
                    $s3Url = $photoService->UploadPhoto($s3Key, $fileTmpPath, $fileType);

                    if ($s3Url != null) {
                        // Add url of s3 photo to database in ProfilePicture table
                        $success = $profileService->UpdateProfilePictureUrl($userKey, $s3Url);

                        if ($success) {
                            $uploadMessage = "Profile picture uploaded successfully!";
                        } else {
                            $uploadMessage = "Error: Could not update profile picture URL in database.";
                        }
                    } else {
                        $uploadMessage = "Error: Could not upload picture to S3.";
                    }
                } else {
                    $uploadMessage = "Error: Invalid file type or size. Allowed types: JPG, PNG, GIF. Max size: 5MB.";
                }
            } else {
                $uploadMessage = "Error: No file uploaded or an upload error occurred.";
            }

            // Uncomment this to display photo upload message on dashboard page (will also need to uncomment echo statement on dashboard.php)
            // session_start();
            // $_SESSION["uploadMessage"] = $uploadMessage;
        }
    }