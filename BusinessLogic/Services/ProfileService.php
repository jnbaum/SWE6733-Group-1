<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../../Models/UserDetails.php");
require_once(__DIR__ . "/../../Models/MileRangeType.php");
require_once(__DIR__ . "/../QueryHelper.php");


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
        $this->da->ExecuteQuery("INSERT INTO profilephoto (UserKey, ProfilePhoto) VALUES ("
            . $userKey . ", " . QueryHelper::SurroundWithQuotes($photoUrl) . ")", QueryType::INSERT);
    }

    public function GetProfilePictureUrl(int $userKey): string{
        //TODO; query is complete but DB needs to change the ProfilePhoto type from blob to varchar?
        $stmt = $this->da->ExecuteQuery("SELECT ProfilePhoto  FROM profilephoto WHERE UserKey=" . $userKey, QueryType::SELECT);
        while($row = $stmt->fetchAssociative()){
            $photoUrl = (string)$row['ProfilePhoto'];
        }
        return $photoUrl;
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
    public function GetMileRangePreference(int $userKey): int{
        //COMPLETE;

        $stmt = $this->da->ExecuteQuery("SELECT DistanceMiles 
            FROM milerange INNER JOIN milerangetype ON 
            milerange.MileRangeTypeKey = milerangetype.MileRangeTypeKey
            WHERE milerange.UserKey =" . $userKey, QueryType::SELECT);
        
        $mileRangeTypes = [];
        //https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/reference/data-retrieval-and-manipulation.html
        while($row = $stmt->fetchAssociative()) {
            $mileRangePreference = (int)($row['DistanceMiles']);
        }
        return $mileRangePreference;
    }


    function createNewUserProfile(
    string $fullName,
    string $bio,
    string $profilePhotoUrl,
    string $socialMediaUrl,
    int $mileRangeTypeKey
): int {

    global $allServices;
    $profileService = $allServices->GetProfileService(); 
    $dataAccess = new DataAccess(); 


    try {
        $initialUserInsertQuery = "INSERT INTO user (FullName) VALUES ('Initial Name')"; // Placeholder query
        $newUserKey = $dataAccess->ExecuteQuery($initialUserInsertQuery, QueryType::INSERT);

        if (!is_int($newUserKey) || $newUserKey <= 0) {
            throw new Exception("Failed to create initial user record or retrieve UserKey.");
        }

    } catch (Exception $e) {
        // Handle database error or key generation failure
        echo "Error during initial user creation: " . $e->getMessage();
        return 0; // Indicate failure
    }

    try {
        // Update user's full name and bio 
        $profileService->UpdateUserInfo($newUserKey, $fullName, $bio); 

        // Add profile picture URL
        $profileService->AddProfilePictureToUser($newUserKey, $profilePhotoUrl);

        // Add social media link (e.g., Instagram)
        $profileService->AddSocialMediaLink($newUserKey, $socialMediaUrl);

        // Add mile range preference
        $profileService->AddMileRangePreferencesToUser($newUserKey, $mileRangeTypeKey); 

        return $newUserKey; // Return the key of the newly created user
    } catch (Exception $e) {
        // Handle errors during profile population
        echo "Error populating user profile: " . $e->getMessage();
        // Depending on error, you might want to clean up the initial user record
        return 0; // Indicate failure
    }
}

}
?>
