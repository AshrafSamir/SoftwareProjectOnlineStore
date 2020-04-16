<?php

include_once realpath(dirname(__FILE__)) . '/../controller/ListUsersController.php';
include_once realpath(dirname(__FILE__)) . '/../model/MySqli.php';
include_once realpath(dirname(__FILE__)) . '/../controller/loginService/LoginControllerProxy.php';




$con = new Mysqli_DB();
$proxy = new loginControllerProxy($con);
$con->connect();


if (isset($_GET['username']) && $proxy->session_checker()){

        $username = $_GET['username'];

        $listUserController = new ListUsersController($username, $con);

        $listUserController->list();
    }

$con->disConenct();
session_destroy();

?>