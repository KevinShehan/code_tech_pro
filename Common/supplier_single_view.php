<?php
// supplier_single_view.php

include('config/dbconnection.php');

// Check if the supplier ID is provided in the URL
if (isset($_GET['id'])) {
    $supplierId = $_GET['id'];

}?>
hello