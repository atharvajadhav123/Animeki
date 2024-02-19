<?php
include'partials/_dbconnect.php';
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
 ?>
<?php

  $productid = $_GET['productid'];
  $sql="SELECT * FROM `product` WHERE product_id=$productid";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $productname = $row['product_name'];
  $productdesc = $row['product_description'];
  $price = $row['price'];
  $originalprice = $row['originalprice'];
  $img_id = $row['img_id'];
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive-style.css">
</head>

<body>

    <div class="container">

        <!--Main layout-->
        <main class="mt-5 pt-4">
            <div class="container mt-5">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-6 mb-4">
                        <img src="images/product<?php echo $img_id?>.jpg" class="img-fluid" alt="" />
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6 mb-4">
                        <!--Content-->
                        <strong>
                            <p style="font-size: 45px;"><?php echo $productname ?></p>
                        </strong>
                        <div class="p-4">
                            <div class="mb-3">
                                <a href="">
                                    <span class="badge bg-dark me-1">Category 2</span>
                                </a>
                                <a href="">
                                    <span class="badge bg-info me-1">New</span>
                                </a>
                                <a href="">
                                    <span class="badge bg-danger me-1">Bestseller</span>
                                </a>
                            </div>

                            <p class="lead">
                                <span class="me-1">
                                    <del><?php echo $originalprice ?>Rs</del>
                                </span>
                                <span><?php echo $price ?>Rs</span>
                            </p>

                            <strong>
                                <p style="font-size: 20px;">Description</p>
                            </strong>

                            <p><?php echo $productdesc?>.</p>
                            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{

                            echo'<form class="d-flex justify-content-left" action="cart.php" method="post" >
                            <!-- Default input -->
                            <div class="form-outline me-1" style="width: 100px;">
                                <input type="number" value="1" name="quantity" class="form-control" />
                            </div>
                            
                            <input type="hidden" name="userid" value="'.$_SESSION['userid'].'">
                            <input type="hidden" name="productid" value="'.$productid.'">
                            <input type="hidden" name="productdesc" value="'.$productdesc.'">
                            <input type="hidden" name="productname" value="'.$productname.'">
                            <input type="hidden" name="price" value="'.$price.'">
                            <input type="hidden" name="imageid" value="'.$img_id.'">

                            <button class="btn btn-primary ms-1" "type="submit">
                                Add to cart
                                <i class="fas fa-shopping-cart ms-1"></i>
                            </button>
                            </form>';

                            }
                            else{
                            echo'<div class="d-flex justify-content-left">
                                <!-- Default input -->
                                <h4>Loggin to add to cart</h4>
                                </div>
                            ';
                            }?>
                        </div>
                        <!--Content-->
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->

                <hr />
                <?php $showAlert = false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST' )
    {
        if(empty($_POST['comment_content']))
        {
          echo'Fields cannot be blank';
          $fieldEmpty=true;
        }
        else{ 
              $user = $_SESSION['email'];
              $username = $user;
              $comment_content = mysqli_real_escape_string($conn, $_POST['comment_content']);
              //$comment_content = $_POST['comment_content'];
              $comment_content = str_replace("<" , "&lt;" , $comment_content);
              $comment_content = str_replace(">" , "&gt;" , $comment_content);
              $_SESSION['commentdesc'] = $comment_content;
              $sql="INSERT INTO `comments` ( `comment_content`, `product_id`, `comment_time`, `username`) VALUES ( '$comment_content', '$productid', current_timestamp(), '$username')";
              $result= mysqli_query($conn, $sql);
              $showAlert= true;
              $_SESSION['success_message'] = 'Form submitted successfully';
              //header('Location: ' . $_SERVER['REQUEST_URI']);  
              //exit();    
            }
        
            if($showAlert){
              echo'reveiw posted';
              echo "<script>window.location.href='".$_SERVER['REQUEST_URI']."'</script>";

    
            }
        elseif ($fieldEmpty == false && $showAlert == false){
            echo'review not posted';
          
        }
    }?>
                <section style="background-color: #eee;">
                    <div class="container my-5 py-3 ">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 col-lg-10 col-xl">
                                <div class="card border-0" style="background-color: #f8f9fa;">
                                    <?php $sql ="SELECT * FROM `comments` where product_id=$productid";
    $result = mysqli_query($conn, $sql);
    $noResult= true;
    while($row = mysqli_fetch_assoc($result)){
      $noResult=false;
      $userprint = $row['username'];
      $userprintdate = $row['comment_time'];
      $catdis = $row['comment_content'];
      echo'
          <div class="card-body">
            <div class="d-flex flex-start align-items-center">
              <img class="rounded-circle shadow-1-strong me-3"
                src="images/userimg.png" alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold text-primary mb-1">'.$userprint.'</h6>
                <p class="text-muted small mb-0">
                  Shared publicly - '.$userprintdate.'
                </p>
              </div>
              </div>
              <p class="mt-3 mb-4 pb-2">'.$catdis.'
              </p>
              
            <div class="small d-flex justify-content-start">
            <a href="#!" class="d-flex align-items-center me-3">
              <i class="far fa-thumbs-up me-2"></i>
              <p class="mb-0">Like</p>
            </a>
            <a href="#!" class="d-flex align-items-center me-3">
              <i class="far fa-comment-dots me-2"></i>
              <p class="mb-0">Comment</p>
            </a>
            <a href="#!" class="d-flex align-items-center me-3">
              <i class="fas fa-share me-2"></i>
              <p class="mb-0">Share</p>
            </a>
          </div>
        </div>';
      }
      if($noResult){
        echo'
            <div class="d-flex flex-start align-items-center mt-4 my-4  " >
              <img class="rounded-circle shadow-1-strong me-3"
              <div>
                <h4>No reviews so far...</h4>
              </div>
              </div>';
      }       
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
      {
          echo'
          <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
          <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="d-flex flex-start w-100">
              <img class="rounded-circle shadow-1-strong me-3"
                src="images/userimg.png" alt="avatar" width="40"
                height="40" />
              <div class="form-outline w-100">
                <textarea class="form-control" id="textAreaExample" name="comment_content" rows="4"
                  style="background: #fff;"></textarea>
                  <input type="hidden" value="comment" name="comment">
                <label class="form-label" for="textAreaExample">Message</label>
              </div>
            </div>
            <div class="float-end mt-2 pt-1">
              <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
              <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
            </div>
          <div>
          </div>
          </form>
          </div>
          ';}
      ?>
                                </div>
                            </div>
                </section>
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>