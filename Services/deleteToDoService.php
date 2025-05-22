<?php 
    include(__DIR__."/../Repository/todoRepository.php");

    if(isset($_POST["submitDelete"]) && isset($_GET["id"])){
        $id = $_GET["id"];
        if(DeleteToDo($id)){
            header("Location: ../index.php");
        }
    }
?>