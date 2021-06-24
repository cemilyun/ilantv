<?php
include 'baglanti.php';

include 'topbar.php';


if (!isset($_SESSION['mail'])) {
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    exit;
}

if (!isset($_COOKIE['urun'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    exit;
}


if (isset($_POST['siparisver'])) {

    foreach ($_POST as $key => $value) {
     $$key = $value;
 }

 $ucret = "0";

 foreach ($_COOKIE['urun'] as $key => $value) {
     $xurunsor = $conn->prepare("SELECT * FROM urunler where id=:id");
     $xurunsor->execute(array('id' => $key));
     $xurun = $xurunsor->fetch(PDO::FETCH_ASSOC);
     $ucret = $ucret+$xurun['amount'];
 }

 $skey = time().rand(00,99);

 $insert = $conn->prepare("INSERT INTO siparisler SET 
    isim=:isim,
    soyisim=:soyisim,
    email=:email,
    telefon=:telefon,
    adres=:adres,
    ulke=:ulke,
    il=:il,
    ilce=:ilce,
    postakodu=:postakodu,
    ucret=:ucret,
    odeme=:odeme,
    sepet=:sepet,
    skey=:skey,
    user=:user
    ");

 $insert->execute(array(
    'isim' => $isim,
    'soyisim' => $soyisim,
    'email' => $email,
    'telefon' => $telefon,
    'adres' => $adres,
    'ulke' => $ulke,
    'il' => $il,
    'ilce' => $ilce,
    'postakodu' => $postakodu,
    'ucret' => $ucret,
    'odeme' => "Kapıda ödeme",
    'sepet' => json_encode($_COOKIE['urun']),
    'skey' => $skey,
    'user' => $_SESSION['mail']
));

 if ($insert) {
    echo "<meta http-equiv='refresh' content='0;url=finish.php?code=".$skey."'>";
    exit;
}



}


?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="cart">Sepet</a></li>
            <li class="breadcrumb-item active">Ödeme Ekranı</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->
<div class="checkout">
    <div class="container-fluid"> 
        <div class="row">

            <div class="col-lg-8">

                <form method="POST" action="">
                    <div class="checkout-inner">
                        <div class="billing-address">
                            <h2>Adres</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>İsim</label>
                                    <input class="form-control" type="text" required="" name="isim" placeholder="İsim">
                                </div>
                                <div class="col-md-6">
                                    <label>Soyisim</label>
                                    <input class="form-control" type="text"  required="" name="soyisim" placeholder="Soyisim">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text"  required="" name="email" placeholder="E-mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Telefon</label>
                                    <input class="form-control" type="text"  required="" name="telefon" placeholder="Telefon No">
                                </div>
                                <div class="col-md-12">
                                    <label>Adres</label>
                                    <input class="form-control" type="text"  required="" name="adres" placeholder="Adres">
                                </div>
                                <div class="col-md-6">
                                    <label>Ülke</label>
                                    <select class="custom-select" required="" name="ulke">
                                        <option selected>Türkiye</option>
                                        <option>Azerbaycan</option>
                                        <option>Yunanistan</option>
                                        <option>Gürcistan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>İl</label>
                                    <input class="form-control" type="text"  required="" name="il" placeholder="İl">
                                </div>
                                <div class="col-md-6">
                                    <label>İlçe</label>
                                    <input class="form-control" type="text"  required="" name="ilce" placeholder="İlçe">
                                </div>
                                <div class="col-md-6">
                                    <label>Posta Kodu</label>
                                    <input class="form-control" type="text"  required="" name="postakodu" placeholder="Posta Kodu">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-inner">
                        <div class="checkout-summary">
                            <?php

                            $fiyat = "0";

                            foreach ($_COOKIE['urun'] as $key => $value) {
                               $urunsor = $conn->prepare("SELECT * FROM urunler where id=:id");
                               $urunsor->execute(array('id' => $key));
                               $urun = $urunsor->fetch(PDO::FETCH_ASSOC);

                               $fiyat = $fiyat+$urun['amount'];

                           }

                           ?>
                           <h1>Sepet Toplam</h1>
                           <?php if (isset($_COOKIE['urun'])) { 
                            foreach ($_COOKIE['urun'] as $key => $value) {
                                $urunsor = $conn->prepare("SELECT * FROM urunler where id=:id");
                                $urunsor->execute(array('id' => $key));
                                $urun = $urunsor->fetch(PDO::FETCH_ASSOC);

                                ?>
                                <p><?php echo $urun['title'] ?><span><?php echo $urun['amount'] ?></span></p>
                            <?php } ?>
                        <?php } ?>
                        <h2>Genel Toplam<span><?php echo $fiyat ?> TL</span></h2>
                    </div>

                    <div class="checkout-payment">
                        <div class="payment-methods">
                            <h1>Ödeme Yöntemleri</h1>

                            <div class="payment-method">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="payment-3" required="" name="payment">
                                    <label class="custom-control-label" for="payment-3">Kapıda Ödeme</label>
                                </div>
                                <div class="payment-content" id="payment-3-show">
                                    <p>
                                        Şuanlık sadece kapıda ödeme seçeneğimiz bulunmaktadır. Çok yakında Online Ödeme sizlerle.
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="checkout-btn">
                            <button type="submit" name="siparisver">Siparişi Onayla</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
</div>
<!-- Checkout End -->

<?php 
include 'footer.php';
?>