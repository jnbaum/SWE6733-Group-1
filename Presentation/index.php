<?php
$bodyClass = 'index-background';
include("head.php"); 

// Testing backend: create user and login
// require_once(__DIR__ . '/../BusinessLogic/Services/UserService.php');
// require_once(__DIR__ . '/../BusinessLogic/AllServices.php');
// $userService = $allServices->GetUserService();
// $userService->CreateNewUser("example", "example");
// if($userService->IsValidUser("example", "example") != null) {
//   echo "User valid!";
// }
?>
</body>
</html>

<div class="login-wrap d-flex align-items-stretch vh-100">
  <div class="login-box d-flex flex-column justify-content-center p-5">
    <h1 class="logo-text text-center mb-5">Rovaly</h1>
    <p class="welcome text-center mb-4">Welcome!</p>
    <form>
      <div class="mb-4">
        <input type="email" class="form-control input-round text-center" placeholder="Email Address">
      </div>
      <div class="mb-5">
        <input type="password" class="form-control input-round text-center" placeholder="Password">
      </div>
      <div class="d-flex justify-content-center gap-5">
        <button type="submit" class="btn btn-brand">SIGN IN</button>
        <button type="button" class="btn btn-brand" onclick="window.location.href='createProfile.php'">SIGN UP</button> <!-- TODO: make this a submit button too, then: 1) set session variable in form action with error message, and 2) redirect back to this page inside the form action. If error message session variable is NOT set on this page (meaning login was successful), then redirect to create profile. -->
      </div>
    </form>
  </div>
</div>
</body>
</html>