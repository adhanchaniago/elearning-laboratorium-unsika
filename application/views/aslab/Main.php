<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard Aslab
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Aslab</li>
      <li class="active">Main Dashboard</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $jumlahTugas; ?></h3>

              <p>Tugas</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $tugasYangTerkumpul; ?></h3>

              <p>Tugas Terkumpul</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $jumlahKelas; ?></h3>

              <p>Kelas Praktikum</p>
            </div>
          </div>
        </div>
      </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Keluhan</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                
              </div>
            </div>
            <div class="box-body chat" id="chat-box" style="overflow-y: scroll; max-height: 300px;">
              <?php foreach($reportTerbaru as $rT){ ?>
              <div class="item">
                <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png" alt="user image" class="online">

                <p class="message">
                  <a class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo $rT['keluhan_post']; ?></small>
                    Pengguna
                  </a>
                  <p class="attachment" style="white-space: pre-line"><?php echo $rT['keluhan_text']; ?></p>
                </p>
              </div>
              <?php } ?>
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              Jumlah keluhan total : <?php echo $jumlahReport; ?>
            </div>
          </div>
      </div>
      <div class="col-lg-6">
        
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
