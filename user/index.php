<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            padding-left: 30%;
        }
        #button{
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 100px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius:50%;
        }
        #button:hover{
            border: 1px solid #0099cc;
            background-color: #4CAF00;
            color: #ffffff;
        }
        #button:disabled{
            cursor:context-menu;
            border: 1px solid #999999;
            background-color: #cccccc;
            color: #666666;
        }
    </style>
</head>
<body>
  <?php
    include 'php/menu-inc.php';
    include 'php/userHome-inc.php';
    $date="";
    $openTime = "";
    list($date,$openTime) = getToday();
    ?>
    <div class="center">
        <p id="sb" style="coor:green">  </p>
        <?php 
        $timeBooked = getCheckinDetails();
        checkin();?>
        <form method="post">
        <input id="date" name="date" value="<?= $date ?>" hidden>
        <input id="opentime" name="opentime" value="<?= $openTime ?>" hidden>
        <button id="button" type="submit" name='submit' value='submit'>Check-in</button>
        </form>
    </div>

    
    <script>

        let date = document.getElementById('date');
        let openTime = document.getElementById('opentime');
        let btn = document.getElementById('button');
        let b <?= "= '$timeBooked';" ?>
        if(b){
            document.getElementById('date').value = `You can visit store on ${date} at ${b}`;
            btn.disabled = true;
        }
        else{
            if(!date.value || !openTime.value){
                btn.disabled = true;
            }
            let d = new Date();
            if(date.value!==formatDate()){
                btn.disabled = true;
            }
        }
        function formatDate() {
            var d = new Date(),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }

    </script>
</body>
</html>