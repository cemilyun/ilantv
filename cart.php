<?php

if (isset($_GET['sil'])) {
    $id = $_GET['sil'];


    setcookie('urun['.$id.']',true,time() - 86400 );

    header('location:cart.php');
    exit;

}

include 'topbar.php';
include 'baglanti.php';



?>

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
            <li class="breadcrumb-item active">Sepet</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Ürün</th>
                                    <th>Fiyat</th>
                                    <th>Kaldır</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">

                                <?php

                                if (isset($_COOKIE['urun'])) {

                                    foreach ($_COOKIE['urun'] as $key => $value) {
                                        $urunsor = $conn->prepare("SELECT * FROM urunler where id=:id");
                                        $urunsor->execute(array('id' => $key));
                                        $urun = $urunsor->fetch(PDO::FETCH_ASSOC);

                                        ?>

                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="<?php echo $urun['image'] ?>" alt="Image" style="width: 90px;"></a>
                                                    <p><?php echo $urun['title'] ?></p>
                                                </div>
                                            </td>
                                            <td><?php echo $urun['amount'] ?> TL</td>
                                            <td><a href="cart.php?sil=<?php echo $key; ?>"><button><i class="fa fa-trash"></i></button></a></td>
                                        </tr>

                                        <?php
                                    }

                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon">
                                <input type="text" placeholder="Kupon Kodu">
                                <button>Kodu Onayla</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Sepet Özeti</h1>
                                    <h2>Toplam Ücret<span><?php

                                    $fiyat = "0";

                                    if (isset($_COOKIE['urun'])) {
                                        foreach ($_COOKIE['urun'] as $key => $value) {
                                           $urunsor = $conn->prepare("SELECT * FROM urunler where id=:id");
                                           $urunsor->execute(array('id' => $key));
                                           $urun = $urunsor->fetch(PDO::FETCH_ASSOC);

                                           $fiyat = $fiyat+$urun['amount'];

                                       }
                                   }
                                   echo $fiyat;
                                   ?> TL</span></h2>
                               </div>
                               <div class="cart-btn">
                                 <a href="checkout"><button>Ödeme Yap</button></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
<!-- Cart End -->
<?php
include 'footer.php';
?>