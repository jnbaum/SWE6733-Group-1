<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../QueryHelper.php");

class MatchingService {
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    public function ping() {
        echo "Test";
    }

    public function GetPotentialMatches(int $userKey, int $mileRangePreferenceInMiles, int $percentLikes): array {
         // TODO: replace with matching algorithm, which will return an array of userKeys
        // return [1, 2, 3, 4];
        $query = "";
        $returnUserKeys = [];

        // Go through each scenario and modify the query accordingly
        // 0-50% likes scenario
        if($percentLikes >= 0 && $percentLikes <= 50) {
            $query = $this->GetPotentialMatchesStrictQuery($userKey, $mileRangePreferenceInMiles, 2); // Require 2 matched preferences with an adventure
        }
        else if ($percentLikes >= 50 && $percentLikes <= 75) {
            $query = $this->GetPotentialMatchesStrictQuery($userKey, $mileRangePreferenceInMiles, 1); // Require only 1 matched preference with an adventure
        }
        // TODO: 50-75%
        // TODO: >75%

        // Execute query if it was set
        if($query !== "") {
            $stmt = $this->da->ExecuteQuery($query, QueryType::SELECT);
             while($row = $stmt->fetchAssociative()) {
                $returnUserKeys[] = $row['UserKey'];
            }
             return $returnUserKeys;
        }
        return null;
    }

     // 0-50% Interactions are LIKE scenario
    private function GetPotentialMatchesStrictQuery(int $userKey, int $mileRangePreferenceInMiles, int $countOfMatchedPreferencesForAdventure): string {
            // TODO: filter out users that have already been matched with in this algorithm.
            return "WITH CurrUserPrefs AS ( 
            SELECT PreferenceKey, AdventureTypeKey, adventure.AdventureKey 
            FROM adventurepreference 
            INNER JOIN adventure ON adventurepreference.AdventureKey = adventure.AdventureKey 
            WHERE UserKey = " . $userKey . "), 
            OtherUserPrefs AS (
                select ap.PreferenceKey, a.AdventureTypeKey, a.UserKey, a.AdventureKey 
                from adventurepreference ap 
                INNER JOIN adventure a ON a.AdventureKey = ap.AdventureKey 
                INNER JOIN MileRange mr ON mr.UserKey = a.UserKey 
                INNER JOIN MileRangeType mrt ON mr.MileRangeTypeKey = mrt.MileRangeTypeKey 
                WHERE ap.PreferenceKey IN (SELECT PreferenceKey FROM CurrUserPrefs) 
                AND a.AdventureTypeKey IN (SELECT AdventureTypeKey FROM CurrUserPrefs) 
                AND mrt.DistanceMiles <= " . $mileRangePreferenceInMiles . " AND a.UserKey != " . $userKey . "
            ) 
            SELECT op.UserKey, op.PreferenceKey, op.AdventureTypeKey 
            FROM OtherUserPrefs op 
            INNER JOIN CurrUserPrefs 
            ON op.PreferenceKey = CurrUserPrefs.PreferenceKey AND op.AdventureTypeKey = CurrUserPrefs.AdventureTypeKey
            GROUP BY op.AdventureKey
            HAVING COUNT(*) >= " . $countOfMatchedPreferencesForAdventure . ";";
        }     

        // TODO: create a new method to not account for preferences at all
        
        
        
        public function RecordInteraction(int $actingUserKey, int $otherUserKey, bool $isLiked): bool {
            // Convert the PHP boolean value to an integer (1 for true, 0 for false)
            $isLikedDbValue = $isLiked ? 1 : 0;
            // Construct the SQL INSERT query to add a new interaction record.
            // User keys and the converted 'IsLiked' value are directly inserted as integers,
            $query = "INSERT INTO interaction (ActingUserKey, OtherUserKey, IsLiked) VALUES ("
                    . $actingUserKey . ", "
                    . $otherUserKey . ", "
                    . $isLikedDbValue . ")";
            try {
                // Execute the INSERT query using the DataAccess object.
                $this->da->ExecuteQuery($query, QueryType::INSERT);
                // If the query executes successfully without throwing an exception, return true.
                return true;
            } catch (Exception $e) {
                // Log any errors that occur during the database operation.
                error_log("Error recording interaction for UserKey " . $actingUserKey . " with OtherUserKey " . $otherUserKey . ": " . $e->getMessage());
                // Return false to indicate that the interaction recording failed.
                return false;
            }
        }
}
?>