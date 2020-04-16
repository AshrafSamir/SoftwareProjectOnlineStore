<?php

include_once realpath(dirname(__FILE__)) . '/user.php';
include_once realpath(dirname(__FILE__)) . '/../controller/ApiConstructor.php';

class SignUpController{


    private $user;
    private $connection;

    function __construct($user, $connection)
    {

        $this->user = $user;
        $this->connection = $connection;
    }

    function signUp(){

        if ($this->ValidateUser() === 1){

            $this->connection->addUser($this->user);

        }
        else{

            // set response code - 404 Not found
            http_response_code(404);
        
            echo json_encode(
                array("message" => "Username,Password Combination is invalid.")
            );
        }
    }

    function ValidateUser(){
       
        
        $errors = $this->connection->checkInDB($this->user->getUsername());

        if (count($errors) > 0){

            return 0;
        }
        else{

            if ($this->user->getRole() < 1 && $this->user->getRole() > 3){


        
                echo json_encode(
                    array("message" => "Role is not valid number.")
            );
            }
            else{

                return 1;
            }
            
        }
    }
}


?>