<?php
require("DBConnection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $data = json_decode(file_get_contents('php://input'), true);

    // Process the data
    $userID = $data['userID'];
    $callID = $data['callID'];
    $_SESSION['CallID'] = $callID;

  $query = "UPDATE users SET Notif = 1 WHERE userID = $userID";

if ($conn->query($query) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

   
    echo json_encode(['status' => 'success', 'message' => 'Data received successfully']);
} else {
    // Invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}


// Check user is still online or not
function handleHeartbeat($conn) {
    $userID = $_POST['userID']; // Assuming you pass userID with the heartbeat
    
    // Check the last seen timestamp in the database
    $result = $conn->query("SELECT last_seen FROM users WHERE id = $userID");

    if ($result && $row = $result->fetch_assoc()) {
        $lastSeenTimestamp = strtotime($row['last_seen']);
        $currentTime = time();
        
        // Assuming you want to consider the session as expired if no heartbeat received for 5 minutes (adjust as needed)
        $expirationTime = 5 * 60;

        if (($currentTime - $lastSeenTimestamp) > $expirationTime) {
            $uid = $_SESSION['id'];
            $query = "UPDATE users SET status = 0 WHERE userID = $uid ";

            if ($conn->query($query) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
            session_destroy();
            echo "Session destroyed due to inactivity";
            
        } else {
            // Update the last seen timestamp
            $query = "UPDATE users SET last_seen = NOW() WHERE id = $userID";

            if ($conn->query($query) === TRUE) {
                echo "Heartbeat processed successfully";
            } else {
                echo "Error updating last seen timestamp: " . $conn->error;
            }
        }
    } else {
        echo "Error retrieving last seen timestamp: " . $conn->error;
    }
}

?>
