<?php
  if($_SESSION['level'] == 'aslab'){
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('main')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>aslab/main">
          <i class="fa fa-tachometer"></i> <span>DASHBOARD</span>
        </a>
      </li>
      <li class="header">MAIN NAVIGATION</li>
      <!-- Kelas -->
      <li class="<?php if(strtolower($this->uri->segment(2)) == 'kelas'){ echo 'active';} ?>"><a href="<?php echo base_url()?>aslab/kelas/master"><i class="fa fa-bookmark"></i> Data Kelas</a></li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == 'tugas'){ echo 'active';} ?>"><a href="<?php echo base_url()?>aslab/tugas/master"><i class="fa fa-tasks"></i> Tugas Kelas</a></li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('materi')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>aslab/materi/master">
          <i class="fa fa-book"></i> <span>Materi</span>
        </a>
      </li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('praktikum')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>aslab/praktikum/master">
          <i class="fa fa-align-justify"></i> <span>Praktikum</span>
        </a>
      </li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('aslab')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>aslab/aslab/master">
          <i class="fa fa-user"></i> <span>Aslab</span>
        </a>
      </li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('mahasiswa')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>aslab/mahasiswa/master">
          <i class="fa fa-database"></i> <span>Mahasiswa</span>
        </a>
      </li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('informasi')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>aslab/informasi/master">
          <i class="fa fa-info"></i> <span>Informasi</span>
        </a>
      </li>
    </ul>
  </section>
</aside>

<?php
  }
?>

<?php
  if($_SESSION['level'] == 'mahasiswa'){
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <!-- Kelas -->
      <li class="<?php if(strtolower($this->uri->segment(2)) == 'main'){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>mahasiswa/main">
          <i class="fa fa-history"></i> <span>History</span>
        </a>
      </li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('tugas')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>mahasiswa/tugas/upload">
          <i class="fa fa-upload"></i> <span>Upload Tugas</span>
        </a>
      </li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('modul')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>mahasiswa/modul">
          <i class="fa fa-book"></i> <span>List Modul</span>
        </a>
      </li>
      <li class="<?php if(strtolower($this->uri->segment(2)) == strtolower('compiler')){ echo 'active'; } ?>">
        <a href="<?php echo base_url()?>mahasiswa/compiler">
          <i class="fa fa-code"></i> <span>Compiler online</span>
        </a>
      </li>
    </ul>
  </section>
</aside>

<?php
  }
?>
