<?php 
include 'topbar.php'; 
include 'baglanti.php';
$mail = $_SESSION['mail'];
$sorgu = $conn->query("SELECT * FROM uyeler WHERE mail = '$mail'");
$cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
extract($cikti);
$idsorgu = $conn->query("SELECT id FROM uyeler WHERE mail = '$mail'");
$idcikti = $idsorgu->fetch(PDO::FETCH_ASSOC);
extract($idcikti);
$id = $idcikti['id'];
$kartsorgu = $conn->query("SELECT * FROM kart_bilgileri WHERE musteri_id = '$id'");
$kartcikti = $kartsorgu->fetch(PDO::FETCH_ASSOC);
extract($kartcikti);
if(isset($_POST['bilgi_guncelle'])){
    $adi = $_POST['adi'];
    $soyadi = $_POST['soyadi'];
    $mail = $_POST['mail'];
    $telefon = $_POST['telefon'];

    $sorgu = $conn->prepare("UPDATE uyeler SET adi = ?, soyadi = ?, mail = ?, telefon = ? WHERE mail = '$mail'");
    $sorgu->bindParam(1,$adi,PDO::PARAM_STR);
    $sorgu->bindParam(2,$soyadi,PDO::PARAM_STR);
    $sorgu->bindParam(3,$mail,PDO::PARAM_STR);
    $sorgu->bindParam(4,$telefon,PDO::PARAM_INT);
    $sorgu->execute();

    if($sorgu->rowCount() > 0){
        $alert = array
        (
            'type' => "success",
            'msg' => "Bilgiler başarıyla güncellendi.",
            'url' => "my-account.php"
        );
    }else{
        echo "HATA";
    }
}
if(isset($_POST['adres_guncelle'])){
    $baslik = $_POST['baslik'];
    $adres = $_POST['adres'];
    $telefon = $_POST['telefon'];

    $sorgu = $conn->prepare("UPDATE uyeler SET adres_baslik = ?, adres = ?, telefon = ? WHERE mail = '$mail'");
    $sorgu->bindParam(1,$baslik,PDO::PARAM_STR);
    $sorgu->bindParam(2,$adres,PDO::PARAM_STR);
    $sorgu->bindParam(3,$telefon,PDO::PARAM_INT);
    $sorgu->execute();

    if($sorgu->rowCount() > 0){
        $alertadres = array
        (
            'type' => "success",
            'msg' => "Adres Bilgisi başarıyla güncellendi.",
            'url' => "my-account.php"
        );
    }else{
        echo "HATA";
    }
}
if(isset($_POST['kart_kaydet'])){
    $kart_sahibi = $_POST['kart_sahibi'];
    $kart_no = $_POST['kart_no'];
    $kart_skt_ay = $_POST['kart_skt_ay'];
    $kart_skt_yil = $_POST['kart_skt_yil'];
    $kart_cvv = $_POST['kart_cvv'];
    $id = $idcikti['id'];

    $sorgu = $conn->prepare("INSERT INTO kart_bilgileri (kart_sahibi, kart_no, kart_skt_ay, kart_skt_yil, kart_cvv, musteri_id) VALUES (?,?,?,?,?,?) ");
    $sorgu->bindParam(1,$kart_sahibi,PDO::PARAM_STR);
    $sorgu->bindParam(2,$kart_no,PDO::PARAM_STR);
    $sorgu->bindParam(3,$kart_skt_ay,PDO::PARAM_STR);
    $sorgu->bindParam(4,$kart_skt_yil,PDO::PARAM_STR);
    $sorgu->bindParam(5,$kart_cvv,PDO::PARAM_INT);
    $sorgu->bindParam(6,$id,PDO::PARAM_INT);
    $sorgu->execute();
    if($sorgu->rowCount() > 0){
        $alertkart = array
        (
            'type' => "success",
            'msg' => "Kart Bilgisi başarıyla güncellendi.",
            'url' => "my-account.php"
        );

    }else{
        echo "HATA";
    }
}
if(isset($_POST['sifre_guncelle'])){
    $eskipass = $_POST['eskipass'];
    $yenipass = $_POST['yenipass'];
    $repass = $_POST['repass'];
    if(strlen($yenipass) > 5){
    $eskipass = sha1(md5($_POST['eskipass']));
    $yenipass = sha1(md5($_POST['yenipass']));
    $repass = sha1(md5($_POST['repass']));
        if($yenipass == $repass){
           $kontrol = $conn->prepare("SELECT * FROM uyeler WHERE password =? AND mail ='$mail'");
           $kontrol->bindParam(1,$eskipass,PDO::PARAM_STR);
           $kontrol->execute();

           if($kontrol->rowCount() > 0){
              $guncelle = $conn->prepare("UPDATE uyeler SET password = ? WHERE mail = '$mail'");
              $guncelle->bindParam(1,$yenipass,PDO::PARAM_STR);
              $guncelle->execute();
              if($guncelle->rowCount() > 0){
                $alertpass = array
                (
                    'type' => "success",
                    'msg' => "Şifre başarıyla güncellendi.",
                    'url' => "my-account.php"
                );
            }
        }else{
            $alertpass = array
            (
                'type' => "danger",
                'msg' => "Eski şifreyi yanlış girdiniz.",
                'url' => "my-account.php"
            );
        }
    }else{
        $alertpass = array
        (
            'type' => "danger",
            'msg' => "Yeni şifre ve tekrarı birbirine uymuyor.",
            'url' => "my-account.php"
        );
    }
}else{
    $alertpass = array
    (
        'type' => "danger",
        'msg' => "Yeni şifre 5 karakterden büyük olmalıdır.",
        'url' => "my-account.php"
    );
}
}
?>

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Hesabım</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- My Account Start -->
<div class="my-account">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i class="fa fa-tachometer-alt"></i>Hesabım</a>
                    <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Siparişler</a>
                    <a class="nav-link" id="payment-nav" data-toggle="pill" href="#payment-tab" role="tab"><i class="fa fa-credit-card"></i>Ödeme Yöntemleri</a>
                    <a class="nav-link" id="address-nav" data-toggle="pill" href="#address-tab" role="tab"><i class="fa fa-map-marker-alt"></i>Adres Bilgileri</a>
                    <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Hesap Detayları</a>
                    <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt"></i>Çıkış Yap</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
                        <h4>Merhaba! <?php echo $adi ?></h4>
                        <p>
                            "Hesabım" sayfasından siparişlerinizi ve arıza/iade/değişim işlemlerinizi takip edebilir; kazandığınız hediye çeki ve puanları görüntüleyebilir; üyelik bilgisi güncelleme, şifre ve adres değişikliği gibi hesap ayarlarınızı kolayca yapabilirsiniz.
                            Size özel fırsatlar ve dönemsel kampanyalar da bu sayfada duyurulur.
                        </p> 
                    </div>
                    <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Date</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Product Name</td>
                                        <td>01 Jan 2020</td>
                                        <td>$99</td>
                                        <td>Approved</td>
                                        <td><button class="btn">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Product Name</td>
                                        <td>01 Jan 2020</td>
                                        <td>$99</td>
                                        <td>Approved</td>
                                        <td><button class="btn">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Product Name</td>
                                        <td>01 Jan 2020</td>
                                        <td>$99</td>
                                        <td>Approved</td>
                                        <td><button class="btn">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="payment-nav">
                        <h4>Kart Bilgileri</h4>
                        <form action="" method="POST">
                            <?php
                            if (isset($alertkart)) { ?>
                                <div class="alert alert-<?php echo $alertkart['type'] ?>"><?php echo $alertkart['msg'] ?></div>                     
                            <?php } ?>
                            <div class="row">
                                <div>
                                    <label>Kart Sahibi:</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="kart_sahibi" value="<?php echo $kart_sahibi ?>" placeholder="Kart Sahibi">
                                </div>
                            </div>
                            <div class="row">
                                <div>
                                    <label>Kart Numarası:</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="kart_no" value="<?php echo $kart_no ?>" placeholder="Kart No">
                                </div>
                            </div>
                            <div class="row">
                                <div>
                                    <label>Son Kullanma Tarihi:</label>
                                </div>
                                <div class="col-md-1">
                                    <input class="form-control" type="text" name="kart_skt_ay" value="<?php echo $kart_skt_ay ?>" placeholder="Ay">
                                </div>
                                <label style="font-size:25px"> / </label>
                                <div class="col-md-1">
                                    <input class="form-control" type="text" name="kart_skt_yil" value="<?php echo $kart_skt_yil ?>" placeholder="Yıl">
                                </div>
                            </div>
                            <div class="row">
                                <div>
                                    <label>CVV:</label>
                                </div>
                                <div class="col-md-1">
                                    <input class="form-control" type="text" name="kart_cvv" value="<?php echo $kart_cvv ?>" placeholder="CVV">
                                </div>
                            </div>
                            <button type="submit" name="kart_kaydet" class="btn">Kaydet</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="address-tab" role="tabpanel" aria-labelledby="address-nav">
                        <h4>Adres</h4>
                        <form action="" method="POST">
                            <?php
                            if (isset($alertadres)) { ?>
                                <div class="alert alert-<?php echo $alertadres['type'] ?>"><?php echo $alertadres['msg'] ?></div>                     
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        Adres Başlığı:<input class="form-control" type="text" name="baslik" value="<?php echo $adres_baslik ?>" placeholder="Adres Başlığı">
                                    </div>
                                    <div class="col-md-6">
                                        Adres:<textarea class="form-control" type="text" name="adres" placeholder="Adres"><?php echo $adres ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        Telefon:<input class="form-control" type="text" name="telefon" value="<?php echo $telefon ?>" placeholder="Telefon">
                                    </div>
                                    <button type="submit" name="adres_guncelle" class="btn">Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                        <h4>Hesap Detayları</h4>
                        <form action="" method="POST">
                            <?php
                            if (isset($alert)) { ?>
                                <div class="alert alert-<?php echo $alert['type'] ?>"><?php echo $alert['msg'] ?></div>                     
                            <?php } ?>
                            <div class="row">

                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="adi" value="<?php echo $adi ?>" placeholder="Adınız">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="soyadi" value="<?php echo $soyadi ?>" placeholder="Soyadınız">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="telefon" value="<?php echo $telefon ?>" placeholder="Telefon Numaranız">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="mail" value="<?php echo $mail ?>" placeholder="Email" disabled>
                                </div>
                                <div class="col-md-12">
                                    <input class="form-control" type="text" value="Üyelik Tarihi: <?php echo $date ?>" placeholder="Üyelik Tarihi" disabled>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="bilgi_guncelle" class="btn">Bilgileri Güncelle</button>
                                    <br><br>
                                </div>
                            </div>
                        </form>
                        <h4>Şifre Değiştirme</h4>
                        <form action="" method="POST">
                            <?php
                            if (isset($alertpass)) { ?>
                                <div class="alert alert-<?php echo $alertpass['type'] ?>"><?php echo $alertpass['msg'] ?></div>                     
                            <?php } ?>
                            <div class="row"> 
                                <div class="col-md-12">
                                    <input class="form-control" type="password" name="eskipass" placeholder="Eski Şifreniz" required="">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="yenipass" placeholder="Yeni Şifreniz" required="">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" name="repass" placeholder="Şifrenizi Onaylayın" required="">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="sifre_guncelle" class="btn">Şifreyi Değiştir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Account End -->

<?php include 'footer.php'; ?>