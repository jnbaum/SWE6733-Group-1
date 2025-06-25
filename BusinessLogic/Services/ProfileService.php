<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../../Models/UserDetails.php");
require_once(__DIR__ . "/../../Models/MileRangeType.php");
require_once(__DIR__ . "/../QueryHelper.php");
require_once(__DIR__ . "/PhotoService.php");


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


    /*
        PROFILEPHOTO
    */
    // insert a new S3 url link for a user; this should be called inside logic to CreateProfile
    public function AddProfilePictureToUser(int $userKey, string $photoUrl){
        //COMPLETE
        $this->da->ExecuteQuery("INSERT INTO photo (UserKey, PhotoUrl) VALUES ("
            . $userKey . ", " . QueryHelper::SurroundWithQuotes($photoUrl) . ")", QueryType::INSERT);
    }
    public function GetProfilePictureUrl(int $userKey): ?string {
        $photoKey = $this->da->GetPhoto($userKey);
      
        if ($photoKey) {
            $photoService = new PhotoService();
            return $photoService->GetPresignedPhotoUrl($photoKey);
        } else {
            return 'https://rovaly-assets.s3.us-east-2.amazonaws.com/DefaultPhoto.png'; 
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


    // this function populates profile details for an existing user.
    // accepts the userKey obtained from UserService.php after user is created.
    function createNewUserProfile(
        int $userKey, // added userKey as parameter
        string $fullName,
        string $bio,
        string $profilePhotoUrl,
        string $socialMediaUrl,
        int $mileRangeTypeKey
    ): int {

        global $allServices;
        $profileService = $allServices->GetProfileService();

        try {
            // update user full name and bio
            $profileService->UpdateUserInfo($userKey, $fullName, $bio);

            // add profile picture URL
            $profileService->AddProfilePictureToUser($userKey, $profilePhotoUrl);

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

}
?>
