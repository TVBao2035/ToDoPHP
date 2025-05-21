<?php 
    include(__DIR__ ."/connectionDB.php");
    include(__DIR__ ."/../Models/ReponseModels.php");
    include(__DIR__ ."/../Models/TodoModal.php");
    function GetAllTodo(){
        global $connect;
        return $connect->query("Select * From todos");
    }
    function GetByTodoById($id){
        global $connect;
        return $connect->query("Select * From todos where id=$id");
    }
    function UpdateStatusToDo(int $id,int $isCompleted){
        global $connect;
        return $connect->execute_query("update todos set isCompleted=$isCompleted where id=$id");
    }

    function CreateToDo(Todo $todo){
        global $connect;

        return $connect->execute_query("insert into todos(name, priority) values('".$todo->name."', ".$todo->priority.")");
    }
?>