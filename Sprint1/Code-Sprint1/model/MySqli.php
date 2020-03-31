<?php

include_once 'Connection.php';
include_once 'SignUpDB.php';


class Mysqli_DB implements Connection, SignUpDB{


    private $serverName = "localhost";
    private $userName = "root";
    private $password = "";
    private $databaseName = "se_proejct";
    private $Connection;

    function __construct(){
        

    }

    function connect(){

        $this->Connection = mysqli_connect(
            $this->serverName,
            $this->userName,
            $this->password,
            $this->databaseName
        );



        if ($this->Connection->connect_error){

            die("Connection failed: " . $this->Connection->connect_error);
            return 0;
        }
        else{

            echo "Conenction Created Successful";
            return $this->Connection;
        }
    }

    function disConenct(){

        mysqli_close($this->connection);

        echo "Connection is Closed";
    }

    function checkInDB($username){

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


        array_push($success, array(

            "Message" => "User Added Successfully"
        ));
    
        // set response code - 200 OK
        http_response_code(200);
        
        echo "Success";
        // show products data in json format
        echo json_encode($success);
            
    }
}

?>