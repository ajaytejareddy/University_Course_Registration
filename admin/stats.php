<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin::Statistics</title>
</head>
<body>
    <?php include '/var/www/html/FinalProj/php/menu-con.php'; ?>
    <?php
        include '/var/www/html/FinalProj/php/session-inc.php';
   
        $con = new Database();

        $resultAry = $con->getWeekStats();

    ?>

    <div id="barchart" style="width: 500px; height: 300px;"></div>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['date', 'total checked-in']
          <?php

            foreach($resultAry as $k=>$v){
                echo ",['$k',$v]";
            }

          ?>
        ]);

        var options = {
          width: 900,
          legend: { position: 'none' },
          chart: {
            title: 'last Week statistics',
            subtitle: 'total day by day visits' },
          axes: {
            x: {
              0: { side: 'top', label: 'last 7 day total vistis'} // Top x-axis.
            }
          },
          bar: { groupWidth: "10%" }
        };

        var chart = new google.charts.Bar(document.getElementById('barchart'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };

</script>
</body>
</html>