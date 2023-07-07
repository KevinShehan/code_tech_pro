<?php
include('config/dbconnection.php');

$id = $_GET['id'];

mysqli_query($con, "DELETE FROM sales_temporary WHERE id = '$id'") or die(mysqli_error($con));

if (mysqli_affected_rows($con) > 0) {
    echo '<script type="text/javascript">
    swal("Deleted!", "Successfully Deleted", "success");
    </script>';
} else {
    echo '<script type="text/javascript">
    swal("Error!", "Item not Deleted", "error");
    </script>';
}

echo '<script>
     setTimeout(function(){
         window.location.href = "invoice sale test.php";
     }, 1000);
</script>';
?>
