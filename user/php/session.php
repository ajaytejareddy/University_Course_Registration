<?php
if(isset($_SESSION['admin'])){
    header('Location:/FinalProj/');
}
if(!isset($_SESSION['uname'])&&!isset($_SESSION['pwd'])){
    header('Location:/FinalProj/');
}


?>