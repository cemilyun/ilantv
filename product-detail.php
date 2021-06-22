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
if (isset($_POST['yorumgonder'])) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $stars=$_POST['stars'];
    $comment=$_POST['comment'];
    $urunid=$_POST['urunid'];

    $sorgu = $conn->prepare("INSERT INTO yorumlar (name, email, stars, comment, urunid) VALUES (?,?,?,?,?) ");
    $sorgu->bindParam(1,$name,PDO::PARAM_STR);
    $sorgu->bindParam(2,$email,PDO::PARAM_STR);
    $sorgu->bindParam(3,$stars,PDO::PARAM_INT);
    $sorgu->bindParam(4,$comment,PDO::PARAM_STR);
    $sorgu->bindParam(5,$urunid,PDO::PARAM_INT);
    $sorgu->execute();
    if($sorgu->rowCount() > 0){
        echo '<script>alert("Yorum başarıyla gönderildi.")</script>';
        header("Refresh: 0;");

    }else{
        echo '<script>alert("Yorum gönderilirken bir hata ile karşılaşıldı.")</script>';
        header("Refresh: 0;");
    }
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
                                <?php $yorumlars = $conn->prepare("SELECT * FROM yorumlar where urunid=:id");
                                $yorumlars->execute(array('id' => strip_tags(htmlspecialchars($_GET['urun'])))); 
                                while ($comment = $yorumlars->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="reviews-submitted">
                                        <div class="reviewer"><?php echo $comment['name'] ?> <span><?php echo $comment['time'] ?></span></div>
                                        <div class="ratting">
                                            <?php for ($i=0; $i <$comment['stars'] ; $i++) { ?>
                                             <i class="fa fa-star"></i>
                                         <?php } ?>


                                     </div>
                                     <p>
                                        <?php echo $comment['comment']; ?>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php 

                            if (isset($_SESSION['mail'])) { ?>
                                <div class="reviews-submit">

                                    <h4>Yorum Yapın!</h4>
                                    <form action="" method="POST">
                                        <div class="row form">
                                            <div class="col-sm-4">
                                                <input type="text" name="name" placeholder="İsim" required="">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" name="email" placeholder="Email" required="">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" name="stars" placeholder="Puan(1-5)" min="1" max="5" required="">
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea name="comment" placeholder="Yorum" required=""></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="hidden" name="urunid" value="<?php echo $urun['id'] ?>">
                                                <button type="submit" name="yorumgonder">Gönder</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php }else{ ?>
                                <div id="description" class="container tab-pane active">
                                <h4>Giriş Yapın !</h4>
                                <p>
                                    Yorum yapmak için lütfen giriş yapın.
                                </p>
                            </div>
                            <?php } ?>
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
                                </div>
                                <div class="product-image">
                                    <a href="product-detail?urun=<?php echo $diger['id'] ?>">
                                        <img src="<?php echo $diger['image'] ?>" alt="Product Image" style="width: 100%; height: 200px;">
                                    </a>
                                </div>
                                <div class="product-price">
                                    <h3><span>₺</span><?php echo $diger['amount'] ?></h3>
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