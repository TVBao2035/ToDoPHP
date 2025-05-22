<?php
    include('../Repository/todoRepository.php');
    if(isset($_GET["id"])){
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

    <main class="flex flex-col items-center justify-center w-full h-full my-10">
        <form action="../Services/editToDoService.php?id=<?php echo $id ?>"  method="post" class="w-full flex justify-center">
            <div class="w-1/2 bg-white px-10 py-10 rounded-xl modal-edit shadow-lg">
                <div class="flex items-center justify-between ">
                    <p class="font-bold text-2xl text-yellow-300">To Do Edit</p>
                    <a href="../index.php">
                        <img src="../Assets/x-red.png" class="w-6 h-6 close-modal" alt="">
                    </a>
                </div>
                <div class="my-5">
                    <div class="flex gap-2 flex-col">
                        <label for="">To Do Name</label>
                        <input
                            type="text"
                            name="name"
                            value="<?php
                                    if(isset($todo)){
                                        echo $todo["Name"];
                                    }
                                ?>"
                            class="border border-blue-300 px-2 py-1 focus:outline-none focus:border-blue-600 focus:ring-sky-400 rounded-md focus:ring-2"
                        >
                    </div>
                    <div class="px-2 ">
                        <div class="flex item-center gap-2 my-2">
                            <input 
                                <?php 
                                    if(isset($todo)){
                                        if($todo["Priority"] == 1) echo "checked";
                                    }
                                ?>
                                type="radio" id="priority_low--edit" name="priority_edit" class="w-6" value="1">
                            <label for="priority_low--edit" class="text-green-500 font-bold">Low</label>
                        </div>
                        <div class="flex item-center gap-2 my-2">
                            <input 
                                <?php 
                                    if(isset($todo)){
                                        if($todo["Priority"] == 2) echo "checked";
                                    }
                                ?>
                                type="radio" id="priority_medium--edit" name="priority_edit" class="w-6" value="2">
                            <label for="priority_medium--edit" class="text-yellow-500 font-bold">Medium</label>
                        </div>
                        <div class="flex item-center gap-2 my-2">
                            <input 
                                <?php 
                                    if(isset($todo)){
                                        if($todo["Priority"] == 3) echo "checked";
                                    }
                                ?>
                                type="radio" id="priority_hight--edit" name="priority_edit" class="w-6" value="3">
                            <label for="priority_hight--edit" class="text-red-500 font-bold">Hight</label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit" name="submitEdit" class="bg-yellow-300 px-4 py-2 font-bold text-black rounded-lg active:bg-yellow-200">Save</button>
                </div>
            </div>
        </form>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>