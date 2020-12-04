<?php
// PHP array
$products = array(
    // product abbreviation, product name, unit price
    "09:00:00" => array(),
    "09:10:00" =>array('carrot_cake', 'Carrot Cake', 12),
    "09:20:00" =>array('cheese_cake', 'Cheese Cake', 20),
    "09:30:00" =>array('banana_bread', 'Banana Bread', 14)
);

$aryJson = array();

$stime = '20:00:00';
$ctime = '23:40:00';

$time = strtotime($stime);

while(true){    
    //echo $stime."\n";
    $aryJson[$stime] = array(); 

    $stime = date("H:i:s", strtotime('+10 minutes', $time));
    
    
    if(strtotime($stime)>strtotime($ctime))
        break;
    
    $time = strtotime($stime);
    //$stime = date("H:i:s", strtotime('-10 minutes', $time));
}
echo "start time = ".$stime;
//echo "end time = ".$endTime;
print_r($aryJson);
?>
