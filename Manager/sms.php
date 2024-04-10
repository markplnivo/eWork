<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SMS Form Overlay</title>
    <style>
        /* style.css */
        .overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
            cursor: pointer;
        }

        .overlay-content {
            position: relative;
            top: 25%;
            width: 50%;
            margin: auto;
            padding: 20px;
            background: white;
            cursor: default;
            border-radius:10px;
        }

        /* Style for form */
        #smsForm {
            width: 300px;
            /* Adjust width as needed */
            margin: 0 auto;
            /* Center the form */
            font-family: Arial, sans-serif;
            /* Choose appropriate font */
            display:grid;
            grid-row-gap: 20px;
            background-color: #edcba7;
            padding: 35px;
            border-radius: 10px;
        }

        #smsForm span {
            background-color: whitesmoke;
            padding:10px;
            border-radius:5px;
        }
        /* Style for labels */
        #smsForm label {
            display: block;
            margin-bottom: 5px;
        }

        /* Style for text input */
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 14px;
        }

        /* Style for radio buttons */
        #smsForm input[type="radio"] {
            margin-right: 5px;
            width:1.2em;
            height:1.2em;
        }

        /* Style for dropdown */
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 14px;
        }

        /* Style for button */
        .overlay button {
            margin: 10px 0;
            padding: 10px 20px;
            background-color: #a6a6c9;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Style for button on hover */
        .overlay button:hover {
            background-color: #778899;
        }

        /* Style for containers */
        #presetMessageContainer,
        #customMessageContainer {
            margin-bottom: 15px;
        }

        #openOverlay:hover {
            background-color: #778899;
        }

        #openOverlay {
            padding: 10px 20px;
            background-color: #191970;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: auto;
            display:flex;
        }
        /* Style for initially hidden container */
    </style>
</head>

    <!-- <button id="openOverlay">Open SMS Form</button> -->

    <div id="overlay" class="overlay">
        <div class="overlay-content">
            <form id="smsForm">
                <label for="artistName"><i class="fa-solid fa-user"></i> Artist Name:</label>
                <span id="artistName"></span>
                <label for="phoneNumber"><i class="fa-solid fa-phone"></i> Phone Number:</label>
                <span id="phoneNumber"></span>

                <!-- Option for choosing message type -->
                <label><input type="radio" name="messageType" value="preset" checked> Use Preset Message</label>
                <label><input type="radio" name="messageType" value="custom"> Enter Custom Message</label>

                <!-- Preset Message Dropdown, initially visible -->
                <div id="presetMessageContainer">
                    <label for="presetMessage">Preset Message:</label>
                    <select id="presetMessage" name="message">
                        <option value="Hello from Semaphore">Hello from Semaphore</option>
                    </select>
                </div>

                <!-- Custom Message Field, initially hidden -->
                <div id="customMessageContainer" style="display: none;">
                    <label for="customMessage">Custom Message:</label>
                    <textarea id="customMessage" name="message"></textarea>
                </div>

                <button type="button" id="sendSMS">Send SMS</button>
            </form>
            <button id="closeOverlay">Close</button>
        </div>
    </div>

</html>