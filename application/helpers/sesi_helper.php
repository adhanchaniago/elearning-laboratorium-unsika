<?php

function sesi(){
	$CI =& get_instance();
	if(!isset($_SESSION['npm'])){
		redirect(base_url());
	}
}

?>