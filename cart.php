<?php
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{

$sum=0;
$exists=false;
include'partials/_dbconnect.php';
$method= $_SERVER['REQUEST_METHOD'];
$showAlert=false;
$email=$_SESSION['email'];
if($method == 'POST')
{
  $productid=$_POST['productid'];
  $productdesc=$_POST['productdesc'];
  $quantity=$_POST['quantity'];
  $productname = $_POST['productname'];
  $price = $_POST['price']; 
  $img_id=$_POST['imageid'];
  $sql="INSERT INTO `cart` (`product_id`, `product_desc`, `dt`, `email`, `img_id`, `price` ,`quantity`) VALUES ('$productid', '$productdesc', current_timestamp(), '$email', '$img_id', '$price', '$quantity')";        
  $result = mysqli_query($conn, $sql);
  $showAlert=true;
}
if($showAlert){

  echo "<script>window.location.href='".$_SERVER['REQUEST_URI']."'</script>";


}
}
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive-style.css">
    <style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>

<body style="background-color: #eee;">
    <section class="h-100 h-custom" style="">
        <div class="container py-5 h-100">
            <div class="container d-flex justify-content-center align-items-center h-100  ">
                <h2>Cart</h2>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">
                                <?php         
              if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{

    $sql = "SELECT * FROM `cart` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num>0)
    {
    while($row = mysqli_fetch_assoc($result)){
      $productid=$row['product_id'];
      $productdesc=$row['product_desc'];
      $img_id=$row['img_id'];    
      $price=$row['price'];
      $quantity=$row['quantity'];
      $cart_id=$row['cart_id'];
      $sum=$sum+$price*$quantity;
      $exists=true;
      echo'
              <div class="col-lg-7">
                

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                  </div>
                  <div>
                    
                  </div>
                </div>

    
                <div class="card mb-3">

                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="images/product'.$img_id.'.jpg"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px object-fit:cover;">
                        </div>
                        <div class="ms-3">
                          <h5></h5>
                          <p class="small mb-0">'.$productdesc.'</p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0">'.$quantity.'</h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0">'.$price*$quantity.'Rs</h5>
                        </div>
                        <a href="delete.php?id='.$cart_id.'"  style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
}
if($sum>0)
echo'<h5>Total='.$sum.'Rs</h5>'; 
}
else{
  echo'<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <h2 class="text-center">Nothing in cart </h2>
</div>
';
}
}
else{
  echo'<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <h2 class="text-center">Loggin to add in cart</h2>
</div>
';
}
  ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>


</body>

</html>