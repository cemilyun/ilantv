<?php include 'header.php';
include 'navbar.php'; 
include '../baglanti.php';

$sorgu = $conn->prepare("SELECT * FROM siparisler");
$sorgu->execute();


?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Siparişler</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">Sipariş Listesi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Sipariş Bilgileri</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Adı</th>
                <th>Soyadı</th>
                <th>Adres</th>
                <th>Telefon</th>
                <th>Sipariş Ücreti</th>
                <th>Ödeme Türü</th>
                <th>Tarih</th>
                <th>Siparişe Git </th>
              </tr>
            </thead>
            <tbody>
              <?php while ($k = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><?php echo $k['id']?></td>
                <td><?php echo $k['isim']?></td>
                <td><?php echo $k['soyisim']?></td>
                <td><?php echo $k['adres']?></td>
                <td><?php echo $k['telefon']?></td>
                <td><?php echo $k['ucret']?> TL</td>
                <td><?php echo $k['odeme']?></td>
                <td><?php echo $k['date']?></td>
                <td><a href="../finish.php?code=<?php echo $k['skey']?>" target="_blank"><button type="submit" class="btn btn-block btn-info">Git</button></a></td>
              </tr>
               <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Adı</th>
                <th>Soyadı</th>
                <th>Adres</th>
                <th>Telefon</th>
                <th>Sipariş Ücreti</th>
                <th>Ödeme Türü</th>
                <th>Tarih</th>
                <th>Siparişe Git </th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
</script>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
