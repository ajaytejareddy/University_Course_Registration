<!DOCTYPE html>
<html lang="enUS">
    <head>
        <title>SignUp</title>
        <link rel="stylesheet" href="css/index.css">
    </head>

    <?php include 'php/index-inc.php'?>

  <body>

    <div id="id02" class="signin">
      <form class="modal-content"  action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return check()" method="post" >
        <div class="container">
          <h1 style="display:block; text-align:center;">Sign In</h1>
          <?php 
      if(isset($_POST['submit'])){
        if(isset($_POST['semail'])){
          $gemail = $_POST['semail'];
          $gpwd = $_POST['spsw'];
          //echo $gemail."  ".$gpwd;
          
          signIn($gemail,$gpwd);
        }
      }
        
      ?>
          <hr>

          <p id="validityErr1" style="color:red;"></p>
          <label for="email"><strong>Email</strong></label>
          <input type="text" placeholder="Enter Email" name="semail">

          <label for="psw"><strong>Password</strong></label>
          <input type="password" placeholder="Enter Password" name="spsw">
          
          <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
          </label>

          <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

          <div class="clearfix">
            <button type="submit" name="submit" value="signIn" class="signupbtn">Sign In</button>
            <button type="button" onclick="document.getElementById('id01').style.display='block'" style="background-color: #f44336;" class="signupbtn">Sign Up</button>
          </div>
        </div>
      </form>
    </div>

    <div id="id01" class="modal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return check_Validity()" method="post" >
        <div class="container">
          <h1 style="display:block; text-align:center;">Sign Up</h1>
          <p>Please fill in this form to create an account.</p>
          <p id="validityErr2" style="color:red;"></p>

            <?php
            if(isset($_POST['submit'])){
            if(isset($_POST['email'])){
              $gemail = $_POST['email'];
              $gpwd = $_POST['psw'];
              $fname = $_POST['fname'];
              $lname = $_POST['lname'];
              $id = $_POST['wiuid'];
              signUp($gemail,$id,$fname,$lname,$gpwd);
            }
              
            }
            ?>


          <hr>

          <label for="fname"><strong>First Name</strong></label>
          <input type="text" placeholder="Enter First Name" name="fname" >

          <label for="lname"><strong>Last Name</strong></label>
          <input type="text" placeholder="Enter Last Name" name="lname" >

          <label for="wiuid"><strong>Wiu ID</strong></label>
          <input type="text" placeholder="Enter WIU ID" name="wiuid" >

          <label for="email"><strong>Email</strong></label>
          <input type="text" placeholder="Enter Email" name="email">

          <label for="psw"><strong>Password</strong></label>
          <p id="passLength" style="color:red; font-size:10px;"><p>
          <input type="password" onkeyup="checkPassLength()" placeholder="Enter Password" name="psw">

          <label for="psw-repeat"><strong>Repeat Password</strong ></label>
          <p id="passMatch" style="color:red; font-size:10px;"><p>
          <input type="password" onkeyup="passMatch()" placeholder="Repeat Password" name="psw_repeat">
          
          <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
          </label>

          <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

          <div class="clearfix">
            <button type="submit"  name="submit" value="signUP" class="signupbtn">Sign Up</button>
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          </div>
        </div>
      </form>
    </div>


    <script src='JS/index.js'></script>
    

  </body>
</html>
