<?php
include('config/dbconnection.php');
// Fetch latest supplier records from the database
$query = 'SELECT * FROM supplier';
$result = mysqli_query($con, $query);

if (!$result) {
  die('Error: ' . mysqli_error($con));
}

// Generate the HTML markup for supplier records
$html = '';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<tr>';
  $html .= '<td>' . $row['id'] . '</td>';
  $html .= '<td>' . $row['name'] . '</td>';
  $html .= '<td>' . $row['name'] . '</td>';
  $html .= '<td><button class="deleteBtn btn btn-danger" data-id="' . $row['id'] . '">Delete</button></td>';
  $html .= '</tr>';
}

echo $html;

// Close the MySQL connection
mysqli_close($conn);
?>
