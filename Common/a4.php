<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<?php 
require('config/dbconnection.php');

$query="SELECT MONTHNAME(created) as monthname, SUM(amount) as amount FROM employee GROUP BY monthname";
$result = mysqli_query($con,$query);

?>

<?php
// Retrieve customer data for January
$sql = "SELECT * FROM employee WHERE MONTH(dob) = 1";
$result = mysqli_query($con,$sql);

// Check if any records were found
if ($result->num_rows > 0) {
    // Display customer data in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Code</th><th>Name</th><th>Address</th><th>Date</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["code"] . "</td>";
        echo "<td>" . $row["fullname"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

// Close the database connection
$con->close();
?>






<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
