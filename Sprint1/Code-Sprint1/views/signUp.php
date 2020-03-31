<?php


include_once realpath(dirname(__FILE__)) . '/../controller/SignUpController.php';
include_once realpath(dirname(__FILE__)) . '/../controller/User.php';
include_once realpath(dirname(__FILE__)) . '/../model/MySqli.php';


$user = new User();
$con = new Mysqli_DB();



$con->connect();

/*$emails = isset($_POST["emails"]) && is_array($_POST["emails"]) ?

$_POST["emails"] : [];


echo json_encode($valid_emails);*/



if (isset($_POST["username"]) && isset($_POST["email"]) 
    && isset($_POST["password"]) && isset($_POST["role"])){



        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setRole($_POST['role']);

        /*$user->setUsername("fdgdgdfg");
        $user->setEmail("dasdqwe");
        $user->setPassword("13123");
        $user->setRole(2);*/

        $signUpController = new SignUpController($user, $con);

        $signUpController->signUp();
    }




    


?>