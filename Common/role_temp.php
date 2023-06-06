<?php

require('config/dbconnection.php');

    $query = "SELECT role.name
    FROM user
    JOIN role ON user.role_id = role.id
    WHERE user.username = 'kevin@gmail.com'";
    $result = mysqli_query($con, $query);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the role name from the query result
        $row = mysqli_fetch_assoc($result);
        $roleName = $row['name'];

        // Output the role name
        echo "Role Name: " . $roleName;
    } else {
        // No matching row found
        echo "No role found for the user.";
    }

?>
