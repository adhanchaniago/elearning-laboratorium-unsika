<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Mahasiswa
      <small>List Tugas yang sudah terkumpul</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Mahasiswa</li>
      <li>Main Dashboard</li>
      <li class="active">List Tugas</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">History</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
                        <?php echo info('message_on_page_main')->value; ?>
                    </div>
                    <?php if(isset($_SESSION['uploadtugas'])){ ?>
                        <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-ban"></i> Berhasil!</h4>
                          <?php echo $_SESSION['uploadtugas']; ?>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                      <table id="dtable_get_list" class="table table-bordered table-hover table-responsive">
                        <thead>
                          <tr>
                              <th>No</th>
                              <th>Kelas</th>
                              <th>Pertemuan</th>
                              <th>Tanggal Kirim</th>
                              <th>Aksi</th>
                          </tr>
                        </thead>
                       </table>
                    </div>
            </div>
          </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
