<?php
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the posted data
    $productId = $_POST['id'] ?? null;

    // Validate the data
    if ($productId) {
        // Prepare the SQL delete statement
        $sql = "DELETE FROM contact_us WHERE id = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("i", $productId);

            // Execute the statement
            if ($stmt->execute()) {
                // Success response
                echo json_encode(['status' => 'success', 'message' => 'Message deleted successfully']);
            } else {
                // Error response
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete message']);
            }

            // Close the statement
            $stmt->close();
        } else {
            // Error response for statement preparation failure
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement']);
        }
    } else {
        // Error response for missing data
        echo json_encode(['status' => 'error', 'message' => 'Invalid data provided']);
    }

    // Close the connection
    $conn->close();
} else {
    // Error response for invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
