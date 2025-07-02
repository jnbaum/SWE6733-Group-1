<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../../Models/Adventure.php");
require_once(__DIR__ . "/../../Models/Preference.php");
require_once(__DIR__ . "/../../Models/AdventureDetails.php");
require_once(__DIR__ . "/../QueryHelper.php");

class AdventureService {
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    public function ping() {
        echo "Test";
    }

    public function GetAdventureTypes(): array {
        $stmt = $this->da->ExecuteQuery("SELECT * FROM adventuretype", QueryType::SELECT);
        $adventureTypes = [];
        //https://www.doctrine-project.org/projects/doctrine-dbal/en/4.2/reference/data-retrieval-and-manipulation.html
        while($row = $stmt->fetchAssociative()) {
            $adventureType = new AdventureType($row['Name']);
            $adventureType->SetAdventureTypeKey($row['AdventureTypeKey']);
            $adventureTypes[] = $adventureType;
        }
        return $adventureTypes;
    }

    // Returns the AdventureKey of the newly inserted Adventure record
    public function CreateAdventure(Adventure $adventure): int {
        $insertedAdventureKey = $this->da->ExecuteQuery("INSERT INTO adventure (AdventureTypeKey, UserKey) VALUES (" 
            . $adventure->GetAdventureTypeKey() . ","
            . $adventure->GetUserKey() . ")", QueryType::INSERT);
        return $insertedAdventureKey;
    }

    public function AddPreferencesToAdventure(int $adventureKey, array $preferenceKeys) {
        // Build string for query
        $insertValuesString = "";
        foreach($preferenceKeys as $preferenceKey) {
            $insertValuesString = $insertValuesString . $this->BuildAdventurePreferenceValueString($adventureKey, $preferenceKey);
            if($preferenceKey != end($preferenceKeys)) {
                $insertValuesString = $insertValuesString . ",";
            }
        }
 
        // Bulk insert AdventurePreference records to tie preferences to adventure in an efficient fashion
        $this->da->ExecuteQuery("INSERT INTO adventurepreference (AdventureKey, PreferenceKey) VALUES" 
            . $insertValuesString, QueryType::INSERT);
        
    }

    public function GetPreferencesByPreferenceTypeKey(int $preferenceTypeKey): array {
        $stmt = $this->da->ExecuteQuery("SELECT * FROM preference WHERE PreferenceTypeKey=" . $preferenceTypeKey, QueryType::SELECT);
        $preferences = [];
        while($row = $stmt->fetchAssociative()) {
            $preference = new Preference($row['PreferenceTypeKey'], $row['Name']);
            $preference->SetPreferenceKey($row['PreferenceKey']);
            $preferences[] = $preference;
        }
        return $preferences;
    }

     private function BuildAdventurePreferenceValueString(int $adventureKey, int $preferenceKey): string {
        return "(" . $adventureKey . "," . $preferenceKey. ")";
    }

    public function GetAdventureDetailsArray(int $userKey): array {
        $stmt = $this->da->ExecuteQuery("SELECT adventure.AdventureKey AS AdventureKey, adventureType.Name AS ActivityName, GROUP_CONCAT(preference.Name SEPARATOR '-') AS Preferences FROM adventurepreference
                INNER JOIN adventure ON adventurepreference.AdventureKey = adventure.AdventureKey
                INNER JOIN adventuretype ON adventure.AdventureTypeKey = adventuretype.AdventureTypeKey
                INNER JOIN preference ON adventurepreference.PreferenceKey = preference.PreferenceKey
                INNER JOIN preferencetype ON preferencetype.PreferenceTypeKey = preference.PreferenceTypeKey
                WHERE adventure.UserKey =" . $userKey .
                " GROUP BY adventure.AdventureKey", QueryType::SELECT);

        $adventureDetailsArray = [];
        while($row = $stmt->fetchAssociative()) {
            $adventureDetails = new AdventureDetails($row["ActivityName"], $row["Preferences"]);
            $adventureDetails->SetAdventureKey($row["AdventureKey"]);
            $adventureDetailsArray[] = $adventureDetails;
        }
        return $adventureDetailsArray;
    }
}
?>