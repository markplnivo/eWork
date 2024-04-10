document.getElementById('openOverlay').onclick = function() {
    document.getElementById('overlay').style.display = 'block';
};

document.getElementById('closeOverlay').onclick = function() {
    document.getElementById('overlay').style.display = 'none';
};

document.querySelectorAll('input[name="messageType"]').forEach((input) => {
    input.addEventListener('change', function() {
        if (this.value === 'preset') {
            document.getElementById('presetMessageContainer').style.display = '';
            document.getElementById('customMessageContainer').style.display = 'none';
        } else if (this.value === 'custom') {
            document.getElementById('presetMessageContainer').style.display = 'none';
            document.getElementById('customMessageContainer').style.display = '';
        }
    });
});

document.getElementById('sendSMS').onclick = function() {
    var messageType = document.querySelector('input[name="messageType"]:checked').value;
    var message = messageType === 'preset' ?
        document.getElementById('presetMessage').value :
        document.getElementById('customMessage').value;
    var phoneNumber = document.getElementById('phoneNumber').value;

    // Example of sending data using Fetch API
    fetch('semaphore.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'number=' + encodeURIComponent(phoneNumber) + '&message=' + encodeURIComponent(message)
        })
        .then(response => response.text())
        .then(result => {
            alert('SMS sent successfully: ' + result);
            document.getElementById('overlay').style.display = 'none';
        })
        .catch(error => {
            console.error('Error sending SMS:', error);
        });
};
