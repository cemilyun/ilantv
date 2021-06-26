<?php include 'topbar.php'; 
	  include 'baglanti.php';
	  $sorgu = $conn->query("SELECT adres,gsm,mail FROM iletisim");
	  $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['iletisim_post'])){
    $adi = $_POST['adi'];
    $mail = $_POST['mail'];
    $konu = $_POST['konu'];
    $mesaj = $_POST['mesaj'];

    $sorgu = $conn->prepare("INSERT INTO mesajlar (adi, mail, konu, mesaj) VALUES (?,?,?,?) ");
    $sorgu->bindParam(1,$adi,PDO::PARAM_STR);
    $sorgu->bindParam(2,$mail,PDO::PARAM_STR);
    $sorgu->bindParam(3,$konu,PDO::PARAM_STR);
    $sorgu->bindParam(4,$mesaj,PDO::PARAM_STR);
    $sorgu->execute();
    if($sorgu->rowCount() > 0){
        $alert = array
        (
            'type' => "success",
            'msg' => "Mesajınız başarıyla gönderildi.",
            'url' => "contact.php"
        );

    }else{
        $alert = array
        (
            'type' => "danger",
            'msg' => "Mesajınız gönderilemedi.",
            'url' => "contact.php"
        );
    }
}

?>

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Anasayfa</a></li>
                    <li class="breadcrumb-item active">İletişim</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Contact Start -->
        <div class="contact">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-info">
                            <h2>İletişim</h2>
                            <h3><i class="fa fa-map-marker"></i><?php echo $cikti["adres"] ?></h3>
                            <h3><i class="fa fa-envelope"></i><?php echo $cikti["mail"]?></h3>
                            <h3><i class="fa fa-phone"></i><?php echo $cikti["gsm"]?></h3>
                            <div class="social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <form action="" method="POST">
                                <?php
                            if (isset($alert)) { ?>
                                <div class="alert alert-<?php echo $alert['type'] ?>"><?php echo $alert['msg'] ?></div>                     
                            <?php } ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="adi" placeholder="Adınız" required />
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="mail" placeholder="Mailiniz" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="konu" placeholder="Konu" required />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="mesaj" placeholder="Mesaj" required></textarea>
                                </div>
                                <div><button class="btn" name="iletisim_post" type="submit">Mesaj Gönder</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12044.317358362743!2d28.817685741633777!3d41.00163661882163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa49ce63e58a1%3A0x4ded382d9d919b1e!2zw4dvYmFuw6dlxZ9tZSwgMzQxOTcgQmFow6dlbGlldmxlci_EsHN0YW5idWw!5e0!3m2!1str!2str!4v1619948853164!5m2!1str!2str" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        <?php include 'footer.php'; ?>