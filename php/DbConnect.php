<?php

class Insert{
    public $con;
    public $q;
    function __construct()
    {
    $serverName = "localhost";
    $user = "root";
    $pass = "1234";  //add password
    $db = "FinalProj";

        //Try to connect

    if ($this->con->connect_error){
        die("connection error");
    }

    }   //connection parameters
        
   
    function Users($email,$name,$epwd){
        $this->con = new mysqli($this->serverName, $this->user, $this->pass, $db);
        $this->q = "INSERT INTO Users VAlUES(920036609,\"$email\",\"$name\",\"$epwd\");";
        echo $this->q."\n";

        if($this->con->query($this->q)===TRUE){
        return 1;
        } 
        else{
            echo $this->con->error;
            $this->con->close();
            return 0;
        }
    }

    function VerifySignIn($email,$epwd){
        $this->con = new mysqli($this->serverName, $this->user, $this->pass, $db);
        $this->q="SELECT Password FROM Users WHERE Email=\"$email\";";

        $this->con->query($this->q);

    }
}