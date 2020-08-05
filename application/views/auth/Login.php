<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-LEARNING LAB Universitas Singaperbangsa Karawang | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.5/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/blue.css">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets') ?>/whatsapp-plugin.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <style type="text/css">
    .bg-ahh {
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
  </style>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page " >
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>">ELEARNING <b>LAB</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
        <?php echo info('message_on_page_login')->value; ?>
    </div>
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo base_url(); ?>Main/auth_login" method="post">
      <?php if(isset($_SESSION['gagallogin'])){ ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
        Cek kembali npm/password anda, pastikan benar. Pastikan akun anda sudah terverifikasi.
      </div>
      <?php } ?>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" placeholder="NPM" name="npm" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-8">

        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"> Sign In</button>
        </div>
        <!-- /.col -->
      </div>
      <div class="form-group">
        <br>
        <p align="center">Belum terdaftar? klik <a href="<?php echo base_url('main/pendaftaran'); ?>">Registrasi Akun</a></p>
        <p align="center">Lupa Password? klik <a href="<?php echo base_url('main/lupa_password'); ?>">Ubah Password</a></p>
      </div>
    </form>
    <p align="center"><?php echo info('version')->value; ?></p>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<div id="chatAdi"></div>
<!-- jQuery 3 -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url('assets') ?>/whatsapp-plugin.js"></script>
<script type="text/javascript">

  $('#chatAdi').floatingWhatsApp({
	    phone: '62895375659992',
	    popupMessage: 'Mengalami eror? Sebutkan Nama dan NPM mu lalu ceritakan masalahnya',
	    showPopup: true,
	    headerTitle:'Adi',
	    position:'right',
	    zIndex:1000,
	    size: '50px',
      url:'<?php echo base_url(); ?>Api/report'
	});
</script>
<script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
