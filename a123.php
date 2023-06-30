<!DOCTYPE html>
<html>
<head>
    <title>Invoice System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Invoice System</h1>

        <form id="customer-form">
            <div class="form-group">
                <label for="name">Customer Name:</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2>Add Items</h2>

        <form id="item-form">
            <div class="form-group">
                <label for="item-name">Item Name:</label>
                <input type="text" class="form-control" id="item-name" required>
            </div>
            <div class="form-group">
                <label for="item-price">Item Price:</label>
                <input type="number" class="form-control" id="item-price" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>

        <h2>Invoice</h2>

        <table id="invoice-table" class="table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Item Price</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <button id="print-button" class="btn btn-primary">Print Bill</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            var items = [];

            // Handle customer form submission
            $('#customer-form').submit(function(event) {
                event.preventDefault();

                var customerName = $('#name').val();
                var customerEmail = $('#email').val();
                var customerAddress = $('#address').val();

                // Do something with customer information
                console.log('Customer Name:', customerName);
                console.log('Customer Email:', customerEmail);
                console.log('Customer Address:', customerAddress);
            });

            // Handle item form submission
            $('#item-form').submit(function(event) {
                event.preventDefault();

                var itemName = $('#item-name').val();
                var itemPrice = $('#item-price').val();

                // Add item to the array
                items.push({
                    name: itemName,
                    price: itemPrice
                });

                // Clear the form inputs
                $('#item-name').val('');
                $('#item-price').val('');

                // Update the invoice table
                updateInvoiceTable();
            });

            // Update the invoice table
            function updateInvoiceTable() {
                var tableBody = $('#invoice-table tbody');
                tableBody.empty();

                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    var row = $('<tr>').append('<td>').text(item.name).parent().append('<td>').text(item.price);
                    tableBody.append(row);
                }
            }

            // Handle print button click
            $('#print-button').click(function() {
                // Print the bill
                window.print();
            });
        });
    </script>
</body>
</html>
