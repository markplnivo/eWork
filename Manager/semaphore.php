<?php

// Semaphore API URL

require_once '../config.php';

// Check if the required fields are present
if (isset($_POST['number']) && (isset($_POST['message']) || isset($_POST['customMessage']))) {
    $phoneNumber = $_POST['number'];
    $message = isset($_POST['message']) ? $_POST['message'] : $_POST['customMessage']; // Use custom message if provided
    echo "<script>console.log(This is the phone number: " . json_encode($phoneNumber) . ");</script>";
    // The data to send to the API
    $postData = array(
        'apikey' => SEMAPHORE_API,
        'number' => $phoneNumber,
        'message' => $message,
        'sendername' => 'SEMAPHORE'
    );

    // Setup cURL
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and fetch the response. Check for errors
    $output = curl_exec($ch);
    if ($output === FALSE) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        // Correct way to output to console
        echo "<script>console.log(" . json_encode($output) . ");</script>";
    
        // Parse the JSON response
        $response = json_decode($output, true);
        if (isset($response['error'])) {
            echo "Error sending SMS: " . $response['message'];
        } else {
            echo "SMS sent successfully!";
        }
    }

    // Close the cURL session
    curl_close($ch);
} else {
    echo "Required fields are missing.";
}
?>
