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
                <div class="card">
                    <div class="card-header">

                        <div class="alert alert-warning m-none">
                            New Sale
                        </div>
                        <h1>
                            <span><i class="bi bi-table me-2"></i></span> Sales Invoice
                        </h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-sm">
                                <div>
                                    <div class="col-md-6">
                                        <label for="">Name :-</label>
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>Mr.</option>
                                                <option value="1">Mrs.</option>
                                                <option value="2">Miss.</option>
                                            </select>
                                            <input type="Text" name="telephone" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>

                                <div>
                                    <label for="">Gender</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Male</option>
                                        <option value="1">Female</option>
                                        <option value="2">Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="">NIC</label>
                                    <input type="tel" name="telephone" id="" class="form-control" required>
                                </div>

                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>


                            </div>
                            <div class="col-sm">
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1" class="form-label "><b></b></label>
                                        <select class="form-select form-select-sm " aria-label=".form-select-sm example" name="itemName" id="itemName">
                                            <option selected>Mr.</option>
                                            <option value="1">Mrs.</option>
                                            <option value="2">Miss.</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1" class="form-label"><b> Quantity</b></label>
                                        <input type="number" name="quantity" min="0" max="100" step="1" class="form-control" name="quantity" id="quantity">

                                    </div>

                                </div>

                                <!-- <div class="input-group">
                                    <input type="number" class="form-control" name="quantity" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fas fa-caret-up"></i></button>
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-caret-down"></i></button>
                                    </div>
                                </div> -->

                                <button type="button" class="btn btn-outline-primary" onclick="addItem()">+Add to List</button>

                            </div>
                        </div>
                        <form action="">
                            <table class="table" id="invoiceTable">
                                <thead class="table-dark">
                                    <tr>
                                        <td>No</td>
                                        <td>Item Name</td>
                                        <td>Warrenty</td>
                                        <td>Unit Price</td>
                                        <td>Total ( P X Q )</td>
                                        <td>-</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Start with an initial row number
                                    $rowNumber = 1;

                                    // Check if the form is submitted
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        // Get the item name and quantity from the form inputs
                                        $itemName = $_POST["itemName"];
                                        $quantity = $_POST["quantity"];

                                        // Create a new row for the table
                                        $row = "<tr>";
                                        $row .= "<td>" . $rowNumber . "</td>";
                                        $row .= "<td>" . $itemName . "</td>";
                                        $row .= "<td>" . $quantity . "</td>";
                                        $row .= "<td><button class='btn btn-danger btn-sm' onclick='deleteRow(this)'>Delete</button></td>";
                                        $row .= "</tr>";

                                        // Increment the row number for the next row
                                        $rowNumber++;

                                        // Echo the row to be added to the table
                                        echo $row;
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <button class="btn btn-success">Create Invoice</button>

                        </form>
                    </div>
                </div>


            </div>
        </div>
</main>
<script>
  function addItem() {
    // Get the item name and quantity from the form inputs
    var itemName = document.getElementById("itemName").value;
    var quantity = document.getElementById("quantity").value;

    // Create a FormData object and append the data
    var formData = new FormData();
    formData.append("itemName", itemName);
    formData.append("quantity", quantity);

    // Send a POST request to the server
    fetch("invoice.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.text())
    .then(row => {
      // Create a new row element
      var newRow = document.createElement("tr");
      newRow.innerHTML = row;

      // Append the new row to the table body
      document.getElementById("invoiceTable").getElementsByTagName("tbody")[0].appendChild(newRow);

      // Clear the form inputs
      document.getElementById("itemName").value = "";
      document.getElementById("quantity").value = "";
    });
  }

  function deleteRow(button) {
    // Get the reference to the row to be deleted
    var row = button.parentNode.parentNode;
    
    // Remove the row from the table
    row.remove();
  }
</script>








<?php
include('pages/footer.php');
?>