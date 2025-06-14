<?php 
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../Models/AdventureType.php");

?>
<html>
<body>
    <form action="../BusinessLogic/Actions/SaveAdventure.php" method="POST">
        
    <select name="adventureTypeKey"> <!-- name attribute is important so that SaveAdventure.php form action can know what to get from the POST request (form submission) -->
            <?php
                $adventureService = $allServices->GetAdventureService();
                $adventureTypes = $adventureService->GetAdventureTypes();
                foreach($adventureTypes as $adventureType) {
                    echo '<option value="' . $adventureType->GetAdventureTypeKey() . '">' . $adventureType->GetName() . '</option>';
                }
            ?>
        </select>
        <input type="submit" value="Save Adventure">
    </form>
    <?php
        if(isset($_GET["adventureKey"])) {
            echo "Adventure saved in database with new AdventureKey: " . $_GET["adventureKey"];
        }
    ?>
</body>
</html>