<?php
include_once(__DIR__ . "/../Enums/PriorityMapToColor.php");
include_once(__DIR__ . "/../Enums/PriorityMap.php");
include_once(__DIR__ . "/../Repository/todoRepository.php");
include_once(__DIR__ . "/../Repository/userRepository.php");

session_start();
$_SESSION['prev_url'] = $_SERVER['REQUEST_URI'];
$userId = CheckCookie($cookie_name);
if ($userId == null) {
    header("Location: ./login.php");
}
if($_GET["page"]){
    $user = GetUserById($userId)->data;
    $pageData = GetAllTodo(7, $_GET["page"]);
    $todoList = $pageData->data;
    $currPage = $pageData->currPage;
    $totalPage = $pageData->totalPage;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mt-4">
        <a href="../index.php" class="flex items-center gap-2 px-20">
            <img src="../Assets/back.png" class="w-8 h-8" alt="">
            <p class="font-bold text-blue-600">Back</p>
        </a>
    </div>
    <div class="flex justify-center">
        <div class="w-1/2 py-5 ">
            <?php 
                $index =0;
                while($todoElement = $todoList->fetch_assoc()) :
            ?>
                <div class="flex justify-between px-4 py-2 my-4 shadow-md  rounded-md">
                    <div class="w-1/2">
                        <p 
                            class= "font-bold text-xl
                                <?= PriorityMapToColor($todoElement['Priority'])  ?>
                                <?php echo $todoElement['IsCompleted'] ? "line-through !text-gray-400" : ""; ?> "
                        >
                            <?= $todoElement["Name"] ?>
                        </p>
                        <p><?= PriorityMap($todoElement['Priority']) ?></p>
                    </div>
                    <div class="flex items-center gap-3 justify-end w-1/2">
                        <div>
                            <p>
                                <?= $todoElement["createdAt"] ?>
                            </p>
                        </div>
                        <div>
                            <input 
                                type="checkbox" 
                                <?php if($todoElement['IsCompleted']) echo 'checked'; ?>
                                onclick="HandleChangeStatus(<?php echo $todoElement['Id']; ?>, <?php echo $todoElement['IsCompleted'] ? 0 : 1; ?>)"
                                class="w-6 h-6 text-yellow-600 bg-gray-100 border-gray-300 rounded-sm  dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="flex justify-center items-center ps-10 icon_contain">
                            <div class="icon">
                                <img src="../Assets/three-dots.png" class="w-9 " alt="">
                            </div>
                            <div class="flex gap-4 icon-actions hidden">
                                <a href="../Page/editToDo.php?id=<?php echo $todoElement['Id'];?>"><img src="../Assets/edit-alt-yellow.png" class="w-6 iconEdit" alt=""> </a>
                                <a href="../Page/deleteToDo.php?id=<?php echo $todoElement['Id']; ?>" ><img src="../Assets/trash-alt -red.png" class="w-6 iconDelete" alt=""></a>
                                <img src="../Assets/x.png" class="w-6 iconClose" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                $index++;
                endwhile;
             ?>
          
        </div>
    </div>
    <div class="flex gap-4 justify-center text-2xl"> 
        <div class="previous cursor-pointer  font-bold <?php
            if(isset($pageData)){
                if($currPage == 1) echo "text-gray-500";
                else echo "text-blue-600";
            }
        ?> "><<</div>
        <p class="text-blue-600">
            <?php if(isset($pageData)) echo $currPage; ?>
        </p>
        <div class="next cursor-pointer font-bold <?php
            if (isset($pageData)) {
                if ($currPage == $totalPage)
                    echo "text-gray-500";
                else
                    echo "text-blue-600";
            }
            ?>
         ">>></div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../Javascripts/HandleToDoItem.js"></script>
    <script src="../Javascripts/HandleChangeStatus.js"></script>
    <script>
        let btnNext = document.querySelector(".next");
        let btnPrevious = document.querySelector(".previous");
        let totalPage = <?php if(isset($pageData)) echo $totalPage; ?>;
        let currPage = <?php if (isset($pageData)) echo $currPage; ?>;
        console.log(totalPage);
        btnNext.onclick = () =>{
            if(currPage < totalPage){
                window.location.href = `${window.location.origin}/TodoPHP/Page/moreTodo.php?page=${currPage + 1}`;
            }
        }
        btnPrevious.onclick = () => {
            if(currPage > 1){
                window.location.href = `${window.location.origin}/TodoPHP/Page/moreTodo.php?page=${currPage - 1}`;
            }
        }
    </script>
</body>
</html>