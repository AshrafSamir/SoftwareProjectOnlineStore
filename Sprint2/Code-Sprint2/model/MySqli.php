<?php

include_once 'Connection.php';
include_once 'SignUpDB.php';
include_once realpath(dirname(__FILE__)) . '/../controller/DB_Controller.php';
include_once realpath(dirname(__FILE__)) . '/../controller/ApiConstructor.php';

class Mysqli_DB implements Connection, SignUpDB, DBController{


    private $serverName = "localhost";
    private $userName = "root";
    private $password = "";
    private $databaseName = "se_proejct";
    private $Connection;
    private $api;

    function __construct(){
        
        $this->api = new ApiConstructor();
    }

    function connect(){

        $this->Connection = mysqli_connect(
            $this->serverName,
            $this->userName,
            $this->password,
            $this->databaseName
           
        );



        if ($this->Connection->connect_error){

            //die("Connection failed: " . $this->Connection->connect_error);
            return 0;
        }
        else{

            //echo "Conenction Created Successful";
            return $this->Connection;
        }
    }

    function disConenct(){

        mysqli_close($this->Connection);

        //echo "Connection is Closed";
    }

    function checkInDB($username){

        $messages = Array();

        $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($this->Connection, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { 
            
            // if user exists
            if ($user['username'] === $username) {

                //array_push($messages, "Username already exists");
                array_push($messages, $user);
            }
        }

        return $messages;
    }

    function checkInDBLogin($username){

        $errors = Array();

        $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($this->Connection, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['username'] === $username) {

            array_push($errors, "Username already exists");
            }
        }

        return $errors;
    }

    function addUser($user){

        $success=array();

        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = md5($user->getPassword());  //encrypt the password before saving in the database
        $role = $user->getRole();
        $query = "INSERT INTO users (username, email, password, role)
                        VALUES('$username', '$email'
                        , '$password', '$role')";

        mysqli_query($this->Connection, $query);


        $this->api->success("User Added Successfuly");
            
    }


    function checkAdmin($username){

        
        $user_check_query = "SELECT role FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($this->Connection, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
           
            return $user['role'];
        }
        else{

            return -1;
        }

    }

    function getusers(){

        $user_check_query = "SELECT * FROM users ";
        $result = mysqli_query($this->Connection, $user_check_query);
        

        $usersList = $this->api->getUsersApi($result);

        // set response code - 200 OK
        http_response_code(200);
    
        // show products data in json format
        echo json_encode($usersList);
    }
}

?>