<?php
require_once("../DataAccess/DataAccess.php");
require_once("../BusinessLogic/Services/MessageService.php");

class AllServices {
        private MessageService $messageService;

        public function __construct() {
            $da = new DataAccess();
            $this->messageService = new MessageService($da);
        }

        public function GetMessageService() {
            return $this->messageService;
        }
    }

    $allServices = new AllServices();

?>