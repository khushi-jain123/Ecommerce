$(document).ready(function() {
    $('#registerForm').on('submit', function(event) {
        let isValid = true;

        // Validate email
        const email = $('#email').val();
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            alert('Please enter a valid email address.');
        }

        // Validate password
        const password = $('#password').val();
        if (password.length < 6) {
            isValid = false;
            alert('Password must be at least 6 characters long.');
        }

        /*if (!isValid) {
            event.preventDefault();
        }*/
    });
});
