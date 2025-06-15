<?php
// General tip: Enums are generally better than hard-coded strings when you need string "constants" 
enum PreferenceTypeEnum: int {
    case SkillLevel = 1;
    case Attitude = 2;
}
?>