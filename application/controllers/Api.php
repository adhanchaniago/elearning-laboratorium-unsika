<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Api');
	}

	function report(){
		$report = $this->input->post('msg', TRUE);
		if($this->M_Api->add_report($report)){
			echo json_encode(['status' => 'success']);
		}
		else{
			echo json_encode(['status' => 'failed']);
		}
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */

?>