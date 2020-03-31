<?php

class User{

    private $username;
    private $email;
    private $password;
    private $userRole;

    function setUsername($username){
    
        $this->username = $username;
    }
    
    function setEmail($email){

        $this->email = $email;
    }

    function setPassword($password){

        $this->password = $password;
    }

    function setRole($role){

        $this->userRole = $role;
    }

    function getUsername(){

        return $this->username;
    }

    function getEmail(){

        return $this->email;
    }

    function getPassword(){
        
        return $this->password;
    }

    function getRole(){
        
        return $this->userRole;
    }
}

?>