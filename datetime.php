<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin::Home</title>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  
  
  <link rel="stylesheet" src="C:/Apache24/htdocs/FinalProj/css/admin-home.css" />
  <link rel="stylesheet" src="C:/Apache24/htdocs/FinalProj/css/menu.css" />
  
  
 
</head>
<body>
<?php include 'C:/Apache24/htdocs/FinalProj/php/menu-con.php'?>

<div id="form-wrapper" style="max-width:500px;margin:auto;">
  <h3 style = "background-color:blue; color:white; text-align:center; height:50px; padding: 10px; border-radius: 25px;">Time slot creation</h3>
  <form autocomplete="off" method='post' onsubmit="return getVal()">
  <?php 
    include 'php/adminHome-con.php';
    check();
  ?>
  <p><label> 
  Date: </label><br />
  <p></p>
  <input type="text" name="date" id="datepicker" />
  </p>

  <p> <label> Open Time: </label> <br />
  <p></p>
  <input type="text" name="open" id="timepicker" placeholder="00:00" /> 
  </p>

  <p> 
  <label> Close Time:<label><br />
  <p></p>
  <input type="text" name="close" id="timepicker2" placeholder="00:00" /> <br />
  </p>

  <label for="max_allowed">Max allowed Users:</label>

  <select name="max_allowed" id="max_allowed">
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
    <option value="25">25</option>
    <option value="30">30</option>
    <option value="35">35</option>
  </select>
  <p></p>

  <p><label>Description:</label><br/> <p></p>
  <textarea id="descript1" name="description" rows="4" cols="50" placeholder="items available">
  </textarea></p>
  <button type="submit" name='submit' value='submit' style="
    width: 100%;
    height: 30%;" >Submit</button>
  </form>
</div>

<style>
  .tableclass{
    margin: 10% 10% 0% 10%;
  }
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    padding :0 0 0 0;
  }
  
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  
  tr:nth-child(even) {
    background-color: #dddddd;
  }
  <style>
  .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }

  .button2 {background-color: #008CBA;} /* Blue */
  .button3 {background-color: #f44336;} /* Red */ 
  .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
  .button5 {background-color: #555555;}
  </style>
</style>

<div class="tableclass">
<?php

deleteSlot();

getTable();

?>
</div>
<script src='C:/Apache24/htdocs/FinalProj//JS/adminHome-con.js'></script>
</body>
</html>