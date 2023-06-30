<!DOCTYPE html>
<html>
<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    .is-valid {
      border-color: green !important;
      box-shadow: 0 0 0.2rem green !important;
    }
  </style>
</head>
<body>
  <div class="container">
    <form id="login-form">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" required>
        <div class="invalid-feedback" id="username-error"></div>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" required>
        <div class="invalid-feedback" id="password-error"></div>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <script>
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const usernameError = document.getElementById('username-error');
    const passwordError = document.getElementById('password-error');

    usernameInput.addEventListener('input', validateUsername);
    passwordInput.addEventListener('input', validatePassword);

    function validateUsername() {
      const username = usernameInput.value.trim();
      if (username === '') {
        displayError(usernameInput, usernameError, 'Username is required.');
      } else if (!isValidEmail(username)) {
        displayError(usernameInput, usernameError, 'Invalid email format.');
      } else {
        hideError(usernameInput, usernameError);
        setValid(usernameInput);
      }
    }

    function validatePassword() {
      const password = passwordInput.value.trim();
      if (password === '') {
        displayError(passwordInput, passwordError, 'Password is required.');
      } else if (password.length < 10) {
        displayError(passwordInput, passwordError, 'Password should be at least 10 characters long.');
      } else {
        hideError(passwordInput, passwordError);
        setValid(passwordInput);
      }
    }

    function displayError(input, errorElement, errorMessage) {
      input.classList.add('is-invalid');
      input.classList.remove('is-valid');
      errorElement.textContent = errorMessage;
      errorElement.style.display = 'block';
    }

    function hideError(input, errorElement) {
      input.classList.remove('is-invalid');
      errorElement.style.display = 'none';
    }

    function setValid(input) {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
    }

    function isValidEmail(email) {
      // Regex pattern for email validation
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailPattern.test(email);
    }

    document.getElementById('login-form').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission for this example
      validateUsername();
      validatePassword();

      // Perform further actions like AJAX login request here
    });
  </script>
</body>
</html>
