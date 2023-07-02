<?php
include('config/dbconnection.php');

$query = 'SELECT * FROM category';
$result = mysqli_query($con, $query);

if (!$result) {
  die('Error: ' . mysqli_error($con));
}

$data = [];
$number = 1;
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = [
    "No" => $number,
    "Code" => $row['code'],
    "Category" => $row['name'],
    "Actions" => '<button class="btn btn-sm" style="background-color: purple;color:#ffffff;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="' . $row['id'] . '"><i class="fas fa-pencil-alt"></i></button>&nbsp;<a class="deleteBtn btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></a>'
  ];
  $number++;
}

header('Content-Type: application/json');
echo json_encode(['data' => $data]);
?>
