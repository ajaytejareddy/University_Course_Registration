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

    function createSlot($date,$oTime,$cTime,$allowed,$description){
        $this->openConnection();
        try{
            $description = $this->con->real_escape_string($description);
            $date = Ymd($date);
            $q = "INSERT INTO 
                slot_table(date,open_time,close_time,allowed_interval,slots,description) 
                VALUES
                ('$date',\"$oTime\",\"$cTime\",$allowed,'{}',\"$description\");";

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
            echo "Database Error";

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

}