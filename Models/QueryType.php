<?php
// General tip: Enums are generally better than hard-coded strings when you need string "constants" 
enum QueryType {
    case SELECT;
    case UPDATE;
    case DELETE;
    case INSERT;
}
?>