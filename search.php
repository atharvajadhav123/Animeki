<?php
include'partials/_dbconnect.php';
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

?>
<?php
if(isset($_GET['search'])) {
 $productname = $_GET['search'];
}
else{
    echo 'Error';
}
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

<body>
    <section style="background-color: #eee;">
        <div class="text-center container py-5 ">

            <h4 class="mt-4 mb-5"><strong>Search Results</strong></h4>


            <div class="row">
                <?php
          $sql="SELECT * FROM `product` WHERE product_name LIKE '%$productname%'";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
    if($num>0)
    {
          while($row = mysqli_fetch_assoc($result)){
            $productname= $row['product_name'];
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
                        }
        else{
            echo'<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;"><h6>No search Results</h6></div>';
        }        
         ?>
            </div>

        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

</body>

</html>