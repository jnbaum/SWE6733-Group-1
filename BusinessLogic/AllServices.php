<?php
require_once(__DIR__ . "/../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../BusinessLogic/Services/MessageService.php");
require_once(__DIR__ . "/../BusinessLogic/Services/AdventureService.php");
require_once(__DIR__ . "/../BusinessLogic/Services/ProfileService.php");
<<<<<<< HEAD
require_once(__DIR__ . "/../BusinessLogic/Services/UserService.php"); 
=======
require_once(__DIR__ . "/../BusinessLogic/Services/UserService.php");
>>>>>>> 0f448b0506ce0d7a6b582f3d3f327a4d8edea07e

// When adding a new service: 
//  1. Add a require_once statement at the top
//  2. Add a private variable and set it in the constructor
//  3. Create a public getter method so we can access the service outside of here
class AllServices {
        private MessageService $messageService;
        private AdventureService $adventureService;
        private ProfileService $profileService;
        private UserService $userService;

        public function __construct() {
            $da = new DataAccess();
            $this->messageService = new MessageService($da);
            $this->adventureService = new AdventureService($da);
            $this->profileService = new ProfileService($da);
            $this->userService = new UserService($da);
        }

        public function GetMessageService() {
            return $this->messageService;
        }

        public function GetAdventureService() {
            return $this->adventureService;
        }

        public function GetProfileService() {
            return $this->profileService;
        }

<<<<<<< HEAD
        public function GetUserService(): UserService { 
        return $this->userService;

            
=======
        public function GetUserService() {
            return $this->userService;
        }
>>>>>>> 0f448b0506ce0d7a6b582f3d3f327a4d8edea07e
    }
 }
?>