<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../../Models/UserDetails.php");
require_once(__DIR__ . "/../../Models/MileRangeType.php");
require_once(__DIR__ . "/../QueryHelper.php");
require_once(__DIR__ . "/PhotoService.php");

use Doctrine\DBAL\Connection;

class ProfileService{
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    /*
        USER DETAILS
    */
    // update a users full name and bio
    public function UpdateUserInfo(int $userKey, string $fullName, string $bio){
        //COMPLETE
        $this->da->ExecuteQuery("UPDATE user SET FullName="
            .  QueryHelper::SurroundWithQuotes($fullName) . ", " . 
            "Bio=" . QueryHelper::SurroundWithQuotes($bio) . 
            " WHERE UserKey=" . $userKey  , QueryType::UPDATE);
    }

    public function GetUserDetails(int $userKey){
        //COMPLETE; write a UserDetail object to call/store these values; currently have each value stored as separate variable
        $stmt = $this->da->ExecuteQuery("SELECT * FROM user WHERE UserKey=" . $userKey , QueryType::SELECT);
        while($row = $stmt->fetchAssociative()){
            $userDetails = new UserDetails($row['FullName'], $row['Bio']);
        }
        return $userDetails;
    }

    public function GetProfilePictureUrl(int $userKey): ?string {
        $photoKey = $this->da->GetPhoto($userKey);

        if ($photoKey) {
            $photoService = new PhotoService();
            return $photoService->GetPresignedPhotoUrl($photoKey);
        } else {
            return 'https://rovaly-assets.s3.us-east-2.amazonaws.com/UserDefault.png'; 
        }
      }

    public function IsExistingProfilePhoto(int $userKey): bool {
         // Check if a profile photo record already exists for this user
        $existingPhoto = $this->da->ExecuteQuery(
            "SELECT ProfilePhotoKey FROM profilephoto WHERE UserKey = " . $userKey,
            QueryType::SELECT // Use QueryType::SELECT for fetching data 
        )->fetchAssociative();

        if($existingPhoto) {
            return true;
        }
        return false;
    }

 public function UpdateProfilePictureUrl(int $userKey, string $s3ImageName): bool {
        $query = "";
        if ($this->IsExistingProfilePhoto($userKey)) {
            // Update existing record in the `profilephoto` table 
            $query = "UPDATE profilephoto SET ProfilePictureUrl = "
                     . QueryHelper::SurroundWithQuotes($s3ImageName) . ", UploadTime = NOW() WHERE UserKey = " . $userKey;
            // For UPDATE, ExecuteQuery returns a statement object, not an ID.
            // A simple try-catch for the query execution is sufficient to determine success.
            $queryType = QueryType::UPDATE; // Use QueryType::UPDATE 
        } else {
            // Insert a new record into the `profilephoto` table 
            $query = "INSERT INTO profilephoto (UserKey, ProfilePictureUrl, UploadTime) VALUES ("
                     . $userKey . ", "
                     . QueryHelper::SurroundWithQuotes($s3ImageName) . ", NOW())";
            $queryType = QueryType::INSERT; // Use QueryType::INSERT 
        }

        try {
            // ExecuteQuery handles both INSERT and UPDATE based on QueryType 
            $this->da->ExecuteQuery($query, $queryType);
            return true;
        } catch (Exception $e) {
            error_log("Error updating profile picture URL for UserKey " . $userKey . ": " . $e->getMessage());
            return false;
        }
    }

    /*
        SOCIAL MEDIA URL
    */
    // add a user's social media link to the SocialMediaLink Table
    public function AddSocialMediaLink(int $userKey, string $url){
        //COMPLETE
         $this->da->ExecuteQuery("INSERT INTO socialmedialink (UserKey, SocialMediaLinkUrl) VALUES ("
            . $userKey . "," . QueryHelper::SurroundWithQuotes($url) . ")", QueryType::INSERT);
    }

