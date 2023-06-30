<?php
function image($con)
{

    // Assuming you have established a database connection
    $username = $_SESSION["username"];

    // Fetch the employee data from the database
    $query = "SELECT employee.photo FROM employee JOIN user ON employee.id = user.employee_id  WHERE user.username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row['photo'];

        if (file_exists($imagePath)) {
            // Step 3: Create the image tag
            $imageTag = '<img src="' . $imagePath . '" alt="profile_image" style="width:50px;height:50px; border-radius: 50%; object-fit: cover; float: left;" class="shadow">';
        } else {
            $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:50px;height:50px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
        }
    } else {
        $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:50px;height:50px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
    }

    // Step 4: Output the image tag
    echo $imageTag;
}


function callname($con)
{
    $username = $_SESSION["username"];

    // Execute the SQL query
    $query = "SELECT employee.callingname FROM employee JOIN user ON user.employee_id = employee.id WHERE user.username = '$username'";
    $result1 = mysqli_query($con, $query);
    // Check if any rows were returned
    if (mysqli_num_rows($result1) > 0) {
        // Fetch the calling name from the query result
        $row = mysqli_fetch_assoc($result1);
        $callingName = $row['callingname'];

        // Output the calling name
        echo $callingName;
    }
}
