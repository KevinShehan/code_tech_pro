<?php
//Authentication
require('pages/Auth.php');
//Profile
include('config/dbconnection.php');
include('pages/Header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

<style>
  body {
    background-color: lightcyan;
  }


  .dataTables_wrapper {
    margin-top: 20px;
    /* Adjust the margin value as per your needs */
  }

  .dataTables_filter {
    margin-bottom: 10px;
    /* Adjust the margin value as per your needs */
  }
</style>


<?php
if (isset($_POST['AddTolist'])) {
  // Access the submitted values
  $property_id = $_POST['property'];
  $property_owner_id = $_POST['property_owner'];

  // Check for current stock
  $query_stock = "SELECT reorder FROM property WHERE id='  $property_id'";
  $result_stock = mysqli_query($con, $query_stock);
  $row_stock = mysqli_fetch_array($result_stock);
  $avblQty = $row_stock['reorder'];
  $qty = $row_stock['value'];

  if ($qty <= $avblQty) {
    // Check if product already exists in the temporary sales table
    $query_existing = "SELECT * FROM Assessment_temporary WHERE Item_id=' $property_id'";
    $result_existing = mysqli_query($con, $query_existing);
    $count_existing = mysqli_num_rows($result_existing);

    if ($count_existing > 0) {
      // Update the quantity if the product already exists
      mysqli_query($con, "INSERT INTO Assessment_temporary (Property_id, value) VALUES ('$prod_id', '$qty')");
    }

    // Success message and redirect
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>';
    echo '<script type="text/javascript">';
    echo '  Swal.fire({';
    echo '    icon: "success",';
    echo '    title: "Success",';
    echo '    text: "Property Added successfully"';
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
    echo '      title: "Already Paid!",';
    echo '      text: "Nothing to pay this Property"';
    echo '    });';
    echo '  };';
    echo '</script>';
  }
}
?>
<?php   // start code to final save from list  
if (isset($_POST['saleDone'])) {
  $username = $_SESSION["username"];
  $user_idq = "select user.id from user where username='$username'";
  $user_resultq = mysqli_query($con, $user_idq);
  $row_user = mysqli_fetch_assoc($user_resultq);
  $user_id = $row_user['id'];

  $innumber = $_POST['innumber']; // get main variables to save into first table
//   $customer = $_POST['customer'];
  $description = $_POST['description'];
//   $total = str_replace(',', '', $_POST['total']);

  date_default_timezone_set("Asia/colombo");
  $date = date("Y-m-d");

//   mysqli_query($con, "INSERT INTO Assessment(user_id,customers_id,date,total,description,code ) 
//   VALUES('$user_id','$customer','$date','$total','$description','$innumber')") or die(mysqli_error($con)); // save to first table


//   $Request_id = mysqli_insert_id($con); // genarate forgin key to save into second table

//   $query = mysqli_query($con, "select * from sales_temporary ") or die(mysqli_error($con));
//   while ($row = mysqli_fetch_array($query)) // select all products from Invoice to save into second table with foreign key
//   {
//     $pid = $row['Item_id'];
//     $qty = $row['qty'];

//     // save into second table
//     mysqli_query($con, "INSERT INTO invoiceitem(item_id,qty,invoice_id) VALUES('$pid','$qty','$Request_id')") or die(mysqli_error($con));

//     // update product qty (-)
//     mysqli_query($con, "UPDATE item SET reorder=reorder-'$qty' where item.id='$pid' ") or die(mysqli_error($con));
//   }
//   //clear  Invoice
//   $result = mysqli_query($con, "DELETE FROM sales_temporary")  or die(mysqli_error($con));
//   // go for invoice print
  echo "<script>document.location='sales_Slip.php?id=$Request_id'</script>";
}
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
              </span> Assessment Invoices
            </h3>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div class="form-group" id="custom-input">
                <div class="row">
                  <div class="form-group">
                    <div>
                      Property Owner
                      <div class="col-sm-4">
                        <select name="property_owner" class="form-control" required>
                          <option selected disabled value=""> Select</option>
                          <?php
                          $queryc = mysqli_query($con, "select * from property_owner") or die(mysqli_error($con));
                          while ($rowc = mysqli_fetch_array($queryc)) {
                          ?>
                            <option value="<?php echo $rowc['id']; ?>"> <?php echo $rowc['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gender" class="col-sm-2 col-form-label">Property Select:</label>
                    <div class="col-sm-4">
                      <select name="property" class="form-control" required>
                        <option selected disabled>Select</option>
                        <?php
                        $queryc = mysqli_query($con, "select * from property");
                        while ($rowc = mysqli_fetch_array($queryc)) {
                        ?>
                          <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['code']; ?> - <?php echo $rowc['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="col-sm-3">
                      <button type="submit" name="AddTolist" class="btn btn-success shadow mt-2" value="Submit" style="background-color: #428bca; color: #ffffff;">+ Add</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <table class="table table-striped table-bordered" id="categoryTable">
              <thead>
                <tr class="table-primary">
                  <th scope="col" class="col-1">No</th>
                  <th scope="col">Name</th>
                  <th scope="col"> Assessment Values</th>
                  <th scope="col">Period</th>
                  <!-- <th scope="col">Total (UxQ)</th> -->
                  <th scope="col" class="col-3">Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Fetch latest category records from the database
                $query = 'SELECT * FROM Assessment_temporary';
                $result = mysqli_query($con, $query);

                if (!$result) {
                  die('Error: ' . mysqli_error($con));
                }

                // Generate the HTML markup for category records
                $number = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  $item = $row['Property_id'];
                  $query2 = "SELECT name,value FROM property WHERE id='$item'";
                  $result2 = mysqli_query($con, $query2); // Corrected variable name here
                  $row2 = mysqli_fetch_assoc($result2);

                  // $qty1 = $row['qty'];
                  // $total = $row['qty'] * $row2['rop'];
                ?>

                  <tr>
                    <td> <?php echo $number; ?> </td>
                    <td> <?php echo $row2['name']; ?> </td>
                    <td> <?php echo $row2['value']; ?></td>
                    <td> <?php echo $row2['value']; ?></td>
                    <!-- <td><?php $total =  $row['qty'] * $row2['rop'];
                              echo number_format($total, 2); ?></td>
                    <td> -->
                    <a href="assessment_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm"><i class="fa fa-lg fa-trash"></i> </a>


                    </td>

                  <?php $number++;
                } ?>
              </tbody>
            </table>
            <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
              <!-- <div class="text-end">
                Discount (%)
                <input type="number" min="0" step="any" id="discountInput" oninput="calculateTotal()">
              </div> -->
              <div class="text-end">
                <?php
                // $query = mysqli_query($con, "SELECT st.qty AS sales_qty, st.Item_id, i.qty AS item_qty FROM sales_temporary AS st LEFT JOIN item AS i ON st.Item_id = i.id") or die(mysqli_error($con));
                // $grand = 0;

                // while ($row = mysqli_fetch_array($query)) {
                //   $item = $row['Item_id'];
                //   $quan = $row['sales_qty'];

                //   $query2 = "SELECT rop FROM item WHERE id='$item'";
                //   $result2 = mysqli_query($con, $query2);
                //   $row2 = mysqli_fetch_assoc($result2);

                //   $qty1 = $row2['rop'];
                //   $total =  $quan * $qty1;
                //   $grand += $total;
                // }
                ?>
                Total
                <input type="text" readonly name="total" id="totalOutput" value="<?php //echo number_format($grand, 2); 
                                                                                  ?>">
              </div>

              <div>
                Description
                <textarea class="form-control" name="description" rows="3"></textarea>
              </div>

              <?php
              $query = mysqli_query($con, "select * from Assessment  order by code DESC LIMIT 1") or die(mysqli_error($con));
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

              <div class="form-group">
                <label for="name" class="col-sm-1 control-label">Date</label>
                <div class="col-sm-2">
                  <input type="Date" class="form-control" name="qty" min="1" required>
                </div>
              </div>
              <br />
              <button type="submit" class="btn btn-primary" name="saleDone">Create Sale</button>
            </form>

            <script>
              function calculateTotal() {
                var discountInput = document.getElementById('discountInput');
                var totalOutput = document.getElementById('totalOutput');

                var discountPercentage = parseFloat(discountInput.value);
                var total = <?php echo $grand; ?>; // Retrieve the initial total from PHP variable

                if (!isNaN(discountPercentage)) {
                  var discountAmount = (discountPercentage / 100) * total;
                  var discountedTotal = total - discountAmount;
                  totalOutput.value = discountedTotal.toFixed(2);
                } else {
                  totalOutput.value = total.toFixed(2);
                }
              }
            </script>

          </div>
        </div>
      </div>
    </div>

    <!-- Include Bootstrap JS -->

  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>



<?php include('pages/Footer.php'); ?>