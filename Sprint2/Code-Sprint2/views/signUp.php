<?php


include_once realpath(dirname(__FILE__)) . '/../controller/SignUpController.php';
include_once realpath(dirname(__FILE__)) . '/../controller/User.php';
include_once realpath(dirname(__FILE__)) . '/../model/MySqli.php';


$user = new User();
$con = new Mysqli_DB();



$con->connect();

if (isset($_POST["username"]) && isset($_POST["email"]) 
    && isset($_POST["password"]) && isset($_POST["role"])){



        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setRole($_POST['role']);


        $signUpController = new SignUpController($user, $con);

        $signUpController->signUp();
    }

$con->disConenct();

?>