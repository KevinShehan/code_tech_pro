<?php
//register supplier
require('pages/Auth.php');

include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>
<?php
// start code to add selected product to customer list
if (isset($_POST['AddTolist'])) {
    $qty = $_POST['qty'];
    $prod_name = $_POST['prod_name'];



    //check for current stock to sell
    $readAction = mysqli_query($con, "SELECT * FROM item WHERE id='$prod_name'") or die(mysqli_error($con));
    $row1 = mysqli_fetch_array($readAction);
    $avblQty = $row1['qty'];



    //check products already in list
    $query1 = mysqli_query($con, "select * from purchase_temporary where prod_id='$prod_name'") or die(mysqli_error($con));
    $count = mysqli_fetch_array($query1);



    if ($count > 0) {
        // if same product found update it
        mysqli_query($con, "update purchase_temporary set qty=qty+'$qty'  where prod_id='$prod_name'  ") or die(mysqli_error($con));
    } else {
        // if product is new save it
        mysqli_query($con, "INSERT INTO purchase_temporary(prod_id,qty) VALUES('$prod_name','$qty')") or die(mysqli_error($con));
    }

    echo '<script type="text/javascript">
          swal("Saved!", " Successfully Added " , "success");
            </script>';
} // end code to add selected product to customer Invoice
?>

<?php
// start code to final save from list
if (isset($_POST['purcahseDone'])) {
    $username = $_SESSION["username"];

    // Execute the SQL query
    $query2 = "SELECT user.id FROM user WHERE user.username = '$username'";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_assoc($result2);

    // Check if a row was returned
    if ($row2) {
        $user_id = $row2['id'];
        $_SESSION['user_id'] = $user_id;
    }

    $innumber = isset($_POST['innumber']) ? $_POST['innumber'] : ''; // get main variables to save into first table
    $supplier = $_POST['supplier'];
    $total = str_replace(',', '', $_POST['total']);

    date_default_timezone_set("Asia/Colombo");
    $date = date("Y-m-d");

    // Save to the first table ("purchase")
    mysqli_query($con, "INSERT INTO purchase (date, code, supplier_id, user_id, total)  
        VALUES ('$date', '$innumber', '$supplier', '$user_id',' $total')") or die(mysqli_error($con));



    $request_id = mysqli_insert_id($con); // generate foreign key to save into the second table
    // Select all products from the "purchase_temporary" table
    $query = mysqli_query($con, "SELECT * FROM purchase_temporary") or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($query)) {
        $pid = $row['prod_id'];
        $qty = $row['qty'];

        // Save to the first table ("purchase")
        mysqli_query($con, "INSERT INTO purchaseitem (purchase_id, Item_id, qty)  
    VALUES ('$request_id', ' $pid',  '$qty')") or die(mysqli_error($con));

        // Update product quantity (-)
        mysqli_query($con, "UPDATE item SET qty = qty + '$qty' WHERE item.id = '$pid' ") or die(mysqli_error($con));
    }

    // Clear the "purchase_temporary" table
    $result = mysqli_query($con, "DELETE FROM purchase_temporary") or die(mysqli_error($con));

    // Redirect to the invoice print page or any other desired page
    echo "<script>document.location='Purchase_Slip.php?id=$request_id'</script>";
}
?>

<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h2>+Purchase Item</h2>
                <div class="card shadow ">
                    <div class="card-header">
                        <h4 class="card-title">New Purchases</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
                            <h6 class="mb-xlg text-center"><b> </b></h6>

                            <div class="form-group">

                                <label for="name" class="col-sm-2 control-label">Item </label>
                                <div class="col-sm-3">
                                    <select name="prod_name" class="form-control" style="width: 100%" required>
                                        <option selected disabled value=""> Select</option>
                                        <?php

                                        $queryc = mysqli_query($con, "select * from item") or die(mysqli_error($con));
                                        while ($rowc = mysqli_fetch_array($queryc)) {
                                        ?>
                                            <option value="<?php echo $rowc['id']; ?>"> <?php echo $rowc['code']; ?> - <?php echo $rowc['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <label for="name" class="col-sm-2 control-label"> Qty Recived</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="qty" min="1" required>
                                </div>
                            </div>


                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" name="AddTolist"> + Add to List </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-3 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="alert alert-warning m-none"> Item Name </th>
                                        <th class="alert alert-warning m-none"> Qty </th>
                                        <th class="alert alert-warning m-none"> Price </th>
                                        <th class="alert alert-warning m-none">Total ( P X Q ) </th>
                                        <th class="alert alert-warning m-none"> - </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $query = mysqli_query($con, "SELECT purchase_temporary.qty AS temp_qty, purchase_temporary.temp_trans_id, item.* FROM purchase_temporary LEFT JOIN item ON purchase_temporary.prod_id = item.id") or die(mysqli_error($con));
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>

                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['temp_qty']; ?></td>
                                            <td><?php echo $row['wop']; ?></td>

                                            <td class="text-end">Rs. <?php $total =  $row['temp_qty'] * $row['wop'];
                                                                        echo number_format($total, 2); ?></td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <a href="Purchase_Tempdelete.php?id=<?php echo $row['temp_trans_id']; ?>" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm"><i class="fa fa-lg fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="card mt-3 shadow">
                    <div class="card-header">
                        <div class="form-group">
                            <?php

                            $query = mysqli_query($con, "select * from purchase  order by code DESC LIMIT 1") or die(mysqli_error($con));
                            $result = mysqli_num_rows($query);
                            if ($result == 0) {
                                $newidNew = "I00001";
                            } else {
                                $rec = mysqli_fetch_assoc($query);
                                $lastid = $rec["code"];
                                $num = substr($lastid, 3);
                                $num++;
                                $newidNew = "I" . str_pad($num, 5, "0", STR_PAD_LEFT);
                            }

                            ?>

                            <label for="name" class="col-sm-2 control-label"> Invoice</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="innumber" value="<?php echo ($newidNew) ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
                            <h6 class="mb-xlg text-center"><b> </b></h6>

                            <?php
                            $query = mysqli_query($con, "SELECT purchase_temporary.qty AS temp_qty, item.wop, item.* FROM purchase_temporary LEFT JOIN item ON purchase_temporary.prod_id = item.id") or die(mysqli_error($con));
                            $grand = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $total = $row['temp_qty'] * $row['wop'];
                                $grand = $grand + $total;
                            }  ?>



                            <label for="name" class="col-sm-2 control-label"> TOTAL</label>
                            <div class="col-sm-9">
                                <input type="text" name="total" class="form-control" value="<?php echo number_format($grand, 2); ?>" readonly>
                            </div>
                            <br /> <br />


                            <label for="name" class="col-sm-2 control-label"> Supplier</label>
                            <div class="col-sm-9">




                                <select name="supplier" class="form-control" style="width: 100%" required>
                                    <option selected disabled value=""> Select</option>



                                    <?php

                                    $queryc = mysqli_query($con, "select * from supplier") or die(mysqli_error($con));
                                    while ($rowc = mysqli_fetch_array($queryc)) {
                                    ?>
                                        <option value="<?php echo $rowc['id']; ?>"> <?php echo $rowc['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-group" align="right">
                        <div class="col-sm-offset-2 col-sm-12"><br /> <br />
                            <button type="submit" class="btn btn-primary" name="purcahseDone"> Confirm Purchase </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
include('pages/footer.php');
?>