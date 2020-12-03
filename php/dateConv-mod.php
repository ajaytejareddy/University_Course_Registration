<?php
function Ymd($date){
    return date("Y-m-d", strtotime($date));
}
function mdY($date){
    return date("m/d/Y", strtotime($date));
}

?>