<?php
//register employee
include('config/dbconnection.php');
include('pages/Header.php');
include('Top_nav.php');
include('Side_nav.php');





$username = $_SESSION['username'];


$query = "SELECT * from employee where email='$username'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $callingname = $row['callingname'];
  $fullname = $row['fullname'];
  $nametitle = $row['nametitle_id'];
  $civilstatus = $row['civilstatus_id'];
  $gender = $row['gender_id'];
  $email = $row['email'];
  $address = $row['address'];
  $mobile = $row['mobile'];
  $land = $row['land'];
  $nic = $row['nic'];
  $dob = $row['dob'];


  $query_nametitle = "SELECT * FROM nametitle WHERE id='$nametitle'";
  $result_nametitle = mysqli_query($con, $query_nametitle);
  $row_nametitle = mysqli_fetch_assoc($result_nametitle);
  $nametitle_new = $row_nametitle['name'];



  $query_civilstatus = "SELECT name FROM civilstatus WHERE id='$civilstatus'";
  $result_civilstatus = mysqli_query($con, $query_civilstatus);
  $row_civilstatus = mysqli_fetch_assoc($result_civilstatus);
  $civilstatus_new = $row_civilstatus['name'];


  $query_gender = "SELECT name FROM gender WHERE id='$gender'";
  $result_gender = mysqli_query($con, $query_gender);
  $row_gender = mysqli_fetch_assoc($result_gender);
  $gender_new = $row_gender['name'];
}


?>





<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>
              <span>
                <i class="fas fa-user"></i>
              </span> Profile View
            </h4>
          </div>
          <div class="card-body">

            <a href="dashboard.php" class="btn btn-purple">
              <i class="fas fa-arrow-left"></i>
              Return Dashboard
            </a>

            <div class="row mb-3">
              <div class="col-sm-4 text-end font-weight-bold">
                <label for="gender" class="col-form-label  ">
                  <b> Name Title: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitle_new) ?>">
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Calling Name:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitle) ?>">
                <select class="form-control" name="nametitle">
                    <?php
                    // Loop through the query result and display data within <option> tags

                    while ($row = mysqli_fetch_assoc($result_nametitle)) {
                      $selected = ($row['name'] === $nametitlenew) ? 'selected' : ''; // Check if the current option matches the $name variable
                      echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                    }
                    ?>
                  </select>

              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Full Name: </b></label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($fullname) ?>">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>NIC: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nic) ?>">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Date of Birth: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($dob) ?>">
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>CivilStatus: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($civilstatus_new) ?>">
              
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Gender: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($gender_new) ?>">
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Mobile Number:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($mobile) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Land Number :</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($land) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Address:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($address) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>E-mail: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($email) ?>">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Image : </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="file" class="form-control-file" id="exampleFormControlFile1" accept="image/*" onchange="previewImage(event)" placeholder="s " name="proimg" />
              </div>
            </div>



            <!-- Remaining label and input field pairs -->

            <div class="form-group row mb-3">
              <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-success" name="submit" id="myButton">Update Profile</button>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <?php
          include('config/dbconnection.php');

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
              $imageTag = '<img src="' . $imagePath . '" alt="profile_image" style="width:150px;height:150px;  object-fit: cover; float: left;" class="shadow">';
            } else {
              $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:150px;height:150px; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
            }
          } else {
            $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:150px;height:150px; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
          }

          // Step 4: Output the image tag
          echo $imageTag;
          ?>
        </div>

        <script>
          var fileInput = document.getElementById("imageUpload");
          var image = document.getElementById("profileImage");

          fileInput.addEventListener("change", function(e) {
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
              image.src = e.target.result;
            };

            reader.readAsDataURL(file);
          });
        </script>
      </div>
    </div>
  </div>
</main>



<style>
  .btn-purple {
    color: #fff;
    background-color: purple;
    border-color: purple;
  }

  .btn-purple:hover {
    color: #fff;
    background-color: darkviolet;
    border-color: darkviolet;
  }

  body {
    background-color: lightcyan;
  }
</style>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById("myButton").addEventListener("click", function() {
    // Displaying a confirmation message using SweetAlert2
    Swal.fire({
      title: 'Confirmation',
      text: 'Are you sure you want to proceed?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user confirms, show a sweet alert popup message
        Swal.fire({
          title: 'Success!',
          text: 'Action completed successfully.',
          icon: 'success',
          confirmButtonText: 'OK'
        });
      }
    });
  });
</script>



<?php
include('pages/Footer.php');
?>