<?php

include_once realpath(dirname(__FILE__)) . '/../controller/ApiConstructor.php';

class ListUsersController{

    private $connection;
    private $username;
    private $api;

    function __construct($username, $connection)
    {

        $this->username = $username;
        $this->connection = $connection;
        $this->api = new ApiConstructor();
    }


    function list(){

        $role = $this->connection->checkAdmin($this->username);

        if ($role != -1){

            if ($role == 3){

            $this->connection->getUsers();

            }
            else{

                $this->api->raiseError();
            }
        }
        else{

            $this->api->raiseError();
        }
        
    }
}

?>