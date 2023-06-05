<?php
//view specific supplier details full
require('pages/Auth.php');
include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');



// Get the database Connection
// $con = getDBConnection();

// Retrieve data from the SQL table
// $query_gender = "SELECT id,name FROM gender";
// $query_civilstatus = "SELECT id,name FROM civilstatus";
// $query_nametitle = "SELECT id,name FROM nametitle";
// $query_role = "SELECT id,name FROM role";
// $query_employeestatus = "SELECT id,name FROM employeestatus";
// $result_gender = mysqli_query($con, $query_gender);
// $result_civilstatus = mysqli_query($con, $query_civilstatus);
// $result_nametitle = mysqli_query($con, $query_nametitle);
// $result_role = mysqli_query($con, $query_role);
// $result_employeestatus = mysqli_query($con, $query_employeestatus);
?>


<?php if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $query = "SELECT * FROM supplier where id= $id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    // Access the values of the record
    $id = $row['id'];
    $code = $row['code'];
    $name = $row['name'];
    $email = $row['email'];
    $tocreation = $row['tocreation'];
    $description = $row['description'];
    $contact1 = $row['contact1'];
    $contact2 = $row['contact2'];
    $email = $row['email'];
    $address = $row['address'];
    $fax = $row['fax'];

    $gender = $row['gender_id'];
    $query1 = "SELECT gender.name FROM supplier,gender where id= $gender and supplier.gender_id=gender.id";
    // $result1 = mysqli_query($con, $query1);

    $logo = $row['logo'];


    $_SESSION['id'] = $id;
    $_SESSION['code'] = $code;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['tocreation'] = $tocreation;
    $_SESSION['description'] = $description;
    $_SESSION['gender'] =  $result1;
    $_SESSION['contact1'] =  $contact1;
    $_SESSION['contact2'] =  $contact2;
    $_SESSION['email'] =  $email;
    $_SESSION['address'] =  $address;
    $_SESSION['fax'] =  $fax;

    // Query the database to retrieve the image data
    $id = 34;
    $query = "SELECT logo FROM supplier WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Set the appropriate content type based on the image extension
        // $extension = $row['extension'];
        // $contentType = 'image/jpeg'; // Default to JPEG if extension is not recognized



        // Set the appropriate headers
        header('Content-Type: image/png');
        header('Content-Length: ' . strlen($row['logo']));

        // Output the image data
        $_SESSION['logo1'] = $row['logo'];
    } else {
        echo 'Image not found.';
    }

    // Close the database connection
}
?><style>
    .dfdd{
        background-color:antiquewhite;
    }
</style>

<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-header">
                        <span><i class="bi bi-table me-2"></i></span> Suppliers
                    </div>
                    <div class="card-body" style="background-color:  antiquewhite;">
                        <a class="btn btn-success" href="supplier_view.php">
                            < Return Supplier List</a>
                                <h1>Profile View</h1>
                                <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="code" class="control-label col-sm-3">
                                            <b> Code :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2">
                                            <label for="email" class="control-label col-lg-2">
                                                <?php echo $_SESSION['code']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nametitle" class="control-label col-sm-3">
                                            <b> Name Title :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2 ">
                                            <label for="nametitle" class="control-label col-lg-2">Mr.</label>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="fullname" class="control-label col-sm-3">
                                            <b> Full Name :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2 ">
                                            <label for="gender" class="control-label col-lg-2">
                                                <?php echo $_SESSION['name']; ?>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b>Date of Register :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2 ">
                                            <label for="gender" class="control-label col-lg-2 ">
                                                <?php echo  $_SESSION['tocreation']; ?>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b> Registered By :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2 ">
                                            <label for="gender" class="control-label col-lg-2 ">Kevin Shehan Perera</label>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b>Description :</b> </label>
                                        <label for="gender" class="col-sm-5 badge bg-dark mb-2 ">
                                            <label for="gender" class="control-label col-lg-2 ">
                                                <?php echo  $_SESSION['description']; ?>
                                            </label>
                                        </label>
                                    </div>



                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b> Gender : </b>
                                        </label>
                                        <label for="gender" class="col-sm-5 badge bg-dark mb-2 ">
                                            <label for="gender" class="control-label col-lg-2 ">
                                                <?php
                                                echo  $_SESSION['gender'];
                                                ?>
                                            </label>
                                        </label>
                                    </div>



                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b>Image :</b>

                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2">
                                            <?php
                                            echo  $_SESSION['logo1'];
                                            ?>
                                            <div id="thumbnailContainer"></div>
                                            <img src="Assets/images/user.png" alt="" srcset="">
                                            <?php if (!empty($imageData)) {
                                                header("Content-type: image/jpg"); // Change the content type if your image is in a different format
                                                echo base64_encode($imageData);
                                            } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b> Contact1 :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2 ">
                                            <label for="gender" class="control-label col-lg-2 ">
                                                <?php echo  $_SESSION['contact1']; ?>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b> Contact2 :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2">
                                            <label for="gender" class="control-label col-lg-2">
                                                <?php echo  $_SESSION['contact2']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b>Email :</b>
                                        </label>
                                        <div class="col-sm-5 badge bg-dark mb-2">
                                            <label for="gender" class="control-label col-lg-2">
                                                <?php echo  $_SESSION['email']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b>Address :</b> </label>
                                        <div class="col-sm-5 badge bg-dark mb-2">
                                            <label for="gender" class="control-label col-lg-2">
                                                <?php echo  $_SESSION['address']; ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="control-label col-sm-3">
                                            <b>FAX :</b> </label>
                                        <div class="col-sm-5 badge bg-dark mb-2">
                                            <label for="gender" class="control-label col-lg-2">
                                                <?php echo  $_SESSION['fax']; ?>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-3 col-form-label">
                                            <b>Supplier Type :</b> </label>
                                        <div class="col-sm-5">
                                            <label for="gender" class="col-lg-2 col-form-label badge bg-dark">0702327328</label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-3 col-form-label">
                                            <b>Supplier Status :</b>
                                        </label>
                                        <div class="col-sm-5">
                                            <label for="gender" class="col-lg-2 col-form-label badge bg-dark">0783045681</label>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group row">
                      <label for="gender" class="col-sm-2 col-form-label">Employee Status :</label>
                     <div class="col-sm-5">
                     <select class="form-control" name="employeestatus">
                     //   <?php
                            // Loop through the query result and display data within <option> tags
                            //   while ($row = mysqli_fetch_assoc($result_employeestatus)) {
                            //     echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            //   }
                            //   
                            ?>
                    </select>
                    </div>
                    </div> -->

                                    <div class="form-group row">
                                        <div class="col-sm-5 offset-sm-2">
                                            <button type="submit" class="btn btn-primary" onclick="generatePassword()">Update Details</button>
                                        </div>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
