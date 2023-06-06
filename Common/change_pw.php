<?php
//register supplier
require('pages/Auth.php');
include('config/dbconnection.php');
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
                            <span><i class="bi bi-table me-2"></i></span> Change Password
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
                        <form class="form-horizontal" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" novalidate>


                            <div class="form-group row" id="custom-input">
                                <label for="gender" class="col-sm-2 col-form-label">Current Password</label>
                                <div class="col-sm-5">
                                    <input type="password" placeholder="Enter Current Passsword" class="form-control" id="current_pw" name="current_pw" required />
                                    <div class="alert alert-danger" id="nameError" style="display: none;">Please Enter Current Password</div>
                                </div>
                            </div>

                            <div class="form-group row" id="custom-input">
                                <label for="gender" class="col-sm-2 col-form-label">New Password :</label>
                                <div class="col-sm-5">
                                    <input type="password" placeholder="Enter New Passsword" class="form-control" id="new_pw" name="new_pw" required />
                                    <div class="alert alert-danger" id="nameError" style="display: none;">Please Enter New Password</div>
                                </div>
                            </div>

                            <div class="form-group row" id="custom-input">
                                <label for="gender" class="col-sm-2 col-form-label">Repeat New Password :</label>
                                <div class="col-sm-5">
                                    <input type="password" placeholder="Repeat New Passsword" class="form-control" id="re_new_pw" name="re_new_pw" required />
                                    <div class="alert alert-danger" id="nameError" style="display: none;">Please Re-enter New Password</div>
                                </div>
                            </div>

                            <div class="form-group row" id="custom-input">
                                <div class="col-sm-5">
                                    <button class="btn btn-success">Change Password</button>
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

<!-- Backend Part -->
<?php
require('pages/footer.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_pw'];
    $newPassword = $_POST['new_pw'];
    $confirmPassword = $_POST['re_new_pw'];

    if($newPassword== $confirmPassword){
        echo "<scrip>alert('Pass');</script>";
    }
}
$con->close();
?>