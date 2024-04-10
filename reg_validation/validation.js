document.addEventListener('DOMContentLoaded', function() {
    const emailResponseDiv = document.getElementById('emailResponse'); // Reference to the email response div
    const usernameResponseDiv = document.getElementById('usernameResponse'); // Reference to the username response div

    // Validate Email
    document.getElementById('email').addEventListener('blur', function() {
        const email = this.value;
        console.log("Email to be sent:", email);
        fetch('reg_validation/check_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({email: email})
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                emailResponseDiv.innerHTML = '<p style="color: red;">Email already in use.</p>';
            } else {
                emailResponseDiv.innerHTML = '<p style="color: green;">Email is available.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            emailResponseDiv.innerHTML = '<p style="color: red;">An error occurred during validation.</p>';
        });
    });

    // Validate Username
    document.getElementById('username').addEventListener('blur', function() {
        const username = this.value;
        console.log("Username to be sent:", username);
        fetch('reg_validation/check_username.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({username: username})
        })
        .then(response => response.json())
        .then(data => {
           if (data.exists) {
                usernameResponseDiv.innerHTML = '<p style="color: red;">Username already in use.</p>';
            } else {
                usernameResponseDiv.innerHTML = '<p style="color: green;">Username is available.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            usernameResponseDiv.innerHTML = '<p style="color: red;">An error occurred during validation.</p>';
        });
    });
});
