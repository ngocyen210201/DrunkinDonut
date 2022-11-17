<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drunkin Donut </title>

    <!-- font  cdn link  -->
    <link rel="stylesheet" href="./public/fonts/fontawesome/fontawesome-free-6.1.2-web/css/all.min.css">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossrigin="" anonymous></script>
    <link rel="stylesheet" href="./public/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include './include/header.php'; ?>
    <?php include './pages/carousel.php'; ?>
    <section class="about" id="about">
        <div class="container one">
            <div class="row">
                <div class=" image">
                    <img src="./public/images/Number 1 Donut Brand.png" class="intro_bg">
                </div>
                <div class="content">
                    <h1 class="title"> Number 1 Donut Brand In Vietnam </h1>
                    <p> We often more than 30 flavors with various type of donuts from Western
                        to Easten. Our donuts are made by skillful bakers with 100% love . They
                        are not only delicious but also beautiful. Gurantee will make you fall in love
                        from the first sight and the first bite!
                    </p>
                    <a href="about_us.php">
                        <div class="more">
                            <span class="text">Find out more</span>
                            <i class="fa-solid fa-right-long"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="container two">
            <div class="row">
                <div class="content">
                    <h1 class="title">Fresh & Clean Ingredients</h1>
                    <p> All of the ingredients are imported from foreign countries such as: France, US, Italy, Sweeden, etc. Fruits are delivered directly from the farm to our shop every day. All donuts are freshly made in day and is not overnight stored. Leftover donuts will be given to the one in needs.
                    </p>
                    <a href="">
                        <div class="more">
                            <span class="text">Order Now</span>
                            <i class="fa-solid fa-right-long"></i>
                        </div>
                    </a>
                </div>
                <div class=" image">
                    <img src="./public/images/Fresh _ Clean Ingredients.jpg" class="intro_bg">
                </div>
            </div>
        </div>

        <div class="container three">
            <div class="row">
                <div class=" image">
                    <img src="./public/images/IMG_0431.jpg" class="intro_bg">
                </div>
                <div class="content">
                    <h1 class="title"> Cattering Service </h1>
                    <p> Want to have a fun and impressive party? Leave it to us!
                        We offer cattering services from A to Z. From wedding to birthday party anything is possible! Just tell us what you want and we will make your wish come true.
                        Contact us now to experience the best service.
                    </p>
                    <a href="#contact">
                        <div class="more">
                            <span class="text">Contact Us</span>
                            <i class="fa-solid fa-right-long"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="container four">
            <div class="row">
                <div class="content">
                    <h1 class="title">Locations</h1>
                    <p>
                        <i class="fa-solid fa-location-dot"></i> No 389 Giai Phong, Phuong Liet, Thanh Xuan, Ha Noi<br>
                        <i class="fa-solid fa-location-dot"></i> 287 Ngoc Lam, Long Bien, Ha Noi <br>
                        <i class="fa-solid fa-location-dot"></i> 72A Ho Dac Di, Dong Da, Ha Noi <br>
                        <i class="fa-solid fa-location-dot"></i> 35 Dao Tan, Ba Dinh, Ha Noi <br>
                        <br><i>We are delighted to see you!</i>
                    </p>
                </div>
                <div class=" image">
                    <img src="./public/images/Offline store 02.jpg" class="intro_bg">
                </div>
            </div>
        </div>
    </section>
    <div><?php include './include/footer.php'; ?></div>
</body>

</html>