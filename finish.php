<?php include 'topbar.php';
include 'baglanti.php';

if (isset($_GET['code'])) {
    $siparis = $_GET['code'];

    $sor = $conn->prepare("SELECT * FROM siparisler where skey=:skey");
    $sor->execute(array('skey' => $siparis));
    $durum = $sor->rowCount();
    if ($durum == "0") {
        echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        exit;
    }

    $cek = $sor->fetch(PDO::FETCH_ASSOC);
    
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

                               <?php

                               $js = json_decode($cek['sepet'],true);
                               $aa = "0";
                               foreach ($js as $key => $value) {
                                   $urunsor = $conn->prepare("SELECT * FROM urunler where id=:id");
                                   $urunsor->execute(array('id' => $key));
                                   $urun = $urunsor->fetch(PDO::FETCH_ASSOC);
                                   $aa = $aa+$urun['amount'];
                                   ?>

                                   <tr>
                                    <td>
                                        <div class="img">
                                            <a href="product-detail.php?urun=<?php echo $urun['id'] ?>"><img src="<?php echo $urun['image'] ?>" alt="Image"></a>
                                            <p><?php echo $urun['title'] ?></p>
                                        </div>
                                    </td>

                                    <td><?php echo $urun['amount'] ?> TL</td>
                                </tr>

                                <?php

                            }

                            ?>
                            
                            <br>
                            <tr>
                                <td>Toplam Ücret:</td>
                                <td><?php echo $aa; ?> TL</td>
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