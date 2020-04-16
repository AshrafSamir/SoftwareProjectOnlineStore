<?php

session_start();


class RealLogin implements loginService{

    private $api;

    public function login($username, $password){

        // API Object
        $this->api = new ApiConstructor();

        // add user to the session 
        $_SESSION['username'] = $username;

        echo $_SESSION['username'];

        // return json object of success
        echo $this->api->success($_SESSION['username'] . " Loged in Successfully");
    }
}

?>