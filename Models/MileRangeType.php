<?php
// unsure about contructor and what getter/setter fucntions are needed
class MileRangeType {
    private int $mileRangeTypeKey;
    private int $distanceMiles;
    
    function __construct( int $mileRangeTypeKey,  int $distanceMiles) {
        $this->mileRangeTypeKey = $mileRangeTypeKey; //???
        $this->distanceMiles = $distanceMiles;
    }
    
    public function GetMileRangeTypeKey(): int {
        return $this->mileRangeTypeKey;
    }

    public function SetMileRangeTypeKey(int $mileRangeTypeKey) { //???
        $this->mileRangeTypeKey = $mileRangeTypeKey;
    }

    public function GetDistanceMiles(): int {
        return $this->distanceMiles;
    }

}