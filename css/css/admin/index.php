<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin::Home</title>
  
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="JS/jquery-1.12.4.js"></script>
  <script src="JS/jquery-ui.js"></script>
  <script src="JS/jquery.timepicker.min.js"></script>
  <link rel="stylesheet" href="css/jquery.timepicker.min.css">
  
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
    .button {
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 10px 25px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

    .button2 {
      background-color: #008CBA;
      border-radius : 25px; 
    } /* Blue */
    .button3 {background-color: #f44336;} /* Red */ 
    .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
    .button5 {background-color: #555555;}
  </style>
  
  
 
</head>
<body>
<?php include 'C:\Apache24\htdocs\FinalProj\php\menu-con.php';?>

<div id="form-wrapper" style="max-width:500px;margin:auto;">
  <h3 style = "background-color:#008CBA; color:white; text-align:center; height:50px; padding: 10px; border-radius: 25px;">Time slot creation</h3>
  <form autocomplete="off" method='post' onsubmit="return getVal()">
  <?php 
    include 'C:/Apache24/htdocs/FinalProj/php/adminHome-inc.php';
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
  <button type="submit" class="button button2" name='submit' value='submit' style="
    width: 100%;
    height: 30%;" >Submit</button>
  </form>
</div>


<div class="tableclass">
<?php

deleteSlot();

getTable();

?>
</div>
<script src='/FinalProj/JS/adminHome-con.js'></script>
</body>
</html>