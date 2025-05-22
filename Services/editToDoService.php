<?php
    include(__DIR__."/../Repository/todoRepository.php");
    if(isset($_POST["submitEdit"]) && isset($_GET["id"])){
        $todo = new ToDo;
        $todo->name = $_POST["name"];
        $todo->priority = $_POST["priority_edit"];
        $todo->id = $_GET["id"];
        if(UpdateToDo($todo)){
            header("Location: ../index.php");
        }
    }
?>

