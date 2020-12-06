<?php

    function startSession(){
        session_start();
    }

    function getSessionVar(...$names){
        $result = [];
         foreach($names as $name)
            array_push($result,$_SESSION[$name]);
           
         return $result;
    }
    
    function unset_SessionVar(...$args){
        foreach($arg as $args)
            unset($_SESSION[$arg]);
    }
    
    function set_SessionVar($name=[],$args=[]){
        if(count($name) !== count($args)){
            return false;
        }
        for($i=0;$i<count($name);$i++){
            $_SESSION[$name[$i]] = $args[$i];
        }
        return true;
    }

    function closeSession(){
        session_destroy();
    }

?>