<?php
session_start();
include '../baglanti.php';

if (isset($_POST["girisform"])) {
  $mail = $_POST['mail'];
  $password = $_POST['password'];

  $query ="SELECT * FROM uyeler WHERE mail=:mail AND password=:password AND status = 1";
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>İlanTv | Yönetim</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index2.html"><b>İlanTv | </b>Yönetim</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Hoşgeldiniz! Giriş yapmak için lütfen bilgilerinizi giriniz.</p>

        <form action="" method="post">
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
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="mail" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Şifre">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Beni Hatırla
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="girisform" class="btn btn-primary btn-block">Giriş Yap</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">Şifremi Unuttum</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Kayıt Ol</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
