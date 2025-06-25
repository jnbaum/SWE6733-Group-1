<?php
////////////////////////////////// TESTING ////////////////////////////////////////////////////////////
session_start(); // starts the php session to store user data like error messasges
////////////////////////////////// TESTING ////////////////////////////////////////////////////////////

$bodyClass = 'index-background';
include("head.php"); 

// Testing backend: create user and login
////////////////////////////////// TESTING ////////////////////////////////////////////////////////////
require_once(__DIR__ . '/../BusinessLogic/Services/UserService.php');
require_once(__DIR__ . '/../BusinessLogic/AllServices.php'); 
////////////////////////////////// TESTING ////////////////////////////////////////////////////////////
// $userService = $allServices->GetUserService();
// $userService->CreateNewUser("example", "example");
// if($userService->IsValidUser("example", "example") != null) {
//   echo "User valid!";
// }

////////////////////////////////// TESTING ////////////////////////////////////////////////////////////
$userService = $allServices->GetUserService(); // retrieves instance of UserService from the $allServices

$signupError = null; // holds sign-up error messages
$signinError = null; // holds sign-in error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") { // checks if form was submitted via POST
    $enteredEmail = $_POST["email_address"] ?? '';   // empty string for empty value handling
    $enteredPassword = $_POST["password"] ?? '';   // empty string for empty value handling

    if (isset($_POST["signup"])) { // if the 'SIGN UP' button was clicked
        if (empty($enteredEmail) || empty($enteredPassword)) { // use empty() for to check for empty strings
            $signupError = "Please enter both email and password to sign up.";
        } else {
            $insertedUserKey = $userService->CreateNewUser($enteredEmail, $enteredPassword); // calls UserService to create a new user

            if ($insertedUserKey === null) { // checks if user creation failed such as email already taken
                $signupError = "Email address is taken. Please choose a different one."; // sets the error message
            } else {
                $_SESSION['user_id'] = $insertedUserKey; // stores new user ID in the session
                header("Location: createProfile.php"); // redirects to createProfile.php after successful sign-up
                exit(); // ends script
            }
        }
    } else if (isset($_POST["signin"])) { // if the 'SIGN IN' button was clicked
        if (empty($enteredEmail) || empty($enteredPassword)) { // use empty() for to check for empty strings
            $signinError = "Please enter both email and password to sign in.";
        } else {
            $userKey = $userService->IsValidUser($enteredEmail, $enteredPassword); // calls UserService to validate the user

            if ($userKey === null) { // checks if user validation failed
                $signinError = "Invalid email or password."; // sets the error message
            } else {
                $_SESSION['user_id'] = $userKey; // stores user ID in the session
                header("Location: dashboard.php"); // redirects to dashboard.php after successful sign-in
                exit(); // ends script
            }
        }
    }
}
////////////////////////////////// TESTING /////////////////////////////////////////////////////////////
?>
</body>
</html>

<div class="login-wrap d-flex align-items-stretch vh-100">
  <div class="login-box d-flex flex-column justify-content-center p-5">
    <h1 class="logo-text text-center mb-5">Rovaly</h1>
    <p class="welcome text-center mb-4">Welcome!</p>
<!------------------------------ TESTING ----------------------------------------------------->
    <!-- if statement - checks whether php variable "$signupError" is set to true or empty (null) -->
    <form method="POST" action=""> <?php if ($signupError): ?> <div class="alert alert-danger text-center" role="alert">
        <?php echo $signupError; ?>
      </div>
    <?php endif; ?>

    <!-- if statement - variable and value exists, the php statement will print directly into the html -->
    <?php if ($signinError): ?> <div class="alert alert-danger text-center" role="alert">
        <?php echo $signinError; ?>
      </div>
    <?php endif; ?>
<!------------------------------ TESTING ----------------------------------------------------->
      <div class="mb-4">
        <input type="email" class="form-control input-round text-center" placeholder="Email Address" name="email_address"> 
        <!-- added name="email_address" to input -->
      </div>
      <div class="mb-5">
        <input type="password" class="form-control input-round text-center" placeholder="Password" name="password">
        <!-- added name="password" to input -->
      </div>
      <div class="d-flex justify-content-center gap-5">
        <button type="submit" class="btn btn-brand" name="signin">SIGN IN</button> <!-- added 'name="signin"' -->
        <button type="submit" class="btn btn-brand" name="signup">SIGN UP</button>
        <!-- changed type from "button" to "submit", removed 'onclick', added 'name="signup"' -->
         
        <!-- TODO(Jake's advice): make this a submit button too, then: 1) set session variable in form action with error message, 
         and 2) redirect back to this page inside the form action. 
         If error message session variable is NOT set on this page (meaning login was successful), then redirect to create profile. -->
      </div>
    </form>
  </div>
</div>
</body>
</html>