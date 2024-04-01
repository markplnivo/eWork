<?php

// Include database configuration and session handling logic
include "../logindbase.php";
include "../session_handler.php";

if (isset($_POST['completionPercentage']) && isset($_POST['artistUsername'])) {
				$completionPercentage = (int) $_POST['completionPercentage'];
				$artistUsername = $_SESSION['username'];

				// Prepare and execute the update statement
				$updateSql = "UPDATE tbl_artist_status SET completion_percentage = ? WHERE artist_name = ?";
				if ($stmt = $conn->prepare($updateSql)) {
					$stmt->bind_param("is", $completionPercentage, $artistUsername);
					if ($stmt->execute()) {
						// Success
						echo json_encode(['status' => 'success']);
					} else {
						// Failure
						echo json_encode(['status' => 'error', 'message' => 'Failed to update.']);
					}
					$stmt->close();
				} else {
					// Error preparing statement
					echo json_encode(['status' => 'error', 'message' => 'Error preparing statement.']);
				}
			} else {
				// Required data not set
				echo json_encode(['status' => 'error', 'message' => 'Incomplete data.']);
			} // End of completion percentage update

?>