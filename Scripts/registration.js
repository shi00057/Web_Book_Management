/*  
     Name: Guokai Shi
     File Name: script.js
     Date Created: 2024-07-18
     Description: This JavaScript file contains the client-side validation logic for the registration form.
                  It includes functions to validate the email, username, password, and confirm password fields,
                  as well as the terms and conditions checkbox. The script provides real-time validation feedback 
                  and prevents form submission if any input is invalid.
*/
// Wait until the entire DOM is fully loaded before executing the script
document.addEventListener("DOMContentLoaded", function() {
    // Get references to form and input elements
    const form = document.querySelector("form"); // The registration form element
    const emailInput = document.getElementById("email"); // The email input field
    const loginInput = document.getElementById("login"); // The username input field
    const passInput = document.getElementById("pass"); // The password input field
    const pass2Input = document.getElementById("pass2"); // The confirm password input field
    const newsletterCheckbox = document.getElementById("newsletter"); // The newsletter subscription checkbox
    const termsCheckbox = document.getElementById("terms"); // The terms and conditions checkbox

    // Add event listeners for real-time validation of input fields
    emailInput.addEventListener("input", validateEmail); // Validate email input on every change
    loginInput.addEventListener("input", validateLogin); // Validate username input on every change
    passInput.addEventListener("input", validatePassword); // Validate password input on every change
    pass2Input.addEventListener("input", validatePasswordMatch); // Validate confirm password input on every change
    termsCheckbox.addEventListener("change", validateTerms); // Validate terms checkbox on every change

    // Add event listener to the newsletter checkbox to alert about potential spam
    newsletterCheckbox.addEventListener("change", function() {
        if (newsletterCheckbox.checked) {
            alert("You may receive spam emails."); // Show alert if newsletter is checked
        }
    });

    // Form submit event handler to validate all inputs before submission
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Validate all input fields and terms checkbox before submitting the form
        const isEmailValid = validateEmail();
        const isLoginValid = validateLogin();
        const isPasswordValid = validatePassword();
        const isPasswordMatchValid = validatePasswordMatch();
        const isTermsValid = validateTerms();

        // If all validations pass, submit the form
        if (isEmailValid && isLoginValid && isPasswordValid && isPasswordMatchValid && isTermsValid) {
            loginInput.value = loginInput.value.toLowerCase(); // Convert username to lowercase
            form.submit(); // Submit the form
        }
    });

    // Function to validate the email input field
    function validateEmail() {
        const emailValue = emailInput.value; // Get the current value of the email input field
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression for validating email format
        if (!emailRegex.test(emailValue)) {
            setError(emailInput, "Email address should be non-empty with the format xyx@xyz.xyz."); // Show error message if email is invalid
            return false;
        } else {
            clearError(emailInput); // Clear any previous error messages if email is valid
            return true;
        }
    }

    // Function to validate the username input field
    function validateLogin() {
        const loginValue = loginInput.value.trim(); // Get the current value of the username input field and trim whitespace
        if (loginValue === "" || loginValue.length > 30) {
            setError(loginInput, "Login name must be non-empty and less than 30 characters long."); // Show error message if username is invalid
            return false;
        } else {
            clearError(loginInput); // Clear any previous error messages if username is valid
            return true;
        }
    }

    // Function to validate the password input field
    function validatePassword() {
        const passValue = passInput.value; // Get the current value of the password input field
        if (passValue.length < 8) {
            setError(passInput, "Password must be at least 8 characters long."); // Show error message if password is too short
            return false;
        } else {
            clearError(passInput); // Clear any previous error messages if password length is sufficient
            return true;
        }
    }

    // Function to validate that the password and confirm password fields match
    function validatePasswordMatch() {
        const passValue = passInput.value; // Get the current value of the password input field
        const pass2Value = pass2Input.value; // Get the current value of the confirm password input field
        if (passValue === "" || pass2Value === "" || passValue !== pass2Value) {
            setError(pass2Input, "Passwords must match and cannot be blank."); // Show error message if passwords do not match
            return false;
        } else {
            clearError(pass2Input); // Clear any previous error messages if passwords match
            return true;
        }
    }

    // Function to validate the terms and conditions checkbox
    function validateTerms() {
        if (!termsCheckbox.checked) {
            setError(termsCheckbox, "You must agree to the terms and conditions.", true); // Show error message if terms checkbox is not checked
            return false;
        } else {
            clearError(termsCheckbox); // Clear any previous error messages if terms checkbox is checked
            return true;
        }
    }

    // Function to display error messages for invalid input fields
    function setError(inputElement, message, isInline = false) {
        // Remove existing error message if it exists
        clearError(inputElement);

        // Create a new error message element
        const error = document.createElement("div");
        error.classList.add("error-message");
        if (isInline) {
            error.classList.add("error-message-inline");
            inputElement.parentNode.appendChild(error); // Append the error message to the parent element
        } else {
            error.style.color = "red";
            error.style.fontSize = "12px";
            inputElement.parentNode.insertBefore(error, inputElement.nextSibling); // Insert the error message after the input field
        }
        error.textContent = message;
    }

    // Function to clear error messages from valid input fields
    function clearError(inputElement) {
        const errorElements = inputElement.parentNode.querySelectorAll(".error-message");
        inputElement.style.borderColor = ""; // Reset the border color of the input field

        // Remove all error message elements
        errorElements.forEach(function(errorElement) {
            errorElement.remove();
        });
    }
});
