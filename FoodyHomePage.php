<?php
include'partials/_dbconnect.php';
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <title>Yummy Tummy</title>
    <!-- bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- OWN CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive-style.css">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">
    <!-- header design -->
    <header>
        <nav class="navbar navbar-expand-lg navigation-wrap">
            <div class="container">
                <a class="navbar-brand" href="FoodyHomePage.php" target="_self">
                    <!-- <img src="images/logo3.png" class="logo">-->
                    <text x="50" y="90" text-anchor="middle">
                        <h2 class="logo"> Yummy Tummy</h2>
                    </text>
                    <svg class="#gfg" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <i class="fas fa-stream navbar-toggler-icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#explore-food">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#testimonial">Reviews</a>
                        </li>
          <?php 
            if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
               echo' <li><a href="login-signup page.php"><button class="main-btn">Login</button></a></li>';
            }
            else{
              echo'<li class="nav-item"><a class="nav-link" href="#testimonial">'.$_SESSION['username'].'</a></li>';
              echo '<li><a href="logout.php"><button class="main-btn">Login out</button></a></li>'; 
            }
          ?>
                    </ul>
                    <ul>
                        <!-- Example split danger button -->
                        <div class="btn-group">
                            <!--<button type="button" class="btn btn-warning"></button>-->
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <!--<span class="visually-hidden">Toggle Dropdown</span>-->
                                Account
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="profile.php">User Account</a></li>
                                <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                <li><a class="dropdown-item" href="#">Offers</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Plus Members</a></li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <!-- section-1 top-banner -->
    <section id="home">
        <div class="container-fluid px-0 top-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <h1>ALL <br> TYPES OF FOOD<span> AVAILABLE</span></h1>
                        <h2>YOUR NEEDS ON YOUR FiNGER-TIP's</h2>
                        <p>*Order now and get free Dilevery .</p>
                        <div class="mt-4">
                            <button class="main-btn">Order now <i class="fas fa-shopping-basket ps-3"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- section-2 our-menu -->
    <section class="our-menu p-4">
        <div class="container text-center">
            <h2 class="pb-4">CATEGORIES</h2>
            <div class="row justify-content-around " >
            <?php
            $sql ="SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['category_id'];
                $catname = $row['category_name'];
                $catdis = $row['category_description'];
                echo'<div class="col-6 col-sm-2 mb-4 mb-lg-0">
                    <div class="card">
                        <div class="cat-image">
                            <a class="link_category_product" href="#">
                                <img src="images/image'.$id.'.png" class="img-fluid" width="35%" >
                            </a>
                        </div>
                        <div class="cat-title">
                            <a href="categories.php?catid='.$id.'"> '.$catname.'</a>
                        </div>
                    </div>
                </div>';
            }?>
                <div class="mt-4">
                    <a href="#"><button class="main-btn">Click For More </button></a>
                </div>
            </div>
        </div>
    </section>


    <!-- section-3 about-->
    <section id="about">
        <div class="about-section wrapper">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-12 mb-lg-0 mb-5">
                        <div class="card border-0">
                            <img src="images/delivery.jpg" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 text-sec">
                        <h2>We pride ourselves on Time Delivery.</h2>
                        <p>Serviceable all around the India with Hundreds of Dilevery partner at your Service.
                        </p>
                        <button class="main-btn mt-4">Learn More</button>
                    </div>
                </div>
            </div>
            <div class="container food-type">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-12 text-sec mb-lg-0 mb-5">
                        <h2>Food and Kitchen Hygiene. </h2>
                        <p>Your safety is our top priority. All Our Partners Takes all Neccesary Precausations before
                            wokring some of them ae as follows:- </p>
                        <ul class="list-unstyled py-3">
                            <li>Keeps Meat and Other Products Away From Eachother.</li>
                            <li>Santizing/Cleaning of Kitchen and Utensils.</li>
                            <li>Pest-Control done every Week.</li>
                        </ul>
                        <button class="main-btn mt-4">Learn More</button>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="card border-0">
                            <img src="images/cleaning.jpg" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- section-4 explore food-->
    <section id="explore-food">
        <div class="explore-food wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-content text-center">
                            <h2>Explore some of our Famous Food</h2>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
                        <div class="card border">
                            <img src="images/briyan.png" class="img-fluid" width="25%">
                            <div class="p-3">
                                <h5>Biryani</h5>
                                <p>Blue Nile</p>
                                <h4>$487</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
                        <div class="card border">
                            <img src="images/image1.png" class="img-fluid" width="37%">
                            <div class="p-3">
                                <h5>Schezewan Cheese Burger</h5>
                                <p>Burger King</p>
                                <h4>$130</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
                        <div class="card border">
                            <img src="images/plate.png" class="img-fluid" width="25%">
                            <div class="p-3">
                                <h5>Maharashtrin-Thali</h5>
                                <p>Maharashtrin-Thali</p>
                                <h4>$120</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Section-5 REVIEW-->
    <section id="testimonial">
        <div class="wrapper testimonial-section">
            <div class="container text-center">
                <div class="text-center pb-4">
                    <h2>SITE REVIEW</h2>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-10 offset-lg-1">
                        <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="carousel-caption">
                                        <img src="images/review/review-1.jpg">
                                        <p>"One of the best sites you can get online simple and attractive UI design and
                                            Food Taste awesome. "</p>
                                        <h5 class="label">Atharva Jadhav</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="carousel-caption">
                                        <img src="images/review/review-2.jpg">
                                        <p>"Best in Taste and can find all restaurent nearby me so in Love with it "</p>
                                        <h5 class="label">Ashraf Kazi</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="carousel-caption">
                                        <img src="images/review/review-1.jpg">
                                        <p>"Fabulous!! MIND-BLOWING experience All information is Genuine and no extra
                                            charges same price as hotel walk in and delivery was free as well . "</p>
                                        <h5 class="label">Abhishek Shelke</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>



    <!-- section-6 footer-->
    <footer id="footer">
        <div class="footer pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="footer-social pb-4 text-center">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="label">For New offers please Enter Your mail-Id here</h5>
                        <form class="newsletter">
                            <div class="d-flex">
                                <input class="form-control" placeholder="Email Address Here" type="email">
                                <button class="main-btn" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12">
                        <div class="footer-copy">
                            <div class="copy-right text-center pt-5">
                                <p class="text-light">© 2023. YUMMY TUMMY. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <!-- own js -->
    <script src="js/main.js"></script>
</body>

</html>