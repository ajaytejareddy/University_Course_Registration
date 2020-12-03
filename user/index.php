<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
  <?php
    
    // include 'php/session-con.php';

    // startSession();

    // echo $_SESSION['uname']."<br>";
    // echo $_SESSION['pwd']."<br>";
    
    // ?>
    <h1>Home</h1>

    <p id="ab1">Javascript : </P><br/>
    <?php
    // closeSession();
    // echo "<br>session closed";
    ?> 

    <?php 
    include 'php/dbConnect-con.php';
    
    // $a = array("ajaytejareddy@gmail.com"=>"9:50");
    
    // print_r($a);

    // echo "<br />";    
    $con = new Database;

    // echo $con->json_create($a);

    $b= $con->getJson();

    echo $b."==php";
    echo "<br> php <br>";
    $c = json_decode($b);

    print_r($c);
    ?>
    <script type="text/javascript">
    let a = <?php echo $b ?>;
    for (value in a)
        document.getElementById("ab1").innerHTML += `<br />${value} => ${a[value]}`;


    </script>
</body>
</html>