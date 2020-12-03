<?php 

include "session-inc.php";
//include 'dbConnect-con.php';
//include 'session-con.php';

//check uname and password
pagesType(0);

function signIn($email,$pwd){
    $con = new Database();
    echo $email.$pwd;
    if($con->verifySignIn($email,$pwd)){
        $_SESSION['uname'] = $email;
        $_SESSION['pwd'] = $pwd;
        header('Location: ./user/');
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
        header('Location: ./Home.php');
    }

    echo '<p style="color:red; text-align:center; font-size:13px;">Unable to create user with given details</p>';

}

?>