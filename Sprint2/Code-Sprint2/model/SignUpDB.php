<?php


interface SignUpDB{

    function checkInDB($username);

    function addUser($user);
}

?>