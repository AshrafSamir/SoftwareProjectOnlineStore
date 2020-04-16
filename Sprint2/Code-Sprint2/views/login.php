<?php


include_once realpath(dirname(__FILE__)) . '/../controller/loginService/LoginControllerProxy.php';

include_once realpath(dirname(__FILE__)) . '/../model/MySqli.php';


$con = new Mysqli_DB();


$con->connect();

if (isset($_POST["username"]) && isset($_POST["password"])){

    $proxy = new loginControllerProxy($con);
    $proxy->login($_POST['username'], $_POST['password']);
}

$con->disConenct();

?>