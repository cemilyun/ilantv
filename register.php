<?php include 'topbar.php'; ?>

<?php
include 'baglanti.php';

foreach ($_POST as $key => $value) {
    $$key = strip_tags(htmlspecialchars($value));
}

if (isset($_POST['register'])) {

if (strlen($ad) > 2) { //// dört deger
    if (strlen($soyad) > 2) { //// dört deger
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strlen($telefon) > 9) {
                if (strlen($pass) > 5) {
                    if ($pass == $repass) {
                        ///

                        $insert = $conn->prepare("INSERT INTO uyeler SET 
                            adi=:adi,
                            soyadi=:soyadi,
                            mail=:mail,
                            telefon=:telefon,
                            password=:password
                            ");

                        $insert->execute(array(
                            'adi' => $ad,
                            'soyadi' => $soyad,
                            'mail' => $email,
                            'telefon' => $telefon,
                            'password' => sha1(md5($pass))
                        ));

                        if ($insert) {

                            $alert = array
                            (
                                'type' => "success",
                                'msg' => "Başarıyla kayıt oldunuz.",
                                'second' => "3",
                                'url' => "login.php"
                            );

                        } else {
                            $alert = array
                            (
                                'type' => "danger",
                                'msg' => "İşlem sırasında hata ile karşılaşıldı.",
                                'second' => "3",
                                'url' => "0"
                            );
                        }

                        ///
                    } else {
                        $alert = array
                        (
                            'type' => "danger",
                            'msg' => "Şifreler eşleşmiyor.",
                            'second' => "3",
                            'url' => "0"
                        );
                    }
                } else {
                    $alert = array
                    (
                        'type' => "danger",
                        'msg' => "Şifre 5 karakterden yüksek olmalıdır.",
                        'second' => "3",
                        'url' => "0"
                    );
                }
            } else {
             $alert = array
             (
                'type' => "danger",
                'msg' => "Telefon 9 karakterden yüksek olmalıdır.",
                'second' => "3",
                'url' => "0"
            );
         }
     } else {
        $alert = array
        (
            'type' => "danger",
            'msg' => "Lütfen geçerli email adresi giriniz.",
            'second' => "3",
            'url' => "0"
        );
    }
} else {
    $alert = array
    (
        'type' => "danger",
        'msg' => "Soyad 2 karakterden yüksek olmalıdır.",
        'second' => "3",
        'url' => "0"
    );
}
} else {
    $alert = array
    (
        'type' => "danger",
        'msg' => "Ad 2 karakterden yüksek olmalıdır.",
        'second' => "3",
        'url' => "0"
    );
}
}
?>

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Kayıt Ol</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12"> 
                <form action="" method="post">   
                    <div class="register-form">
                        <?php

                        if (isset($alert)) { ?>
                            <div class="alert alert-<?php echo $alert['type'] ?>"><?php echo $alert['msg'] ?></div>
                            <?php

                            if ($alert['url'] != "0") { ?>
                                <meta http-equiv="refresh" content="<?php echo $alert['second'] ?>;URL=<?php echo $alert['url'] ?>">
                            <?php } else { ?>
                                <meta http-equiv="refresh" content="<?php echo $alert['second'] ?>;">
                            <?php } ?>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Adınız</label>
                                <input class="form-control" name="ad" type="text" placeholder="Adınız">
                            </div>
                            <div class="col-md-6">
                                <label>Soyadınız</label>
                                <input class="form-control" name="soyad" type="text" placeholder="Soyadınız">
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control" name="email"type="email" placeholder="E-mail">
                            </div>
                            <div class="col-md-6">
                                <label>Telefon</label>
                                <input class="form-control" name="telefon" type="text" placeholder="Telefon">
                            </div>
                            <div class="col-md-6">
                                <label>Şifre</label>
                                <input class="form-control" name="pass" type="password" placeholder="Şifre">
                            </div>
                            <div class="col-md-6">
                                <label>Şifreyi yeniden giriniz</label>
                                <input class="form-control" name="repass" type="password" placeholder="Şifreyi yeniden giriniz">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="register" class="btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Login End -->
<?php include 'footer.php'; ?>