<?php
//register supplier
session_start();
include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>
<style>
	/* Hide elements in the printed version */
	@media print {
		.hidden-print {
			display: none;
		}

		.print-only {
			display: block;
		}
	}
</style>

<script>
	function printPage() {
		window.print();
	}


	function addRow() {
		var table = document.getElementById("myTable");
		var row = table.insertRow(-1);

		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		var cell7 = row.insertCell(6);

		cell1.innerHTML = "<button class='btn btn-danger remove-btn' onclick='removeRow(this)'><span >&#10006;</span></button>&nbsp;1";
		cell2.innerHTML = "Data 1";
		cell3.innerHTML = "Data 2";
		cell4.innerHTML = "Data 2";
		cell5.innerHTML = "Data 2";
		cell6.innerHTML = "Data 2";
		cell7.innerHTML = "Data 2";


	}

	function removeRow(btn) {
		var row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
	}
</script>










<!-- offcanvas -->
<main class="mt-5 pt-3">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 mb-3">
				<!-- Quotation View Section -->
				<div class="heading">
					<img src="Assets/images/Picture1.png" alt="" width="30%">
					<h3 style="text-align: center;"> Quotation</h3>
				</div>

				<!-- Quotation End  View Section -->


				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">

				<!-- Add the Font Awesome CSS link -->
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

				<style>
					.input-group-sm .form-control {
						height: calc(1.5em + 0.75rem + 2px);
						padding: 0.375rem 0.75rem;
						font-size: 0.875rem;
						line-height: 1.5;
						border-radius: 0.2rem;
					}
				</style>
				</head>

				<body>
					<div class="container">
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
							</div>
							<input type="date" class="form-control form-control-sm" id="invoiceDate" placeholder="Invoice Date">
						</div>
					</div>

					<!-- Add the Bootstrap JS and jQuery scripts (required for some Bootstrap features) -->
					<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
					<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

					<script>
						// Function to handle the placeholder behavior
						function handlePlaceholder() {
							const invoiceDateInput = document.getElementById('invoiceDate');
							const placeholderText = 'Invoice Date';

							invoiceDateInput.addEventListener('focus', function() {
								if (this.value === '') {
									this.type = 'date';
									this.classList.remove('placeholder');
								}
							});

							invoiceDateInput.addEventListener('blur', function() {
								if (this.value === '') {
									this.type = 'text';
									this.classList.add('placeholder');
								}
							});

							invoiceDateInput.addEventListener('change', function() {
								this.classList.remove('placeholder');
							});

							// Set initial state
							if (invoiceDateInput.value === '') {
								invoiceDateInput.type = 'text';
								invoiceDateInput.classList.add('placeholder');
								invoiceDateInput.value = placeholderText;
							}
						}

						handlePlaceholder();
					</script>




















































					<div class="container">
						<!-- Modal -->
						<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="customerModalLabel">Select An Existing Customer</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table class="table table-striped table-bordered" id="myTable">
											<thead>
												<tr>
													<th>Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$customer_query = 'select * from customers';
												$result_customer = mysqli_query($con, $customer_query);

												$html = '';
												$number = 1;
												while ($row = mysqli_fetch_assoc($result_customer)) {
													echo "<tr>";
													echo "<td>" . $row['name'] . "</td>";
													echo "<td>" . $row['address'] . "</td>";
													echo "<td>" . $row['Mobile1'] . "</td>";
													echo '<td><button class="btn btn-primary btn-sm" onclick="fillForm(\'' . $row['name'] . '\', \'' . $row['address'] . '\',\'' . $row['Mobile1'] . '\')">select</button></td>';
													echo "</tr>";
												}
												?>
											</tbody>
										</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card" style="width: 50%;">
						<div class="card-header">
							<h5 class="card-title">Customer Information
								<b>OR</b> <!-- Button trigger modal -->
								<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#customerModal" style="color: #007cb7;">
									Select Existing Customer
								</button>
							</h5>
						</div>

						<!-- Your HTML form -->
						<form>
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Name">
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="address" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<label for="Mobile1">Mobile</label>
								<input type="text" class="form-control" id="Mobile1" name="Mobile1" placeholder="Mobile">
							</div>
						</form>
					</div>

					<!-- JavaScript code -->
					<script>
						function fillForm(name, address, Mobile1) {
							document.getElementById('name').value = name;
							document.getElementById('address').value = address;
							document.getElementById('Mobile1').value = Mobile1;
							$('#customerModal').modal('hide'); // Hide the modal after filling the form
						}
					</script>


























					<script>
						function fillForm(name, address, Mobile1) {
							document.getElementById('name').value = name;
							document.getElementById('address').value = address;
							document.getElementById('Mobile1').value = Mobile1;
							$('#customerModal').modal('hide'); // Hide the modal after filling the form
						}
					</script>







					<div class="container">
						<!-- Modal -->
						<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="customerModalLabel">Select An Existing Customer</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">

										<table class="table table-striped table-bordered" id="myTable">
											<thead>
												<tr>
													<th>Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$customer_query = 'select * from customers';
												$result_customer = mysqli_query($con, $customer_query);

												$html = '';
												$number = 1;
												while ($row = mysqli_fetch_assoc($result_customer)) {
													echo "<tr>";
													echo "<td>" . $row['name'] . "</td>";
													echo "<td>" . $row['address'] . "</td>";
													echo "<td>" . $row['Mobile1'] . "</td>";
													echo '<td><button class="btn btn-primary btn-sm" onclick="fillForm(\'' . $row['name'] . '\', \'' . $row['address'] . '\',\'' . $row['Mobile1'] . '\')">select</button></td>';
													echo "</tr>";
												}

												?>
											</tbody>
										</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>


						<div class="card" style="width: 50%;">
							<div class="card-header">
								<h5 class="card-title">Customer Information
									<b>OR</b> <!-- Button trigger modal -->
									<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#customerModal" style="color: #007cb7;">
										Select Existing Customer
									</button>

								</h5>
							</div>
							<div class="card-body">


								<div class="row">
									<form>
										<div class="input-group mb-3">
											<select class="form-select form-select-sm" aria-label="Select option">
												<option selected>Select an option</option>
												<option value="1">Option 1</option>
												<option value="2">Option 2</option>
												<option value="3">Option 3</option>
											</select>
										</div>
										<div class="form-group">
											<label for="nameInput">Name:</label>
											<input type="text" class="form-control form-control-sm"  id="name" name="name" placeholder="Name">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="address" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="Mobile1" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
										<div class="form-group">
											<label for="emailInput">Email:</label>
											<input type="email" class="form-control form-control-sm" id="emailInput" placeholder="Enter your email">
										</div>
									</form>
								</div>
							</div>
						</div>




						<h3>New Quotation</h3>

						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th>
										<button class="btn btn-success btn-sm" onclick="addRow()"><span style="font-family: 'Arial', sans-serif">&#43;</span>
										</button>
										No
									</th>
									<th>Item</th>
									<th>Description</th>
									<th>Warrenty</th>
									<th>Quantity</th>
									<th>Unit Price</th>
									<th>Total Price</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
						<button class="btn btn-success" onclick="printPage()">Create Quotation</button>
					</div>
			</div>
		</div>
</main>






<?php
include('pages/footer.php');
?>