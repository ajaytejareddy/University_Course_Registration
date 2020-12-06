<?php
include 'dateConv-mod.php';

class Database{
    public $con;
    private $serverName;
    private $user;
    private $pass;  //add password
    private $db;
    function __construct()
    {
    $this->serverName = "localhost";
    $this->user = "root";
    $this->pass = "1234";  //add password
    $this->db = "final_proj";
    
    }   //connection parameters

    function openConnection(){
        $this->con = new mysqli($this->serverName, $this->user, $this->pass, $this->db);
        // echo "connect<br>";
         if ($this->con->connect_error){
 
             die("connection error");
         }
    }
        
   //user functions
    function createUser($id,$email,$fname,$lname,$pwd){
        //connection variable
        $this->openConnection();

        try{
            //query
            $id = $this->con->real_escape_string($id);
            $email = $this->con->real_escape_string($email);
            $fname = $this->con->real_escape_string($fname);
            $lname = $this->con->real_escape_string($lname);
            $epwd = password_hash($pwd,PASSWORD_DEFAULT);
            $q = "INSERT INTO cust_table VAlUES($id,\"$email\",\"$fname\",\"$lname\",\"$epwd\");";
            //echo $this->q."\n";

            if($this->con->query($q)===TRUE){
                $this->con->close();
                return 1;
            }

            else{
                echo $this->con->error;
                $this->con->close();
                return 0;
            }
        }

        catch(Exception $e){
            return "Database Error";
        }
    }

    function verifySignIn($email,$pwd){
        $this->openConnection();


        try{
            $email = $this->con->real_escape_string($email);
            $q="SELECT epwd FROM cust_table WHERE email=\"$email\";";
        //    echo $q."<br>";
          
            $result = $this->con->query($q);
            //echo $result->num_rows."<br>";

            if($result->num_rows !== 1){
                $this->con->close();
                return 0;
            }

            $row = $result->fetch_assoc();
            //echo $row['epwd']."<br />";

            if(!password_verify($pwd,$row['epwd'])){
               // echo "false";
               $this->con->close();
                return 0;
            }
            
            //echo "true";
            $this->con->close();
            return 1;
        }
        
        catch(Exception $e){
            return "Database Error";
        }
    }

    //Admin functions
    function verifyAdmin($uname,$pwd){
        $this->openConnection();

        try{
            $uname = $this->con->real_escape_string($uname);
            $q="SELECT pwd FROM admin_table WHERE uname=\"$uname\";";
        //    echo $q."<br>";
          
            $result = $this->con->query($q);
            //echo $result->num_rows."<br>";

            if($result->num_rows !== 1){
                $this->con->close();
                return 0;
            }

            $row = $result->fetch_assoc();
            //echo $row['epwd']."<br />";

            if(!password_verify($pwd,$row['pwd'])){
               // echo "false";
               $this->con->close();
                return 0;
            }
            
            //echo "true";
            $this->con->close();
            return 1;
        }
        
        catch(Exception $e){
            return "Database Error";
        }
    }

    function updateAdminPass($uname,$pwd,$upwd){
        if(!$this->verifyAdmin($uname,$pwd)){
            return 0;
        }

        $this->openConnection();

        try{
            $uname = $this->con->real_escape_string($uname);
            $upwd = password_hash($upwd,PASSWORD_DEFAULT);
            $q = "UPDATE admin_table
            SET pwd = \"$upwd\"
            WHERE uname=\"$uname\";
            ";
            //echo $this->q."\n";

            if($this->con->query($q)===TRUE){
                $this->con->close();
                return 1;
            }

            else{
                echo $this->con->error;
                $this->con->close();
                return 0;
            }
        }
        
        catch(Exception $e){
            return "Database Error";
        }

    }

    //slot table functions

