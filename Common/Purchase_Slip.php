<?php

include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

<div class="content">
  <div class="content-header">
    <div class="leftside-content-header">
      <ul class="breadcrumbs">
        <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Invoice</a></li>

      </ul>
    </div>
  </div>

  <div class="row">
    <div id="myDiv">
      <div id="div_print">
        <div class="col-md-8 col-md-offset-2 col-lg-12 col-lg-offset-0">
          <div class="panel">
            <div class="panel-content">
              <h5> Code Technology </h5> Purchase Invoice
            </div>
          </div>


          <div class="col-6">

            <?php
            $id = $_GET['id'];
            $query = mysqli_query($con, "SELECT * FROM purchase LEFT JOIN supplier ON purchase.supplier_id = supplier.id WHERE purchase.id = '$id'");

            if (mysqli_num_rows($query) > 0) {
              while ($row = mysqli_fetch_array($query)) {
                echo '<h5 class="text-right">Date: ' . $row['date'] . '</h5>';
                echo '<h5 class="text-right">Supplier Invoice#: ' . $row['code'] . '</h5>';
                echo '<br />';
                echo '<h5 class="text-right">Supplier Name: ' . $row['name'] . '</h5>';
                echo '<h5 class="text-right">Address: ' . $row['address'] . '</h5>';
              }
            } else {
              echo '<h5 class="text-right">No records found.</h5>';
            }
            ?>

            <div class="panel">
              <div class="panel-content">
                <div class="form-wizard wizard-basic ">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Items</th>
                          <th> Qty</th>
                          <th> Cost</th>
                          <th> Total</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        $id = $_GET['id'];
                        $query = mysqli_query($con, "SELECT item.name AS item_name, purchaseitem.qty, item.wop
                         FROM purchaseitem LEFT JOIN item ON purchaseitem.Item_id = item.id
                          WHERE purchaseitem.purchase_id = '$id'") or die(mysqli_error($con));



                        // $query = mysqli_query($con, "SELECT item.name AS item_name, invoiceitem.qty, item.rop
                        //                  FROM invoiceitem
                        //                  LEFT JOIN item ON invoiceitem.Item_id = item.id
                        //                  WHERE invoiceitem.invoice_id = '$id'")
                        //   or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($query)) {

                          $cus = "SELECT  total FROM purchase WHERE id = $id ";
                          $cus_result = mysqli_query($con, $cus);
                          $row1 = mysqli_fetch_assoc($cus_result)['total'];
                        ?>

                          <tr>
                            <td class="product-name"> <?php echo $row['item_name']; ?> </td>
                            <td class="product-name"> <?php echo $row['qty']; ?> </td>
                            <td class="product-name"> <?php $p =  $row['wop'];
                                                      echo number_format($p, 2); ?> </td>
                            <td class="product-name"> <?php $t =  $row['wop']  *  $row['qty'];
                                                      echo number_format($t, 2); ?> </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>


                    <div align="right">
                      <div class="col-4 table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th> Total</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $query = mysqli_query($con, "SELECT purchase.total FROM purchase WHERE purchase.id = '$id'")
                              or die(mysqli_error($con));
                            $grand = 0;
                            while ($row = mysqli_fetch_array($query)) {
                              $qty = $row['total'];
                              // $rop = $row['rop'];
                              // $total = $qty * $rop;
                              // $grand += $total;


                            ?> <?php } ?>

                            <tr>

                              <td class="product-name"> <?php echo number_format($qty, 2); ?>
                              </td>


                          </tbody>
                        </table>
                      </div>





                    </div>


                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
      <center>

        <input name="b_print" type="button" class="btn btn-success btn-print" onClick="printdiv('div_print');" value=" Print ">
      </center>

    </div>
  </div>


  <script language="javascript">
    window.onload = function() {
      printdiv('div_print');
    };

    function printdiv(printpage) {
      var headstr = "<html><head><title></title></head><body>";
      var footstr = "</body>";
      var newstr = document.getElementById(printpage).innerHTML;
      var oldstr = document.body.innerHTML;
      document.body.innerHTML = headstr + newstr + footstr;
      window.print();
      document.body.innerHTML = oldstr;
      return false;
    }

    window.onafterprint = function() {
      window.location.href = 'Purchase_view.php'; // Replace with the URL of your invoice test page
    };
  </script>


  <?php include('pages/footer.php');    ?>