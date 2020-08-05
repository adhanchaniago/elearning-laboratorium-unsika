<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Aslab
      <small>Upload Materi</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Aslab</li>
      <li>Main Dashboard</li>
      <li class="active">Upload Materi</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Kelas</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <form action="<?php echo base_url(); ?>aslab/materi/upload_proses" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama Mata Kuliah</label>
            <select class="form-control" name="idMKuliah">
              <?php 
                foreach ($listMataKuliah as  $value) {
                  ?>
                    <option value="<?php echo $value['idMKuliah']; ?>"><?php echo $value['namaMKuliah']; ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Dosen</label>
            <input class="form-control" type="text" name="dosen"></input>
          </div>
          <div class="form-group">
            <label>File</label>
            <input class="form-control" type="file" name="file_materi"></input>
          </div>
          <div class="form-group">
            <input type="submit" name="" value="Tambah" class="btn bg-primary">
          </div>    
        </form>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        E-LEARNING LAB V 0.5 (BETA)
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
