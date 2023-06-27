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
                            <label>Item Name</label>
                            <input type="text" name="" id="" class="form-control">
                            <label>Category</label>
                            <select class="form-control" name="nametitle">
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
                            <label>ROP Price</label>
                            <input type="text" name="" id="" class="form-control">
                            <label>Wholesale Price</label>
                            <input type="text" name="" id="" class="form-control">
                            <label>Price</label>
                            <input type="text" name="" id="" class="form-control">
                            <label>Description</label>
                            <input type="text" name="" id="" class="form-control">
                            <label>Quantity</label>
                            <input type="number" name="" id="" class="form-control" min="0" required>
                            <label>Warrenty Period</label>
                            <input type="text" name="" id="" class="form-control">
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
    $itemname = $_POST['itemname'];
    $category = $_POST['category'];
    $Itemstatus = $_POST['Itemstatus'];
    $Warrenty = $_POST['warrenty'];
    $qty = $_POST['qty'];
    $rop = $_POST['rop'];
    $wop = $_POST['wop'];
    $dop = $_POST['dop'];




    $query="INSERT INTO item(name,category_id, itemstatus_id,Warrenty_id,qty,rop,wop,price) VALUES('$itemname',' $category ',' $Itemstatus ','$Warrenty ','$qty',' $rop',' $wop','  $dop')";
    $result=mysqli_query($con,$query);
}






?>





<?php
include('pages/footer.php');
?>