<?php
require_once(__DIR__ . "/../../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../../Models/UserDetails.php");
require_once(__DIR__ . "/../../Models/MileRangeType.php");
require_once(__DIR__ . "/../QueryHelper.php");


class UserService {
    private DataAccess $da;
    public function __construct($da) {
        $this->da = $da;
    }

    public function IsValidUser(string $enteredEmail, string $enteredPassword): ?int {
        $query = "SELECT * FROM User WHERE Username=" . QueryHelper::SurroundWithQuotes($enteredEmail) . " LIMIT 1";
        $stmt = $this->da->ExecuteQuery($query, QueryType::SELECT);
        $row = $stmt->fetchAssociative(); 
        // password_verify($plainTextPassword, $passwordHash) - returns true if the plain text password matches passwordHash after hash from password_hash() is applied
        // https://www.phptutorial.net/php-tutorial/php-password_verify/
        if($row && password_verify($enteredPassword, $row['PasswordHash'])) { // if a User was found in database with that username and entered password was valid
            return $row['UserKey'];
        }
        return null;
    }

    public function CreateNewUser(string $enteredEmail, string $enteredPassword): ?int {
        $query = "SELECT * FROM User WHERE Username=" . QueryHelper::SurroundWithQuotes($enteredEmail) . " LIMIT 1";
        $stmt = $this->da->ExecuteQuery($query, QueryType::SELECT);
        $row = $stmt->fetchAssociative();
        if($row) {
            return null; // User already exists
        }
        $passwordHash = password_hash($enteredPassword, PASSWORD_BCRYPT);
        $insertedUserKey = $this->da->ExecuteQuery("INSERT INTO User(Username, PasswordHash) VALUES(" 
        . QueryHelper::SurroundWithQuotes($enteredEmail) . ", " . QueryHelper::SurroundWithQuotes($passwordHash) . ")", QueryType::INSERT);

        return $insertedUserKey;
    }

}
?>
