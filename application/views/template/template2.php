<?php
    
    if (isset($this->session->level)) {
	
	}
	else {
		redirect(base_url());
	}

?>
<?php 
    $dat = [
        'title' => $data['title']
    ];
    $this->load->view('template/head2',$dat);

?>
<body class="skin-yellow-light fixed sidebar-mini"> 
    <div class="wrapper" style="height: auto; min-height: 100%;">

	<?php
		$this->load->view('template/topnav');
		$this->load->view('template/leftnav');
		$this->load->view('template/content');
		$this->load->view('template/foot2');
	?>

	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="<?php echo base_url(); ?>vendor/adminlte/js/adminlte.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo base_url(); ?>vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>vendor/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

	<!-- jQuery 3 -->
    
	<!-- Bootstrap 3.3.7 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- <script src="<?php echo base_url()?>vendor/datatables.net/js/jquery.dataTables.min.js"></script> -->
	<!-- <script src="<?php echo base_url()?>vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
	
	</body>
</html>
