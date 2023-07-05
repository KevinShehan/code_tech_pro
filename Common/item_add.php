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
                        <form method="post" action="">

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

                            <label>Item Name</label>
                            <input type="text" name="" id="" class="form-control">


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
                            <label>Retail of Price</label>
                            <input type="number" id="currency" class="form-control" name="currency" step="0.01" min="0" required>

                            <label>Wholesale Price</label>
                            <input type="number" id="currency" class="form-control" name="currency" step="0.01" min="0" required>

                            <label>Dealer of Price</label>
                            <input type="number" id="currency" class="form-control" name="currency" step="0.01" min="0" required>

                            <label>Description</label>
                            <input type="text" name="" id="" class="form-control">

                            <label>Quantity</label>
                            <input type="number" name="" id="" class="form-control" min="0" required>

                            <label>Warrenty Period</label>
                            <select class="form-control" name="nametitle">
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
     VALUES('$itemcode','$itemname',' $category ','$Warrenty ','$qty',' $rop',' $wop','$reorder','$description', '$user_id')";
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
        echo '    location.href = "Category_save.php";';
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





<?php
include('pages/footer.php');
?>