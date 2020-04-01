<?php

class ApiConstructor{


    function getUsersApi($response){

        $usersList["records"] = array();

        while ($users = mysqli_fetch_assoc($response)){

            $user=array(
                "id" => $users['id'],
                "name" => $users['username'],
                "E-mail" => $users['email'],
                "password" => $users['password'],
                "role" => $users['role']
            );
      
            array_push($usersList["records"], $user);
        }

        return $usersList;
    }

    function raiseError(){

        http_response_code(404);
        
            echo json_encode(
                array("message" => "There is Error in the request !!!")
            );
    }

    function success(){

        $success=array();

        array_push($success, array(

            "Message" => "User Added Successfully"
        ));
    
        // set response code - 200 OK
        http_response_code(200);
        
        // show products data in json format
        echo json_encode($success);
    }
}

?>