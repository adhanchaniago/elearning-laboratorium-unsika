<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>E</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">ELEARNING <b>LAB</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
            
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $_SESSION['npm']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <p>
                <?php cetak($_SESSION['npm']); ?>
              </p>
              <small><?php cetak($_SESSION['level']); ?></small>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <?php if($_SESSION['level'] == 'mahasiswa'){ ?>
                  <a href="<?php echo base_url(); ?>mahasiswa/profile" class="btn btn-default btn-flat">Profile</a>
                <?php } ?>
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url(); ?>Main/stop_auth" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>