    function createSlot($date,$openTime,$closeTime,$max_allowed,$description){
        $this->openConnection();

        try{
            //query

            $aryJson = array();

            $stime = $openTime;
            $ctime = $closeTime;

            $time = strtotime($stime);

            while(true){    
                //echo $stime."\n";
                $aryJson[$stime] = array(); 

                $stime = date("H:i", strtotime('+10 minutes', $time));
                
                
                if(strtotime($stime)>strtotime($ctime))
                    break;
                
                $time = strtotime($stime);
                //$stime = date("H:i:s", strtotime('-10 minutes', $time));
            }

            //$json = array($openTime=>array());
            $json = json_encode($aryJson);
            $date =  date('Y-m-d', strtotime($date));

            $q = "INSERT INTO slot_table(date,open_time,close_time,allowed_interval,slots,description)  
                    VAlUES
                    (\"$date\",\"$openTime\",\"$closeTime\",\"$max_allowed\",'$json',\"$description\");";
            //echo $this->q."\n";

            if($this->con->query($q)===TRUE){
                $this->con->close();
                return 1;
            }

            else{
                echo $this->con->error;
                $this->con->close();
                return 0;
            }
        }

        catch(Exception $e){
            return "Database Error";
        }
    }

    function getSlots(){
        $this->openConnection();

        try{
            $q="SELECT date,open_time,close_time,description 
                FROM slot_table 
                WHERE 
                date=CURDATE() and open_time>CURRENT_TIME 
            UNION
                SELECT date,open_time,close_time,description 
                FROM slot_table 
                WHERE 
                date>CURDATE() order by date;
            ";
        //    echo $q."<br>";
          
            $result = $this->con->query($q);
            //echo $result->num_rows."<br>";
            $resultAry = array();

            if($result->num_rows < 1){
                $this->con->close();
                return $resultAry;
            }

            while($row = $result->fetch_assoc()){
            //echo $row['epwd']."<br />";
                array_push($resultAry,array($row['date'],$row['open_time'],$row['close_time'],$row['description']));
            }
            
            //echo "true";
            $this->con->close();
            return $resultAry;
        }
        
        catch(Exception $e){
            return "Database Error";
        }
    }

    function delSlot($date,$time){
        
        $this->openConnection();

        try{
            $q ="DELETE FROM slot_table WHERE date = '$date' and open_time='$time';";
            
            if($this->con->query($q)===TRUE){
                $this->con->close();
                return 1;
            }

            else{
                echo $this->con->error;
                $this->con->close();
                return 0;
            }

        }
        catch(Exception $e){
            return "Database Error";
        }

    }

    function getDate_OTime(){
        $this->openConnection();

        try{
            $q="SELECT 
                date,open_time 
                FROM 
                slot_table 
                WHERE 
                date=current_date() AND open_time<=ADDTIME(current_time(),'00:30:00') AND close_time>=current_time();
            ";
          
            $result = $this->con->query($q);
            $resultAry = array();

            if($result->num_rows !== 1){
                $this->con->close();
                return array("undefined","undefined");
            }

            $row = $result->fetch_assoc();
            //echo $row['epwd']."<br />";
            array_push($resultAry,$row['date'],$row['open_time']);
            
            //echo "true";
            $this->con->close();
            return $resultAry;
        }
        
        catch(Exception $e){
            return "Database Error";
        }

    }

    function slotCheckin($date,$time,$username){
        $this->openConnection();
        try{
            $gq = "SELECT slots,allowed_interval FROM slot_table WHERE date = '$date' AND open_time = '$time';";
            
            $result = $this->con->query($gq);

            if($result->num_rows !== 1){
                $this->con->close();
                return array("undefined","undefined");
            }

            $row = $result->fetch_assoc();
            
            $jsonObj = $row['slots'];
            $max_allowed = $row['allowed_interval'];

            $aryJson = json_decode($jsonObj,true);

            date_default_timezone_set('Asia/Kolkata');

            $currTime = date("H:i");
            
            $full = 1;
           

            foreach($aryJson as $key=>$value){
                if(strtotime($key)>=strtotime($currTime)){
                    if(count($aryJson[$key]) < $max_allowed){
                        if(!in_array($username,$aryJson[$key])){
                            array_push($aryJson[$key],$username);
                            
                            $full = 0;
                            break;
                        }
                    break;
                    }
                }
            }
            
            if($full === 1){
                return 0;
            }

            $jsonObj = json_encode($aryJson);

            $q = "UPDATE slot_table 
            SET slots = '$jsonObj' WHERE date = '$date' AND open_time='$time';";

            if($this->con->query($q)===TRUE){
                $this->con->close();
                return 1;
            }

            else{
                echo $this->con->error;
                $this->con->close();
                return 0;
            }


        }
        catch(Exception $e){
            $this->con->close();
            return 0;
        }
    }

    function getDetails($username,$date,$time){
        $this->openConnection();
        try{
            $gq = "SELECT slots FROM slot_table WHERE date = '$date' AND open_time = '$time';";
                
            $result = $this->con->query($gq);
            if(isset($result)){
                if($result->num_rows !== 1){
                    $this->con->close();
                    return array("undefined","undefined");
                }

                $row = $result->fetch_assoc();
                    
                $jsonObj = $row['slots'];

                $aryJson = json_decode($jsonObj,true);
                $found  = 0;
                $keyFound = 0;
                foreach($aryJson as $key=>$value){
                    // print_r($aryJson[$key]);
                    // echo " => $key<br>";
                    if(in_array($username,$aryJson[$key])){
                            $found = 1;
                            $keyFound = $key;
                            break;
                    }
                }

                if($found == 1){
                    return $keyFound;
                }
                return 0;
            }
        }
        catch(Exception $e){
            return "Database Error";
        }

    }

}