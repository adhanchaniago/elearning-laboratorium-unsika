<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Aslab
      <small>Tambah Matkul</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Aslab</li>
      <li>Main Dashboard</li>
      <li class="active">Tambah Matkul</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Matkul</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <form action="<?php echo base_url(); ?>aslab/praktikum/tambah_proses" method="POST">
          <div class="form-group">
            <label>Nama Mata Kuliah</label>
            <input type="text name" name="namaMKuliah" class="form-control">
          </div>
          <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" id="jurusan" class="form-control">
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
            </select>
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
