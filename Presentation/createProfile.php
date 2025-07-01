<?php
$bodyClass = 'create-profile';
include("head.php");
include("header.php");

require_once(__DIR__ . "/../BusinessLogic/AllServices.php");
require_once(__DIR__ . "/../Models/AdventureType.php");
require_once(__DIR__ . "/../Models/PreferenceTypeEnum.php");

$allServices = new AllServices();
$uploadMessage = '';
$adventureService = $allServices->GetAdventureService(); 
$profileService = $allServices->GetProfileService();

?>

<main class="profile-container">
        <div class="profile-row">
             <form class="profile-form" action="../BusinessLogic/Actions/SaveProfile.php" method="POST" enctype="multipart/form-data">
            <!-- Left Column: Profile Picture and Delete Button -->
            <div class="profile-left-column">
                 <!-- header 4: "Edit/Create Profile -->
                <h4 class="profile-heading">Edit/Create Profile</h4>
                <div class="profile-card">
                    <div class="profile-picture-section">
                        <div class="profile-picture-placeholder">
                             <!-- Profile icon -->
                            <svg class="profile-picture-icon" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                         <!-- Upload profile picture -->
                        <label for="profile-picture" class="profile-upload-button" form action="" method="post" enctype="multipart/form-data">
                            Upload Picture
                            <input type="file" name="profile_picture" id="profile-picture" class="hidden-input">
                        </label>
                        <button class="profile-delete-button">Delete Profile</button>          
                    </div>
                </div>
            </div>

            <!-- Right Column: Profile Details & Adventure Preferences -->
            <div class="profile-right-column">
                <div class="profile-card">
                   
                        <!-- Name Fields -->
                        <div class="form-group name-form-group">
                            <label for="first-name" class="form-label" style="color: black;">Name</label>
                            <div class="name-fields form-field-wrapper">
                                <input type="text" name="first-name" class="form-input" id="first-name" placeholder="First" style="margin-right: 1rem;">
                                <input type="text" name="last-name" class="form-input" id="last-name" placeholder="Last">
                            </div>
                        </div>

                        <!-- Instagram Field -->
                        <div class="form-group instagram-form-group">
                            <label for="instagram" class="form-label" style="color: black;">Instagram</label>
                            <input type="url" name="instagramUrl" class="form-input form-field-wrapper" id="instagram" placeholder="URL">
                        </div>

                        <!-- Location Field -->
                        <div class="form-group location-form-group">
                            <label for="location" class="form-label" style="color: black;">Location &nbsp; &nbsp; &nbsp; &nbsp; Kennesaw, Georgia</label>
                            <!--<input type="text" class="form-input form-field-wrapper" id="location" value="Kennesaw, Georgia" style="text-align: left; border: none;"> -->
                        </div>

                        <!-- Match Range Field -->
                        <div class="form-group match-form-group">
                            <label for="match-range" class="form-label" style="color: black;">Match Range</label>
                            <!-------------------------- dropdown option ------------------------------------------>
                            <div class="dropdown-container">
                                <label for="myDropdown" class="sr-only">Choose an option</label>
                                <select id="myDropdown" name="myDropdown">
                                    <option value="disabled-option" disabled selected>Number</option>
                                    <?php
                                        $mileRangeOptions = $profileService->GetMileRangeTypes();
                                        foreach($mileRangeOptions as $mileRangeOption) {
                                            echo '<option value="' . $mileRangeOption->GetMileRangeTypeKey() . '">' . $mileRangeOption->GetDistanceMiles() . '</option>';
                                        }
                                    ?>
                                    <!-- <option value="option1">5</option>
                                    <option value="option2">10</option>
                                    <option value="option3">15</option>
                                    <option value="option4">20</option>
                                    <option value="option5">25</option> -->
                                </select>
                            </div>
                            <span class="ml-2">Miles</span>
                            <!-------------------------- dropdown option ------------------------------------------>
                        </div>

                        <!-- Adventure Types -->
                       <!-- Adventure Types -->
                        <div class="form-group">
                            <label for="adventure-types" class="form-label" style="color: black;">Adventure Types</label>
                            <a href="javascript:void(0);" onclick="openModal()" class="link-text form-field-wrapper">
                             + <span class="underline-me">Click to add</span>
                            </a>
                        </div>

                        <!-- Biography -->
                        <div class="form-group bio-form-group">
                            <label for="bio" class="form-label" style="color: black;">Bio</label>
                            <textarea name="bio" class="form-textarea form-field-wrapper" id="bio" rows="5"></textarea>
                        </div>

                        <input type="hidden" id="pendingAdventures" name="pendingAdventures">

                        <div class="form-group submit-form-group">
                            <button type="submit" class="submit-button">Create Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- TODO: Uncomment this section and style it so that it appears to the right of the page 
         - Also, set userKey to the userKey of the logged in user via a session variable -->
        <!-- <ul>
            <?php 
                //$userKey = 1; // replace with $_SESSION['currentUserKey'] after login is implemented
                //$adventureDetailsArray = $adventureService->GetAdventureDetailsArray(1);
                //foreach($adventureDetailsArray as $adventureDetails) {
                //   echo '<li>' . $adventureDetails->GetActivityName() . '-' . $adventureDetails->GetPreferencesString() . '</li>';
                //}
            ?>
        </ul> -->

        <!-- TODO: style this -->
        <p>Pending Adventures:</p>
        <ul id="adventuresToAddList">
           
        <ul>
          
    </main>
