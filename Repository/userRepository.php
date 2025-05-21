<?php 
    include("connectionDB.php");
    include("../Models/ReponseModels.php");
    
    function GetAllUsers(){
        global $connect;
        return $connect->query("Select * From Users");
    }

    function GetUserByEmail($email){
        global $connect;
        return $connect->query("select * from Users where email = '$email'");
    }
    function Login($email, $password){
        $data = GetUserByEmail($email)->fetch_assoc();
        $response = new Response();
        if($data && $data["Password"] != $password) {
            $response->data = "Password";
            $response->message = "Password is wrong";
            $response->isSuccess = false;
        }

        else if($data == null){
            $response->data = "Email";
            $response->message = "Email is wrong";
            $response->isSuccess = false;
        }else{
            $response->data = $data;
            $response->message = "Success";
            $response->isSuccess = true;
        }
        return $response;
    }
?>