<?php
    include_once(__DIR__. "/../Enums/PriorityMapToColor.php");
    include_once(__DIR__ . "/../Enums/PriorityMap.php");
    include_once(__DIR__ . "/../Repository/todoRepository.php");
    include_once(__DIR__ . "/../Repository/userRepository.php");
    session_start();
    $_SESSION['prev_url'] = $_SERVER['REQUEST_URI'];
    $userId = CheckCookie($cookie_name);
    if ($userId == null) {
        header("Location: ./login.php");
    }
    $user = GetUserById($userId)->data;
    $todoList = GetAllToDoCompleted();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <header class="flex justify-between px-20 py-5 shadow-lg">
        <a href="../index.php">
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
                <img src="../Assets/userIcon.png" class="w-9 h-9" alt="">
                <div class="fixed right-2 setting_modal hidden w-full h-full flex justify-end items-top h ">
                    <div>
                        <div class="shadow-lg bg-white">
                            <a href="./profile.php">
                                <div class="px-9 py-2 hover:bg-blue-500 hover:text-white ">
                                    <p>Profile</p>
                                </div>
                            </a>
                            <a href="">
                                <div class="px-9 py-2 hover:bg-blue-500 hover:text-white ">
                                    <p>To Do Completed</p>
                                </div>
                            </a>
                            <a href="../Page/login.php">
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
    <main class="flex justify-center">
        <div class="w-1/2 py-5 ">
            <?php 
                $index =0;
                while($todoElement = $todoList->fetch_assoc()) :
            ?>
               <div class="flex justify-between px-4 py-2 my-4 shadow-md  rounded-md">
                    <div class="w-1/2">
                        <p 
                            class= "font-bold text-xl
                                <?= PriorityMapToColor($todoElement['Priority'])  ?> "
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
                       
                    </div>
                </div>
            <?php 
                $index++;
                endwhile;
             ?>
          
        </div>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../Javascripts/HandleMenu.js"></script>
</body>
</html>