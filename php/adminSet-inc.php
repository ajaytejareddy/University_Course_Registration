<?php

include 'dbConnect-con.php';
include 'session-con.php';

startSession();

    if(isset($_SESSION['admin'])){
        $uname = $_SESSION['uname'];
        $pwd = $_SESSION['pwd'];

        $con = new Database();

        if(!$con->verifyAdmin($uname,$pwd)){
            header('Location: /FinalProj/signout.php');
        }
    }
    else{
        header('Location: /FinalProj');
    }

    // redirects to signin if not logged in
    
    // else{
    //     header('Location: /FinalProj');
    // }

    function changePassword(){

        $con = new Database();

        if(isset($_POST['submit'])){
            $uname = "admin001";
            $pwd = $_POST['pwd'];
            $upwd = $_POST['upwd'];

            $bool = $con->verifyAdmin($uname,$pwd,$upwd);
        
            if($bool){
                echo "<p style='color:green'>**password updated successfully**</p>";
                // closeSession();
                // header('Location: /FinalProj/');
            }
            else if($bool === 0)
                echo "<p style='color:red'>**Invalid Old password**</p>";
        
        }

        

    }

?>