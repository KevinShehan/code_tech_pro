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
                Quotation List

                <table class="table table-striped table-bordered" id="categoryTable">
              <thead>
                <tr class="table-primary">
                  <th scope="col" class="col-1">No</th>
                  <th scope="col">Code</th>
                  <th scope="col">Category</th>
                  <th scope="col" class="col-3">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  // Fetch latest supplier records from the database
                  $query = 'SELECT * FROM category';
                  $result = mysqli_query($con, $query);

                  if (!$result) {
                    die('Error: ' . mysqli_error($con));
                  }

                  // Generate the HTML markup for supplier records
                  $html = '';
                  $number = 1;
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['code'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' .
                      '<button class="btn btn-warning" style="background-color: purple;color:#ffffff;"><i class="fas fa-pencil-alt"></i></button>' .
                      '&nbsp;' .
                      '<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>';
                    echo "</tr>";
                  }
                  echo '<script>$("#supplierTable tbody").html(`' . $html . '`);</script>';
                  ?>
              </tbody>
            </table>






			
			</div>
		</div>
	</div>
</main>






<?php
include('pages/footer.php');
?>