<?php include 'header.php';
include 'navbar.php'; 
include '../baglanti.php';

if (isset($_POST['kaydet'])) {
  $kategori = $_POST['kategori'];
  $title = $_POST['title'];
  $amount = $_POST['amount'];
  $descc = $_POST['descc'];

  $izinli_uzantilar=array('jpg','png','jpeg');

  $ae = explode(".",$_FILES['image']['name']);
  $aw = count($ae);
  $ext = $ae[$aw-1];


  if (in_array($ext, $izinli_uzantilar)===false) {
    echo '<script>alert("Sadece .jpg , .png , .jpeg uzantılı dosyalar yüklenebilir!")</script>';
  } else {

    $uploads_dir = '../upload';

    @$tmp_name = $_FILES['image']["tmp_name"];
    @$name = $_FILES['image']["name"];

    $benzersizsayi4=rand(100000,9999999);
    $refimgyol=$uploads_dir."/".$benzersizsayi4.$name;
    $refimgyolmain="upload/".trim($benzersizsayi4.$name);

    @move_uploaded_file($tmp_name, trim("$uploads_dir/$benzersizsayi4$name"));


    $sorgu = $conn->prepare("INSERT INTO urunler (kategori, title, amount, descc, image) VALUES (?,?,?,?,?)");
    $sorgu->bindParam(1,$kategori,PDO::PARAM_INT);
    $sorgu->bindParam(2,$title,PDO::PARAM_STR);
    $sorgu->bindParam(3,$amount,PDO::PARAM_INT);
    $sorgu->bindParam(4,$descc,PDO::PARAM_STR);
    $sorgu->bindParam(5,$refimgyolmain,PDO::PARAM_STR);
    $sorgu->execute();
    if($sorgu->rowCount() > 0){
      $alert = array
      (
        'type' => "success",
        'msg' => "Ürün başarıyla eklendi.",
        'second' => "2",
        'url' => "blank.php"
      );

    }else{
      $alert = array
      (
        'type' => "danger",
        'msg' => "Bir hata oluştu.",
        'second' => "2",
        'url' => "blank.php"
      );
    }

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
          <h1>Ürünler</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Ürünler</li>
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
          <h3 class="card-title">Ürün Ekle</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST" enctype="multipart/form-data" data-parsley-validate>
          <div class="card-body">
            <div class="form-group">
              <label>Kategori</label>
              <select class="form-control" name="kategori">
                <?php 
                $catsor = $conn->prepare("SELECT * FROM kategoriler");
                $catsor->execute();
                while ($cat = $catsor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $cat['id'] ?>"><?php echo $cat['adi'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Başlık</label>
              <input type="text" class="form-control" name="title" placeholder="Ürün başlığı giriniz.">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Fiyat</label>
              <input type="text" class="form-control" name="amount" placeholder="Fiyat giriniz.">
            </div>
            <div class="form-group">
              <label>Açıklama</label>
              <textarea class="form-control" rows="3" name="descc" placeholder="Açıklama giriniz..."></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Resim</label>
              <input type="file" class="form-control" name="image">
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
