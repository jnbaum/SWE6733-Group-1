<?php 
require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../Models/AdventureType.php");
require_once(__DIR__ . "/../Models/PreferenceTypeEnum.php");

$adventureService = $allServices->GetAdventureService();
?>
<html>
<body>
    <form action="../BusinessLogic/Actions/SaveAdventure.php" method="POST">
        
        <select name="adventureTypeKey"> <!-- name attribute is important so that SaveAdventure.php form action can know what to get from the POST request (form submission) -->
            <?php
                $adventureTypes = $adventureService->GetAdventureTypes();
                foreach($adventureTypes as $adventureType) {
                    echo '<option value="' . $adventureType->GetAdventureTypeKey() . '">' . $adventureType->GetName() . '</option>';
                }
            ?>
        </select>
        <select name="skillLevelPreferenceKey"> 
            <?php
                $preferenceTypeKey = PreferenceTypeEnum::SkillLevel->value;
                $skillLevelPreferences = $adventureService->GetPreferencesByPreferenceTypeKey((int)$preferenceTypeKey);
                foreach($skillLevelPreferences as $skillLevelPreference) {
                    echo '<option value="' . $skillLevelPreference->GetPreferenceKey() . '">' . $skillLevelPreference->GetName() . '</option>';
                }
            ?>
        </select>
        <select name="attitudePreferenceKey"> 
            <?php
                $preferenceTypeKey = PreferenceTypeEnum::Attitude->value;
                $attitudePreferences = $adventureService->GetPreferencesByPreferenceTypeKey((int)$preferenceTypeKey);
                foreach($attitudePreferences as $attiudePreference) {
                    echo '<option value="' . $attiudePreference->GetPreferenceKey() . '">' . $attiudePreference->GetName() . '</option>';
                }
            ?>
        </select>
        <input type="submit" value="Save Adventure">
    </form>
    <?php
        if(isset($_GET["adventureKey"])) {
            echo "Adventure saved with preferences in database with new AdventureKey: " . $_GET["adventureKey"];
        }
    ?>
    <h1>My Adventures</h1>
        <ul>
            <?php 
                $userKey = 1; // replace with $_SESSION['currentUserKey'] after login is implemented
                $adventureDetailsArray = $adventureService->GetAdventureDetailsArray(1);
                foreach($adventureDetailsArray as $adventureDetails) {
                    echo '<li>' . $adventureDetails->GetActivityName() . '-' . $adventureDetails->GetPreferencesString() . '</li>';
                }
            ?>
        </ul>
</body>
</html>