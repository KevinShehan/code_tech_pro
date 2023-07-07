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

            <?php $id = $_GET['id'];
            $query = mysqli_query($con, "select * from purchase left join supplier on  purchase.supplier_id =  supplier.id  where purchase_id = '$id'") or die(mysqli_error());

            while ($row = mysqli_fetch_array($query)) {


            ?>

              <h5 class="text-right">Date: <?php echo $row['date_added']; ?> </h5>
              <h5 class="text-right">Supplier Invoice#: <?php echo $row['innumber']; ?> </h5>

              <br />

              <h5 class="text-right">Supplier Name: <?php echo $row['supplier_name']; ?> </h5>
              <h5 class="text-right">Address: <?php echo $row['supplier_address']; ?> </h5>
            <?php } ?>


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
                        $query = mysqli_query($con, "select * from purchaseitem left join item on purchaseetails.item_id = item.id  where purchase_id = '$id' ") or die(mysqli_error());

                        while ($row = mysqli_fetch_array($query)) {

                        ?>

                          <tr>
                            <td class="product-name"> <?php echo $row['name']; ?> </td>
                            <td class="product-name"> <?php echo $row['qty']; ?> </td>
                            <td class="product-name"> <?php $p =  $row['total'];
                                                      echo number_format($p, 2); ?> </td>
                            <td class="product-name"> <?php $t =  $row['Cost']  *  $row['qty'];
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

                            $id = $_GET['id'];
                            $query = mysqli_query($con, "select * from purchaseetails left join products on purchaseetails.pro_id = products.prod_id  where Requested_id = '$id' ") or die(mysqli_error());
                            $grand = 0;
                            while ($row = mysqli_fetch_array($query)) {
                              $total = $row['qty'] * $row['Cost'];
                              $grand = $grand + $total;


                            ?> <?php } ?>

                            <tr>

                              <td class="product-name"> <?php echo number_format($grand, 2); ?> </td>


                            </tr>

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
    function printdiv(printpage) {
      var headstr = "<html><head><title></title></head><body>";
      var footstr = "</body>";
      var newstr = document.all.item(printpage).innerHTML;
      var oldstr = document.body.innerHTML;
      document.body.innerHTML = headstr + newstr + footstr;
      window.print();
      document.body.innerHTML = oldstr;
      location.reload();
      return false;
    }
  </script>

  <?php include('Include/footer.php');    ?>