<?php
    
    if (isset($this->session->level)) {
	
	}
	else {
		redirect(base_url());
	}

?>
<?php 

$this->load->view('template/head');

?>
<body class="skin-yellow-light fixed sidebar-mini">
<!-- Site wrapper -->
	<div class="wrapper">

	<?php
		$this->load->view('template/topnav');
		$this->load->view('template/leftnav');
		$this->load->view($content);
		$this->load->view('template/foot');
	?>

	</div>
	<div id="chatDika"></div>
	<!-- jQuery 3 -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets') ?>/whatsapp-plugin.js"></script>
    <script type="text/javascript">
    
      $('#chatDika').floatingWhatsApp({
    	    phone: '62895332548343',
    	    popupMessage: 'Mengalami eror? Sebutkan Nama dan NPM mu lalu ceritakan masalahnya',
    	    showPopup: true,
    	    zIndex:10000,
    	    size: '50px'
    	});
    </script>
	<!-- Bootstrap 3.3.7 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<?php 
    	if(isset($select2)){
      		echo '<script typr="text/javascript" src="'.base_url().'vendor/select2/dist/js/select2.full.min.js"></script>';

    	
  	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.select2').select2();
		})
	</script>
	<?php 
	} 
	?>
	<?php  
		if(isset($dtable)){
			echo '<script src="'.base_url().'vendor/datatables.net/js/jquery.dataTables.min.js"></script>
			<script src="'.base_url().'vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>';
			$this->load->view($dtable);
		}
		if(isset($js)){
			$this->load->view($js);
		}
	?>

	<!-- SlimScroll -->
	<script src="<?php echo base_url(); ?>vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>vendor/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url(); ?>vendor/adminlte/js/demo.js"></script>

</html>


