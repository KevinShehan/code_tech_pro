<?php
require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
// include('trash/astyle.php');
if (isset($_POST['AddTolist'])) {
    $qty = $_POST['qty'];
    $prod_id = $_POST['prod_name'];

    //check for current stock to sell

    $readAction = mysqli_query($con, "SELECT * FROM item WHERE id='$prod_id'") or die(mysqli_error($con));
    $row1 = mysqli_fetch_array($readAction);
    $avblQty = $row1['reorder'];

    if ($qty <= $avblQty) {

        //check products already in list
        $query1 = mysqli_query($con, "select * from sales_temporary where Item_id='$prod_id'") or die(mysqli_error($Hardwaresystem_Connection));
        $count = mysqli_fetch_array($query1);



        if ($count > 0) {
            // if same product found update it
    $row = mysqli_fetch_array($query1);
    $newQty = $row['qty'] + $qty;
    mysqli_query($con, "UPDATE sales_temporary SET qty = '$newQty' WHERE Item_id = '$prod_id'") or die(mysqli_error($con));
        } else {
            // if product is new save it
          // if product is new save it
    mysqli_query($con, "INSERT INTO sales_temporary (Item_id, qty) VALUES ('$prod_id', '$qty')") or die(mysqli_error($con));
        }

        echo '<script type="text/javascript">
          swal("Saved!", " Successfully Added " , "success");
            </script>';
    } else {
        echo '<script type="text/javascript">
      swal("NO STOCK!", "   No Stock   " , "info");
        </script>';
    }
} 


// Delete item from sales_temporary table
if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    $deleteQuery = mysqli_query($con, "DELETE FROM sales_temporary WHERE id = '$deleteId'") or die(mysqli_error($con));

    if ($deleteQuery) {
        echo '<script type="text/javascript">
            swal("Deleted!", "Successfully Deleted", "success");
            </script>';
    } else {
        echo '<script type="text/javascript">
            swal("Error!", "Failed to delete item", "error");
            </script>';
    }
}// end code to add selected product to customer Invoice
?>

<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="content">
                    <div class="content-header">
                        <div class="leftside-content-header">
                            <ul class="breadcrumbs">
                                <li><i class="fa fa-recycle" aria-hidden="true"></i><a href="#"> Item Sales</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="alert alert-warning m-none">
                            New Sale
                        </div>

                        <div class="col-md-8 col-md-offset-2 col-lg-12 col-lg-offset-0">
                            <div class="panel">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
                                                <h6 class="mb-xlg text-center"><b> </b></h6>

                                                <div class="form-group">

                                                    <label for="name" class="col-sm-2 control-label">Item </label>
                                                    <div class="col-sm-3">

                                                        <select name="prod_name" class="form-control" style="width: 100%" required>
                                                            <option selected disabled > Select</option>
                                                            <?php

                                                            $queryc = mysqli_query($con, "select * from item");
                                                            while ($rowc = mysqli_fetch_array($queryc)) {
                                                            ?>
                                                                <option value="<?php echo $rowc['id']; ?>"> <?php echo $rowc['code']; ?> - <?php echo $rowc['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <label for="name" class="col-sm-2 control-label"> Qty </label>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" name="qty" min="1" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary" name="AddTolist"> + Add to List </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel">
                                    <div class="panel-content">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="alert alert-warning m-none"> Item Name </th>
                                                        <th class="alert alert-warning m-none"> Price </th>
                                                        <th class="alert alert-warning m-none"> Qty </th>
                                                        <th class="alert alert-warning m-none">Total ( P X Q ) </th>
                                                        <th class="alert alert-warning m-none"> - </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $query = mysqli_query($con, "select * from sales_temporary left join item on sales_temporary.Item_id = item.id") or die(mysqli_error($con));
                                                    while ($row = mysqli_fetch_array($query)) { ?>
                                                        <tr>
                                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
                                                            <td><?php echo $row['name']; ?></td>
                                                            <td><?php echo $row['rop']; ?></td>
                                                            <td><?php echo $row['qty']; ?></td>

                                                            <td><?php $total =  $row['qty'] * $row['rop'];
                                                                echo number_format($total, 2); ?></td>



                                                            <td>
                                                                <div class="btn-group btn-group-xs">


                                                                <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm"><i class="fa fa-lg fa-trash"></i></a>

                                                                </div>
                                                            </td>
                                                        </tr>


                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
    function confirmDelete(id) {
        swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'sales_list_delete.php?id=' + id;
            } else {
                swal.fire('Cancelled', 'Your item is safe.', 'info');
            }
        });
    }
</script>

                            <div class="panel">
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
                                                <h6 class="mb-xlg text-center"><b> </b></h6>

                                                <div class="form-group">


                                                    <?php

                                                    // $query = mysqli_query($con, "select * from sales  order by innumber DESC LIMIT 1") or die(mysqli_error($con));
                                                    // $result = mysqli_num_rows($query);
                                                    // if ($result == 0) {
                                                    //     $newidNew = "I00001";
                                                    // } else {
                                                    //     $rec = mysqli_fetch_assoc($query);
                                                    //     $lastid = $rec["innumber"];
                                                    //     $num = substr($lastid, 3);
                                                    //     $num++;
                                                    //     $newidNew = "I" . str_pad($num, 5, "0", STR_PAD_LEFT);
                                                    // }

                                                    ?>

                                                    <label for="name" class="col-sm-2 control-label"> Invoice</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="innumber" value="<?php echo ($newidNew)  ?>" readonly>
                                                    </div>
                                                </div>



                                                <?php
                                                $query = mysqli_query($con, "select * from sales_temporary left join item on sales_temporary.item_id = item.id") or die(mysqli_error($con));
                                                $grand = 0;
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $total = $row['qty'] * $row['prod_price'];
                                                    $grand = $grand + $total;
                                                }
                                                ?>
                                                <label for="name" class="col-sm-2 control-label"> TOTAL</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" value="<?php //echo number_format($grand, 2); 
                                                                                                    ?>" readonly>
                                                </div>


                                                <br /> <br />
                                                <label for="name" class="col-sm-2 control-label"> Customer</label>


                                                <div class="col-sm-9">
                                                    <select name="customer" class="form-control" style="width: 100%" required>
                                                        <option selected disabled value=""> Select</option>
                                                        <?php

                                                        $queryc = mysqli_query($con, "select * from customer") or die(mysqli_error($con));
                                                        while ($rowc = mysqli_fetch_array($queryc)) {
                                                        ?>
                                                            <option value="<?php echo $rowc['id']; ?>"> <?php echo $rowc['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                        </div>


                                        <br />

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <br />
                                                <button type="submit" class="btn btn-primary" name="saleDone"> Confirm Sale </button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>


            </div>
        </div>
    </div>
</main>



<?php
include('pages/footer.php');
?>