include('pages/Footer.php');
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Access the submitted values
    $emp_code = $_POST['emp_code'];

    //should get values from foreign tables id's
    $gender = $_POST['gender'];
    $civilstatus = $_POST['civilstatus'];
    $nametitle = $_POST['nametitle'];


    $callname = $_POST['callname'];
    $fullname = $_POST['fullname'];
    // $proimg = $_POST['proimg'];
    $image = $_FILES['proimg']['name'];
    $image_tmp = $_FILES['proimg']['tmp_name'];

    $dob = $_POST['dob'];


    $username = $_POST['username'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $nic = $_POST['nic'];
    $land = $_POST['land'];
    $mobile1 = $_POST['mobile1'];
    $mobile2 = $_POST['mobile2'];
    $role = $_POST['role'];
    $dorecruite = $_POST['dorecruite'];
    $employeestatus_id = $_POST['employeestatus'];

    echo "Name: " . $username . "<br>";
    echo "Email: " . $password;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql1 = "INSERT INTO user (username, password) VALUES (?, ?)";
    $stmt1 = $con->prepare($sql1);
    $stmt1->bind_param("ss", $username,  $hashedPassword);
    $stmt1->execute();



    $user_id = "SELECT id FROM user WHERE username = '$username'";


    $profilePicturePath = "";
    if ($_FILES["proimg"]["size"] > 0) {
        $targetDir = "uploads/";
        $profilePicturePath = $targetDir . basename($_FILES["proimg"]["name"]);
        move_uploaded_file($_FILES["proimg"]["tmp_name"], $profilePicturePath);
    }

    // Save customer information to the database
    $sql = "INSERT INTO customers (name, email, profile_picture) VALUES (?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute([$name, $email, $profilePicturePath]);





    $sql2 = "INSERT INTO employee ( code, nametitle_id ,callname, fullname, civilstatus_id, photo, 
  dob, gender_id, nic, land, mobile1, mobile2, email, address, role_id, dorecruite, 
  employeestatus_id, user_id, tocreation) VALUES
   ($emp_code,
    $nametitle,
    $callname,
    $fullname,
    $civilstatus,
    $proimg,
    $dob,
    $gender,
    $nic,
    $land,
    $mobile1,
    $mobile2,
    $username,
    $address,
    $role,
    $dorecruite,
    $employeestatus_id,
    $user_id,
    CURRENT_TIMESTAMP)";



    $stmt2 = $con->prepare($sql2);
    $stmt->execute([$name, $email, $profilePicturePath]);

    // $stmt2->bind_param(
    //   "sssssbssssssssssssss",


    // $result = mysqli_query($con, $sql2); // Replace $connection with your database connection variable

    // Check if the query was successful
    // if ($result) {
    //     echo "Current date and time stored successfully.";
    // } else {
    //     echo "Error storing current date and time: " . mysqli_error($connection);
    // }
    // );
    // $sql2->execute();

    // if ($stmt2->affected_rows > 0) {
    //   echo "Data saved successfully!";
    // } else {
    //   echo "Error saving data: " . $stmt2->error;
    // }

    // Close statement
    $stmt1->close();
    // $stmt2->close();
}

//Close connection
$con->close();
?>