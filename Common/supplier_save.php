<?php
//register supplier

include('config/dbconnection.php');



// Retrieve data from the SQL table
$query_gender = "SELECT id,name FROM v3.gender";
$query_nametitle = "SELECT id,name FROM v3.nametitle";
$query_supplierstatus = "SELECT id,name FROM v3.supplierstatus";
$query_suppliertype = "SELECT id,name FROM v3.suppliertype";


$result_gender = mysqli_query($con, $query_gender);
$result_nametitle = mysqli_query($con, $query_nametitle);
$result_supplierstatus = mysqli_query($con, $query_supplierstatus);
$result_suppliertype = mysqli_query($con, $query_suppliertype);

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

            <h1>
              <span><i class="bi bi-table me-2"></i></span> Supplier Registration
            </h1>
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
            <form class="form-horizontal" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" novalidate>
              <div class="form-group row" id="custom-input">
                <label for="code" class="control-label col-sm-2">Code
                  <span class="align-right"> :</span></label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Code " required class="form-control" name="sup_code" id="codeInput" readonly />
                </div>
              </div>



              <script>
                function generateUniqueCode() {
                  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                  var counter = 1;
                  var code = 'S';

                  function incrementCounter() {
                    var number = counter.toString().padStart(3, '0');
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
                <label for="gender" class="col-sm-2 col-form-label">Gender :</label>
                <div class="col-sm-5">
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



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Name Title :</label>
                <div class="col-sm-5">
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
                <label for="gender" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" id="fullname" name="fullname" />
                  <div class="alert alert-danger" id="nameError" style="display: none;">Please Enter Valid Name</div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Description :</label>
                <div class="col-sm-5">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">LOGO :</label>
                <div class="col-sm-5">
                  <div id="thumbnailContainer"></div>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1 accept=" image/*" onchange="previewImage(event)" name="logoimg" />
                </div>
              </div>

              <script>
                // Image Preview Script
                function previewImage(event) {
                  var input = event.target;
                  var reader = new FileReader();

                  reader.onload = function() {
                    var img = document.createElement("img");
                    img.src = reader.result;
                    img.classList.add("thumbnail");

                    var container = document.getElementById("thumbnailContainer");
                    container.innerHTML = "";
                    container.appendChild(img);
                  };

                  reader.readAsDataURL(input.files[0]);
                }
              </script>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">email :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" id="emailInput" name="email" />
                  <div class="alert alert-danger" id="emailError" style="display: none;">Please Enter Valid Email !</div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Address :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="address" />
                  <div class="alert alert-danger" id="errorMessage" style="display: none;"></div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Mobile1 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="mobile1" />
                  <div class="alert alert-danger" id="errorMessage" style="display: none;"></div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Mobile2 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="mobile2" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">FAX :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="fax" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Supplier Status :</label>
                <div class="col-sm-5">
                  <select class="form-control" name="supplier_status">
                    <?php
                    // Loop through the query result and display data within <option> tags
                    while ($row = mysqli_fetch_assoc($result_supplierstatus)) {
                      echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Supplier Type :</label>
                <div class="col-sm-5">
                  <select class="form-control" name="supplier_type">
                    <?php
                    // Loop through the query result and display data within <option> tags
                    while ($row = mysqli_fetch_assoc($result_suppliertype)) {
                      echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <div class="col-sm-5 offset-sm-2">
                  <button type="submit" class="btn btn-primary" value="Submit">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>
<script>
  // Regex patterns
  var nameRegex = /^[A-Za-z\s]+$/;
  var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var passwordRegex = /^.{8,}$/;

  // Form validation
  var form = document.getElementById('myForm');
  var errorMessage = document.getElementById('errorMessage');

  form.addEventListener('submit', function(event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
      errorMessage.style.display = 'block';
    }
    form.classList.add('was-validated');
  });

  // Real-time validation
  var nameInput = document.getElementById('fullname');
  var emailInput = document.getElementById('emailInput');
  var passwordInput = document.getElementById('passwordInput');
  var confirmPasswordInput = document.getElementById('confirmPasswordInput');

  nameInput.addEventListener('input', function() {
    validateInput(nameInput, nameRegex, 'nameError');
  });

  emailInput.addEventListener('input', function() {
    validateInput(emailInput, emailRegex, 'emailError');
  });

  passwordInput.addEventListener('input', function() {
    validateInput(passwordInput, passwordRegex, 'passwordError');
  });

  confirmPasswordInput.addEventListener('input', function() {
    validatePasswordConfirmation();
  });

  function validateInput(input, regex, errorId) {
    var errorElement = document.getElementById(errorId);
    if (regex.test(input.value)) {
      input.classList.add('is-valid');
      input.classList.remove('is-invalid');
      errorElement.style.display = 'none';
    } else {
      input.classList.add('is-invalid');
      input.classList.remove('is-valid');
      errorElement.style.display = 'block';
    }
  }

  function validatePasswordConfirmation() {
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    if (passwordInput.value === confirmPasswordInput.value) {
      confirmPasswordInput.classList.add('is-valid');
      confirmPasswordInput.classList.remove('is-invalid');
      confirmPasswordError.style.display = 'none';
    } else {
      confirmPasswordInput.classList.add('is-invalid');
      confirmPasswordInput.classList.remove('is-valid');
      confirmPasswordError.style.display = 'block';
    }
  }
</script>




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


  // Access the submitted values
  $sup_code = $_POST['sup_code'];

  //should get values from foreign tables id's
  $nametitle = $_POST['nametitle'];
  $fullname = $_POST['fullname'];


  $description = $_POST['description'];


  // $proimg = $_POST['proimg'];
  $image = $_FILES['logoimg']['name'];
  $image_tmp = $_FILES['logoimg']['tmp_name'];


  $gender = $_POST['gender'];
  $contact1 = $_POST['mobile1'];
  $contact2 = $_POST['mobile2'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $fax = $_POST['fax'];
  // Read the image content
  // $imageData = file_get_contents($image);

  $supplierstatus_id = $_POST['supplier_status'];
  $suppliertype_id = $_POST['supplier_type'];


  // $targetDir = "uploads/";
  // $targetFile = $targetDir . basename($_FILES["image"]["name"]);

  $sql = "INSERT INTO supplier ( code, nametitle_id, name, description, logo,gender_id, contact1, contact2,
    address, email, fax, supplierstatus_id,suppliertype_id) VALUES ('$sup_code',$nametitle, 
     '$fullname','$description','$image','$gender','$contact1','$contact2','$address','$email','$fax',
     $supplierstatus_id,$suppliertype_id)";
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
        window.location.href = 'supplier_view.php';
    });
</script>
";
    //Close connection
  }
}
$con->close();


?>