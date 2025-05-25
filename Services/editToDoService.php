<?php
    include_once(__DIR__."/../Repository/todoRepository.php");
session_start();
    $userId = CheckCookie($cookie_name);
    if ($userId == null) {
        header("Location: ../Page/login.php");
    }
    if(isset($_POST["submitEdit"]) && isset($_GET["id"])){
        $todo = new ToDo;
        $todo->name = $_POST["name"];
        $todo->priority = $_POST["priority_edit"];
        $todo->id = $_GET["id"];
        if(UpdateToDo($todo)){
            header("Location:  ". $_SESSION['prev_url']."");
        }
    }
?>

