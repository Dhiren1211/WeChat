<?php
session_start();
ini_set('error_reporting', 0);
// Check if $_SESSION['id'] is set
if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
    header("Location:./");
    exit;
}

require_once './DBConnection.php';

// Your database connection and update code can go here

// For example:

// Set a default page if $_GET['page'] is not set
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Now you can use $_SESSION['id'] and $page as needed

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN |WeChat</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
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
    </style>
</head>
<body class="bg-dark bg-gradient">
  <div class="h-100 d-flex justify-content-center align-items-center" >
    <div class="w-100">
      <div class="card my-3 col-md-4 offset-md-4">
        <div class="card-body bg-dark" style="box-shadow: 0 8px 16px rgba(10, 10, 10, 0.5); color:white;">
          <div class="text-center">
            <h4 class="text-primary">Welcome to WeChat</h4>
          </div>
          <form action="" id="login-form">
            <input type="hidden" name="type" value="2">
            <p class="text-center" style = "color: orangered;"><small>Please enter your credentials.</small></p>
            <div class="form-group">
              <label for="email"class="control-label text-left" >Contact</label>
              <input type="text" id="email" autofocus name="contact" class="form-control form-control-sm rounded-0" required>
            </div>
            <div class="form-group">
              <label for="password" class="control-label text-left">password</label>
              <input type="password" id="password" autofocus name="password" class="form-control form-control-sm rounded-0" required>
            </div>
            <div class="form-group d-flex w-100 justify-content-between mt-2">
              <a href="./registration.php">Sign Up</a>
              <button class="btn btn-sm btn-primary rounded-1 my-1 mt-2" style="width: 100px; font-family: sans-serif; font-style: italic; font-size: 15px;">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
    $(function(){
        $('#login-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('Loging in...')
            $.ajax({
                url:'./Actions.php?a=login',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                            location.replace('./');
                        }, 2000);
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg);

                    _el.hide();
                    _this.prepend(_el);
                    _el.show('slow');
                    _this.find('button').attr('disabled',false);
                    _this.find('button[type="submit"]').text('Save');
                }
            })
        })
    })
</script>
</html>
