<?php
require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

<style>
    body {
        background-color: lightcyan;
    }

    #myTable th:nth-child(9),
    #myTable td:nth-child(9) {
        text-align: right;
        width: 150px;
        /* Adjust the width as needed */
    }

    #subtotal {
        float: right;
        margin-top: 10px;
    }

    #discount {
        float: right;
        margin-top: 10px;
        margin-right: 10px;
    }

    @media print {
        button.btn {
            display: none;
        }

        form,
        #subtotal,
        #discount {
            display: none !important;
        }
    }
</style>

<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                Create Invoice
                <div class="panel">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
                                    <h6 class="mb-xlg text-center"><b> </b></h6>

                                    <div class="form-group">

                                        <label for="name" class="col-sm-2 control-label">Item / Tool</label>
                                        <div class="col-sm-3">

                                            <select name="prod_name" class="form-control" style="width: 100%" required>
                                                <option selected disabled value=""> Select</option>
                                                <?php

                                                $queryc = mysqli_query($con, "select * from item");
                                                //     while($rowc=mysqli_fetch_array($queryc)){
                                                //     
                                                ?>
                                                <option value="<?php //echo //$rowc['prod_id'];
                                                                ?>"> <?php //echo $rowc['serial'];
                                                                        ?> - <?php //echo $rowc['prod_name'];
                                                                                                            ?></option>
                                                <?php //}
                                                ?>
                                            </select>
                                        </div>

                                        <label for="name" class="col-sm-2 control-label"> Qty Sold</label>
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




















                <form>
                    <label for=""></label>
                    <input type="text">
                </form>

                <table class="table table-striped table-bordered table-primary" id="myTable">
                    <thead>
                        <tr>
                            <th>No
                            </th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Warranty</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Total Price</th>
                            <th>
                                <button class="btn btn-success btn-sm" onclick="addRow()"><span style="font-family: 'Arial', sans-serif">&#43;</span>
                                </button>
                            </th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div id="subtotal">Subtotal: Rs0</div> <!-- Subtotal label -->
                <br />
                <div id="discount" class="text-end">Discount: Rs 0</div> <!-- Discount label -->
                <button class="btn btn-primary" onclick="createInvoice()">Create Invoice</button>
            </div>
        </div>
    </div>
</main>

