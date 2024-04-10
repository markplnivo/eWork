<?php
// Assuming you have a database connection set up
include "../logindbase.php";

if(isset($_POST['artistName'])) {
    $artistName = $_POST['artistName'];
    
    // Prepare your SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_contactnumber FROM tbl_userlist WHERE username = ?");
    $stmt->bind_param("s", $artistName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($row = $result->fetch_assoc()) {
        // Send back the contact number as JSON
        echo json_encode(array('contactNumber' => $row['user_contactnumber']));
    } else {
        // Handle case where no contact number is found
        echo json_encode(array('error' => 'No contact number found.'));
    }
} else {
    // Handle error
    echo json_encode(array('error' => 'Artist name not provided.'));
}
?>
