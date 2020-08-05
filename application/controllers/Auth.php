<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$data = [
			'title' => 'Dashboard | ELABLTE',
			'content' => 'mahasiswa/main'
		];
		$this->load->view('template/template', $data, FALSE);
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
?>