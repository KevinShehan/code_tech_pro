
<?php
include('config/dbconnection.php');
// Retrieve the user's role from the session
$userrole = $_SESSION["user_role"];

// Retrieve the role ID based on the role name
$sql_roleid = "SELECT id FROM role WHERE name = '$userrole'";
$result_roleid = mysqli_query($con, $sql_roleid);
$row_roleid = mysqli_fetch_assoc($result_roleid);
$userRoleId = $row_roleid['id'];

// Retrieve the associated use cases for the user's role from the database
$sql = "SELECT u.name FROM role r
        INNER JOIN roleusecase ru ON r.id = ru.role_id
        INNER JOIN usecase u ON ru.usecase_id = u.id
        WHERE r.id = $userRoleId";

$result = mysqli_query($con, $sql);

$allowedUseCases = [];

while ($row = mysqli_fetch_assoc($result)) {
  // Store the allowed use cases in an array
  $allowedUseCases[] = $row['name'];
}












?>