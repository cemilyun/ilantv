<?php include 'topbar.php'; 
include 'baglanti.php';
$sorgu = $conn->query("SELECT * FROM kategoriler");
$cikti = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Product List</li>
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
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="product-search">
                                        <input type="email" value="Search">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product short by</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Newest</a>
                                                <a href="#" class="dropdown-item">Popular</a>
                                                <a href="#" class="dropdown-item">Most sale</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-price-range">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">$0 to $50</a>
                                                <a href="#" class="dropdown-item">$51 to $100</a>
                                                <a href="#" class="dropdown-item">$101 to $150</a>
                                                <a href="#" class="dropdown-item">$151 to $200</a>
                                                <a href="#" class="dropdown-item">$201 to $250</a>
                                                <a href="#" class="dropdown-item">$251 to $300</a>
                                                <a href="#" class="dropdown-item">$301 to $350</a>
                                                <a href="#" class="dropdown-item">$351 to $400</a>
                                                <a href="#" class="dropdown-item">$401 to $450</a>
                                                <a href="#" class="dropdown-item">$451 to $500</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $urunler = $conn->prepare("SELECT * FROM urunler where kategori=:kategori");
                    $urunler->execute(array('kategori' => strip_tags(htmlspecialchars($_GET['kategori'])))); 
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
                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Satın Al</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>



            </div>

            <!-- Pagination Start -->
            <div class="col-md-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
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
                        <?php foreach ($cikti as $k) {
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