<?php 
    $cookie_name = "TO_DO_USER_ID";

    function SaveMyCookie($name, $value = ""){
        setcookie($name, $value, time() + 3600, "/");
    }

    function RemoveCookie($name){
        setcookie($name, "", time() - 3600, "/");
    }   
    function CheckCookie($cookie_name){
        if(isset($_COOKIE[$cookie_name])){
            $userId = $_COOKIE[$cookie_name];
           return $userId;
    
        }else{
            return null;
        }
    }
?>