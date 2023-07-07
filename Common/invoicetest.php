<?php
//Authentication
require('pages/Auth.php');
//Profile
include('config/dbconnection.php');
include('pages/Header.php');
include('Top_nav.php');
include('Side_nav.php');
?>



<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card shadow">
          <div class="card-header">
            <h3>
              <span><i class="fas fa-folder"></i>
              </span> Invoices
            </h3>
          </div>
          <div class="card-body">
            <?php
            if (isset($_POST['AddTolist'])) {
              // Access the submitted values
              $prod_id = $_POST['prod_name'];
              $qty = $_POST['qty'];

              // Check for current stock
              $query_stock = "SELECT reorder FROM item WHERE id='$prod_id'";
              $result_stock = mysqli_query($con, $query_stock);
              $row_stock = mysqli_fetch_array($result_stock);
              $avblQty = $row_stock['reorder'];

              if ($qty <= $avblQty) {
                // Check if product already exists in the temporary sales table
                $query_existing = "SELECT * FROM sales_temporary WHERE Item_id='$prod_id'";
                $result_existing = mysqli_query($con, $query_existing);
                $count_existing = mysqli_num_rows($result_existing);

                if ($count_existing > 0) {
                  // Update the quantity if the product already exists
                  $row_existing = mysqli_fetch_array($result_existing);
                  $newQty = $row_existing['qty'] + $qty;
                  mysqli_query($con, "UPDATE sales_temporary SET qty = '$newQty' WHERE Item_id = '$prod_id'");
                } else {
                  // Insert a new entry for the product if it doesn't exist
                  mysqli_query($con, "INSERT INTO sales_temporary (Item_id, qty) VALUES ('$prod_id', '$qty')");
                }

                // Success message and redirect
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>';
                echo '<script type="text/javascript">';
                echo '  Swal.fire({';
                echo '    icon: "success",';
                echo '    title: "Success",';
                echo '    text: "Category saved successfully"';
                echo '  }).then(function() {';
                echo '    window.location.href = "Invoice sale test.php";';
                echo '  });';
                echo '</script>';
              } else {
                // Out of stock error message
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>';
                echo '<script>';
                echo '  window.onload = function() {';
                echo '    Swal.fire({';
                echo '      icon: "info",';
                echo '      title: "NO STOCK!",';
                echo '      text: "Out of stock item"';
                echo '    });';
                echo '  };';
                echo '</script>';
              }
            }
            ?>
            <form class="form-horizontal" id="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Item Name:</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <div class="col-sm-2">
                      <!-- <input type="text" placeholder="Code" required class="form-control col-sm-2" name="cat_code" readonly id="codeInput"> -->

                    </div>
                    <select name="prod_name" class="form-control" style="width: 100%" required>
                      <option selected disabled>Select</option>
                      <?php
                      $queryc = mysqli_query($con, "select * from item");
                      while ($rowc = mysqli_fetch_array($queryc)) {
                      ?>
                        <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['code']; ?> - <?php echo $rowc['name']; ?></option>
                      <?php } ?>
                    </select>
                    <label for="name" class="col-sm-2 control-label">Qty</label>
                    <div class="col-sm-3">
                      <input type="number" class="form-control" name="qty" min="1" required>
                    </div>
                    <div class="input-group-append">
                      <button type="submit" name="AddTolist" class="btn btn-success shadow" value="Submit" style="background-color: #428bca; color: #ffffff; margin-left: 10px;" onmouseover="this.style.backgroundColor='#245269';" onmouseout="this.style.backgroundColor='#428bca';">+ Add Item</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>


            <?php   // start code to final save from list  
