<?php
    include_once(__DIR__ ."/../Repository/todoRepository.php");
    session_start();
    $userId = CheckCookie($cookie_name);
    if ($userId == null) {
        header("Location: ../Page/login.php");
    }
    if(isset($_GET["id"]) && isset($_GET["isCompleted"])){
        $id = $_GET["id"];
        $isCompleted = $_GET["isCompleted"];
        if(UpdateStatusToDo($id, $isCompleted)){
            header("Location: " . $_SESSION['prev_url'] . "");
        }
        
    }
?>
