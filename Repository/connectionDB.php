<?php
    $server_name = "localhost";
    $username = "root";
    $pass = "";
    $db_name = "todoapp";
    $connect = new mysqli($server_name, $username, $pass, $db_name);

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
?>