if (isset($_POST['saleDone'])) {
  $username = $_SESSION["username"];
  $user_idq = "select user.id from username where username='$username'";
  $user_resultq = mysqli_query($con, $user_idq);
  $row_user = mysqli_fetch_assoc($user_resultq);
  $user_id = $row_user['id'];

  $innumber = $_POST['innumber']; // get main variables to save into first table
  $customer = $_POST['customer'];
  $description = $_POST['description'];
  $total = $_POST['total'];

  date_default_timezone_set("Asia/colombo");
  $date = date("Y-m-d H:i:s");

  mysqli_query($con, "INSERT INTO invoice(user_id,customer_id,date_total,description,code ) 
  VALUES('$user_id','$customer','$date','$total','$Description','$innumber')") or die(mysqli_error($con)); // save to first table


  $Request_id = mysqli_insert_id($con); // genarate forgin key to save into second table

  $query = mysqli_query($con, "select * from sales_temporary ") or die(mysqli_error($con));
  while ($row = mysqli_fetch_array($query)) // select all products from Invoice to save into second table with foreign key
  {
    $pid = $row['item_id'];
    $qty = $row['qty'];

    // save into second table
    mysqli_query($con, "INSERT INTO invioceitem(item_id,qty,Requested_id) VALUES('$pid','$qty','$Request_id')") or die(mysqli_error($con));

    // update product qty (-)
    mysqli_query($con, "UPDATE item SET reorder=reorder-'$qty' where item.it='$pid' ") or die(mysqli_error($con));
  }
  //clear  Invoice
  $result = mysqli_query($con, "DELETE FROM sales_temporary")  or die(mysqli_error($con));
  // go for invoice print
  echo "<script>document.location='sales_Slip.php?id=$Request_id'</script>";
}
?>

<table class="table table-striped table-bordered" id="categoryTable">
              <thead>
                <tr class="table-primary">
                  <th scope="col" class="col-1">No</th>
                  <th scope="col">Name</th>
                  <th scope="col"> Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total (UxQ)</th>
                  <th scope="col" class="col-3">Manage</th>
                </tr>
              </thead>
              <tbody>
              <?php
$total = 0; // Initialize the $total variable outside the loop

// Fetch latest category records from the database
$query = 'SELECT * FROM sales_temporary';
$result = mysqli_query($con, $query);

if (!$result) {
  die('Error: ' . mysqli_error($con));
}

// Generate the HTML markup for category records
$number = 1;
$x;
while ($row = mysqli_fetch_assoc($result)) {
  $item = $row['Item_id'];
  $query2 = "SELECT name, rop FROM item WHERE id='$item'";
  $result2 = mysqli_query($con, $query2);
  $row2 = mysqli_fetch_assoc($result2);

  $qty1 = $row['qty'];
  $total = $qty1 * $row2['rop']; // Calculate $total inside the loop

  ?>

  <tr>
    <td><?php echo $number; ?></td>
    <td><?php echo $row2['name']; ?></td>
    <td><?php echo $row2['rop']; ?></td>
    <td><?php echo $row['qty']; ?></td>
    <td><?php echo number_format($total, 2); ?></td>
    <? $x=$x+$total; 
    $_SESSION['x']=$x?>
    <td>
      <a href="sales_list_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm"><i class="fa fa-lg fa-trash"></i> </a>
    </td>
  </tr>

  <?php
  $number++;
}
?>

              </tbody>
            </table>

            <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
              <div class="text-end">
                Discount
                <input type="number" min="1">
              </div>
              <div class="text-end">
                <?php
                $query = mysqli_query($con, "select * from sales_temporary left join item on sales_temporary.item_id = item.id") or die(mysqli_error($con));
                $grand = 0;

                while ($row = mysqli_fetch_array($query)) {
                  $item = $row['Item_id'];
                  $quan=$row['qty'];

                  $query2 = "SELECT rop FROM item WHERE id='$item'";
                  $result2 = mysqli_query($con, $query2);
                  $row2 = mysqli_fetch_assoc($result2);

                  $qty1 = $row2['rop'];
                  $total =  $quan* $qty1;
                  $grand += $total;
                }
                ?>
                Total
                <input type="text" readonly name="total" value="<?php echo number_format( $total, 2); ?>">
              </div>
              <?php ?>

              <div>
                Description
                <input type="text" name="description">

              </div>


              <?php
              $query = mysqli_query($con, "select * from invoice  order by code DESC LIMIT 1") or die(mysqli_error($con));
              $result = mysqli_num_rows($query);
              if ($result == 0) {
                $newidNew = "I00001";
              } else {
                $rec = mysqli_fetch_assoc($query);
                $lastid = $rec["innumber"];
                $num = substr($lastid, 3);
                $num++;
                $newidNew = "I" . str_pad($num, 5, "0", STR_PAD_LEFT);
              }
              ?>

              <label for="name" class="col-sm-2 control-label"> Invoice</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="innumber" value="<?php echo ($newidNew) ?>" readonly>
              </div>


              <div>
                Customer Select
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
              <br />
              <button class="btn btn-primary" name="saleDone">Create Sale</button>
            </form>
          </div>
        </div>
      </div>
    </div>






























          </div>
        </div>
      </div>
    </div>

    <!-- Include Bootstrap JS -->

  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>



<?php include('pages/Footer.php'); ?>