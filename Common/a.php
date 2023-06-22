<!DOCTYPE html>
<html>
<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <div class="container">
    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" placeholder="Enter password">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Toggle password visibility
      $('#togglePassword').click(function() {
        var passwordInput = $('#password');
        var passwordFieldType = passwordInput.attr('type');

        if (passwordFieldType === 'password') {
          passwordInput.attr('type', 'text');
          $(this).html('<i class="fas fa-eye-slash"></i>');
        } else {
          passwordInput.attr('type', 'password');
          $(this).html('<i class="fas fa-eye"></i>');
        }
      });
    });
  </script>
</body>
</html>
