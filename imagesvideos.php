<?php
session_start();
include('./DBConnection.php');

function send_message($conn) {
    $resp = []; // Initialize the response array

    // Extracting POST data
    extract($_POST);

    // Default values
    $from_user = $_SESSION['id'];
    $to_user = $_SESSION['user_to'];
    $type = 4; // Default type for file messages
    $message = "This is a link to the file"; // Default message

    if (isset($_FILES['uploadedFile'])) {
        // Handling file upload
        $uploadedFile = $_FILES['uploadedFile'];

        // Validate the file type and size
        $allowedFileTypes = array(
            'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg', 
            'mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm',  );
        $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedFileTypes)) {
            $resp['status'] = 'failed';
            $resp['error'] = 'Invalid file type.';
            echo json_encode($resp);
            exit;
        }

        $maxFileSize = 70 * 1024 * 1024; // 70 MB
        if ($uploadedFile['size'] > $maxFileSize) {
            $resp['status'] = 'failed';
            $resp['error'] = 'File size exceeds the limit.';
            echo json_encode($resp);
            exit;
        }

        
        $uploadDirectory = 'ImagesVideos/';
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $destinationPath = $uploadDirectory . basename($uploadedFile['name']);

        if (move_uploaded_file($uploadedFile['tmp_name'], $destinationPath)) {
       
            $type = 3;
            $message = basename($uploadedFile['name']);
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = 'Error moving uploaded file to ' . $destinationPath;
            echo json_encode($resp);
            exit;
        }
    } else {
        // If no file uploaded, handle text message
        $message = $conn->real_escape_string($message);
        $message = str_replace('/r', '<br>', $message);
    }

    // Insert the message into the messages table using prepared statements
    $insMessageSql = "INSERT INTO `messages` (from_user, to_user, type, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insMessageSql);
    $stmt->bind_param('ssis', $from_user, $to_user, $type, $message);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $resp['status'] = "success";
    } else {
        $resp['status'] = "failed";
        $resp['error'] = 'Error executing SQL query: ' . $stmt->error;
    }

    echo json_encode($resp);
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    send_message($conn);
} else {
    echo json_encode(['status' => 'failed', 'error' => 'Invalid request method']);
    exit;
}
?>
