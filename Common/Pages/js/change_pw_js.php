
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>
  $(document).ready(function() {
    // Event listener for current password field
    $('#currentPassword').on('input', function() {
      var currentPassword = $(this).val();
      var errorMessage = '';

      // Check if the current password field is empty
      if (currentPassword === '') {
        errorMessage = 'Current password field cannot be empty';
      } else if (currentPassword.length < 10) {
        errorMessage = 'Current password must contain at least 10 characters';
      }

      showError($('#currentPasswordError'), errorMessage);
    });

    // Event listener for new password field
    $('#newPassword').on('input', function() {
      var newPassword = $(this).val();
      var errorMessage = '';

      // Check if the new password field is empty
      if (newPassword === '') {
        errorMessage = 'New password field cannot be empty';
      } else if (newPassword.length < 10) {
        errorMessage = 'New password must contain at least 10 characters';
      }

      showError($('#newPasswordError'), errorMessage);
    });

    // Event listener for re-enter password field
    $('#reenterPassword').on('input', function() {
      var newPassword = $('#newPassword').val();
      var reenterPassword = $(this).val();
      var errorMessage = '';

      // Check if the re-enter password field is empty
      if (reenterPassword === '') {
        errorMessage = 'Re-enter password field cannot be empty';
      } else if (newPassword !== reenterPassword) {
        errorMessage = 'Passwords do not match';
      }

      showError($('#reenterPasswordError'), errorMessage);
    });

    // Event listener for form submission
    $('#passwordForm').submit(function(event) {
      // Check if any error message is displayed
      if ($('#currentPasswordError').hasClass('d-none') &&
        $('#newPasswordError').hasClass('d-none') &&
        $('#reenterPasswordError').hasClass('d-none')) {
        // Form is valid, allow the form to submit
      } else {
        // Form has validation errors, display a general error message
        $('#errorMessage').text('Please correct the errors before submitting.').removeClass('d-none');
        event.preventDefault(); // Prevent form submission
      }
    });

    // Function to show error messages and apply styles to fields
    function showError(element, errorMessage) {
      element.text(errorMessage);
      if (errorMessage !== '') {
        element.removeClass('d-none');
        element.addClass('text-danger');
        element.closest('.form-group').find('input').addClass('is-invalid');
        element.closest('.form-group').find('input').removeClass('is-valid');
      } else {
        element.addClass('d-none');
        element.removeClass('text-danger');
        element.closest('.form-group').find('input').removeClass('is-invalid');
        element.closest('.form-group').find('input').addClass('is-valid');
      }
    }
  });
</script>
