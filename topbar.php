<?php
session_start();
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>İlanTv</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="ilan tv" name="keywords">
        <meta content="IlanTv ilan vermek çok basit." name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Top bar Start -->
        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-envelope"></i>
                        ggaripcem@gmail.com
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-phone-alt"></i>
                        +90-531-088-9707
                    </div>
                </div>
            </div>
        </div>
        <!-- Top bar End -->
        
        <!-- Nav Bar Start -->
        <div class="nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index" class="nav-item nav-link active">Anasayfa</a>
                            <a href="cart" class="nav-item nav-link">Sepet</a>
                            <a href="checkout" class="nav-item nav-link">Kontrol</a>
                            <a href="contact" class="nav-item nav-link">İletişim</a>
                        </div>

                        <?php
                        if (isset($_SESSION["mail"])) { ?>
                            
                            <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["mail"] ?></a>
                                <div class="dropdown-menu">
                                    <a href="my-account.php" class="dropdown-item">Hesabım</a>
                                    <a href="logout.php" class="dropdown-item">Çıkış Yap</a>
                                </div>
                            </div>
                        </div>
                         
                       <?php } else { ?>
                            <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Hesabım</a>
                                <div class="dropdown-menu">
                                    <a href="login.php" class="dropdown-item">Giriş Yap</a>
                                    <a href="register.php" class="dropdown-item">Kayıt Ol</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>


                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->      
        
        <!-- Bottom Bar Start -->
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="index.php">
                                <img src="img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search">
                            <input type="text" placeholder="Arama Yap">
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <a href="cart.php" class="btn cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span>(<?php
                                if (isset($_COOKIE['urun'])) {
                                    echo count($_COOKIE['urun']);
                                } else {
                                    echo "0";
                                }
                                ?>)</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->  