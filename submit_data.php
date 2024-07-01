<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>submit_data</title>
</head>
<body>
    <?php
    include("db_connection.php");
    
    $requestType = $_SERVER['REQUEST_METHOD'];
    if ($requestType == 'POST') {    
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $comment = $_POST["comment"];

        $targetDir = "uploads/";
        $fileNames = array_filter($_FILES['file']['name']);
        $errorUpload = $errorUploadType = "";
        $successimage = false;

        if (!empty($fileNames)) {
            foreach ($_FILES['file']['name'] as $key => $val) {
                $fileName = basename($_FILES["file"]["name"][$key]);
                $targetFilePath = $targetDir . $fileName;
                
                if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)) {
                    $successimage = true;
                } else {
                    $errorUpload .= $_FILES["file"]["name"][$key] . '|';
                    echo "ERROR";
                }
            }
        }

        $insert_success = false;

        foreach ($first_name as $key => $val) {
            // Check if a file was uploaded for this iteration
            $file = !empty($fileNames) && isset($fileNames[$key]) ? $fileNames[$key] : '';

            // Prepare and execute the INSERT statement
            $stmt = $conn->prepare("INSERT INTO contact_us (first_name, last_name, email, file, comment, created_at) VALUES (?, ?, ?, ?, ?, ?)");
            $created_at = date('Y-m-d H:i:s');
            $stmt->bind_param("ssssss", $first_name[$key], $last_name[$key], $email[$key], $file, $comment[$key], $created_at);

            // Execute the statement
            if ($stmt->execute()) {
                $insert_success = true;
            } else {
                // Handle insertion error
                echo "Error inserting data: " . $stmt->error;
                $insert_success = false;
            }
        }

        session_start();
        if ($insert_success == true) {
            $_SESSION["success_message"] = "Your data has been inserted successfully.";
            $conn->close();
            header("Location: view.php");
            exit();
        }
    }
    ?>
</body>
</html>
