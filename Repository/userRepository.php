<?php
include_once(__DIR__ . "/connectionDB.php");
include_once(__DIR__. "/../Models/UserModal.php");
include_once(__DIR__ . "/../Models/ReponseModels.php");
    function GetAllUsers(){
        global $connect;
        return $connect->query("Select * From Users");
    }

    function GetUserByEmail($email){
        global $connect;
        $data = $connect->query("select * from Users where email = '$email'");
        $response = new Response();
        if($data){
            $response->data = $data->fetch_assoc();
            $response->message = "Success";
            $response->isSuccess = true;
        }else{
            $response->data = null;
            $response->message = "Not found";
            $response->isSuccess = false;
        }
        return $response;
    }

    function GetUserByPhone($phone)
    {
        global $connect;
        $data = $connect->query("select * from Users where phone = '$phone'");
        $response = new Response;
        if ($data) {
            $response->data = $data->fetch_assoc();
            $response->message = "Success";
            $response->isSuccess = true;
        } else {
            $response->data = null;
            $response->message = "Not found";
            $response->isSuccess = false;
        }
        return $response;
    }

    function UpdateUser(UserModal $userRequest){
        global $connect;
        $response = new Response();
        $user = GetUserByEmail($userRequest->email);
        if(isset($user) && $user->isSuccess && $user->data != null && $userRequest->id != $user->data["Id"]){
            $response->message = "Email is existing ";
            $response->isSuccess = false;
            $response->data = null;
            return $response;
        }
        $user = GetUserByPhone($userRequest->phone);
        if (isset($user) && $user->isSuccess && $user->data != null && $userRequest->id != $user->data["Id"]) {
            $response->message = "Phone is existing";
            $response->isSuccess = false;
            $response->data = null;
            return $response;
        }

        $connect->query("update users set name='".$userRequest->name."', phone='".$userRequest->phone."', email='".$userRequest->email."' where id=".$userRequest->id."");
        $response->message = "Update Success";
        $response->isSuccess = true;
        $response->data = null;
        return $response;
    }
    function GetUserById($Id)
    {
        global $connect;
        $data = $connect->query("select * from Users where id = $Id");
        $response = new Response();
        $response->data = $data->fetch_assoc();
        $response->message = "Success";
        $response->isSuccess = true;
        return $response;
    }
    function Login($email, $password){
        $data = GetUserByEmail($email);
        $response = new Response;
        if($data && $data->data["Password"] != $password) {
            $response->data = "Password";
            $response->message = "Password is wrong";
            $response->isSuccess = false;
        }

        else if($data == null){
            $response->data = "Email";
            $response->message = "Email is wrong";
            $response->isSuccess = false;
        }else{
            $response->data = $data->data;
            $response->message = "Success";
            $response->isSuccess = true;
        }
        return $response;
    }
?>