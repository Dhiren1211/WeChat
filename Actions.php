<?php
session_start();
require_once 'DBConnection.php';

class Actions extends DBConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function login()
    {
        extract($_POST);

        // Hash the password
        $hashedPassword = md5($password);

        $sql = "SELECT * FROM users WHERE contact = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);

        // Use variables in bind_param
        $stmt->bind_param("ss", $contact, $hashedPassword);
        $stmt->execute();

        $result = $stmt->get_result();
        $qry = $result->fetch_array();

        if (!$qry) {
            $resp['status'] = "failed";
            $resp['msg'] = "Invalid contact or password.";
        } else {
            $resp['status'] = "success";
            $resp['msg'] = "sucessfully logged in!!.";

            foreach ($qry as $k => $v) {
                if (!is_numeric($k)) {
                    $_SESSION[$k] = $v;
                }

            }
        }

        return json_encode($resp);
    }

    public function logout()
    {
        session_destroy();
        header("location:./");
        $this->conn->query("UPDATE users SET status = 0 WHERE id = '{$_SESSION['id']}'");
    }

    /*  function save_user()
    {
    $resp = array();

    try {
    // Validate and sanitize input data
    $data = array();
    $fields = array('id', 'lastname', 'firstname', 'middlename', 'gender', 'contact', 'dob', 'email', 'password', 'profile_picture');

    foreach ($fields as $field) {
    if (isset($_POST[$field])) {
    $data[$field] = $this->conn->real_escape_string($_POST[$field]);
    }
    }

    // Check for existing email
    $existingEmailCheck = $this->conn->query("SELECT * FROM users WHERE `email` = '{$data['email']}' " . ($data['id'] > 0 ? " AND id != '{$data['id']}'" : ""))->num_rows;

    if ($existingEmailCheck > 0) {
    $resp['status'] = 'failed';
    $resp['msg'] = "Email already exists.";
    } else {
    // Hash the password if provided
    if (!empty($data['password'])) {
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    } else {
    unset($data['password']); // Remove password field if empty
    }

    // Handle avatar upload
    if (isset($_FILES['avatar']['tmp_name']) && !empty($_FILES['avatar']['tmp_name'])) {
    $fileTmpPath = $_FILES['avatar']['tmp_name'];
    $fileContent = file_get_contents($fileTmpPath);
    $data['profile_picture'] = $fileContent;
    }

    // Build the SQL query
    $sql = '';
    foreach ($data as $key => $value) {
    if ($key !== 'id') {
    $sql .= "`{$key}` = '{$value}', ";
    }
    }

    $sql = rtrim($sql, ', '); // Remove trailing comma

    if (!empty($data['id'])) {
    $sql = "UPDATE `users` SET {$sql} WHERE id = '{$data['id']}'";
    } else {
    $sql = "INSERT INTO `users` SET {$sql}";
    }

    $result = $this->conn->query($sql);

    if ($result) {
    $resp['status'] = 'success';
    $resp['user_id'] = isset($data['id']) ? $data['id'] : $this->conn->insert_id;
    $resp['msg'] = empty($data['id']) ? 'New User successfully saved.' : 'User Details successfully updated.';
    } else {
    throw new Exception('Saving User Details Failed. Error: ' . $this->conn->error . ' Query: ' . $sql);
    }
    }
    } catch (Exception $e) {
    error_log('Exception: ' . $e->getMessage());
    $resp['status'] = 'failed';
    $resp['msg'] = 'An error occurred. Please try again later.' . $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($resp);
    die;
    }*/
    public function save_user()
    {
        $resp = array();

        try {
            // Validate and sanitize input data
            $data = array();
            $fields = array('id', 'lastname', 'firstname', 'middlename', 'gender', 'contact', 'dob', 'email', 'password', 'profile_picture');

            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    $data[$field] = $this->conn->real_escape_string($_POST[$field]);
                } else {
                    $data[$field] = ''; // Set a default value if the key is not present
                }
            }

            // Check for existing email
            $existingEmailCheck = $this->conn->query("SELECT * FROM users WHERE `email` = '{$data['email']}' " . ($data['id'] > 0 ? " AND id != '{$data['id']}'" : ""))->num_rows;

            if ($existingEmailCheck > 0) {
                $resp['status'] = 'failed';
                $resp['msg'] = "Email already exists.";
            } else {
                // Hash the password if provided
                if (!empty($data['password'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                } else {
                    unset($data['password']); // Remove password field if empty
                }

                // Handle avatar upload
                if (isset($_FILES['avatar']['tmp_name']) && !empty($_FILES['avatar']['tmp_name'])) {
                    $fileTmpPath = $_FILES['avatar']['tmp_name'];
                    $fileContent = file_get_contents($fileTmpPath);
                    $data['profile_picture'] = $fileContent;
                }

                // Build the SQL query
                $sql = '';
                foreach ($data as $key => $value) {
                    if ($key !== 'id') {
                        $sql .= "`{$key}` = '{$value}', ";
                    }
                }

                $sql = rtrim($sql, ', '); // Remove trailing comma

                if (!empty($data['id'])) {
                    $sql1 = "UPDATE `users` SET {$sql} WHERE id = '{$data['id']}'";
                } else {
                    $sql1 = "INSERT INTO `users` SET {$sql}";
                }

                $result = $this->conn->query($sql1);

                if ($result) {
                    $resp['status'] = 'success';
                    $resp['user_id'] = isset($data['id']) ? $data['id'] : $this->conn->insert_id;
                    $resp['msg'] = empty($data['id']) ? 'New User successfully saved.' : 'User Details successfully updated.';
                } else {
                    throw new Exception('Saving User Details Failed. Error: ' . $this->conn->error . ' Query: ' . $sql);
                }
            }
        } catch (Exception $e) {
            error_log('Exception: ' . $e->getMessage());
            $resp['status'] = 'failed';
            $resp['msg'] = 'An error occurred. Please try again later.' . $e->getMessage();
        }

        header('Content-Type: application/json');
        echo json_encode($resp);
        die;
    }
    public function delete_user()
    {
        extract($_POST);

        @$delete = $this->conn->query("DELETE FROM `users` where id = '{$id}'");
        if ($delete) {
            $resp['status'] = 'success';
            $_SESSION['flashdata']['type'] = 'success';
            $_SESSION['flashdata']['msg'] = 'User successfully deleted.';
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->lastErrorMsg();
        }
        return json_encode($resp);
    }
    public function update_credentials()
    {
        $resp = array();

        // Ensure that the required fields are present in the $_POST array
        $required_fields = array('id', 'old_password', 'password'); // Add other fields as needed
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field])) {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Missing required field: ' . $field;
                return json_encode($resp);
            }
        }

        extract($_POST);

        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'old_password')) && !empty($v)) {
                if (!empty($data)) {
                    $data .= ",";
                }

                if ($k == 'password') {
                    $v = md5($v);
                }

                $data .= " `{$k}` = '{$v}' ";
            }
        }

        if (!empty($password) && ($old_password) != $_SESSION['password']) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Old password is incorrect.";
        } else {
            $sql = "UPDATE `users` SET {$data} WHERE id = '{$_SESSION['id']}'";
            $save = $this->conn->query($sql);

            if ($save) {
                $resp['status'] = 'success';
                $_SESSION['flashdata']['type'] = 'success';
                $_SESSION['flashdata']['msg'] = 'Credential successfully updated.';

                // Update session data
                foreach ($_POST as $k => $v) {
                    if (!in_array($k, array('id', 'old_password')) && !empty($v)) {
                        $_SESSION[$k] = $v;
                    }
                }

                // Handle avatar update
                // Handle avatar update
                if (isset($_FILES['avatar']['tmp_name']) && !empty($_FILES['avatar']['tmp_name'])) {
                    $dir_path = __DIR__ . '/Profiles/';

                    if (!is_dir($dir_path)) {
                        mkdir($dir_path, 0755, true);
                    }
                    // Extract the extension from the uploaded file
                    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

                    // Append the extension to the filename
                    $fname .= '.' . $extension;

                    $fname = $dir_path . $_SESSION['id'] . '_avatar'; // Adjust filename based on user's ID (without extension)

                    $upload = $_FILES['avatar']['tmp_name'];

                    // Move the uploaded file to the destination
                    if (move_uploaded_file($upload, $fname)) {
                        // Update the database or session with the new filename if needed
                        // Example: $_SESSION['avatar'] = $_SESSION['id'] . '_avatar';

                        $resp['msg'] .= " Image successfully uploaded.";
                    } else {
                        $resp['msg'] .= " But Image failed to upload due to an unknown reason.";
                    }
                }

            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Updating Credentials Failed. Error: ' . $this->conn->error;
                $resp['sql'] = $sql;
            }
        }

        return json_encode($resp);
    }

    public function find_user()
    {
        extract($_POST);
        $sql = "SELECT *,CONCAT(firstname,' ',middlename,' ',lastname) as `name` FROM `users` where (CONCAT(firstname,' ',middlename,' ',lastname) LIKE '%{$keyword}%' OR CONCAT(lastname,' ',firstname,' ',middlename) LIKE '%{$keyword}%' OR email LIKE '%{$keyword}%') and id != '{$_SESSION['id']}'";
        $search = $this->conn->query($sql);
        $data = array();
        while ($row = $search->fetch_assoc()) {
            $row['avatar'] = is_file('./uploads/avatars/' . $row['id'] . '.png') ? './uploads/avatars/' . $row['id'] . '.png?v=' . (!is_null($row['date_updated']) ? strtotime($row['date_updated']) : strtotime($row['date_created'])) : './images/no-image-available.png';
            $row['id'] = md5($row['id']);
            $data[] = $row;
        }
        return json_encode($data);
    }
    public function send_message()
    {
        extract($_POST);
        $from_user = $_SESSION['id'];
        $to_user = $user_to;
        $type = 1;
        $message = $this->conn->real_escape_string(($message));
        $message = str_replace('/r', '<br>', $message);
        $ins_message = $this->conn->query("INSERT INTO `messages` set from_user='{$from_user}', to_user='{$to_user}', `type` = '{$type}',`message` ='{$message}'");
        if ($ins_message) {
            $resp['status'] = "success";
        } else {
            $resp['status'] = "failed";
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }
    public function get_messages()
    {
        extract($_POST);
        $awhere = "";
        $last_id = empty($last_id) ? 0 : $last_id;

        $messages = $this->conn->query("SELECT * FROM `messages` where ((from_user = '{$_SESSION['id']}' and to_user = '{$convo_with}') OR (to_user = '{$_SESSION['id']}' and from_user = '{$convo_with}')) and id > {$last_id} order by unix_timestamp(date_created) asc ");

        $data = array();
        $ids = array();

        while ($row = $messages->fetch_assoc()) {

            // Check if the message is a file message (type 4)
            if ($row['type'] == 4) {
                // Check if 'message' key exists in $row array
                if (isset($row['message'])) {
                    $dir = 'files/';
                    $filename = $row['message'];
                    $link = $dir . $row['message'];

                    if (!file_exists($link)) {
                        error_log("file not found: $link", 0);
                        $row['message'] = "This message has been deleted.";
                    } else {
                        // Provide a direct link to the file
                        $row['message'] = "<a href='$link' target='_blank'><i class ='fa fa-file'> </i>&nbsp; $filename </a>";
                    }
                } else {
                    // Handle the case where 'message' key is not set
                    echo "Error: 'message' key not set in the row array.";
                }
            } elseif ($row['type'] == 5) {
                $audioPath = $row['message'];
                $decodedFileName = $audioPath;
                $audioElement = '<audio controls>
                <source src="'.$decodedFileName. '" type="audio/mpeg"> </audio>';

                if (!file_exists($audioPath)) {
                    // Log an error if the file doesn't exist
                    error_log("Audio file not found: $audioPath", 0);
                    $row['message'] = "This message has been deleted.";
                } else {
                    $row['message'] = $audioElement;
                }
            } elseif ($row['type'] == 3) {
                $filelink = $row['message'];
                $dir = "ImagesVideos/";

                // Get the file extension from the file link
                $fileExtension = pathinfo($filelink, PATHINFO_EXTENSION);

                if (in_array(strtolower($fileExtension), array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg'))) {
                    // It's an image
                    $image = '<img src="' . $dir . $filelink . '" style="height:200px; width:auto;" controls>';
                    $row['message'] = $image;
                } elseif (in_array(strtolower($fileExtension), array('mp4', 'mov', 'avi', 'mkv', 'wmv', 'flv', 'webm'))) {
                  
                    $video = '<video src="' . $dir . $filelink . '" style="height:200px; width:auto;" autoplay muted controls></video>';
                    $row['message'] = $video;
                } else {
                    // It's neither an image nor a video, handle accordingly
                    echo "This is neither an image nor a video.";
                }
            } else {
                $row['message'] = str_replace('\r', '<br>', $row['message']);
            }

            $data[] = $row;

            if ($row['from_user'] != $_SESSION['id']) {
                $ids[] = $row['id'];
            }
        }

        if (count($ids) > 0) {
            $this->conn->query("UPDATE `messages` set status = 1 where id in (" . implode(',', $ids) . ") ");

        }

        return json_encode($data);
    }

    public function get_prev_messages()
    {
        extract($_POST);
        $messages = $this->conn->query("SELECT * FROM `messages` WHERE (from_user = '{$_SESSION['id']}' AND to_user = '{$convo_with}') OR (to_user = '{$_SESSION['id']}' AND from_user = '{$convo_with}') ORDER BY unix_timestamp(date_created) DESC LIMIT {$message_limit} OFFSET {$message_offset}");

        $data = array();

        while ($row = $messages->fetch_assoc()) {

            // Check if the message is a file message (type 4)
            if ($row['type'] == 4) {
                // Assume that the files are stored in the 'files/' directory
                $fileLink = '<a href="files/' . basename($row['message']) . '" target="_blank">Download File</a>';
                $row['formatted_message'] = $fileLink;
            } elseif ($row['type'] == 5) {
                $row['message'] = "Audio Message.";
            } elseif ($row['type'] == 1) {
                $row['message'] = str_replace('\r', '<br>', $row['message']);
            } else {
                $row['message'] = "invalid message!!";
            }

            $data[] = $row;
        }

        return json_encode($data);
    }

    /*function get_prev_messages(){
    extract($_POST);
    $messages = $this->conn->query("SELECT * FROM `messages` WHERE (from_user = '{$_SESSION['id']}' AND to_user = '{$convo_with}') OR (to_user = '{$_SESSION['id']}' AND from_user = '{$convo_with}') ORDER BY unix_timestamp(date_created) DESC LIMIT {$message_limit} OFFSET {$message_offset}");

    $data = array();

    while($row = $messages->fetch_assoc()){

    // Check if the message is a file message (type 4)
    if ($row['type'] == 4) {
    // Assume that the files are stored in the 'files/' directory
    $fileLink = '<a href="files/' . basename($row['message']) . '" target="_blank">Download File</a>';
    $row['formatted_message'] = $fileLink;

    }
    elseif ($row['type'] == 5) {
    $row['message'] = '<audio src = `$row['message']`> </audio>'
    }
    else {
    $row['message'] = str_replace('\r', '<br>', $row['message']);
    }

    $data[] = $row;
    }

    return json_encode($data);
    }*/

    public function get_unread()
    {
        $qry = $this->conn->query("SELECT distinct(m.from_user),m.*,concat(u.firstname,' ',u.lastname) as name FROM `messages` m inner join `users` u on m.from_user = u.id where m.to_user = '{$_SESSION['id']}' and m.popped = '0' and m.status =0 order by unix_timestamp(m.date_created) desc ");
        $data = array();
        while ($row = $qry->fetch_assoc()) {
            $row['avatar'] = is_file('./uploads/avatars/' . $row['from_user'] . '.png') ? './uploads/avatars/' . $row['from_user'] . '.png' : './images/no-image-available.png';
            $row['convo_with'] = $row['from_user'];
            $row['eid'] = md5($row['from_user']);
            $this->conn->query("UPDATE messages set popped = 1 where id <= '{$row['id']}' and from_user = '{$row['from_user']}' and to_user = '{$_SESSION['id']}' ");
            $un_read = $this->conn->query("SELECT * FROM messages where to_user = '{$_SESSION['id']}' and from_user = '{$row['from_user']}' and status = '0' ")->num_rows;
            $row['un_read'] = $un_read > 0 ? $un_read : '';
            $data[] = $row;
        }
        return json_encode($data);
    }
    public function delete_message()
    {
        extract($_POST);
        $delete = $this->conn->query("UPDATE messages set delete_flag = 1 where id ='{$id}'");
        if ($delete) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
            $resp['err'] = $this->conn->error;
        }
        return json_encode($resp);
    }
    public function check_deleted()
    {
        extract($_POST);
        $data = array();
        if (!empty($ids)) {
            $qry = $this->conn->query("SELECT * FROM messages where id in ({$ids}) and delete_flag=1");
            while ($row = $qry->fetch_assoc()) {
                $data[] = $row['id'];
            }
        }
        return json_encode($data);
    }

}
$a = isset($_GET['a']) ? $_GET['a'] : '';
$action = new Actions();
switch ($a) {
    case 'login':
        echo $action->login();
        break;
    case 'logout':
        echo $action->logout();

        break;
    case 'save_user':
        echo $action->save_user();
        break;
    case 'delete_user':
        echo $action->delete_user();
        break;
    case 'update_credentials':
        echo $action->update_credentials();
        break;
    case 'find_user':
        echo $action->find_user();
        break;
    case 'send_message':
        echo $action->send_message();
        break;
    case 'get_messages':
        echo $action->get_messages();
        break;
    case 'get_prev_messages':
        echo $action->get_prev_messages();
        break;
    case 'get_unread':
        echo $action->get_unread();
        break;
    case 'delete_message':
        echo $action->delete_message();
        break;
    case 'check_deleted':
        echo $action->check_deleted();
        break;
    default:
        // default action here
        break;
}
