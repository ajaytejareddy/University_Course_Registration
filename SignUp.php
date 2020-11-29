<?php
    include "DbConnect.php";
    $email = $_POST["email"];
    $psw = password_hash($_POST["psw"],PASSWORD_DEFAULT);
    $name ="Ajay"; 

    $con = new Insert();

    $q = "INSERT INTO Users VAlUES(920036609,\"$email\",\"$name\",\"$epwd\");";


    $a = $con->con;
    $b = $a->query($q);

    if($b == 0){
        echo "User not created";
    }
    else{
        echo "User Created";
    }

    ?>