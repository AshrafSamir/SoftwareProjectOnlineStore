<?php

include_once('Login.php');
include_once ('RealLogin.php');

class loginControllerProxy implements loginService{

    private $reallogin;
    private $mysqli;
    private $api;

    public function __construct(Mysqli_DB $mysqli)
    {

        $this->reallogin = new RealLogin();
        $this->mysqli = $mysqli;
        $this->api = new ApiConstructor();
    }

    public function login($username, $password){
        
        // returned array from checking function 
        $message = $this->mysqli->checkInDB($username);

        if (count($message) > 0){
            
            // get the object that returned from DB
            $user = $message[0];
            // decrypt the password
            $passwordDB = $user['password'];
            // check the password
            if (md5($password) == $passwordDB){

                $this->reallogin->login($username, $password);
            }
            else{

                // return json object of Failure
                $this->api->raiseError("There is Error in the data  !!!", 404);
            }
        }
        else{

            // return json object of Failure
            $this->api->raiseError("There is Error in the request !!!", 404);
        }



    }

    public function session_checker(){

        $flag = true;
        if (!isset($_SESSION['username'])){

            // return json of 401 ERROR
            $this->api->raiseError("There is Error with the authentication !!!", 401);
            $flag = false;
        }

        
        return $flag;
    }


}

?>