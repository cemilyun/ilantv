<?php include 'topbar.php';
include 'baglanti.php';

foreach ($_COOKIE['urun'] as $key => $value) {
    $sorgu = $conn->prepare("SELECT * FROM siparisler where id=:id");
    $sorgu->execute(array('id' => $key));
    $urun = $sorgu->fetch(PDO::FETCH_ASSOC);
}
    ?>
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                <li class="breadcrumb-item active">Ödeme Başarı ile tamamlandı.</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Wishlist Start -->
    <div class="wishlist-page">
        <div class="container-fluid">
            <div class="wishlist-page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Ürün</th>
                                        <th>Fiyat</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">

                                    <tr>
                                        <td>
                                            <div class="img">
                                                <a href="#"><img src="img/product-6.jpg" alt="Image"></a>
                                                <p>Ürün Adı</p>
                                            </div>
                                        </td>
                                        <td>$99</td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td>Toplam Ücret:</td>
                                        <td>0 TL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist End -->

    <?php include 'footer.php'; ?>