<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../QueryHelper.php");


class ProfileService{
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    // insert a new S3 url link for a user; this should be called inside logic to CreateProfile
    public function AddProfilePictureToUser(int $userKey, string $photoUrl){
        $this->da->ExcuteQuery("INSERT INTO ProfilePhoto (UserKey, ProfileUrl) VALUES"
            . $userKey . "," . $photoUrl . ")", QueryType::INSERT);
    }

    // update a users full name and bio
    public function UpdateUserInfo(int $userKey, string $fullName, string $bio){
        $this->da->ExecuteQuery("UPDATE User SET 
            FullName=" .  $fullName . "," . 
            "Bio=" . $bio . "," . 
            "WHERE UserKey=" . $userkey . ")", QueryType::UPDATE);
    }

    // add a user's social media link to the SocialMediaLink Table
    public function AddSocialMediaLink(int $userKey, string $url){
         $this->da->ExcuteQuery("INSERT INTO SocialMediaLink (UserKey, SocialMediaLinkUrl) VALUES"
            . $userKey . "," . $url . ")", QueryType::INSERT);
    }

    public function GetMileRangeTypes(): array{
        //TODO; use a SELECT query and a list array of MileRangeTypeObjects
    }

    //add mile range preference to user
    public function AddMileRangePreferencesToUser(int $userKey, int $mileRangeTypeKey){
        $this->da->ExcuteQuery("INSERT INTO MileRange (MileRangeTypeKey, UserKey) VALUES"
            . $mileRangeTypeKey . "," . $userKey . ")", QueryType::INSERT);
    }


    // TODO; may need to specify the WHERE Table.Key rather than just Key; test with DB
    /* 
    $url = $this->da->ExcuteQuery("SELECT SocialMediuaLinkUrl FROM SocialMediaLink WHERE UserKey=" . $userKey . ")", QueryType::SELECT);
    OR 
    $url = $this->da->ExcuteQuery("SELECT SocialMediuaLinkUrl FROM SocialMediaLink WHERE SoccialMediaLink.UserKey=" . $userKey . ")", QueryType::SELECT);
    
    LOOKS LIKE IT MAY RETURN THE SAME VALUE(s)
    */
    
    public function GetSocialMediaLink(int $userKey): string{
        //TODO; SELECT
        $url = $this->da->ExcuteQuery("SELECT SocialMediuaLinkUrl FROM SocialMediaLink WHERE UserKey=" . $userKey . ")", QueryType::SELECT);
        return $url;
    }

    public function GetUserDetails(int $userKey){
        //TODO; write a UserDetail object to call/store these values
        $UserDetails->$fullName = $this->da->ExcuteQuery("SELECT FullName FROM User WHERE UserKey=" . $userKey . ")", QueryType::SELECT);
        $UserDetails->$bio = $this->da->ExcuteQuery("SELECT Bio FROM User WHERE UserKey=" . $userKey . ")", QueryType::SELECT);
        return $UserDetails;
    }

    public function GetProfilePictureUrl(int $userKey): string{
        //TODO; SELECT; need to distinguish between table and row name 'ProfilePhoto'
        $photoUrl = $this->da->ExcuteQuery("SELECT ProfilePhoto FROM ProfilePhoto WHERE UserKey=" . $userKey . ")", QueryType::SELECT);
        return $photoUrl;
    }

    public function GetMileRangePreference(int $userKey): int{
        //TODO; SELECT

    }

}
?>
