<?php

include_once realpath(dirname(__FILE__)) . '/../controller/ListUsersController.php';
include_once realpath(dirname(__FILE__)) . '/../model/MySqli.php';


$con = new Mysqli_DB();

$con->connect();

if (isset($_GET['username'])){

        $username = $_GET['username'];

        $listUserController = new ListUsersController($username, $con);

        $listUserController->list();
    }

$con->disConenct();


?>