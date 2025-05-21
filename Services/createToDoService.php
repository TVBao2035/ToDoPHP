<?php 
    include(__DIR__."/../Repository/todoRepository.php");

    if(isset($_POST["submit_create"])){
        $todo = new ToDo;
        $todo->name = $_POST["todo_name"];
        $todo->priority = $_POST["priority"];
        if(CreateToDo($todo)){
            header("Location: ../index.php");
        }
    }
?>