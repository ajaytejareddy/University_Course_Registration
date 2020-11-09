<?php


class Insert extends Exception{
    public $con;
    function __construct()
    {
    $serverName = "localhost";
    $user = "root";
    $pass = "1234";  //add password
    $db = "FinalProj";

        //Try to connect
    $con = new mysqli($serverName, $user, $pass, $db);

    if ($con->connect_error){
        die("connection error");
    }

    }   //connection parameters
        
   
    function Users($email,$name,$epwd){
        $q = "INSERT INTO users(Email,Name,Password) VLAUES($email,$name,$epwd);";
        try{
            $this->con->query($q);
        }
        catch (Exception e){
            $this->con->close();
            return 0;
        }
        $this->con->close();
        return 1;
    }
}