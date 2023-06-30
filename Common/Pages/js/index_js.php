<script>
    const usernameInput = document.getElementById('exampleInputEmail1');
    const passwordInput = document.getElementById('exampleInputPassword1');
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
