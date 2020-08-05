<div class="content-wrapper" style="min-height: 644px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard <?php echo ucfirst($_SESSION['level']) ?>
      <small><?php echo $data['page_detail']; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> <?php echo ucfirst($_SESSION['level']) ?></li>
      <li>Main Dashboard</li>
      <li class="active"></li><?php echo $data['page_detail']; ?></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <?php echo $output; ?>
          </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
