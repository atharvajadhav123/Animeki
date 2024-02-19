<?php
include'partials/_dbconnect.php';
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

?>

<?php
        $id= $_GET['catid'];
        $sql="SELECT * FROM `product` WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $productname = $row['product_name'];
            $productdesc = $row['product_description'];
            $price = $row['price'];
            $productid = $row['product_id'];
            $originalprice = $row['originalprice'];
        }
?>

<?php
        $id= $_GET['catid'];
        $sql="SELECT * FROM `categories` WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive-style.css">
</head>
<style>
    .form-inline, .input-group {
    transition: all 0.3s ease;
  }
  
  .form-inline:hover, .input-group:hover {
    transform: scale(1.05);
  }

</style>
<body>
    <section style="background-color: #eee;">
        <div class="text-center container py-5 ">
            <?php if( isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
    {
      echo'
      <form class="form-inline my-2 my-lg-0 container" method="get" action="search.php" style="max-width: 500px; margin: 0 auto;">
  <div class="input-group">
    <input class="form-control border-success py-2 rounded-0 mr-2" type="search" placeholder="Search" aria-label="Search" name="search">
    <div class="input-group-append">
      <button class="btn btn-outline-success rounded-0 my-2 my-sm-0" type="submit" style="line-height: 38px;"><i class="fas fa-search text-green align-middle"></i></button>
    </div>
  </div>
</form>
';
    }
    ?>

            <h4 class="mt-4 mb-5"><strong>Bestsellers</strong></h4>

            <div id="carouselExampleCaptions" class="carousel slide my-5">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/cat3.jpg" class="d-block w-100" alt="...">
                        
                    </div>
                    <div class="carousel-item">
                        <img src="images/cat1.jpg" class="d-block w-100" alt="...">
                        
                    </div>
                    <div class="carousel-item">
                        <img src="images/cat2.jpg" class="d-block w-100" alt="...">
                        
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="row">
                <?php
          $sql="SELECT * FROM `product` WHERE category_id=$id";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
              $productname = $row['product_name'];
              $productdesc = $row['product_description'];
              $price = $row['price'];
              $productid = $row['product_id'];
              $imageid = $row['img_id'];
              $originalprice = $row['originalprice'];
                echo'<div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                            <img src="images/product'.$imageid.'.jpg" class="w-50 img-fluid zoom-out" style="object-fit:cover;" />
                            <style>
                            .card {
                              position: relative;
                              overflow: hidden;
                            }
                            
                            .card img {
                              display: block;
                              width: 100%;
                            }
                            
                            .card:after {
                              content: "";
                              position: absolute;
                              left: 50%;
                              top: 50%;
                              transform: translate(-50%, -50%);
                              width: 100%;
                              height: 100%;
                              background-color: rgba(255, 255, 255, 0.5);
                              opacity: 0;
                              border-radius: 50%;
                              pointer-events: none;
                              transition: opacity 0.3s ease-out, transform 0.3s ease-out;
                            }
                            
                            .card:hover:after {
                              opacity: 1;
                              transform: translate(-50%, -50%) scale(2);
                            }
                            
                            .w-50 {
                              width: 100%!important;
                          }
                            .zoom-out {
                            transition: transform 0.5s ease;
                            }
                            .zoom-out:hover {
                            transform: scale(0.9);
                            }
                            </style>
                            <a href="#!">
                                <div class="mask">
                                    <div class="d-flex justify-content-start align-items-end h-100">
                                        <h5>
                                            <span class="badge bg-primary ms-2">New</span><span
                                                class="badge bg-danger ms-2">-10%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <a href="reviews.php?productid='.$productid.'" class="text-reset">
                                <h5 class="card-title mb-3" >'.$productname.'</h5>
                            </a>
                                <p>'.$productdesc.'</p>
                            <h6 class="mb-3">
                                <s>'.$originalprice.'Rs</s><strong class="ms-2 text-danger">'.$price.'Rs</strong>
                            </h6>
                        </div>
                    </div>
                </div>'; }
         ?>
            </div>

        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

</body>

</html>