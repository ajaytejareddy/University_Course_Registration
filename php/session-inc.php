<?php
include 'dbConnect-con.php';
include 'session-con.php';

startSession();

//$glname = $_SESSION['lname'];
$email = isset($_SESSION['uname']) ? $_SESSION['uname']:"";
$pwd = isset($_SESSION['pwd']) ? $_SESSION['pwd']: "";

// pass a zero (0) value for index page
function pagesType($page){
    if(isset($_SESSION['uname']) && isset($_SESSION['pwd']) ){
        echo "a";
        if($page !== 0 || $page !== 'index')
          header('Location: /FinalProj/');

        return;
         }
      
      
   $gemail = isset($_SESSION['uname']) ? $_SESSION['uname']:"";
   $gpwd = isset($_SESSION['pwd']) ? $_SESSION['pwd']: "";
         
    $con = new Database();

    if($con->verifySignIn($gemail,$gpwd)){   
        header('Location: ./user/');
    }

    if($page !== 0){
       //echo "";
       header('Location: /FinalProj/');
    }

}

?>