<script>
    var rowCounter = 1;

    function addRow() {
       // Get the table and tbody element
       var table = document.getElementById("myTable");
        var tbody = table.getElementsByTagName("tbody")[0];

        // Create a new row
        var row = document.createElement("tr");
        row.id = "row" + rowCounter;

        // Add cells to the row
        row.innerHTML = `
            <td>${rowCounter}</td>
            <td><a href="#" onclick="selectItem(this)">Item ${rowCounter}</a></td>
            <td><input type="text" class="form-control" placeholder="Description"></td>
            <td><input type="text" class="form-control" placeholder="Warranty"></td>
            <td><input type="number" class="form-control" placeholder="Quantity" onchange="calculateTotal(this)"></td>
            <td><input type="number" class="form-control" placeholder="Unit Price" onchange="calculateTotal(this)"></td>
            <td><input type="number" class="form-control" placeholder="Discount" onchange="calculateTotal(this)"></td>
            <td><span class="total-price text-end">0</span></td>
            <td><button class="btn btn-danger btn-sm" onclick="deleteRow(this)">&#10060;</button></td>
        `;

        // Append the row to the tbody
        tbody.appendChild(row);

        // Increment the row counter
        rowCounter++;

        // Calculate subtotal and update the display
        calculateSubtotal();
    }

    function deleteRow(deleteButton) {
        var row = deleteButton.parentNode.parentNode;
        row.parentNode.removeChild(row);

        // Calculate subtotal and update the display
        calculateSubtotal();
    }

    function clearRowInputs(row) {
        var inputs = row.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = "";
        }
        row.cells[7].innerHTML = "<span class='total-price text-end'>0</span>";

        // Calculate subtotal and update the display
        calculateSubtotal();
    }

    function calculateTotal(input) {
        var row = input.parentNode.parentNode;
        var quantityInput = row.cells[4].getElementsByTagName("input")[0];
        var unitPriceInput = row.cells[5].getElementsByTagName("input")[0];
        var discountInput = row.cells[6].getElementsByTagName("input")[0];
        var totalPriceSpan = row.cells[7].getElementsByClassName("total-price")[0];

        var quantity = parseInt(quantityInput.value);
        var unitPrice = parseFloat(unitPriceInput.value);
        var discount = parseFloat(discountInput.value);
        var totalPrice = quantity * unitPrice * (1 - discount / 100);

        totalPriceSpan.textContent = totalPrice.toFixed(2);

        // Calculate subtotal and update the display
        calculateSubtotal();
        calculateDiscountTotal();
    }

    function calculateSubtotal() {
        var table = document.getElementById("myTable");
        var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
        var subtotal = 0;

        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var totalPrice = parseFloat(row.cells[7].textContent);
            subtotal += totalPrice;
        }

        document.getElementById("subtotal").textContent = "Subtotal: Rs" + subtotal.toFixed(2);
    }

    function calculateDiscountTotal() {
        var table = document.getElementById("myTable");
        var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
        var discountTotal = 0;

        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var discountInput = row.cells[6].getElementsByTagName("input")[0];
            var discount = parseFloat(discountInput.value);
            discountTotal += discount;
        }

        document.getElementById("discount").textContent = "Discount: Rs" + discountTotal.toFixed(2);
    }

    function createInvoice() {
  var table = document.getElementById("myTable");
  var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
  var invoiceItems = [];
  
  for (var i = 0; i < rows.length; i++) {
    var row = rows[i];
    var itemNo = row.cells[0].textContent;
    var description = row.cells[2].getElementsByTagName("input")[0].value;
    var warranty = row.cells[3].getElementsByTagName("input")[0].value;
    var quantity = parseInt(row.cells[4].getElementsByTagName("input")[0].value);
    var unitPrice = parseFloat(row.cells[5].getElementsByTagName("input")[0].value);
    var discount = parseFloat(row.cells[6].getElementsByTagName("input")[0].value);
    var totalPrice = parseFloat(row.cells[7].textContent);
    
    var item = {
      itemNo: itemNo,
      description: description,
      warranty: warranty,
      quantity: quantity,
      unitPrice: unitPrice,
      discount: discount,
      totalPrice: totalPrice
    };
    
    invoiceItems.push(item);
  }
  
  // Send invoiceItems to server or perform further actions
  console.log(invoiceItems);
  
  // Print the table only
  window.print();
}


function selectItem(link) {
  var row = link.parentNode.parentNode;
  var itemId = row.cells[1].getElementsByTagName("a")[0].textContent;
  var itemSelect = document.getElementById("itemSelect");
  var quantityInput = document.getElementById("quantityInput");
  
  // Set the selected item and quantity in the modal
  itemSelect.value = itemId;
  quantityInput.value = 1;
  
  // Open the Bootstrap modal
  $('#itemModal').modal('show');
}
</script>


<!-- Add this code after the <div id="discount" class="text-end">Discount: Rs 0</div> line -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Item Selection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Customize the content of the modal body as per your requirements -->
                <label for="itemSelect">Select Item:</label>
                <select id="itemSelect" class="form-control">
                    <option value="">Select</option>
                    <?php
                    $queryc = mysqli_query($con, "select * from item");
                    while ($rowc = mysqli_fetch_array($queryc)) {
                    ?>
                        <option value="<?php echo $rowc['id']; ?>">
                            <?php echo $rowc['id']; ?> - <?php echo $rowc['name']; ?>
                        </option>
                    <?php } ?>
                </select>

                <label for="quantityInput">Quantity:</label>
                <input type="number" id="quantityInput" class="form-control" min="1" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Select Item</button>
            </div>
        </div>
    </div>
</div>


<?php
include('pages/footer.php');
?>