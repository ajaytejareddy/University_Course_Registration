<?php

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

    // $this->con = new mysqli($this->serverName, $this->user, $this->pass, $this->db);
    //     if ($this->con->connect_error){
    //         die("connection error");
    //     }
    
    }   //connection parameters
        
   
    function createUser($id,$email,$fname,$lname,$pwd){
        //connection variable
        $this->con = new mysqli($this->serverName, $this->user, $this->pass, $this->db);
        if ($this->con->connect_error){
            die("connection error");
        }
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
        $this->con = new mysqli($this->serverName, $this->user, $this->pass, $this->db);
       // echo "connect<br>";
        if ($this->con->connect_error){

            die("connection error");
        }

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
}