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
    //userpage();
    //echo $_SESSION['uname'];
    list($date,$openTime) = getToday();
    ?>
    <div class="center">
        <p id="sb" style="color:green">  </p>
        <?php 
        //echo $date.$openTime;
        userpage();
        checkin();
        $timeBooked = getCheckinDetails();
        ?>
        <form method="post" autocompelte="off">
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
            document.getElementById('sb').innerHTML = `You can visit store on ${date.value} at ${timeConverter(b)}`;
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

        function timeConverter (time) {
            // Check correct time format and split into components
            time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

            if (time.length > 1) { // If time format correct
                time = time.slice (1);  // Remove full string match value
                time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            return time.join (''); // return adjusted time or original string
        }

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }

    </script>
</body>
</html>