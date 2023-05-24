<?php

session_start();

require_once('config/dbconnection.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Assets/images/favicon/Untitled.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Code Technologies</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
</head>

<body>
    <style>
        body{
            background-color: lightcyan;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <h1>Change PASSWORD</h1>
                    <div class="">
                        <label>Current Password</label>
                        <input type="password" name="current_pw" id="" class="form-control">
                    </div>
                    <div class="">
                        <label>New Password</label>
                        <input type="password" name="new_pw1" id="" class="form-control">
                    </div>
                    <div class="">
                        <label>Confirm Password</label>
                        <input type="password" name="new_pw2" id="" class="form-control">
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-success">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $current_pw = $_POST['current_pw'];
    $new_pw1 = $_POST['new_pw1'];
    $new_pw2 = $_POST['new_pw2'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


  

    if(empty($current_pw)){
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
        swal('Error', 'Please Current Password', 'error'); </script>";
    }else{
        // $old_pass = trim($_REQUEST["old_pass"]);
    }

    if(empty($new_pw1)){
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
        swal('Error', 'Please New Password', 'error'); </script>";
    }else{
        // $old_pass = trim($_REQUEST["old_pass"]);
    }

    if(empty($new_pw2)){
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
        swal('Error', 'Please Reenter Password', 'error'); </script>";
    }else{
        // $old_pass = trim($_REQUEST["old_pass"]);
    }


}
?>