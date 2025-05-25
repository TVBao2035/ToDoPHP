<?php
include_once(__DIR__."/../Repository/todoRepository.php");
    
    $userId = CheckCookie($cookie_name);
    if ($userId == null) {
        header("Location: ../Page/login.php");
    }
    if(isset($_POST["submit_create"])){
        $todo = new ToDo;
        $todo->name = $_POST["todo_name"];
        $todo->priority = $_POST["priority"];
        $todo->userId = $userId;
        $todo->createdAt = date("d/m/Y");
        if(CreateToDo($todo)){
            header("Location: ../index.php");
        }
    }
?>