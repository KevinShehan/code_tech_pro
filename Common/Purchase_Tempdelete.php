<?php
 
include('config/dbconnection.php');
 
mysqli_query($con,"DELETE FROM purchase_temporary WHERE temp_trans_id = '".$_GET['id']." '")or die(mysqli_error($con));

        echo '<script type="text/javascript">
        swal("Deleted!", "Temporary Item Successfully Removed" , "success");
          </script>';

        echo '<script>
         setTimeout(function(){
         window.location.href = "Purchase_Save.php";
        }, 1000);
        </script>';


?>