<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive-style.css">
    <!-- bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>
<?php
include'partials/_dbconnect.php';
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{

$email=$_SESSION['email'];
$sql="SELECT * FROM `users` WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$name=$row['username'];
$phoneno=$row['phoneno'];
$address=$row['address'];

echo'
<body style="background-color: #eee;">
    <section style="">
        <div class="container py-5">
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="images/userimg.png"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"></h5>
                            
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">'.$name.'</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">'.$email.'</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">'.$phoneno.'</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">'.$address.'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>';
}
else{
    echo'<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <h2 class="text-center">Loggin to get user details</h2>
</div>';
}
?>
<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

</body>

</html>