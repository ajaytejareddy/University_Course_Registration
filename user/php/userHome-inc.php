<?php
include '/var/www/html/FinalProj/php/session-inc.php';


function getToday(){

    $con = new Database();
    
    return $con->getDate_OTime();
}

function checkin(){
    $con = new Database();
    //echo $_POST['submit'];
    if(isset($_POST['submit'])){
        $date = isset($_POST['date'])?$_POST['date']:"";
        
        $openTime = $_POST['opentime'];
        //echo $openTime."\t".$date."<br>";
        $uname = isset($_SESSION['uname'])?$_SESSION['uname']:"";
        $bool = $con -> slotCheckin($date,$openTime,$uname);
        
       //echo "$date $openTime = $uname";
       unset($_POST['submit']);

        if($bool)
            echo "<p style='color:green;'>**Checked in Successfully**</p>";
        else
            echo "<p style='color:red'>**Server Error**</p>";
    }
}

function getCheckinDetails(){
    $con = new Database();
    $username = $_SESSION['uname'];
    //echo $_SESSION['uname'];
    list($date,$time) = getToday();
    if($date!=="undefined" || $time!=="undefined"){
        $keydate = $con->getDetails($username,$date,$time);
        //echo $keydate;
        if($keydate !==0){
            //echo date('h:i:s a',strtotime($time));
            return $keydate;
        }
    }   
    return ;
}

// $con = new Database();
// list($date,$time) = getToday();
// echo $con->getDetails("ajaytejareddy13@gmail.com",'2020-12-04','22:00:00')."\n\n";
// echo $date.$time;
?>