<?php
session_start();
$count=0;

$Gtotal=0;
$total=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/index.css" rel="stylesheet">


    <link rel="stylesheet" href="./css/main.css">
    

    
    
</head>
<body>

<nav class="navbar fixed-top shadow-sm navbar-expand-lg bg-dark navbar-dark py-1 py-lg-0 px-lg-5">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="index.html" class="nav-item nav-link ">Home</a>
                    <a href="products.php" class="nav-item nav-link " >Shop</a>
                    <?php 
                    if(isset($_SESSION['cart'])){
                        $count=count($_SESSION['cart']);
                    }
                    
                    ?>
                    <a href="cart_.php" class="nav-item nav-link active" >My Cart(<?php echo $count; ?>)</a>
                    <a href="signup.php" class="nav-item nav-link " >SignUp</a>
                    <?php
                    if (isset($_SESSION["name"])){
                        ?>
                    <a href="#" class="nav-item nav-link " ><?php echo $_SESSION["name"]; ?></a>

                        <?php
                        
                    }
                    ?>
                </div>
            </div>
        </nav>
    


    
        <?php  
if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0 ){
    ?>
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
            <tr>
                <td>Remove</td>
                <td>Images</td>
                <td>Products</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>SubTotal</td>
            </tr>
            </thead>     
    <?php

    foreach($_SESSION['cart'] as $key => $value){
        
        $total=$value['price']*$value['qnt'];
        $Gtotal=$Gtotal+$total;
        
        ?>
        
        <tbody>
            <tr>
                <td>
                    <form action="menage_cart.php" method="post">
                        <button type="submit" name="btn" class="normal">Remove</button>

                        <input type="hidden" name="prod_name" value="<?php  echo"$value[name]" ?>">
                    </form>
                </td>
                <td> <img src="uploads/<?php echo $value['img']; ?>" alt=""></td>
                <td><?php  echo"$value[name]" ?></td>
                <td class="price"><?php  echo"$value[price]" ?></td>
                <td >
                    <form action="menage_cart.php" method="post">
                    <input type="number"  value="<?php  echo"$value[qnt]" ?>" name="number" onchange="this.form.submit()" class="qnt" min="1">
                    <input type="hidden" name="prod_quantity" value="<?php  echo"$value[name]" ?>">
                    </form>
                    
                </td>
                <td><?php echo $total ;?></td>
            </tr>
            <?php
            }

            ?>
        </tbody>
    
        </table>

    </section>

    
    <?php


}
else{
    ?>
    <!-- <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
            <tr>
                <td>Remove</td>
                <td>Images</td>
                <td>Products</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>SubTotal</td>
            </tr>
            </thead>       
        </table>

</section> -->
<img src="/img/empt.jpg" id="img">

<?php

}
?>

<section id="cart-add" class="section-p1">
        <!-- <div id="coupan">
            <h3>Apply Coupan</h3>
            <div>
                <input type="text" placeholder="Enter Your Coupan">
                <button class="normal1">Apply</button>
            </div>
        </div> -->

        <div id="subtotal">
            <h3>Cart Total</h3>
            <table>
                <tr>
                    <td>Cart subtotal</td>
                    <td>$<?php echo $Gtotal ?></td>
                </tr>
                <tr>
                    <td>Shipping</td> 
                    <td>Free</td>
                </tr>
                <tr>
                    <td><Strong>Total</Strong></td>
                    <td><strong>$<?php echo $Gtotal ?></strong></td>
                </tr>
            </table>
            <form method="post" action="checkout_manage.php">
            <label>Payment Mod</label><br>
            <input type="radio" name="pay" value="cod" required>COD<br>
            <input type="radio" name="pay" value="upi" required>UPI<br>
            <button type="submit" name="purchase" class="normal">Order Place</button>
            </form>   
        </div>
    </section>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-12 mb-4 px-4">
                <div class="row mb-5 p-4" style="background: rgba(256, 256, 256, .05);">
                    <div class="col-md-4">
                        <div class="text-md-center">
                            <h5 class="text-primary text-uppercase mb-2" style="letter-spacing: 5px;">Our Office</h5>
                            <p class="mb-4 m-md-0">Location, City, Country</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-md-center">
                            <h5 class="text-primary text-uppercase mb-2" style="letter-spacing: 5px;">Email Us</h5>
                            <p class="mb-4 m-md-0">info@example.com</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-md-center">
                            <h5 class="text-primary text-uppercase mb-2" style="letter-spacing: 5px;">Call Us</h5>
                            <p class="m-0">+012 345 6789</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <p>Et et amet ut elitr ipsum sit dolor dolor dolore. Sit accusam elitr ut diam sit rebum. Eirmod duo kasd diam vero labore sea, est et et lorem ut at erat, gubergren ipsum et ipsum elitr et rebum rebum</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Our Products</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white btn-scroll mb-2" href="#service"><i class="fa fa-angle-right mr-2"></i>Solar System</a>
                            <a class="text-white btn-scroll mb-2" href="#service"><i class="fa fa-angle-right mr-2"></i>Wind Turbine</a>
                            <a class="text-white btn-scroll mb-2" href="#service"><i class="fa fa-angle-right mr-2"></i>Wind Generator</a>
                            <a class="text-white btn-scroll mb-2" href="#service"><i class="fa fa-angle-right mr-2"></i>Solar Energy</a>
                            <a class="text-white btn-scroll" href="#service"><i class="fa fa-angle-right mr-2"></i>Solar Panel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 mb-5">
                <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Newsletter</h5>
                <p>Rebum labore lorem dolores kasd est, et ipsum amet et at kasd, ipsum sea tempor magna tempor. Accu kasd sed ea duo ipsum. Dolor duo eirmod sea justo no lorem est diam</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white text-center border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .05) !important;">
        <p class="m-0 text-white">&copy; <a href="#">Domain Name</a>. All Rights Reserved. Designed by <a href="https://freewebsitecode.com">Free Website Code</a></p>
    </div>
    <!-- Footer End -->

            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/index.js"></script>

    


</body>
</html>