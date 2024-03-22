
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.querySelector('input[type="tel"]');
   
    const feedbackTextarea = document.querySelector('textarea');
    const successMessageDiv = document.getElementById('success-message'); 

    form.addEventListener('submit', function(event) {
        let isValid = true;
        const errors = {};

        // Clear previous success message
        successMessageDiv.textContent = '';

        // Name validation
        if (!nameInput.value.trim()) {
            errors.name = 'Name is required.';
            isValid = false;
        }

        // Email validation
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailInput.value.match(emailRegex)) {
            errors.email = 'Valid Email is required.';
            isValid = false;
        }

        // Phone number validation
        const phoneRegex = /^[0-9]{10}$/;
        if (!phoneInput.value.match(phoneRegex)) {
            errors.phone = 'Valid 10-digit phone number is required.';
            isValid = false;
        }

        // Feedback validation
        if (!feedbackTextarea.value.trim()) {
            errors.feedback = 'Feedback is required.';
            isValid = false;
        }

        // Display errors and prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
            displayErrors(errors);
        } else {
            // Display success message
            successMessageDiv.textContent = 'Feedback has been submitted successfully.';
            successMessageDiv.style.color = 'green'; // Style the success message
        }
    });

    function displayErrors(errors) {
        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

        // Set error messages
        if (errors.name) {
            nameInput.nextElementSibling.textContent = errors.name;
        }
        if (errors.email) {
            emailInput.nextElementSibling.textContent = errors.email;
        }
        if (errors.phone) {
            phoneInput.nextElementSibling.textContent = errors.phone;
        }
        
       
        if (errors.feedback) {
            feedbackTextarea.nextElementSibling.textContent = errors.feedback;
        }
    }
});
