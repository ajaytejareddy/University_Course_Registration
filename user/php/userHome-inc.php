<?php
include 'C:/Apache24/htdocs/FinalProj/php/session-inc.php';


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
        $bool = $con -> slotCheckin($date,$openTime,"ajaytejareddy13@gmail.com");
        if($bool)
            echo "<p style='color:green;'>**Checked in Successfully**</p>";
        else
            echo "<p style='color:red'>**Server Error**</p>";
    }
}

function getCheckinDetails(){
    $con = new Database();
    list($date,$time) = getToday();
    if($date!=="undefined" || $time!=="undefined"){
        $keydate = $con->getDetails($_SESSION['uname'],$date,$time);
        if($keydate !==0)
            return date('h:i a',strtotime($time));
    }   
    return ;
}

print_r(getToday());

?>