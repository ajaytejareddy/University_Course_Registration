<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php
    
    include 'php/session-con.php';

    startSession();

    echo $_SESSION['email']."<br>";
    echo $_SESSION['pwd']."<br>";
    
    ?>
    <h1>Home</h1>
    <?php
    closeSession();
    echo "<br>session closed";
    ?>
</body>
</html>