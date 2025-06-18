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

    //TODO; MISSING milerange table; 
    //add mile range preference to user
    public function AddMileRangePreferencesToUser(int $userKey, int $mileRangeTypeKey){
        /*TESTING; created own milerange table from command below
        CREATE TABLE milerange ( 
            MileRangeKey int(11) NOT NULL AUTO_INCREMENT,  
            MileRangeTypeKey int(11) DEFAULT NULL, 
            UserKey int(11) DEFAULT NULL,  
            PRIMARY KEY (MileRangeKey), 
            FOREIGN KEY (MileRangeTypeKey) REFERENCES milerangetype(MileRangeTypeKey), 
            FOREIGN KEY (UserKey) REFERENCES user(UserKey)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

}



//METHOD TESTING
$da = new DataAccess();
$profileService = new ProfileService($da);
$testKey = 1;
$testUrl = 'www.w3schools.com';
$profileService->AddSocialMediaLink($testKey, $testUrl);
echo "Socail Media Link: " . $profileService->GetSocialMediaLink($testKey);
echo "\n";

$testFullName = "Type type type Doe";
$testBio= "Ttypew type tpyes";
$profileService->UpdateUserInfo($testKey, $testFullName, $testBio);
echo "UserDetail(s) Name: " .  $profileService->GetUserDetails($testKey)->GetFullName();
echo "\n";
echo "UserDetail(s) Bio: " .  $profileService->GetUserDetails($testKey)->GetBio();
echo "\n";

$testPhotoUrl = 'www.photourl.com';
$profileService->AddProfilePictureToUser($testKey, $testPhotoUrl);
echo "Profile Picture Url: " . $profileService->GetProfilePictureUrl($testKey);
echo "\n";


//requires records to exist in table
$mileranges = $profileService->GetMileRangeTypes();
echo "Mile Ranges: " . $mileranges[0]->GetMileRangeTypeKey() . "\n"; 
echo "Mile Ranges: " . $mileranges[0]->GetDistanceMiles();
echo "\n";
foreach ($mileranges as $x => $mileRangeType){
    echo "Mile Range Type " . $mileRangeType->GetMileRangeTypeKey() . " is: " . $mileRangeType->GetDistanceMiles() . "\n";
}


//requires milerange table to exist
$testMileRangeKey = 2;
$profileService->AddMileRangePreferencesToUser($testKey, $testMileRangeKey);

$distanceMiles = $profileService->GetMileRangePreference($testKey);

echo "Distance Miles from  User " . $testKey . " is: " . $distanceMiles;
echo "\n";
?>
