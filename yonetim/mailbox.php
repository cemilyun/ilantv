<?php include 'header.php';
include 'navbar.php'; 
$sorgu = $conn->query("SELECT * FROM mesajlar");
$cikti = $sorgu->fetchAll(PDO::FETCH_ASSOC);


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
            <li class="breadcrumb-item active">Mesajlar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
   <?php
   if (isset($_GET['durum'])=='success') { ?>
    <meta http-equiv="refresh" content="2;url=mailbox.php" />
    <div class="alert alert-success ?>">Mesaj başarıyla silindi.</div>                     
  <?php }else if (isset($_GET['durum'])=='warning'){ ?>
    <div class="alert alert-warning ?>">Mesaj silinemedi.</div>
  <?php } ?>
  <div class="row">

    <!-- /.col -->
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Gelen Kutusu</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" placeholder="Search Mail">
              <div class="input-group-append">
                <div class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <form action="mailbox.php">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm">
                <i class="far fa-trash-alt"></i>
              </button>
            </div>
            <!-- /.btn-group -->
            <button type="submit" class="btn btn-default btn-sm">
              <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-chevron-right"></i>
                </button>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.float-right -->
          </div>
          </form>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                <?php 
                $sayi = 0;
                foreach ($cikti as $k) {
                  $sayi++;
                  ?><tr>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" value="" id="check<?php echo $sayi ?>">
                        <label for="check<?php echo $sayi ?>"></label>
                      </div>
                    </td>
                    <td class="mailbox-name"><a href="read-mail.php?message=<?php echo $k["id"] ?>"><?php echo $k['adi'] ?></a></td>
                    <?php $mesaj = substr($k['mesaj'], 0,35);  ?>
                    <td class="mailbox-subject"><b><?php echo $k['konu'] ?></b> - <?php echo $mesaj ?>...
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo $k['time'] ?></td>
                    </tr> <?php
                  } ?>

                </tbody>
              </table>
              <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer p-0">
           
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>