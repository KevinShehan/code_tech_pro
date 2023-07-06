<script>
    function generateUniqueCode() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var counter = 1;
        var code = 'CU';

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




    $(document).ready(function() {
        // Function to validate the name input
        function validateName() {
            var nameInput = $("#fullname");
            var name = nameInput.val().trim();
            var isValid = /^[A-Za-z\s]+$/.test(name); // Regular expression to check if name contains only letters and spaces

            if (isValid) {
                // Remove any existing error classes and hide the error message
                nameInput.removeClass("is-invalid").addClass("is-valid");
                $("#name-error").hide();
                return true; // Name is valid
            } else {
                // Add error classes and show the error message
                nameInput.removeClass("is-valid").addClass("is-invalid");
                $("#name-error").show();
                return false; // Name is invalid
            }
        }

        // Function to validate NIC
        function validateNIC(nic) {
            var pattern = /^\d{9}[vVxX]$/; // Regular expression for NIC validation
            return pattern.test(nic);
        }

        // Function to handle NIC validation
        function handleNICValidation() {
            var nicInput = $("#nic");
            var nicValue = nicInput.val();

            if (validateNIC(nicValue)) {
                nicInput.removeClass("is-invalid").addClass("is-valid");
                $("#nic-error").text("").hide();
                return true; // NIC is valid
            } else {
                nicInput.removeClass("is-valid").addClass("is-invalid");
                $("#nic-error").text("Invalid NIC format!").show();
                return false; // NIC is invalid
            }
        }

        // Function to handle address validation
        function handleAddressValidation() {
            var addressInput = $("#address");
            var addressValue = addressInput.val();

            if (addressValue.trim() === "") {
                addressInput.removeClass("is-valid").addClass("is-invalid");
                $("#address-error").show();
                $("#address-check").hide();
                return false; // Address is invalid
            } else {
                addressInput.removeClass("is-invalid").addClass("is-valid");
                $("#address-error").hide();
                $("#address-check").show();
                return true; // Address is valid
            }
        }

        // Function to handle telephone number validation
        function handleTelephoneValidation() {
            var telephoneInput = $("#mobile1");
            var telephoneValue = telephoneInput.val();

            // Remove any non-digit characters
            var sanitizedValue = telephoneValue.replace(/\D/g, "");

            if (sanitizedValue.length === 10) {
                telephoneInput.removeClass("is-invalid").addClass("is-valid");
                $("#mobile1-error").hide();
                return true; // Telephone number is valid
            } else {
                telephoneInput.removeClass("is-valid").addClass("is-invalid");
                $("#mobile1-error").show();
                return false; // Telephone number is invalid
            }
        }

        // Event listener for form submission
        $("form").submit(function(event) {
            // Perform validation checks
            var isNameValid = validateName();
            var isNICValid = handleNICValidation();
            var isAddressValid = handleAddressValidation();
            var isTelephoneValid = handleTelephoneValidation();

            // Prevent form submission if any validation fails
            if (!isNameValid || !isNICValid || !isAddressValid || !isTelephoneValid) {
                event.preventDefault();
                // Optionally, you can display an error message indicating the reason for the form not being submitted.
                // For example: $("#error-message").text("Please fix the errors before submitting theform.").show();
            } else {

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
            }
        });

        // Call the validateName function whenever the name input changes
        $("#fullname").on("input", validateName);

        // Call the handleNICValidation function whenever the NIC input changes
        $("#nic").on("input", handleNICValidation);

        // Call the handleAddressValidation function whenever the address input changes
        $("#address").on("input", handleAddressValidation);

        // Call the handleTelephoneValidation function whenever the telephone number input changes
        $("#mobile1").on("input", handleTelephoneValidation);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>