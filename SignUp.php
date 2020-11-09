<?php
    include "DbConnect.php";
    $email = $_POST["email"];
    $psw = password_hash($_POST["psw"],PASSWORD_DEFAULT);
    $name = $_POST["name"];

    $con = new $insert();

    $a = $con->createUser($email,$name,$pwd);

    if($a == 0){
        echo "User not created";
    }
    else{
        echo "User Created";
    }

    ?>