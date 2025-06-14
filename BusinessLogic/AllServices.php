<?php
require_once(__DIR__ . "/../DataAccess/DataAccess.php");
require_once(__DIR__ . "/../BusinessLogic/Services/MessageService.php");
require_once(__DIR__ . "/../BusinessLogic/Services/AdventureService.php");

// When adding a new service: 
//  1. Add a require_once statement at the top
//  2. Add a private variable and set it in the constructor
//  3. Create a public getter method so we can access the service outside of here
class AllServices {
        private MessageService $messageService;
        private AdventureService $adventureService;
        public function __construct() {
            $da = new DataAccess();
            $this->messageService = new MessageService($da);
            $this->adventureService = new AdventureService($da);
        }

        public function GetMessageService() {
            return $this->messageService;
        }

        public function GetAdventureService() {
            return $this->adventureService;
        }
    }

    $allServices = new AllServices();

?>