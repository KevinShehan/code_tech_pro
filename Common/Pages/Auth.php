<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  // User is not logged in, redirect to login page
  header("Location: index.php");
  exit();
}
?>