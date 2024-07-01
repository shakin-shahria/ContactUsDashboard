<?php
// Include the database connection file
include("db_connection.php");

// Check if the id parameter is passed
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare SQL statement to fetch product data
    $sql = "SELECT * FROM contact_us WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the data into an associative array
            $row = $result->fetch_assoc();

            // Return the data as JSON
            echo json_encode($row);
        } else {
            // No rows found with the given id
            echo json_encode(array('error' => 'No product found'));
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the statement
        echo json_encode(array('error' => 'Failed to prepare the SQL statement'));
    }
} else {
    // No id parameter provided
    echo json_encode(array('error' => 'No product id provided'));
}

// Close the database connection
$conn->close();
?>
