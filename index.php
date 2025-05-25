<?php 
    include_once(__DIR__ . "/Repository/todoRepository.php");
    include_once(__DIR__."/Repository/userRepository.php");
    include_once(__DIR__ . "/Enums/PriorityMap.php");
    include_once(__DIR__ . "/Enums/PriorityMapToColor.php");

    session_start();
    $_SESSION['prev_url'] = $_SERVER['REQUEST_URI'];
    $userId = CheckCookie($cookie_name);
    if($userId == null) {
        header("Location: ./Page/login.php");
    }
    $user = GetUserById($userId)->data;
    $todoList = GetAllTodo()->data;
    if(isset($_POST["submitEdit"])){
        $message = "you submit edit";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <title>To Do App</title>
    </head>
<body>
   <header class="flex justify-between px-20 py-5 shadow-lg">
        <a href="index.php">
            <p class="font-bold text-4xl text-blue-600 ">To Do App</p>
           
        </a>
        <div class="flex items-center gap-2">
            <p>
                <?php 
                    if(isset($user)){
                        echo $user["Email"];
                    }
                ?>
            </p>
            <div class="icon_setting relative">
                <img src="./Assets/userIcon.png" class="w-9 h-9" alt="">
                <div class="fixed right-2 setting_modal hidden w-full h-full flex justify-end items-top h ">
                    <div>
                        <div class="shadow-lg bg-white">
                            <a href="./Page/profile.php">
                                <div class="px-9 py-2 hover:bg-blue-500 hover:text-white ">
                                    <p>Profile</p>
                                </div>
                            </a>
                            <a href="./Page/todoCompleted.php">
                                <div class="px-9 py-2 hover:bg-blue-500 hover:text-white ">
                                    <p>To Do Completed</p>
                                </div>
                            </a>
                            <a href="./Page/login.php">
                                <div class="px-9 py-2 hover:bg-blue-500 hover:text-white ">
                                    <p>Logout</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </header>
    <main class="flex flex-col items-center my-10">
        <form 
            action="./Services/createToDoService.php" 
            method="post"
            class="w-1/2"
        >
            <div class="w-full">
                <div class="flex">
                    <div class="w-3/4">   
                        <input type="text" name="todo_name" class="border w-full rounded-md px-2 py-1 hover:outline-none focus:outline-none focus:ring-1 ring-blue-300">
                    </div>
                    <div class="w-1/4 flex justify-center">
                        <button type="submit" name="submit_create" class="bg-blue-600 px-5 py-2 rounded-md text-white active:bg-blue-300">Add</button>
                    </div>
                </div>
                <div class="px-5">
                    <div class="flex item-center gap-2 my-2">
                        <input type="radio" value="1" id="priority_low" name="priority" class="w-6" checked>
                        <label for="priority_low" class="text-green-500 font-bold">Low</label>
                    </div>
                    <div class="flex item-center gap-2 my-2">
                        <input type="radio" id="priority_medium" value="2" name="priority" class="w-6">
                        <label for="priority_medium" class="text-yellow-500 font-bold">Medium</label>
                    </div>
                    <div class="flex item-center gap-2 my-2">
                        <input type="radio" id="priority_hight" value="3" name="priority" class="w-6">
                        <label for="priority_hight" class="text-red-500 font-bold">Hight</label>
                    </div>
                </div>
            </div>
        </form>
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
                                <img src="./Assets/three-dots.png" class="w-9 " alt="">
                            </div>
                            <div class="flex gap-4 icon-actions hidden">
                                <a href="./Page/editToDo.php?id=<?php echo $todoElement['Id'];?>"><img src="./Assets/edit-alt-yellow.png" class="w-6 iconEdit" alt=""> </a>
                                <a href="./Page/deleteToDo.php?id=<?php echo $todoElement['Id']; ?>" ><img src="./Assets/trash-alt -red.png" class="w-6 iconDelete" alt=""></a>
                                <img src="./Assets/x.png" class="w-6 iconClose" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                $index++;
                endwhile;
             ?>
          
        </div>
        <div class="text-blue-600">
            <a href="./Page/moreTodo.php?page=1">[ more ]</a>
        </div>
    </main>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>"  method="post">
        <footer>
            </footer>
        </form>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="./Javascripts/HandleToDoItem.js"></script>
        <script src="./Javascripts/HandleMenu.js"></script>
        <script src="./Javascripts/HandleChangeStatus.js"></script>
</body>

</html>