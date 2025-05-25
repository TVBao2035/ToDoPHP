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
$user = GetUserById($userId)->data;
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
                if (isset($user)) {
                    echo $user["Email"];
                    //echo $_SERVER['REQUEST_URI'];
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
                            <a href="./todoCompleted.php">
                                <div class="px-9 py-2 hover:bg-blue-500 hover:text-white ">
                                    <p>To Do Completed</p>
                                </div>
                            </a>
                            <a href="./login.php">
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
        <form 
            action="../Services/updateUser.php" 
            method="post" 
            class="w-1/3 mt-20 flex-col  "
        >
            <!-- <p class="text-blue-700 font-bold text-4xl mb-10 text-center">Login</p> -->
            <div class="flex flex flex-col my-4">
                <label for="" class="font-bold text-blue-600">Name</label>
                <input 
                    value="<?php if(isset($user)) echo $user["Name"] ?>"
                    type="text" 
                    name="name" 
                    class="border rounded-md px-2 py-1 hover:outline-none focus:outline-none focus:ring-1 ring-blue-300">
            </div>
            <div class="flex flex flex-col my-4">
                <label for="" class="font-bold text-blue-600">Email</label>
                <input 
                    
                    value="<?php if (isset($user))
                        echo $user["Email"] ?>"
                    type="text" 
                    name="email" 
                    class="border rounded-md px-2 py-1 hover:outline-none focus:outline-none focus:ring-1 ring-blue-300">
                
            </div>
            <div class="flex flex flex-col my-4">
                <label for="" class="font-bold text-blue-600">Phone</label>
                <input 
                    
                    value="<?php if (isset($user))
                        echo $user["Phone"] ?>"
                    type="text" 
                    name="phone" 
                    class="border rounded-md px-2 py-1 hover:outline-none focus:outline-none focus:ring-1 ring-blue-300">
            </div>
            
    
            <div class="flex justify-center">
                <button 
                    class="bg-blue-700 px-4 py-2 rounded-md text-white focus:bg-blue-500"
                    name="submit_update_profile"
                    type="submit"
                >Submit</button>
            </div>
    
        </form>
    </main>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../Javascripts/HandleMenu.js"></script>
</body>
</html>