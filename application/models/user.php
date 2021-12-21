<?php
class User
{
    public $id;
    public $nickname;
    public $password;
    public $firstName;
    public $lastName;
    public $location;

    function __construct($id, $nickname, $password, $firstName, $lastName, $location) 
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->location = $location;
    }
}
?>