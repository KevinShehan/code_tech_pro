<?php 

 function tbldata($con){
 // Fetch latest customer records from the database
 $query = 'SELECT * FROM customer';
 $result = mysqli_query($con, $query);

 if (!$result) {
     die('Error: ' . mysqli_error($con));
 }
 // Generate the HTML markup for customer records
 $html = '';
 $number = 1;
 while ($row = mysqli_fetch_assoc($result)) {
     $id = $row['id'];
     $html .= '<tr>';
     $html .= '<td>' . $number . '</td>';
     $html .= '<td>' . $row['name'] . '</td>';
     $html .= '<td>' . $row['Mobile1'] . '</td>';
     $html .= '<td>' . $row['address'] . '</td>';
     $html .= '<td>
 <a class="viewBtn btn btn-info btn-sm" href="customer_view_single.php?id=' . $id . '"><i class="far fa-eye"></i></a>                                          
 <a class="updateBtn btn btn-warning btn-sm" data-id="' . $row['id'] . '"  href="customer_update.php?id=' . $id . '"><i class="fas fa-pencil-alt"></i></a>
 <a class="deleteBtn btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></a>
 </td>';
     $html .= '</tr>';
     $number++;
 }

 echo '<script>$("#supplierTable tbody").html(`' . $html . '`);</script>';

 }
