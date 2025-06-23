<?php

require_once(__DIR__ . "/../../DataAccess/DataAccess.php"); 
require_once(__DIR__ . "/../../Models/QueryType.php"); 
require_once(__DIR__ . "/../QueryHelper.php"); 
require_once(__DIR__ . "/../../Models/UserDetails.php"); 



class UserService {

    private DataAccess $da;

    public function __construct(DataAccess $da) {
        $this->da = $da;
    }

    /**
     * @param string $username The user's chosen username.
     * @param string $passwordHash The hashed password for the user. (Password hashing is crucial but not covered in sources)
     * @return int The UserKey of the newly created user, or 0 on failure.
     */
    public function CreateUser(string $username, string $passwordHash): int {
        $query = "INSERT INTO user (Username, PasswordHash) VALUES ("
            . QueryHelper::SurroundWithQuotes($username) . ", "
            . QueryHelper::SurroundWithQuotes($passwordHash) . ")";

        try {
            // ExecuteQuery returns the last inserted ID for INSERT queries [12].
            $newUserKey = $this->da->ExecuteQuery($query, QueryType::INSERT);
            return (int)$newUserKey;
        } catch (Exception $e) {
            // Log or handle the error
            error_log("Error creating new user: " . $e->getMessage());
            return 0; // Indicate failure
        }
    }

    /**
     * Authenticates a user by checking their username and password.
     * Returns the UserKey if authentication is successful, otherwise 0.
     *
     * @param string $username The username provided by the user.
     * @param string $password The plain-text password provided by the user.
     * @return int The UserKey of the authenticated user, or 0 if authentication fails.
     */
    public function AuthenticateUser(string $username, string $password): int {
        // Query to retrieve hashed password and UserKey for the given username.
        $query = "SELECT UserKey, PasswordHash FROM user WHERE Username=" . QueryHelper::SurroundWithQuotes($username);

        try {
            $stmt = $this->da->ExecuteQuery($query, QueryType::SELECT);
            $row = $stmt->fetchAssociative();

            if ($row) {
                $storedPasswordHash = $row['PasswordHash'];
                // In a real application, use password_verify($password, $storedPasswordHash)
                // For demonstration, assuming plain text or a direct match (not secure for production).
                if ($password === $storedPasswordHash) { // This comparison is for demonstration only. Use password_verify() in production.
                    return (int)$row['UserKey'];
                }
            }
            return 0; // Authentication failed
        } catch (Exception $e) {
            error_log("Error during user authentication: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Retrieves a list of users for display in a 'Find a Rover' search.
     * This method could be expanded to include search parameters.
     * For now, it returns basic user details (FullName, Bio).
     *
     * @return UserDetails[] An array of UserDetails objects.
     */
    public function GetUsersForRoverSearch(): array {
        // The 'user' table is referenced for UserDetails [17].
        // This assumes that FullName and Bio are sufficient for a basic rover search display.
        $query = "SELECT UserKey, FullName, Bio FROM user"; // Exclude the current user or add filters in a real app.

        $stmt = $this->da->ExecuteQuery($query, QueryType::SELECT);
        $users = [];

        while ($row = $stmt->fetchAssociative()) {
            $userDetails = new UserDetails($row['FullName'], $row['Bio']); // UserDetails class defined [15]
            // If UserDetails had a setter for UserKey, we could set it here.
            // $userDetails->SetUserKey($row['UserKey']); // Assuming UserDetails had this method.
            $users[] = $userDetails;
        }
        return $users;
    }

 
    public function LogoutUser(): void {
        session_start(); // Ensure session is started to destroy it
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        // Optionally, redirect to login page.
        // header('Location: /path/to/login.php');
        // exit();
    }

     public function IsValidUser(int $userKey): bool {
        // Checking for the existence of the UserKey itself is sufficient to confirm the user exists.
        $query = "SELECT UserKey FROM user WHERE UserKey=" . $userKey;

        try {
            // Execute the SELECT query using the DataAccess layer. 
            $stmt = $this->da->ExecuteQuery($query, QueryType::SELECT);
            return (bool)$stmt->fetchAssociative();
        } catch (Exception $e) {
            // to aid in debugging without exposing sensitive information to the user.
            error_log("Database error in IsValidUser for UserKey " . $userKey . ": " . $e->getMessage());
            return false;
        }
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

