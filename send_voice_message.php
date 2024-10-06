<?php
include('./DBConnection.php');
//$conn = new DBConnection();
session_start();
error_log("Received file: " . print_r($_FILES, true), 3, "error.log");
if (isset($_GET['a']) && $_GET['a'] === 'getUserName') {
    // Handle the getUserName request
    if (isset($_SESSION['firstname'])) {
        $username = trim($_SESSION['firstname']);
        $username = preg_replace('/[^a-zA-Z0-9_-]/', '', $username);
        echo $username;
    } else {
        echo 'unknown_user';
    }
    exit(); // Exit after handling the request
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audioFile'])) {
    // Example: Save the audio file to a directory named 'audioFiles/'S
    $uploadDir = 'audioFile/';
    $uploadFile = $uploadDir. basename($_FILES['audioFile']['name']);
    error_log("Upload directory: " . $uploadDir, 3, "error.log");
    error_log("Upload file path: " . $uploadFile, 3, "error.log");
    if (move_uploaded_file($_FILES['audioFile']['tmp_name'], $uploadFile)) {
        // Your existing database logic
        $from_user = $_SESSION['id'];
        $user_to = $_SESSION['user_to'];
        $to_user = $user_to; 
        $type = 5;
        $message = $uploadFile; // Use the file path here

        $stmt = $conn->prepare("INSERT INTO `messages` (from_user, to_user, type, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $from_user, $to_user, $type, $message);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $resp['status'] = "success";
        } else {
            $resp['status'] = "failed";
            $resp['error'] = $stmt->error;
        }

        $stmt->close();
        echo 'Voice message sent successfully.';
    } else {
        error_log("Error moving file: " . error_get_last(), 3, "error.log");
    echo 'Error saving audio file.';
    }
} else {
    echo 'Invalid request.';
}

//$conn-> __destruct();
?>
