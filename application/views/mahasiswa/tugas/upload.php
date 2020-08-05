<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Mahasiswa
      <small>Upload Tugas</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Mahasiswa</li>
      <li>Main Dashboard</li>
      <li class="active">Upload Tugas</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Upload Tugas</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
          <?php echo info('message_on_page_upload')->value; ?>
        </div>
        <?php if(isset($_SESSION['tidakbolehuploadtugas'])){ ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
          <?php echo $_SESSION['tidakbolehuploadtugas']; ?>
        </div>
        <?php } ?>
        <form action="<?php echo base_url(); ?>mahasiswa/tugas/upload_proses" method="POST" enctype="multipart/form-data">
          <div class="form-group" id="FormidTugas">
            <label>Kode Tugas</label>
            <input class="form-control" type="text" name="idTugas" onchange="cekKodeTugas();" id="idTugas">
            <small id="pesanpesan">Kode Tugas silahkan minta ke asisten laboratoriummu!</small>
          </div>
          <div class="form-group">
            <label>File</label>
            <input class="form-control" type="file" name="file_tugas">
          </div>
          <div class="form-group">
            <input type="submit" name="" value="Tambah" class="btn bg-primary" id="uploadTugas" required>
          </div>    
        </form>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <p>Ukuran Maksimum file : 25 Mb | Maksimum waktu eksekusi : 90 s | Upload file > 2 Mb gunakan laptop/komputer</p>
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
