<?php 
    include(__DIR__ ."/../Repository/todoRepository.php");
    
    if(isset($_GET["id"]) && isset($_GET["isCompleted"])){
        $id = $_GET["id"];
        $isCompleted = $_GET["isCompleted"];
        if(UpdateStatusToDo($id, $isCompleted)){
            header("Location: ../index.php");
        }
        
    }
?>
