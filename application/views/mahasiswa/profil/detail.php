<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Mahasiswa
      <small>Profil</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Mahasiswa</li>
      <li class="active">Profil</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Update Profil</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php if(isset($_SESSION['suksesupdate'])){ ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Berhasil!</h4>
                    <?php echo $_SESSION['suksesupdate']; ?>
                  </div>
                <?php } ?>
                <?php if(isset($_SESSION['gagalupdate'])){ ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                    <?php echo $_SESSION['gagalupdate']; ?>
                  </div>
                <?php } ?>
                <form action="<?php echo base_url(); ?>mahasiswa/profile/update" method="POST" class="from">

                  <div class="row">
                    <div class="col-sm-4">
                      <label>NPM</label>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="number" name="npm" class="form-control" value="<?php cetak($data->npm); ?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <label>Email</label>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="email" name="email" class="form-control" value="<?php cetak($data->email); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <label>Nama Lengkap</label>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="text" name="namaLengkap" class="form-control" value="<?php cetak($data->namaLengkap); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <label>Password</label>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="password" name="password" class="form-control" value="<?php echo $this->encryption->decrypt($data->password); ?>">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    
                    <div class="col-sm-12">
                      <button type="submit" class="btn bg-primary">Ubah Data</button>
                    </div>
                  </div>

                </form>  
              </table>
            </div>
          </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
