<?php
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the posted data
    $productId = $_POST['product_id'] ?? null;
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $comment = $_POST['comment'] ?? null;

    // Debug statements to check received data
    error_log("Received POST data: product_id=$productId, first_name=$first_name, last_name=$last_name, email=$email, comment=$comment");

    // Validate the data (add more validation as needed)
    if ($productId && $first_name && $last_name && $email && $comment) {
        // Prepare the SQL update statement
        $sql = "UPDATE contact_us SET first_name = ?, last_name = ?, email = ?, comment = ? WHERE id = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssssi", $first_name, $last_name, $email, $comment, $productId);

            // Execute the statement
            if ($stmt->execute()) {
                // Success response
                echo json_encode(['status' => 'success', 'message' => 'Message updated successfully']);
            } else {
                // Error response
                echo json_encode(['status' => 'error', 'message' => 'Failed to update message']);
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
