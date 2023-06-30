
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- Include Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Include Bootstrap Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<script>
  function generateUniqueCode() {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var counter = 1;
    var code = 'EM';

    function incrementCounter() {
      var number = counter.toString().padStart(2, '0');
      counter++;
      return number;
    }
    code += incrementCounter();
    for (var i = 0; i < 3; i++) {
      code += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById('codeInput').value = code;
  }
  // Automatically generate code when the page loads
  window.addEventListener('load', generateUniqueCode);


  ///////////////////////////////////////////////////
  function previewImage(event) {
    var reader = new FileReader();
    var imageElement = document.getElementById("preview");

    reader.onload = function() {
      imageElement.src = reader.result;
      imageElement.style.display = "block"; // Show the image preview after uploading
    }

    if (event.target.files[0]) {
      reader.readAsDataURL(event.target.files[0]);
    }
  }


  ////////////////////////////////////////////////////////////////////
  $(document).ready(function() {
    var callnameInput = $('#callname');

    callnameInput.on('input', function() {
      var callnameValue = callnameInput.val().trim();
      var regex = /^[a-zA-Z]+$/; // Regular expression to match alphabetic letters only

      if (callnameValue === '') {
        callnameInput.removeClass('is-valid').addClass('is-invalid');
        $('#callname-validation').show();
      } else if (!regex.test(callnameValue)) {
        callnameInput.removeClass('is-valid').addClass('is-invalid');
        $('#callname-validation').show();
      } else {
        callnameInput.removeClass('is-invalid').addClass('is-valid');
        $('#callname-validation').hide();
      }
    });
  });

//////////////////////////////////////////////////////////////////////////////////////
  $(document).ready(function() {
    // Initialize the selectpicker
    $('.selectpicker').selectpicker();

    // Set the width of the selectpicker dynamically
    function setSelectPickerWidth() {
      var callNameWidth = $('[name="callname"]').outerWidth();
      var selectPickerWidth = callNameWidth * 2 + 30; // Adding extra 30px for arrow button
      $('.custom-selectpicker .bootstrap-select .dropdown-toggle').css('width', selectPickerWidth);
    }

    // Call the function initially and on window resize
    setSelectPickerWidth();
    $(window).resize(setSelectPickerWidth);
  });


  ////////////////////////////////////////////////////////////
  $(document).ready(function() {
    var callnameInput = $('#fullname');

    callnameInput.on('input', function() {
      var callnameValue = callnameInput.val().trim();
      var regex = /^[a-zA-Z ]*$/; // Regular expression to match only alphabetic letters and spaces

      if (!regex.test(callnameValue)) {
        callnameInput.removeClass('is-valid').addClass('is-invalid');
        $('#callname-validation').show();
      } else {
        callnameInput.removeClass('is-invalid').addClass('is-valid');
        $('#callname-validation').hide();
      }
    });
  });


  ////////////////////////////////////////////////////
  $(document).ready(function() {
    var dobInput = $('#dob');

    dobInput.on('input', function() {
      var dobValue = dobInput.val();

      if (!isValidDate(dobValue)) {
        dobInput.removeClass('is-valid').addClass('is-invalid');
        $('#dob-validation').show();
      } else {
        dobInput.removeClass('is-invalid').addClass('is-valid');
        $('#dob-validation').hide();
      }
    });

    function isValidDate(dateString) {
      var pattern = /^\d{4}-\d{2}-\d{2}$/; // Date format pattern (YYYY-MM-DD)
      if (!pattern.test(dateString)) return false;

      var date = new Date(dateString);
      var year = date.getFullYear();
      var month = date.getMonth() + 1;
      var day = date.getDate();

      var inputYear = parseInt(dateString.split('-')[0]);
      var inputMonth = parseInt(dateString.split('-')[1]);
      var inputDay = parseInt(dateString.split('-')[2]);

      return (
        inputYear === year &&
        inputMonth === month &&
        inputDay === day &&
        month >= 1 &&
        month <= 12 &&
        day >= 1 &&
        day <= 31
      );
    }
  });



  //////////////////////////////////////////////////////////////////
  $(document).ready(function() {
    var emailInput = $('#email');

    emailInput.on('input', function() {
      var emailValue = emailInput.val().trim();
      var regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/; // Regular expression to match email format

      if (!regex.test(emailValue)) {
        emailInput.removeClass('is-valid').addClass('is-invalid');
        $('#email-validation').show();
      } else {
        emailInput.removeClass('is-invalid').addClass('is-valid');
        $('#email-validation').hide();
      }
    });
  });
</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>
<script>
  document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    Swal.fire({
      title: "Confirm Submission",
      text: "Are you sure you want to submit the form?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Submit",
      cancelButtonText: "Cancel"
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user confirms submission, submit the form
        document.getElementById("myForm").submit();
      }
    });
  });
</script>