       public function GetSocialMediaLink(int $userKey): string{
        //COMPLETE; SELECT
        $stmt = $this->da->ExecuteQuery("SELECT SocialMediaLinkUrl FROM socialmedialink  WHERE UserKey=" . $userKey, QueryType::SELECT);
        $url = '';
        while($row = $stmt->fetchAssociative()){
            $url = (string)$row['SocialMediaLinkUrl'];
        }
        return $url;
    }


     /*
        MILE  RANGE
    */
    // get mile range types
    public function GetMileRangeTypes(): array{
        //COMPLETE; use a SELECT query and a list array of MileRangeTypeObjects; sourced and modified from AdventureService.php
        $stmt = $this->da->ExecuteQuery("SELECT * FROM milerangetype", QueryType::SELECT);
        $mileRangeTypes = [];
        //https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/reference/data-retrieval-and-manipulation.html
        while($row = $stmt->fetchAssociative()) {
            $mileRangeType = new MileRangeType($row['MileRangeTypeKey'], $row['DistanceMiles']);
            #$mileRangeType->SetMileRangeTypeKey($row['MileRangeTypeKey']);
            $mileRangeTypes[] = $mileRangeType;
        }
        return $mileRangeTypes;
    }

    //TESTING; ADDED milerange table; MAY STILL HAVE ISSUES
    //add mile range preference to user
    public function AddMileRangePreferencesToUser(int $userKey, int $mileRangeTypeKey){
        /*TESTING; created own milerange table from command below
            the query below works based on table creation, does NOT update mile range preference BUT adds a new preferences
        */

        $this->da->ExecuteQuery("INSERT INTO milerange (MileRangeTypeKey, UserKey) VALUES ("
            . $mileRangeTypeKey . "," . $userKey . ")", QueryType::INSERT);
    }

