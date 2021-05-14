<?php 
include 'topbar.php'; 
include 'baglanti.php'; 
if (isset($_POST['login'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $query ="SELECT * FROM uyeler WHERE mail=:mail AND password=:password";
    $statement = $conn->prepare($query);  
    $statement->execute(  
       array(  
          'mail' => $_POST["mail"],  
          'password' => sha1(md5($_POST["password"]))  
      )  
   );  
    $count = $statement->rowCount();  
    if($count > 0)  
    {  
       $_SESSION["mail"] = $_POST["mail"];  
       $alert = array
       (
        'type' => "success",
        'msg' => "Başarıyla giriş yaptınız. Anasayfaya yönlendiriliyorsunuz.",
        'second' => "2",
        'url' => "index.php"
    );
   }else  
   {  
    $alert = array
       (
        'type' => "danger",
        'msg' => "Hatalı şifre veya kullanıcı adı !",
        'second' => "2",
        'url' => "login.php"
    ); 
}  

}
?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Giriş Yap</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <form action="" method="POST">
                    <div class="login-form">
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
                                <label>E-mail</label>
                                <input class="form-control" type="email" name="mail" placeholder="E-mail">
                            </div>
                            <div class="col-md-6">
                                <label>Şifre</label>
                                <input class="form-control" type="password" name="password" placeholder="Şifre">
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Beni Hatırla</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="login" class="btn">Giriş Yap</button>
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