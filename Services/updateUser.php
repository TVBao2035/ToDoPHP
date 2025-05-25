<?php
    session_start();
    include_once(__DIR__. "/../Repository/userRepository.php");
    include_once(__DIR__. "/../Enums/cookie.php");
    $userId = CheckCookie($cookie_name);
    if ($userId == null) {
        header("Location: ../Page/login.php");
    }
    if(isset($_POST["submit_update_profile"])){
        $user = new UserModal;
        //$temp = GetUserById($userId)->data;
        $user->email = $_POST["email"];
        $user->phone = $_POST["phone"];
        $user->name = $_POST["name"];
        $user->id = $userId;
        $data = UpdateUser($user);
        if($data->isSuccess){
            header("Location:  ".$_SESSION['prev_url']."");
        }

    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        <?php
            if(isset($data)) echo $data->message;
        ?>
    </p>
    <a href="<?php
        if (isset($_SESSION['prev_url'])) {
            echo  $_SESSION['prev_url'];
        }
    ?>">back</a>
</body>
</html>
