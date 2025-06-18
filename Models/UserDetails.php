<?php
// TODO: create UserDetails class 
class UserDetails {
    private string $fullName;
    private string $bio;
    
    function __construct(string $fullName, string $bio) {
        $this->fullName = $fullName;
        $this->bio = $bio;
    }
    
    public function GetFullName(): string {
        return $this->fullName;
    }

    public function SetFullName(string $fullName) {
        $this->fullName = $fullName;
    }

    public function GetBio(): string {
        return $this->bio;
    }

    public function SetBio(string $bio) {
        return $this->bio;
    }

}