    // get mile range preferences for user
    public function GetMileRangePreference(int $userKey): ?int{
        //COMPLETE;

        $stmt = $this->da->ExecuteQuery("SELECT DistanceMiles 
            FROM milerange INNER JOIN milerangetype ON 
            milerange.MileRangeTypeKey = milerangetype.MileRangeTypeKey
            WHERE milerange.UserKey =" . $userKey, QueryType::SELECT);
        
        $mileRangeTypes = [];
        //https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/reference/data-retrieval-and-manipulation.html
        $mileRangePreference = null; //initialize
        while($row = $stmt->fetchAssociative()) {
            $mileRangePreference = (int)($row['DistanceMiles']);
        }
        return $mileRangePreference;
    }

    public function DeleteAdventures(int $userKey) {
        $stmt = $this->da->ExecuteQuery("SELECT * FROM adventure WHERE UserKey = " . $userKey, QueryType::SELECT);
        $adventureKeys = [];
        $adventureKeysString = "";
        while($row = $stmt->fetchAssociative()) {
            $adventureKeys[] = $row["AdventureKey"];
        }
        
        // Build comma-separated string containing adventure keys to delete for query
        foreach($adventureKeys as $adventureKey) {
            $adventureKeysString = $adventureKeysString . (string)$adventureKey;
            if($adventureKey != end($adventureKeys)) {
                $adventureKeysString = $adventureKeysString + ",";
            }
        }

        $this->da->ExecuteQuery("DELETE FROM adventurepreference WHERE AdventureKey IN (" . $adventureKeysString . ")", QueryType::DELETE);
        $this->da->ExecuteQuery("DELETE FROM adventure WHERE AdventureKey IN (" . $adventureKeysString . ")", QueryType::DELETE);
    }

    // Delete from profilephoto
    public function DeleteUserProfilePicture($userKey): bool{
        try {
            // Check if the userKey exists
            $checkQuery = "SELECT COUNT(*) AS count FROM profilephoto WHERE UserKey = " . $userKey;
            $result = $this->da->ExecuteQuery($checkQuery, QueryType::SELECT)->fetchAssociative();

            if ($result && $result["count"] > 0) {
                // If it exists, delete the user
                $deleteQuery = "DELETE FROM profilephoto WHERE profilephoto.UserKey =" . $userKey;
                $this->da->ExecuteQuery($deleteQuery, QueryType::DELETE);

                return true; // Indicate success
            } else {
                return false; // UserKey not found
            }
        } catch (Exception $e) {
            error_log("Error deleting user profilephoto with UserKey $userKey: " . $e->getMessage());
            return false; // Indicate failure
        }
        //also delete picture from s3???
    }

    // Delete from socialmedialink
     public function DeleteUserSocialMediaLinkUrl($userKey): bool{
        try {
            // Check if the userKey exists
            $checkQuery = "SELECT COUNT(*) AS count FROM socialmedialink WHERE UserKey = " . $userKey;
            $result = $this->da->ExecuteQuery($checkQuery, QueryType::SELECT)->fetchAssociative();

            if ($result && $result["count"] > 0) {
                // If it exists, delete the user
                $deleteQuery = "DELETE FROM socialmedialink WHERE socialmedialink.UserKey =" . $userKey;
                $this->da->ExecuteQuery($deleteQuery, QueryType::DELETE);

                return true; // Indicate success
            } else {
                return false; // UserKey not found
            }
        } catch (Exception $e) {
            error_log("Error deleting user socialmedialink with UserKey $userKey: " . $e->getMessage());
            return false; // Indicate failure
        }
    }

    // Delete milerange Link
     public function DeleteUserMileRangePreference($userKey): bool{
        try {
            // Check if the userKey exists
            $checkQuery = "SELECT COUNT(*) AS count FROM milerange WHERE UserKey = " . $userKey;
            $result = $this->da->ExecuteQuery($checkQuery, QueryType::SELECT)->fetchAssociative();

            if ($result && $result["count"] > 0) {
                // If it exists, delete the user
                $deleteQuery = "DELETE FROM milerange WHERE milerange.UserKey =" . $userKey;
                $this->da->ExecuteQuery($deleteQuery, QueryType::DELETE);

                return true; // Indicate success
            } else {
                return false; // UserKey not found
            }
        } catch (Exception $e) {
            error_log("Error deleting user milerange with UserKey $userKey: " . $e->getMessage());
            return false; // Indicate failure
        }
    }

    // Delete messages
     public function DeleteUserMessages($userKey): bool{
        try {
            // Check if the userKey exists
            $checkQuery = "SELECT COUNT(*) AS count FROM message WHERE message.SendingUserKey = " . $userKey . " OR message.RecipientUserKey= ". $userKey;
            $result = $this->da->ExecuteQuery($checkQuery, QueryType::SELECT)->fetchAssociative();

            if ($result && $result["count"] > 0) {
                // If it exists, delete the user
                $deleteQuery = "DELETE FROM message WHERE message.SendingUserKey =" . $userKey . " OR message.RecipientUserKey =" . $userKey;
                $this->da->ExecuteQuery($deleteQuery, QueryType::DELETE);

                return true; // Indicate success
            } else {
                return false; // UserKey not found
            }
        } catch (Exception $e) {
            error_log("Error deleting user message(s) with UserKey $userKey: " . $e->getMessage());
            return false; // Indicate failure
        }
    }

    // Delete chatroom
     public function DeleteUserChatrooms($userKey): bool{
        try {
            // Check if the userKey exists
            $checkQuery = "SELECT COUNT(*) AS count FROM chatroom WHERE chatroom.FirstUserKey = " . $userKey . " OR chatroom.SecondUserKey= ". $userKey;
            $result = $this->da->ExecuteQuery($checkQuery, QueryType::SELECT)->fetchAssociative();

            if ($result && $result["count"] > 0) {
                // If it exists, delete the user
                $deleteQuery = "DELETE FROM chatroom WHERE chatroom.FirstUserKey =" . $userKey . " OR chatroom.SecondUserKey =" . $userKey;
                $this->da->ExecuteQuery($deleteQuery, QueryType::DELETE);

                return true; // Indicate success
            } else {
                return false; // UserKey not found
            }
        } catch (Exception $e) {
            error_log("Error deleting user chatroom(s) with UserKey $userKey: " . $e->getMessage());
            return false; // Indicate failure
        }
     }
    
     // Delete interaction
     public function DeleteUserInteractions($userKey): bool{
        try {
            // Check if the userKey exists
            $checkQuery = "SELECT COUNT(*) AS count FROM interaction WHERE interaction.ActingUserKey = " . $userKey . " OR interaction.OtherUserKey= ". $userKey;
            $result = $this->da->ExecuteQuery($checkQuery, QueryType::SELECT)->fetchAssociative();

            if ($result && $result["count"] > 0) {
                // If it exists, delete the user
                $deleteQuery = "DELETE FROM interaction WHERE interaction.ActingUserKey = " . $userKey . " OR interaction.OtherUserKey= ". $userKey;
                $this->da->ExecuteQuery($deleteQuery, QueryType::DELETE);

                return true; // Indicate success
            } else {
                return false; // UserKey not found
            }
        } catch (Exception $e) {
            error_log("Error deleting user interaction(s) with UserKey $userKey: " . $e->getMessage());
            return false; // Indicate failure
        }
     }

     // Delete interaction
     public function DeleteUser($userKey): bool{
        try {
            // Check if the userKey exists
            $checkQuery = "SELECT COUNT(*) AS count FROM user WHERE user.UserKey =" . $userKey;
            $result = $this->da->ExecuteQuery($checkQuery, QueryType::SELECT)->fetchAssociative();

            if ($result && $result["count"] > 0) {
                // If it exists, delete the user
                $deleteQuery = "DELETE FROM user WHERE user.UserKey =" . $userKey;
                $this->da->ExecuteQuery($deleteQuery, QueryType::DELETE);

                return true; // Indicate success
            } else {
                return false; // UserKey not found
            }
        } catch (Exception $e) {
            error_log("Error deleting user with UserKey $userKey: " . $e->getMessage());
            return false; // Indicate failure
        }
     }

    // this function populates profile details for an existing user.
    // accepts the userKey obtained from UserService.php after user is created.
    function createNewUserProfile(
        int $userKey, // added userKey as parameter
        string $fullName,
        string $bio,
        string $socialMediaUrl,
        int $mileRangeTypeKey
    ): int {

        global $allServices;
        $profileService = $allServices->GetProfileService();

        try {
            // update user full name and bio
            $profileService->UpdateUserInfo($userKey, $fullName, $bio);

            // add social media link (e.g., Instagram)
            $profileService->AddSocialMediaLink($userKey, $socialMediaUrl);

            // add mile range preference
            $profileService->AddMileRangePreferencesToUser($userKey, $mileRangeTypeKey);

            return $userKey; // return userKey of the profile that was just updated
        } catch (Exception $e) {
            // handle errors during profile population
            error_log("Error populating user profile for UserKey $userKey: " . $e->getMessage());
            return 0; // failure
        }
    }
    function DeleteUserProfile(
        int $userKey, // added userKey as parameter
    ): bool {

        global $allServices;
        $profileService = $allServices->GetProfileService();

        try {
            // delete profile photo
            $profileService->DeleteUserProfilePicture($userKey);

            // delete mile range preference
            $profileService->DeleteUserMileRangePreference($userKey);
            
            // delete social media link
            $profileService->DeleteUserSocialMediaLinkUrl($userKey);
            
            // delete messages
            $profileService->DeleteUserMessages($userKey);
            
            // delete chatrooms
            $profileService->DeleteUserChatrooms($userKey);

            //delete interatcions
            $profileService->DeleteUserInteractions($userKey);

            //delete advenutres
            $profileService->DeleteAdventures($userKey);

            //delete user
            $profileService->DeleteUser($userKey);

            return true; // return true that the profile that was just deleted
        } catch (Exception $e) {
            // handle errors during profile deletion
            error_log("Error deleting user profile for UserKey $userKey: " . $e->getMessage());
            return false; // failure
        }
    }

}
