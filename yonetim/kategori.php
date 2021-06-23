<?php include 'header.php';
include 'navbar.php'; 
include '../baglanti.php';

$kategori = $conn->query("SELECT * FROM kategoriler");
$cikti = $kategori->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['kaydet'])) {
  $title = $_POST['title'];
  $descc = $_POST['descc'];

  $sorgu = $conn->prepare("INSERT INTO kategoriler (adi, aciklama) VALUES (?,?)");
  $sorgu->bindParam(1,$title,PDO::PARAM_STR);
  $sorgu->bindParam(2,$descc,PDO::PARAM_STR);
  $sorgu->execute();
  if($sorgu->rowCount() > 0){
    $alert = array
    (
      'type' => "success",
      'msg' => "Kategori başarıyla eklendi.",
      'second' => "2",
      'url' => "kategori.php"
    );

  }else{
    $alert = array
    (
      'type' => "danger",
      'msg' => "Bir hata oluştu.",
      'second' => "2",
      'url' => "kategori.php"
    );
  }

}
if(isset($_POST['sil'])){
  $btn = $_POST['sil'];
  $sorgux = $conn->prepare("DELETE FROM kategoriler WHERE id = ?");
  $sorgux->bindParam(1,$btn,PDO::PARAM_INT);
  $sorgux->execute();
  if ($sorgux->rowCount()>0) {
    echo "<meta http-equiv='refresh' content='0;url=kategori.php?durum=success'>";
  }else{
    echo "<meta http-equiv='refresh' content='0;url=kategori.php?durum=warning'>";
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
          <h1>Kategoriler</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Kategoriler</li>
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
      <?php
      if (isset($_GET['durum'])=='success') { ?>
        <meta http-equiv="refresh" content="2;url=kategori.php" />
        <div class="alert alert-success ?>">Kategori başarıyla silindi.</div>                     
      <?php }else if (isset($_GET['durum'])=='warning'){ ?>
        <div class="alert alert-warning ?>">Kategori silinemedi.</div>
      <?php } ?>
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Kategori Ekle</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST" enctype="multipart/form-data" data-parsley-validate>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Başlık</label>
              <input type="text" class="form-control" name="title" placeholder="Kategori başlığı giriniz.">
            </div>
            <div class="form-group">
              <label>Açıklama</label>
              <textarea class="form-control" rows="3" name="descc" placeholder="Açıklama giriniz..."></textarea>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="kaydet">Kaydet</button>
          </div>
        </form>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Kategoriler</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Kategori</th>
                <th>Ürün sayısı</th>
                <th>Sil</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cikti as $k) { ?>
                <tr>
                  <td><?php echo $k['id']?></td>
                  <td><?php echo $k['adi']?></td>
                  <?php $urunsorgu = $conn->prepare("SELECT COUNT(*) FROM urunler WHERE kategori = ?");
                  $urunsorgu->bindParam(1,$k['id'],PDO::PARAM_INT);
                  $urunsorgu->execute();
                  $say = $urunsorgu->fetchColumn();
                  ?>
                  <td><span class="badge bg-primary"><?php echo $say ?></span></td>
                  <form action="" method="POST"><td><button type="submit" class="btn btn-block btn-danger" name="sil" value="<?php echo $k['id']?>">Sil</button></td></form>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
