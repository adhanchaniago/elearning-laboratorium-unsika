<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Aslab
      <small>Tugas Kelas</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Aslab</li>
      <li>Main Dashboard</li>
      <li class="active">Tugas Kelas</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
              Buat Tugas
            </button>
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Buat Tugas</h4>
                  </div>
                  <form action="<?php echo base_url(); ?>aslab/kelas/tugas_proses" method="POST">
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Kelas</label>
                        <select name="idKelas" class="form-control">
                          <?php 
                            foreach ($listKelas as $val) {
                              ?>
                              <option value="<?php echo $val['id']; ?>"><?php echo $val['nama']; ?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                      <div class="from-group">
                        <label>Kode Tugas</label>
                        <input class="form-control" type="text" name="kodeTugas" readonly value="<?php echo date('H').'TUGAS'.date('d').date('Y').date('m').strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 2)); ?>" />
                      </div>
                      <div class="form-group">
                        <label>Pertemuan</label>
                        <select class="form-control" name="pertemuan">
                          <?php  
                            for($i=1;$i<=14;$i++){
                          ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php }
                             ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>deadLine</label>
                        <input type="datetime-local" class="form-control" name="deadLine">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Buat Tugas</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
      </div> 
    </div>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title"></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="dtable_get_list" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Kelas</th>
                          <th>Kode Tugas</th>
                          <th>Pertemuan</th>
                          <th>Deadline</th>
                          <th>Dibuat</th>
                          <th>Aksi</th>
                      </tr>
                    </thead>
                </table>
            </div>
          </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="viewTugas">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">List Hasil Tugas</h4>
        </div>
        <div id="tableTugas">
          <table class="table">
            <tr>
              <th>No</th>
              <td>Npm</td>
              <td>File</td>
            </tr>
            <tbody id="tableTugaslist">
              
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.content -->
</div>
