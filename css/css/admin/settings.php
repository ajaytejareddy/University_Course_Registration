<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    include 'C:/Apache24/htdocs/FinalProj/php/menu-con.php';
    include 'C:/Apache24/htdocs/FinalProj/php/adminSet-inc.php';
    ?>
    <div id="settings" style="">
    <h1>Admin Details</h1>

    <img id='profileImage'></img>
    <form method="post" onsubmit="return checkForm()">
        <?php changePassword();?>
        <label>UserName:</label>
        <p></p>
        <input type="text" name="uname" value="<?php echo isset($_SESSION['uname'])?$_SESSION['uname']:"admin001";?>" disabled/><br />
        <label>Old Password:</label>
        <p></p>
        <input type="text" id="pwd" onclick="enableSub()" name="pwd" value=""/><br/>
        <label>New Password:</label>
        <p id='01'></p>
        <input type="text" id="upwd" onclick="enableSub()" name="upwd" value=""/><br/>
        <label>Re-Enter New Password:</label>
        <p id='02'></p>
        <input type="text" id="rpwd" onclick="enableSub()" value=""/><br/>
        <button type="submit" id="sButton" name="submit" value="submit" disabled>Submit</button>
        <button type="button" onclick="clearAll()">Reset</button>
    </form>
    </div>

    <script>
    
    function enableSub(){
        let sub = document.getElementById('sButton');
        sub.disabled  = false;
    }

    function checkForm(){
        let pwd = document.getElementById('pwd').value;
        let upwd = document.getElementById('upwd').value;
        let rpwd = document.getElementById('rpwd').value;

        if(rpwd==="" || upwd==="" || pwd===""){
            return false;
        }
        return true;
    }

    </script>
</body>
</html>