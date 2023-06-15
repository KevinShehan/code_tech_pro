<?php
// supplier_single_view.php

include('config/dbconnection.php');

// Check if the supplier ID is provided in the URL
if (isset($_GET['id'])) {
    $supplierId = $_GET['id'];

    // Escape the supplier ID to prevent SQL injection
    $escapedSupplierId = mysqli_real_escape_string($con, $supplierId);

    // Fetch the supplier details from the database
    $query = "SELECT * FROM supplier WHERE id = '$escapedSupplierId'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the supplier details
        $row = mysqli_fetch_assoc($result);

        // Create an array to store the supplier details
        $supplierDetails = array(
            'name' => $row['name'],
            'description' => $row['description'],
            'gender' => $row['gender'],
            'contact1' => $row['contact1'],
            'contact2' => $row['contact2'],
            'address' => $row['address'],
            'email' => $row['email'],
            'fax' => $row['fax']
        );

        // Prepare the JSON response
        $response = array(
            'success' => true,
            'data' => $supplierDetails
        );
    } else {
        // Supplier not found
        $response = array(
            'success' => false,
            'message' => 'Supplier not found'
        );
    }
} else {
    // Supplier ID not provided
    $response = array(
        'success' => false,
        'message' => 'Supplier ID not provided'
    );
}

// Set the response header to JSON
header('Content-Type: application/json');

// Send the JSON response
echo json_encode($response);
