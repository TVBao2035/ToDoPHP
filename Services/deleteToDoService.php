<?php
include_once(__DIR__."/../Repository/todoRepository.php");
session_start();
    $userId = CheckCookie($cookie_name);
    if ($userId == null) {
        header("Location: ../Page/login.php");
    }
    if(isset($_POST["submitDelete"]) && isset($_GET["id"])){
        $id = $_GET["id"];
        if(DeleteToDo($id)){
            header("Location: ". $_SESSION['prev_url']." ");
        }
    }
?>