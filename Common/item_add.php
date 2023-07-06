<?php
//register supplier
session_start();

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
                <h2>+Product Add</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">+Product Add</h5>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="itemForm">

                            <script>
                                function generateUniqueCode() {
                                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                    var counter = 1;
                                    var code = 'IT';

                                    function incrementCounter() {
                                        var number = counter.toString().padStart(2, '0');
                                        counter++;
                                        return number;
                                    }
                                    code += incrementCounter();
                                    for (var i = 0; i < 2; i++) {
                                        code += characters.charAt(Math.floor(Math.random() * characters.length));
                                    }
                                    document.getElementById('codeInput').value = code;
                                }
                                // Automatically generate code when the page loads
                                window.addEventListener('load', generateUniqueCode);
                            </script>


                            <label>CODE</label>
                            <input type="text" name="itemcode" id="codeInput" class="form-control" readonly>

                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" name="itemname" id="itemname" class="form-control">
                                <div class="alert alert-danger mt-2" id="name-error" style="display: none;">Please enter a valid name (only letters and spaces).</div>
                            </div>


                            <label>Category</label>
                            <select class="form-control" name="category">
                                <?php
                                // Retrieve data from the SQL table
                                $query_category = "SELECT id,name FROM category";
                                $result_category = mysqli_query($con, $query_category);

                                // Loop through the query result and display data within <option> tags
                                while ($row = mysqli_fetch_assoc($result_category)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>


                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>
                            <div class="form-group">
                                <label>Retail of Price</label>
                                <input type="number" id="currency" class="form-control" name="rop" step="0.01" min="0" required>
                                <div id="retail-price-error" class="invalid-feedback">Retail price cannot be negative.</div>
                            </div>


                            <div class="form-group">
                                <label>Wholesale Price</label>
                                <input type="number" id="wholesale-price" class="form-control" name="wop" step="0.01" min="0" required>
                                <div id="whole-price-error" class="invalid-feedback">Whole price cannot be negative.</div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" id="" class="form-control">
                            </div>


                            <script>
                                $(document).ready(function() {
                                    // Function to validate the name input
                                    function validateName() {
                                        var nameInput = $("#itemname");
                                        var name = nameInput.val().trim();
                                        var isValid = /^[A-Za-z\s]+$/.test(name); // Regular expression to check if name contains only letters and spaces

                                        if (isValid) {
                                            // Remove any existing error classes and hide the error message
                                            nameInput.removeClass("is-invalid").addClass("is-valid");
                                            $("#name-error").hide();
                                            return true; // Name is valid
                                        } else {
                                            // Add error classes and show the error message
                                            nameInput.removeClass("is-valid").addClass("is-invalid");
                                            $("#name-error").show();
                                            return false; // Name is invalid
                                        }
                                    }

                                    function validateRetailPrice() {
                                        var retailPriceInput = $("#currency");
                                        var retailPrice = parseFloat(retailPriceInput.val().trim());

                                        if (retailPrice >= 0) {
                                            // Remove any existing error classes and hide the error message
                                            retailPriceInput.removeClass("is-invalid").addClass("is-valid");
                                            $("#retail-price-error").hide();
                                            return true; // Retail price is valid
                                        } else {
                                            // Add error classes and show the error message
                                            retailPriceInput.removeClass("is-valid").addClass("is-invalid");
                                            $("#retail-price-error").show();
                                            return false; // Retail price is invalid
                                        }
                                    }

                                    function validateWholePrice() {
                                        var wholePriceInput = $("#wholesale-price");
                                        var wholePrice = parseFloat(wholePriceInput.val().trim());

                                        if (wholePrice >= 0) {
                                            // Remove any existing error classes and hide the error message
                                            wholePriceInput.removeClass("is-invalid").addClass("is-valid");
                                            $("#whole-price-error").hide();
                                            return true; // Retail price is valid
                                        } else {
                                            // Add error classes and show the error message
                                            wholePriceInput.removeClass("is-valid").addClass("is-invalid");
                                            $("#whole-price-error").show();
                                            return false; // Retail price is invalid
                                        }
                                    }

                                    // Function to validate the quantity input

                                    function validateQty() {
                                        var qtyInput = $("#qty");
                                        var qty = parseInt(qtyInput.val().trim());

                                        if (qty >= 0) {
                                            // Remove any existing error classes and hide the error message
                                            qtyInput.removeClass("is-invalid").addClass("is-valid");
                                            $("#qty-error").hide();
                                            return true; // Quantity is valid
                                        } else {
                                            // Add error classes and show the error message
                                            qtyInput.removeClass("is-valid").addClass("is-invalid");
                                            $("#qty-error").show();
                                            return false; // Quantity is invalid
                                        }
                                    }


                                    // Event listener for form submission
                                    $("itemForm").submit(function(event) {
                                        // Perform validation checks
                                        var isNameValid = validateName();
                                        var isRetailPriceValid = validateRetailPrice();
                                        var isWholePriceValid = validateWholePrice();
                                        var isQtyValid = validateQty();
                                        

                                        // Prevent form submission if any validation fails
                                        if (!isNameValid || isRetailPriceValid || isWholePriceValid|| isQtyValid) {
                                            event.preventDefault();
                                            // Optionally, you can display an error message indicating the reason for the form not being submitted.
                                            // For example: $("#error-message").text("Please fix the errors before submitting theform.").show();
                                        } else {

                                            document.getElementById("itemForm").addEventListener("submit", function(event) {
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
                                                        document.getElementById("itemForm").submit();
                                                    }
                                                });
                                            });
                                        }
                                    });
                                    // Call the validateName function whenever the name input changes
                                    $("#itemname").on("input", validateName);
                                    $("#currency").on("input", validateRetailPrice);
                                    $("#wholesale-price").on("input", validateWholePrice);
                                    $("#qty").on("input", validateQty);// Updated ID for the wholesale price input
                                });
                            </script>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="qty" id="qty" class="form-control" min="0" required>
                                <div id="qty-error" class="invalid-feedback">Quantity cannot be negative.</div>
                            </div>

                            <div class="form-group">
                                <label>Warrenty Period</label>
                                <select class="form-control" name="warrenty">
                                    <?php
                                    // Retrieve data from the SQL table
                                    $query_warrenty = "SELECT id,name FROM warrenty";
                                    $result_warrenty = mysqli_query($con, $query_warrenty);

                                    // Loop through the query result and display data within <option> tags
                                    while ($row = mysqli_fetch_assoc($result_warrenty)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-group justify-content-end">
                                <button class="btn btn-success float-end">+Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>

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




    $itemcode = $_POST['itemcode'];
    $itemname = $_POST['itemname'];
    $category = $_POST['category'];
    // $Itemstatus = $_POST['Itemstatus'];
    $Warrenty = $_POST['warrenty'];
    $qty = $_POST['qty'];
    $rop = $_POST['rop'];
    $wop = $_POST['wop'];
    $reorder = $_POST['reorder'];
    $description = $_POST['description'];
    // $dop = $_POST['dop'];




    $query = "INSERT INTO item(code,name,category_id, Warrenty_id,qty,rop,wop,reorder,description,user_id)
     VALUES('$itemcode','$itemname',' $category ','$Warrenty ','$qty',' $rop',' $wop','$qty','$description', '$user_id')";
    $result = mysqli_query($con, $query);


    if ($result) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>';
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "success",';
        echo '    title: "Success",';
        echo '    text: "Item saved successfully"';
        echo '  }).then(function() {';
        echo '    location.href = "items_view.php";';
        echo '  });';
        echo '};';
        echo '</script>';
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>';
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "error",';
        echo '    title: "Error",';
        echo '    text: "An error occurred while saving the category"';
        echo '  });';
        echo '};';
        echo '</script>';
    }
}


?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>
<script>
    document.getElementById("itemForm").addEventListener("submit", function(event) {
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
                document.getElementById("itemForm").submit();
            }
        });
    });
</script>


<?php
include('pages/footer.php');
?>