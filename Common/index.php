<?php
session_start();
require('pages/header.php');
?>
<style>
    body {
        background-color: #21D4FD;
        background-image: linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);
        background-image: url('Assets/images/Login/Milad.jpg');
        background-repeat: no-repeat;
        background-size: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
    }

    .card {
        top: 30%;
        width: 35%;
    }

    .logo1 {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 20%;
    }

    .btn {
        width: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background-color: #286090;
        box-shadow: 0 0 6px #286090;
    }

    .forget {
        text-align: right;
        padding-bottom: 10px;
    }

    .s1 {
        height: 20px;
        border-bottom: 1px solid black;
        text-align: center;
        left: calc(50% - 257px / 2 + 0.5px);
        top: 743px;

        font-family: "Poppins";
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: rgba(0, 0, 0, 0.8);
    }


    .input-field {
        display: flex;
        flex-direction: column;
    }



    span {
        color: #fff;
        font-size: small;
        display: flex;
        justify-content: center;
        padding: 10px 0 10px 0 10px;
    }

    header {
        color: #fff;
        font-size: 30px;
        display: flex;
        justify-content: center;
        padding: 10px 0 10px 0;
    }

    .input-field {
        display: flex;
        flex-direction: column;
    }

    .input {
        height: 45px;
        width: 87%;
        border: none;
        outline: none;
        border-radius: 30px;
        color: #fff;
        padding: 0 0 0 45px;
        background: grey;
    }

    i {
        position: relative;
        top: -31px;
        left: 17px;
        color: #fff;
    }

    ::-webkit-input-placeholder {
        color: #fff;
    }

    a {
        text-transform: none;
    }
</style>
<div class="container">
    <div class="row">
        <div class="d-flex align-items-center justify-content-center">
            <div class="card shadow">
                <div class="card-body">
                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <img src="Assets/images/Login/user.png" alt="usr_logo" srcset="" class="logo1">
                        <h1 class="head">
                            <div class="s1" style="margin-top:12px">
                                <span style="background-color: #ffffff; padding: 0 10px;font-weight:900;  font-weight: bold;font-size:xx-large; margin-top:0px" class="social">
                                    Login
                                </span>
                            </div>
                        </h1>
                        <div>
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                            <div id="emailHelp" class="form-text">Hint - Username email address</div>
                        </div>
                        <div>
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                        <div class="forget">
                            <a href="forget_password.php" style="text-decoration: none;">Forget Password</a>
                        </div>

                        <button type="submit" class="btn btn-primary shadow">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

require('config/dbconnection.php');

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
            $query = "SELECT role.name
            FROM user
            JOIN role ON user.role_id = role.id
            WHERE user.username = '$username'";
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
                    <script>
                            window.onload = function() {
                             swal({
                                 title: "Successfully Logged",
                                icon: "success",
                            buttons: {
                            confirm: {
                                text: "Login",
                                value: true,
                                visible: true,
                                className: "btn btn-primary",
                                closeModal: true
                                }
                            }
                            }).then(function() {
                                window.location.href = "dashboard.php";
                             });
                            };
                    </script>
                ';
                //  "<script>
                //     swal('Welcome!', 'Verified User!', 'success');
                //     // .then(function ()=>{
                //     // window.location.href = 'dashboard.php';
                //     </script>";
                //     header('Location: dashboard.php');



            } else {
                // Passwords do not match
                echo "<script>swal('txt','Invalid Passsword','error');</script>";
            }
        } else {
            // User not found
            echo "<script>swal('User Not Found');</script>";
        }

        // Close the MySQL connection
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>