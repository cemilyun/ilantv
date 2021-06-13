<?php include 'baglanti.php';
$sorgu = $conn->query("SELECT * FROM kategoriler");
$cikti = $sorgu->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['urun'])) {
    $id = strip_tags(htmlspecialchars($_GET['urun']));
    $urunsor = $conn->prepare("SELECT * FROM urunler where id=:id");
    $urunsor->execute(array('id' => $id));

    $urundurum = $urunsor->rowCount();

    if ($urundurum == "0") {
        header('location:index');
        exit;
    } else {
        $urun = $urunsor->fetch(PDO::FETCH_ASSOC);
    }
} else {
     header('location:index');
        exit;
}

include 'topbar.php'; ?>

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="#">Ürünler</a></li>
            <li class="breadcrumb-item active">Ürün Detay</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Detail Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="<?php echo $urun['image'] ?>" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title"><h1><?php echo $urun['title'] ?></h1></div>
                                <div class="price">
                                    <h4>Fiyat:</h4>
                                    <p>₺<?php echo $urun['amount'] ?></p>
                                </div>
                                <div class="action">
                                    <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Sepete Ekle</a>
                                    <a class="btn" href="#"><i class="fa fa-shopping-bag"></i>Satın Al</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row product-detail-bottom">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#description">Açıklama</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#reviews">Yorumlar</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="description" class="container tab-pane active">
                                <h4>İlan Açıklama</h4>
                                <p>
                                    <?php echo $urun['descc'] ?>
                                </p>
                            </div>
                            <div id="reviews" class="container tab-pane fade">
                                <div class="reviews-submitted">
                                    <div class="reviewer">Phasellus Gravida - <span>01 Jan 2020</span></div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                                    </p>
                                </div>
                                <div class="reviews-submit">
                                    <h4>Give your Review:</h4>
                                    <div class="ratting">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <div class="row form">
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Name">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" placeholder="Email">
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea placeholder="Review"></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <button>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product">
                    <div class="section-header">
                        <h1>Benzer İlanlar</h1>
                    </div>

                    <div class="row align-items-center product-slider product-slider-3">

                        <?php 

                        $digersor = $conn->prepare("SELECT * FROM urunler where kategori=:kategori and id!=:id");
                        $digersor->execute(array(
                            'kategori' => $urun['kategori'],
                            'id' => $urun['id']
                        ));

                        while ($diger = $digersor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#"><?php echo $diger['title'] ?></a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img src="<?php echo $diger['image'] ?>" alt="Product Image" style="width: 100%; height: 200px;">
                                    </a>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>99</h3>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <!-- Side Bar Start -->
            <div class="col-lg-4 sidebar">
                <div class="sidebar-widget category">
                    <h2 class="title">Kategori</h2>
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            <ul class="navbar-nav">
                        <?php foreach ($cikti as $k) {
                            ?><li class="nav-item">
                                <a class="nav-link" href="product-list?kategori=<?php echo $k["id"] ?>"><i class="fas fa-angle-right"></i><?php echo $k["adi"] ?></a>
                                </li><?php
                            } ?>

                        </ul>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Side Bar End -->
        </div>
    </div>
</div>
<!-- Product Detail End -->

<!-- Brand Start -->
<div class="brand">
    <div class="container-fluid">
        <div class="brand-slider">
            <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
            <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
        </div>
    </div>
</div>
<!-- Brand End -->

<?php include 'footer.php'; ?>