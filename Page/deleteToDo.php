<?php
include_once(__DIR__ .'/../Repository/todoRepository.php');
include_once(__DIR__ . '/../Enums/PriorityMap.php');
session_start();
$userId = CheckCookie($cookie_name);
if ($userId == null) {
    header("Location: ./login.php");
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $data = GetByTodoById($id);
    $todo = $data->fetch_assoc();
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
    <main class="flex flex-col items-center my-10">
        <form action="../Services/deleteToDoService.php?id=<?php echo $id ?>"  method="post" class="w-full flex justify-center">
            <div class="w-2/5 bg-white px-10 py-10 rounded-xl modal-delete shadow-lg">
                <div class="flex items-center justify-between ">
                    <p class="font-bold text-2xl text-red-500">To Do Delete</p>
                    <a href="<?php if(isset($_SESSION['prev_url'])) echo $_SESSION['prev_url']; ?>">
                        <img src="../Assets/x-red.png" class="w-6 h-6 close-modal" alt="">
                    </a>
                </div>
                <div class="my-5">
                    <div class="flex gap-2">
                        <p class="font-bold">Name</p>
                        <p>
                            <?php
                                if(isset(($todo))){
                                    echo $todo["Name"] ;
                                }
                            ?>
                         </p>
                    </div>
                    <div class="flex gap-2">
                        <p class="font-bold">Priority</p>
                        <p>
                            <?php 
                                if(isset(($todo)))
                                    echo PriorityMap($todo["Priority"]);
                            ?>
                        </p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit" name="submitDelete" class="bg-red-500 px-4 py-2 font-bold text-white rounded-lg active:bg-blue-200">Delete</button>
                    <span>
                        <?php
                            if(isset($message)) echo $message;
                        ?>
                    </span>
                </div>
            </div>
        </form>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>