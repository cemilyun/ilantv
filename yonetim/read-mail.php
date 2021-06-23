<?php include 'header.php';
include 'navbar.php'; 
if (isset($_GET['message'])) {
  $id = strip_tags(htmlspecialchars($_GET['message']));
  $mesajsor = $conn->prepare("SELECT * FROM mesajlar where id=:id");
  $mesajsor->execute(array('id' => $id));

  $mesajdurum = $mesajsor->rowCount();

  if ($mesajdurum == "0") {
    header('location:index');
    exit;
  } else {
    $mesaj = $mesajsor->fetch(PDO::FETCH_ASSOC);
  }
} else {
 header('location:index');
 exit;
}
if(isset($_POST["sil"]))
{
  $sorgu = $conn->prepare("DELETE FROM mesajlar WHERE id = ?");
  $sorgu->bindParam(1,$id,PDO::PARAM_INT);
  $sorgu->execute();
  if ($sorgu->rowCount()>0) {
    echo "<meta http-equiv='refresh' content='0;url=mailbox.php?durum=success'>";
  }else{
    echo "<meta http-equiv='refresh' content='0;url=mailbox.php?durum=warning'>";
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
          <h1>Mesajlar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Mesaj</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Mesaj İçeriği</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5><b><?php echo $mesaj['konu'] ?></b></h5>
                <h6>From: <?php echo $mesaj['mail'] ?>
                <span class="mailbox-read-time float-right"><?php echo $mesaj['time'] ?></span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" title="Print">
                  <i class="fas fa-print"></i>
                </button>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p><?php echo $mesaj['mesaj'] ?></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Cevap Ver</button>
              </div>
              <form action="" method="POST">
                <button type="submit" class="btn btn-default" name="sil"><i class="far fa-trash-alt"></i> Sil</button>
              </form>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>