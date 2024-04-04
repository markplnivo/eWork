<?php
include "../logindbase.php";
include "../session_handler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artistName = $_POST['artistName'];

    $stmt = $conn->prepare("SELECT artist_status FROM tbl_artist_status WHERE artist_name = ?");
    $stmt->bind_param("s", $artistName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row["artist_status"];
        }
    } else {
        echo "0 results";
    }
    $stmt->close();
    $conn->close();
}
?>
