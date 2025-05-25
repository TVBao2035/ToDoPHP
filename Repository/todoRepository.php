<?php 
    include_once(__DIR__ ."/connectionDB.php");
    include_once(__DIR__ ."/../Models/ReponseModels.php");
    include_once(__DIR__ ."/../Models/TodoModal.php");
    include_once(__DIR__ ."/../Models/PagingModal.php");
    include_once(__DIR__ . "/../Enums/cookie.php");

    $userId = CheckCookie($cookie_name);
    if ($userId == null) {
        header("Location: ./login.php");
    }
    function GetAllTodo($limit=4, $page=1){
        global $connect;
        global $userId;
        $users =  $connect->query("Select *   From todos where UserId=$userId");
        $paging = new PagingModal;
        $paging->currPage = $page;
        $skip = ($page - 1) * $limit;
        $paging->totalPage = ($users->num_rows/$limit) + 1;
        $paging->data =  $connect->query("Select *   From todos where UserId=$userId order by isCompleted asc, priority desc limit $skip, $limit");
        return $paging;
    }
    function GetAllToDoCompleted(){
        global $connect;
        global $userId;
        return $connect->query("Select * From todos where UserId=$userId and isCompleted=1");
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

        return $connect->execute_query("insert into todos(name, priority, userId, createdAt) values('".$todo->name."', ".$todo->priority.", ".$todo->userId.", '".$todo->createdAt."')");
    }
    function UpdateToDo(Todo $todo){
        global $connect;
        return $connect->execute_query("update todos set name='".$todo->name."', priority='".$todo->priority."' where id=".$todo->id."");
    }

    function DeleteToDo(int $id){
        global $connect;
        return $connect->execute_query("delete from todos where id=$id");
    }
?>