
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_current_pw = $_POST['currentPassword'] ?? '';
  $user_new_pw = $_POST['newPassword'] ?? '';
  $user_reenter_pw = $_POST['reenterPassword'] ?? '';
  $username = $_SESSION["username"];

  if (empty($user_current_pw) || empty($user_new_pw) || empty($user_reenter_pw)) {
    echo '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
    window.onload = function() {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Please fill in all the fields.",
        showConfirmButton: false,
        timer: 2000,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showCancelButton: true,
        cancelButtonText: "Close"
      })
    };
    </script>';
  } else {

    if ($user_new_pw === $user_reenter_pw) { // Check if new password and re-entered password match
      // Assuming you have retrieved the current user's password from the database
      $query = "SELECT password FROM user WHERE username = '$username'";
      $result = mysqli_query($con, $query);

      if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentPasswordFromDatabase = $row['password'];

        if (password_verify($user_current_pw, $currentPasswordFromDatabase)) {
          $hashedPassword = password_hash($user_new_pw, PASSWORD_DEFAULT);
          $updateQuery = "UPDATE user SET password = '$hashedPassword' WHERE username = '$username'";
          $updateResult = mysqli_query($con, $updateQuery);

          if ($updateResult) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
            <script>
            window.onload = function() {
              Swal.fire({
                icon: "success",
                title: "Success",
                text: "Password changed successfully.",
                showConfirmButton: false,
                timer: 2000,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: true,
                cancelButtonText: "Close"
              }).then(function(result) {
                if (result.dismiss === Swal.DismissReason.cancel) {
                  window.location.href = "profile.php";
                }
              });
            };
            </script>';
          } else {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
            <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Error updating the password. Please try again.",
              showConfirmButton: false,
              timer: 2000,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false,
              showCancelButton: true,
              cancelButtonText: "Close"
            });
            </script>';
          }
        } else {
          echo '
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
          <script>
          Swal.fire({
            icon: "error",
            title: "Incorrect Password",
            text: "Please enter the correct current password.",
            showConfirmButton: false,
            timer: 2000,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showCancelButton: true,
            cancelButtonText: "Close"
          });
          </script>';
        }
      } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
        <script>
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Error executing the query. Please try again.",
          showConfirmButton: false,
          timer: 2000,
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
          showCancelButton: true,
          cancelButtonText: "Close"
        });
        </script>';
      }
    } else {
      echo '
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
      <script>
      Swal.fire({
        icon: "error",
        title: "Passwords do not match",
        text: "Please make sure the new password and re-entered password match.",
        showConfirmButton: false,
        timer: 2000,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showCancelButton: true,
        cancelButtonText: "Close"
      });
      </script>';
    }
  }
}
?>
