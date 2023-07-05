<?php
require('config/dbconnection.php');
session_start();
if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
    // Set a cookie to store the email for 30 days
    setcookie('remembered_email', $_POST['username'], time() + (30 * 24 * 60 * 60), '/');
}




// Check if the "Remember Me" checkbox is selected

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Access the submitted values
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userEnteredPassword = $password; // Assuming the user-entered password is received via a form post.

    $query = "SELECT password FROM user WHERE username = '$username'";
    $result = mysqli_query($con, $query);


    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPasswordFromDB = $row['password'];

        // User input password
        $userPassword = $_POST['password']; // Assuming the password is submitted via a form

        // Verify the user's password
        if (password_verify($userPassword, $hashedPasswordFromDB)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            // Passwords match





            // Execute the SQL query
            $query = "SELECT role.name FROM user JOIN role ON user.role_id = role.id WHERE user.username = '$username'";
            $result = mysqli_query($con, $query);

            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                // Fetch the role name from the query result
                $row = mysqli_fetch_assoc($result);
                $roleName = $row['name'];

                // Output the role name
                // echo "Role Name: " . $roleName;
                $_SESSION["user_role"] =  $roleName;

                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: "success",
                                title: "Successfully Logged",
                                text: "Login to the dashboard",
                                showConfirmButton: true,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "Login",
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.href = "dashboard.php";
                                }
                            });
                        });
                    </script>';
            } else {
                // Passwords do not match
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: "error",
                                title: "Incorrect Password",
                                text: "Please enter the correct password.",
                            });
                        });
                    </script>';
            }
        } else {
            // Password incorrect
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "error",
                            title: "Incorrect Password",
                            text: "Please enter the correct password.",
                        });
                    });
                </script>';
        }
    } else {
        // User not found or both username and password are incorrect
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "error",
                title: "Invalid Credentials",
                text: "Please enter valid username and password.",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK",
            });
        });
    </script>';
    }
}
