<?php
session_start();
include('./DBConnection.php');

// Check if the user is already logged in
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
    header("Location: ./");
    exit;
}

// Include the database connection class


if($_SERVER['REQUEST_METHOD']=="POST")
{
    $userFirstName = $_POST['firstname'];
    $userMidName = $_POST['middlename'];
    $userLastName = $_POST['lastname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $cPassword = $_POST['cpassword'];
    $gender = $_POST['gender'];
    $picture_name = $_FILES['profile_picture']['name']; 
    $temp_name = $_FILES['profile_picture']['tmp_name'];
    $folder = "Profiles/".$picture_name;
    move_uploaded_file($temp_name , $folder);

    //Email Counter
    $email_qry = "SELECT COUNT(email) AS email_count FROM users WHERE email = ?";
    $smtp_email = mysqli_prepare($conn, $email_qry);
    mysqli_stmt_bind_param($smtp_email, "s", $email);
    mysqli_stmt_execute($smtp_email);
    mysqli_stmt_bind_result($smtp_email, $email_count);
    mysqli_stmt_fetch($smtp_email);
    $num_email = $email_count;
    mysqli_stmt_close($smtp_email);
//Contact Counter
$contact_qry = "SELECT COUNT(contact) AS contact_count FROM users WHERE contact = ?";
$contact_stmt = mysqli_prepare($conn, $contact_qry);

if ($contact_stmt) {
    
    mysqli_stmt_bind_param($contact_stmt, "s", $contact);
    mysqli_stmt_execute($contact_stmt);
    mysqli_stmt_bind_result($contact_stmt, $contact_count);
    mysqli_stmt_fetch($contact_stmt);
    $num_contact = $contact_count;
    mysqli_stmt_close($contact_stmt);
    // Now you can use $contact_count as needed
} else {
    die("Error in contact preparation: " . mysqli_error($conn));
}
   

if (!is_numeric($contact)) {
    $_SESSION['error'] = "The number should be numeric!!!";
    echo "<script> alert('Contact should be numeric') </script>";
} else if ($password != $cPassword) {
    $_SESSION['error'] = "Password doesn't match with confirm password";
    echo "<script> alert('Password doesn't match with confirm password') </script>";
} else if ($num_email > 0) {
    $_SESSION['error'] = "Email ID: {$email} is already exists";
    echo "<script> alert('Email ID: {$email} is already exists') </script>";
} else if ($contact_count > 0) {
    $_SESSION['error'] = "Contact: {$contact} is already exists";
    echo "<script> alert('Contact: {$contact} is already exists')</script>";
} 
    else{
        $encPassword = md5($_POST['password']);
     
       $query = "INSERT INTO users (firstname, middlename, lastname, contact, gender, dob, email, password, image_link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssssssss", $userFirstName, $userMidName, $userLastName, $contact, $gender, $dob, $email, $encPassword, $folder);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script> alert('User Registration Successful!!') </script>";
           header("Location: login.php");
            die;
        } else {
            echo "Error: " . mysqli_error($conn);
            $_SESSION['form_data'] = compact('userFirstName', 'userMidName', 'userLastName', 'contact', 'gender', 'dob', 'email', 'password', 'folder');
            // Redirect to the registration page
            header("Location: registration.php");
            die;
            if (isset($_SESSION['error'])) {
                $error = $_SESSION['error'];
                unset($_SESSION['error']);
                $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
                unset($_SESSION['form_data']);
            }
        }
    }

   
}
else{

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Messaging Web Application</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/custom.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
    <link rel="stylesheet" href="./select2/dist/css/select2.css">
<script src="./select2/dist/js/select2.min.js"></script>
    <style>
        html, body{
            height:100%;
        }
        #logo-img{
            width:75px;
            height:75px;
            object-fit:scale-down;
            background : var(--bs-light);
            object-position:center center;
            border:1px solid var(--bs-dark);
            border-radius:50% 50%;
        }
        @media (max-width: 768px) {
            .card {
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-dark bg-gradient">

    <div class="h-100 d-flex justify-content-center align-items-center">
        <div class='w-100'>
            <h3 class="py-5 text-center " style = "color: white;">WeChat- User Registration</h3>
            <div class="card my-3 col-md-8 offset-md-2">
                <div class="card-body bg-dark" style = " color: white; ">
                    <form action="#" id="register-form" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="0">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="firstname" class="control-label">First Name</label>
                                <input type="text" id="firstname" autofocus name="firstname" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="col-md-4">
                                <label for="lastname" class="control-label">Last Name</label>
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-sm rounded-0" required>
                            </div>
                            <div class="col-md-4">
                                <label for="middlename" class="control-label">Middle Name</label>
                                <input type="text" id="middlename" name="middlename" class="form-control form-control-sm rounded-0" placeholder="(optional)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="control-label">Sex</label>
                                    <select id="gender" name="gender" class="form-control form-control-sm rounded-0" required>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contact" class="control-label">Contact</label>
                                    <input type="text" id="contact" pattern="[0-9]+" name="contact" class="form-control form-control-sm rounded-0" title="Digits Only" required>
                                    <span id="contact_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob" class="control-label">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-sm rounded-0" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-sm rounded-0" required>
                            <span id="password_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="cpassword" class="control-label">Confirm Password</label>
                            <input type="password" id="cpassword" name="cpassword" class="form-control form-control-sm rounded-0" required>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture" class="control-label">User Profile</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control form-control-sm rounded-0" required onchange="display_img(this)">
                        </div>
                        <div class="form-group text-center mt-2">
                            <img src="././images/OIP.jpg" id="logo-img" alt="Avatar">
                        </div>
                        <div class="form-group d-flex w-100 justify-content-between">
                            <a href="./">Already have an Account?</a>
                            <button type="submit" class="btn btn-sm btn-primary rounded-0 my-1">SignUp</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your JS files or CDN links here -->
</body>
<script>
    function display_img(input){
        if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#logo-img').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
    }
</script>
</html>

   
