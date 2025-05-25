<?php
    include_once(__DIR__."/../Repository/userRepository.php");
    include_once(__DIR__. "/../Enums/cookie.php");
    RemoveCookie($cookie_name);
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(strlen(trim($email)) != 0 
        && strlen((trim($password))) != 0 ){
            $data = Login($email, $password);
            if($data->isSuccess){
                SaveMyCookie($cookie_name, $data->data["Id"]);
                header("Location: ../index.php");
            }
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body class="flex justify-center ">
    <form 
        action="<?php
        echo $_SERVER["PHP_SELF"]
        ?>" 
        method="post" 
        class="w-1/3 mt-20"
    >
        <p class="text-blue-700 font-bold text-4xl mb-10 text-center">Login</p>
        
        <div class="flex flex flex-col my-2">
            <label for="" class="font-bold text-blue-600">Email</label>
            <input type="text" name="email" class="border rounded-md px-2 py-1 hover:outline-none focus:outline-none focus:ring-1 ring-blue-300">
            <span class="text-red-500">
                <?php 
                    if(isset($data) && $data->data == "Email"){
                        echo $data->message;
                    }
                ?>
            </span>
        </div>

        <div class="flex flex flex-col my-2">
            <label for="" class="font-bold text-blue-600">Password</label>
            <input type="text" name="password" class="border rounded-md px-2 py-1 hover:outline-none focus:outline-none focus:ring-1 ring-blue-300">
            <span class="text-red-500">
                <?php 
                  if(isset($data) && $data->data=="Password" ){
                    echo $data->message;
                }
                ?>
            </span>
        </div>

        <div class="flex justify-center">
            <button 
                class="bg-blue-700 px-4 py-2 rounded-md text-white focus:bg-blue-500"
                name="submit"
            >Submit</button>
        </div>

    </form>
     <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>