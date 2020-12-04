<?php
include 'dbConnect-con.php';
include 'session-con.php';

startSession();
// pass a zero (0) value for index page
function userpage(){

    if(!(isset($_SESSION['uname']) && isset($_SESSION['pwd'])) || isset($_SESSION['admin'])){
        header('Location:/FinalProj/');
    }

}

function adminPage(){
    if(isset($_SESSION['admin']) && isset($_SESSION['uname']) && isset($_SESSION['pwd'])){
        header('Location:/FinalProj/');
    }
}

?>