<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Auth');
		$this->load->model('M_Email');
		$this->load->library('encryption');
	}

	public function index()
	{
		$verificationText = $this->input->get('verifCode');
		if ($this->M_Email->verifyEmailAddress($this->encryption->decrypt($verificationText))){
		 	$error =  "Email berhasil diverifikasi!";
		}else{
		 	$error = "Maaf kami gagal memverifikasi email anda!"; 
		}
		$data['errormsg'] = $error; 
		$this->load->view('auth/verifikasi_berhasil', $data);   
	}

}

/* End of file Verify.php */
/* Location: ./application/controllers/Verify.php */