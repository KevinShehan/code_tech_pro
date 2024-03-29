<!-- <?php
      session_start();

      ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="Assets/images/favicon/favicon.png" type="image/x-icon">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="pages/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.css">
  <link href="Pages/CSS/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="pages/css/dashboard.css" />
  <link rel="stylesheet" href="pages/CSS/emp_form.css">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nanoscroller/0.8.7/css/nanoscroller.min.css"> -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <title>Code Technologies</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
  <!-- 
    <link rel="stylesheet" href="pages/css/adminlte.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.5/dist/simplebar.min.css" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['SSD', 'Hours per Day'],
        ['Monitors', 11],
        ['KBD', 2],
        ['Mouse', 2],
        ['Motherboards', 2],
        ['RAM', 7]
      ]);

      var options = {
        title: 'Purchases'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script> -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
      <?php
      // Database configuration
      $host = 'localhost';
      $dbName = 'v3';
      $user = 'root';
      $password = '1234';

      // Create a new MySQLi instance
      $con = new mysqli($host, $user, $password, $dbName);

      // Check connection
      if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
      }

      // Fetch the data for the bar chart
      $barChartQuery = "SELECT MONTH(date) AS month, SUM(total) AS total FROM invoice GROUP BY MONTH(date)";
      $barChartResult = $con->query($barChartQuery);

      // Create the bar chart data array
      $barChartData = array(['Month', 'Total']);
      while ($row = $barChartResult->fetch_assoc()) {
        $barChartData[] = [$row['month'], (int)$row['total']];
      }

      // Fetch the data for the pie chart
      $pieChartQuery = "SELECT name, qty FROM item";
      $pieChartResult = $con->query($pieChartQuery);

      // Create the pie chart data array
      $pieChartData = array(['Item', 'Quantity']);
      while ($row = $pieChartResult->fetch_assoc()) {
        $pieChartData[] = [$row['name'], (int)$row['qty']];
      }

      // Close the database connection
      $con->close();

      // Convert PHP arrays to JavaScript arrays
      $jsBarChartData = json_encode($barChartData);
      $jsPieChartData = json_encode($pieChartData);
      ?>

      // Draw the bar chart
      var barChartData = google.visualization.arrayToDataTable(<?php echo $jsBarChartData; ?>);

      var barChartOptions = {
        title: 'Total Invoice by Month',
        chartArea: {
          width: '50%'
        },
        hAxis: {
          title: 'Total',
          minValue: 0
        },
        vAxis: {
          title: 'Month'
        }
      };

      var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
      barChart.draw(barChartData, barChartOptions);

      // Draw the pie chart
      var pieChartData = google.visualization.arrayToDataTable(<?php echo $jsPieChartData; ?>);

      var pieChartOptions = {
        title: 'Item Quantities',
      };

      var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
      pieChart.draw(pieChartData, pieChartOptions);
    }
  </script>
</head>

<body>