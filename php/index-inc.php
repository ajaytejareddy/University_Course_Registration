<?php 

//include "session-inc.php";
include 'dbConnect-con.php';
include 'session-con.php';

//check uname and password
startSession();


if(isset($_SESSION['admin'])){
    $uname = $_SESSION['uname'];
    $pwd = $_SESSION['pwd'];

    $con = new Database();

    if($con->verifyAdmin($uname,$pwd)){
        header('Location: /FinalProj/admin');
    }
    else{
        header('Location: /FinalProj/signout.php');
    }
}
else if(isset($_SESSION['uname']) && isset($_SESSION['pwd'])){
    $uname = $_SESSION['uname'];
    $pwd = $_SESSION['pwd'];

    $con = new Database();

    if($con->verifySignIn($uname,$pwd)){
        header('Location: /FinalProj/user');
    }
    else{
        header('Location: /FinalProj/signout.php');
    }
}

function signIn($email,$pwd){
    $con = new Database();
    //echo $email.$pwd;

    $pattern = "/^\\b(admin[0-9]{2,3})\\b/i";

    if(preg_match($pattern, $email)){
        $email = strtolower($email);
        if($con->verifyAdmin($email,$pwd)){
            $_SESSION['admin'] = 1;
            $_SESSION['uname'] = $email;
            $_SESSION['pwd'] = $pwd;
            header('Location: ./admin/');
        }
    }

    
    if($con->verifySignIn($email,$pwd)){
        $_SESSION['uname'] = $email;
        $_SESSION['pwd'] = $pwd;
        header('Location: ./user');
    }

    echo '<p style="color:red; text-align:center; font-size:13px;">Please enter valid email or password</p>';

}

function signUp($email,$id,$fname,$lname,$pwd){
    $con = new Database();
    echo $email." ".$id." ".$fname." ".$lname." ".$pwd;
    $con = new Database();

    if($con->createUser($id,$email,$fname,$lname,$pwd)){
        $_SESSION['uname'] = $email;
        $_SESSION['pwd'] = $pwd;
        header('Location: ./user/');
    }

    echo '<p style="color:red; text-align:center; font-size:13px;">Unable to create user with given details</p>';

}


?>