<!---------------------- Modal --------------------------------->
                    <form action="" method="POST">
                        <div id="customModal" class="modal">
                            <div class="modal-content">
                               <p>Choose your adventure type:</p>
                                <div class="dropdown-container">
                                    <select id="myDropdown2" name="adventureTypeKey" onchange="setSelectedAdventureTypeName(this.options[this.selectedIndex].text)">
                                    <option disabled selected>Adventure</option>
                                    <?php
                                   $adventureTypes = $adventureService->GetAdventureTypes();
                                    foreach($adventureTypes as $adventureType) {
                                        echo '<option value="' . $adventureType->GetAdventureTypeKey() . '">' . $adventureType->GetName() . '</option>';
                                    }
                                    ?>
                                    </select>
                                </div>

                            <div class="dropdown-container">
                                <select id="myDropdown3" name="skillLevelPreferenceKey" onchange="setSelectedSkillLevelName(this.options[this.selectedIndex].text)">
                                <option disabled selected>Skill Level</option>
                                <?php
                                $preferenceTypeKey = PreferenceTypeEnum::SkillLevel->value;
                                $skillLevelPreferences = $adventureService->GetPreferencesByPreferenceTypeKey((int)$preferenceTypeKey);
                                foreach($skillLevelPreferences as $skillLevelPreference) {
                                    echo '<option value="' . $skillLevelPreference->GetPreferenceKey() . '">' . $skillLevelPreference->GetName() . '</option>';
                                }
                                ?>
                                </select>
                            </div>

                            <div class="dropdown-container">
                            <select id="myDropdown4" name="attitudePreferenceKey" onchange="setSelectedAttitudeName(this.options[this.selectedIndex].text)">
                                <option disabled selected>Attitude</option>
                                <?php
                                    $preferenceTypeKey = PreferenceTypeEnum::Attitude->value;
                                    $attitudePreferences = $adventureService->GetPreferencesByPreferenceTypeKey((int)$preferenceTypeKey);
                                    foreach($attitudePreferences as $attiudePreference) {
                                        echo '<option value="' . $attiudePreference->GetPreferenceKey() . '">' . $attiudePreference->GetName() . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
            <button type="button" id="saveAdventureButton" onclick="addAdventureFromForm()" class="adventurebutton">Add Adventure</button>
             </form>
    <script>
        var adventures = [];
        var selectedAdventureTypeName = "";
        var selectedSkillLevelName = "";
        var selectedAttitudeName = "";

        // Add selected from Add Adventure modal to "Pending Adventures" section whenever modal save button is clicked
        // When the "create profile" button is finally clicked, it saves all the stored up adventures to the database at that time.
        function addAdventureFromForm() {
            var adventureTypeKey = $("#myDropdown2").val();
            var skillLevelPreferenceKey = $("#myDropdown3").val();
            var attitudePreferenceKey = $("#myDropdown4").val();

            if(adventureTypeKey == null || skillLevelPreferenceKey == null || attitudePreferenceKey == null) { // require all three modal fields to have an option selected
                return;
            }

            var objAdventure = {adventureTypeKey:adventureTypeKey, skillLevelPreferenceKey:skillLevelPreferenceKey, attitudePreferenceKey:attitudePreferenceKey}
            adventures.push(objAdventure);

            // Show pending adventure to add when submit button on create profile page is clicked
            var ul = document.getElementById("adventuresToAddList");
            var li = document.createElement('li');
            li.appendChild(document.createTextNode(selectedAdventureTypeName + "-" + selectedSkillLevelName + "-" + selectedAttitudeName));
            ul.appendChild(li);

            $("#pendingAdventures").val(JSON.stringify(adventures));

            $("#customModal").hide(); // close modal
        }
            

        function setSelectedAdventureTypeName(name) {
            selectedAdventureTypeName = name;
        }

        function setSelectedSkillLevelName(name) {
            selectedSkillLevelName = name;
        }

        function setSelectedAttitudeName(name) { 
            selectedAttitudeName = name;
        }
    </script>    
</body>
           
</html>
