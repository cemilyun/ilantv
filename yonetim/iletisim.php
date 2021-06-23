<?php include 'header.php';
include 'navbar.php'; 
include '../baglanti.php';

$sorgu = $conn->query("SELECT * FROM iletisim");
$cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['kaydet'])) {
  $adres = $_POST['adres'];
  $gsm = $_POST['gsm'];
  $mail = $_POST['mail'];

  $sorgu = $conn->prepare("UPDATE iletisim SET adres = ?, gsm = ?, mail = ? ");
  $sorgu->bindParam(1,$adres,PDO::PARAM_STR);
  $sorgu->bindParam(2,$gsm,PDO::PARAM_INT);
  $sorgu->bindParam(3,$mail,PDO::PARAM_STR);
  $sorgu->execute();
  if($sorgu->rowCount() > 0){
    $alert = array
    (
      'type' => "success",
      'msg' => "İletişim başarıyla güncellendi.",
      'second' => "2",
      'url' => "iletisim.php"
    );

  }else{
    $alert = array
    (
      'type' => "danger",
      'msg' => "Bir hata oluştu.",
      'second' => "2",
      'url' => "iletisim.php"
    );
  }

}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>İletişim</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">İletişim</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-12">
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
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">İletişim bilgileri düzenle</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Adres</label>
              <input type="text" class="form-control" name="adres" value="<?php echo $cikti['adres'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Gsm</label>
              <input type="text" class="form-control" name="gsm" value="<?php echo $cikti['gsm'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Mail</label>
              <input type="mail" class="form-control" name="mail" value="<?php echo $cikti['mail'] ?>">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="kaydet">Kaydet</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
