<?php 
$user_id = isset($_GET['user']) ? $_GET['user'] : md5($_SESSION['id']);
$user_qry = $conn->query("SELECT *,CONCAT(firstname,' ',middlename,' ',lastname) as fullname FROM users where md5(id) = '{$user_id}'");
if($user_qry->num_rows <= 0)
    echo '<script>location.replace("404.html")</script>';
foreach($user_qry->fetch_array() as $k => $v){
    if(!is_numeric($k)){
        $$k=$v;
    }
}
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<div class="h-100 d-flex align-items-center justify-content-center" style = "margin-left:25%">
    <div class="row">
        <div class="col-md-8">
            <div class="info-card card p-4">
            <div class="profile-card text-center p-4">
                <img src="<?php echo $image_link ?>" style="aspect-ratio: 3/2.6;" class="profile-image img-fluid" alt="./images/no-image-available.png">
              <a href="./?page=home">
                 <button style ='position: absolute; top:20%; bottom:50% left:100%; border:none; height:30px; width:30px; background-color:red; color:white;'><span><i class="fa fa-multiply"></i></span></button>
             </a>  
                <h2 class="mt-3"><?php echo $fullname ?></h2>
            </div>
                <center><div class="card-header bg-gradient-primary text-black">
                    <h5 class="card-title mb-0">Details</h5>
                </div> </center>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3 text-muted">Email:</dt>
                        <dd class="col-sm-9"><?php echo $email ?></dd>

                        <dt class="col-sm-3 text-muted">Gender:</dt>
                        <dd class="col-sm-9"><?php echo $gender ?></dd>

                        <dt class="col-sm-3 text-muted">Date of Birth:</dt>
                        <dd class="col-sm-9"><?php echo date("F d, Y", strtotime($dob)) ?></dd>

                        <dt class="col-sm-3 text-muted">Contact:</dt>
                        <dd class="col-sm-9"><?php echo $contact ?></dd>
                    </dl>

                    <?php if ($_SESSION['id'] == $id): ?>
                       <center> <a href="./?page=manage_account" class="btn btn-primary  mt-2"><i>Edit Profile</i></a></center>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
