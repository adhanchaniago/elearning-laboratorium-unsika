<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Aslab
      <small>Tugas</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Aslab</li>
      <li>Main Dashboard</li>
      <li class="active">Tugas</li>
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
        <form action="<?php echo base_url(); ?>aslab/kelas/buat_proses" method="POST">
          <div class="form-group">
            <label>Nama Mata Kuliah</label>
            <select class="form-control" name="idMataKuliah">
              <?php 
                foreach ($listMataKuliah as  $value) {
                  ?>
                    <option value="<?php echo $value['idMKuliah']; ?>"><?php echo $value['namaMKuliah']; ?> (<?php echo $value['jurusan']; ?>)</option>
                  <?php
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tahun Praktikum</label>
            <input class="form-control" type="number" name="tahun"></input>
          </div>
          <div class="form-group">
            <label>Semester</label>
            <input class="form-control" type="number" name="semester"></input>
          </div>
          <div class="form-group">
            <label>Huruf Kelas</label>
            <select class="form-control" name="hurufKelas">
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="E">E</option>
              <option value="F">F</option>
              <option value="G">G</option>
              <option value="H">H</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="" value="Tambah" class="btn bg-primary">
          </div>    
        </form>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
