<?php
include 'dbConnect-con.php';
include 'session-con.php';

startSession();

//$glname = $_SESSION['lname'];
$gemail = $_SESSION['email'];
$gpwd = $_SESSION['pwd'];

// pass a zero (0) value for index page
function pagesType($page){
    if(isset($_SESSION['lname']) && isset($_SESSION['email']) && isset($_SESSION['pwd']) ){
        echo "a";
        if($page !== 0 || $page !== 'index')
          header('Location: ./index.php');

        return;
         }

    $con = new Database();

    if(!$con->verifySignIn($gemail,$gpwd)){
       // header('Location: ./index.php');
    }

    if($page !== 0){
       header('Location: ./Home.php');
    }

}


?>