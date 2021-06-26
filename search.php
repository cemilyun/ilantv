<?php include 'topbar.php'; 
include 'baglanti.php';

?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item">Ürün Arama</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    
                    <?php

                    $sayfada = 9;
                    $miktarsor = $conn->prepare("SELECT * FROM urunler where title LIKE ?");
                    $miktarsor->execute(array("%".$_GET['q']."%"));
                    $toplam_icerik = $miktarsor->rowCount();
                    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                    if($sayfa < 1) $sayfa = 1;
                    if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;

                    $limit = ($sayfa - 1) * $sayfada;



                    if ($toplam_icerik > 0) {
                        $urunler = $conn->prepare('SELECT * FROM urunler where title LIKE ? LIMIT ' . $limit . ', ' . $sayfada);
                        $urunler->execute(array("%".$_GET['q']."%")); 
                    } else {
                        $urunler = $conn->prepare('SELECT * FROM urunler where title LIKE ? ');
                        $urunler->execute(array("%".$_GET['q']."%")); 
                    }


                    while ($urun = $urunler->fetch(PDO::FETCH_ASSOC)) { ?>
                       <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-title">

                                <a href="#"><?php echo $urun['title'] ?></a>
                            </div>
                            <div class="product-image">
                                <a href="product-detail?urun=<?php echo $urun['id'] ?>">
                                    <img src="<?php echo $urun['image'] ?>" alt="Product Image" style="width: 400px; height: 230px;">
                                </a>
                            </div>
                            <div class="product-price">
                                <h3><span>₺</span><?php echo $urun['amount'] ?></h3>
                                <a class="btn" href="product-detail?urun=<?php echo $urun['id'] ?>&sepetekle=1"><i class="fa fa-shopping-cart"></i>Sepete Ekle</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>



            </div>

            <!-- Pagination Start -->
            <div class="col-md-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">

                        <?php

                        for($s = 1; $s <= $toplam_sayfa; $s++) {
                            if($sayfa == $s) {
                                echo '<li class="page-item active"><a class="page-link" href="javascript:void(0);">'.$s.'</a></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="search?q='.$_GET['q']."&sayfa=". $s . '">'.$s.'</a></li>';
                            }
                        }

                        ?>
                    </ul>
                </nav>
            </div>
            <!-- Pagination Start -->
        </div>           

        <!-- Side Bar Start -->
        <div class="col-lg-4 sidebar">
            <div class="sidebar-widget category">
                <h2 class="title">Kategoriler</h2>
                <nav class="navbar bg-light">
                    <ul class="navbar-nav">
                        <?php 
                        $sorgu = $conn->query("SELECT * FROM kategoriler");
                        $cikti = $sorgu->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($cikti as $k) {
                            ?><li class="nav-item">
                                <a class="nav-link" href="product-list?kategori=<?php echo $k["id"] ?>"><i class="fas fa-angle-right"></i><?php echo $k["adi"] ?></a>
                                </li><?php
                            } ?>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- Side Bar End -->
        </div>
    </div>
</div>
<!-- Product List End -->  

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