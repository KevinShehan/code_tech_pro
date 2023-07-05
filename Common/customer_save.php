<?php
//register employee
include('config/dbconnection.php');

// Retrieve data from the SQL table
$query_gender = "SELECT id,name FROM gender";
$query_nametitle = "SELECT id,name FROM nametitle";
$query_customerstatus = "SELECT id,name FROM customertype";

$result_gender = mysqli_query($con, $query_gender);
$result_nametitle = mysqli_query($con, $query_nametitle);
$result_customerstatus = mysqli_query($con, $query_customerstatus);

include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>


<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">
            <h3>
              <span>
                <i class="fas fa-user-friends"></i>
              </span>
              Customer Registration
              <?php ?>
            </h3>
          </div>
          <div class="card-body">
            <style>
              body {
                background-color: lightcyan;
              }

              .align-right {
                text-align: right;
              }
            </style>
            <form class="form-horizontal" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group row" id="custom-input">
                <label for="email" class="control-label col-sm-2 text-end" style="font-weight: bold;">Code :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Code " required class="form-control" name="cus_code" id="codeInput" readonly />
                </div>
              </div>

              <script>
                function generateUniqueCode() {
                  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                  var counter = 1;
                  var code = 'CU';

                  function incrementCounter() {
                    var number = counter.toString().padStart(2, '0');
                    counter++;
                    return number;
                  }
                  code += incrementCounter();
                  for (var i = 0; i < 3; i++) {
                    code += characters.charAt(Math.floor(Math.random() * characters.length));
                  }
                  document.getElementById('codeInput').value = code;
                }
                // Automatically generate code when the page loads
                window.addEventListener('load', generateUniqueCode);
              </script>






              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Name Title :</label>
                <div class="col-sm-10">
                  <select class="form-control" name="nametitle">
                    <?php
                    // Loop through the query result and display data within <option> tags
                    while ($row = mysqli_fetch_assoc($result_nametitle)) {
                      echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Name</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" id="fullname" name="fullname" />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">NIC :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter NIC " required class="form-control" name="nic" id="nic" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Gender :</label>
                <div class="col-sm-10">
                  <select class="form-control" name="gender">
                    <?php
                    // Loop through the query result and display data within <option> tags
                    while ($row = mysqli_fetch_assoc($result_gender)) {
                      echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

              <!-- <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Email :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Email" required class="form-control" name="email" />
                </div>
              </div> -->

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Address :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Address" required class="form-control" name="address" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Land :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter LAND Phone Number" required class="form-control" name="land" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Mobile1 :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Mobile1" required class="form-control" name="mobile1" />
                </div>
              </div>
              <!-- 
              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Address :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Mobile2" required class="form-control" name="mobile2" />
                </div>
              </div> -->

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Description :</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="message" name="message" rows="4" cols="50"></textarea>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Customer Type :</label>
                <div class="col-sm-10">
                  <select class="form-control" name="customerstatus">
                    <?php
                    // Loop through the query result and display data within <option> tags
                    while ($row = mysqli_fetch_assoc($result_customerstatus)) {
                      echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>


              <style>
                .btn-purple {
                  background-color: purple;
                  border-color: purple;
                }

                .btn-purple:hover {
                  background-color: #8a2be2;
                  border-color: #8a2be2;
                }
              </style>


              <div class="form-group row" id="custom-input">
                <div class="col-sm-5 offset-sm-2">
                  <button type="submit" class="btn btn-primary btn-purple" value="Register">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>
<script>
  document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    Swal.fire({
      title: "Confirm Submission",
      text: "Are you sure you want to submit the form?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Submit",
      cancelButtonText: "Cancel"
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user confirms submission, submit the form
        document.getElementById("myForm").submit();
      }
    });
  });
</script>
<?php
require('pages/footer.php');
?>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_SESSION["username"];
  // Execute the SQL query
  $query2 = "SELECT user.id from user WHERE user.username = '$username'";
  $result2 = mysqli_query($con, $query2);
  $row2 = mysqli_fetch_assoc($result2);
  // Check if a row was returned
  if ($row2) {
    $user_id = $row2['id'];
    $_SESSION['user_id'] = $user_id;
    // echo $user_id ;
  }
  // else {
  //   echo "Failed";
  // }

  // Access the submitted values
  $sup_code = $_POST['cus_code'];

  //should get values from foreign tables id's
  $nametitle = $_POST['nametitle'];
  $fullname = $_POST['fullname'];
  $nic = $_POST['nic'];
  $gender = $_POST['gender'];
  $contact1 = $_POST['mobile1'];
  $contact2 = $_POST['mobile2'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $fax = $_POST['fax'];


  $customerstatus_id = $_POST['customerstatus'];

  $sql = "INSERT INTO customer ( code, nametitle_id, name,gender_id, nic, mobile1,
    address, user_id,description,customertype_id) VALUES ('$cus_code',$nametitle, 
     '$fullname','$gender','$nic','$contact1','$address','$user_id','$description',
     $customerstatus_id)";
  $result = mysqli_query($con, $sql);

  // Print the query statement
  // echo "Query: " . $sql . "<br>";
  if ($result) {
    // Display SweetAlert success message
    echo "
<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js' ></script>
<script>
    swal({
        title: 'Success!',
        text: 'Query executed successfully.',
        icon: 'success',
    }).then(function() {
        // Redirect to view.php
        window.location.href = 'customer_view.php';
    });
</script>
";
    //Close connection
  }
}
$con->close();


?>