<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Auth');
		$this->load->model('M_Email');
		$this->load->library('encryption');
		$this->load->helper('cookie');
	}

	public function index()
	{
		$this->auth_super();
		$this->load->view('auth/Login', FALSE);
	}

	function auth_login(){
		$npm	 	= $this->input->post('npm',TRUE);
		$password 	= $this->input->post('password',TRUE);
		$level		= 'mahasiswa';

		$account = [
			'npm' 		=> $npm,
			'active_status' => 'active'
		];
		
		// Untuk membuat akun
		// $this->Auth->try($account);
		$log = $this->M_Auth->check($account);

		if($log->num_rows() > 0){

			$pass = $log->result_array();
			if($this->encryption->decrypt($pass[0]['password']) == $password){
				$array = array(
					'npm' 		=> $npm,
					'level'	    => $level,
					'session_code' => $this->encryption->encrypt($npm)
				);
				
				$this->session->set_userdata($array);
				// if(isset($_POST['save_cookies'])){
				// 	$this->input->set_cookie('elearninglabcookie',  $this->encryption->encrypt($npm), 3600*24*30);
				// }
				activity_log('login', 'login', 'berhasil');
				$this->auth_super();
			}
			else {
				$this->session->set_flashdata('gagallogin', 'andagagallogin');
				activity_log('login', 'login', 'gagal', $npm);
				redirect(base_url());
			}
			
		}
		else {
			$this->session->set_flashdata('gagallogin', 'andagagallogin');
			activity_log('login', 'login', 'gagal', $npm);
			redirect(base_url());
		}

	}
	function auth_super(){
		if (isset($this->session->level)) {
			if($this->session->level == 'mahasiswa'){
				redirect(base_url('mahasiswa/Main'));
			}
			elseif($this->session->level == 'aslab'){
				redirect(base_url('aslab/Main'));
			}
		}
		else {
			return true;
		}
	}

	function stop_auth(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function try_account(){
		$account = [
			'npm' => '1610630062',
			'namaLengkap' => 'Christ Memory',
			'email'	=> 'christmemory5@gmail.com',
			'password' => md5('memory543')
		];
		$this->M_Auth->try($account);
	}
	function pendaftaran(){
		$this->load->view('auth/Pendaftaran', FALSE);
	}
	function pendaftaran_berhasil($message){
		$data = [
			'message' => $message
		];
		$this->load->view('auth/Pendaftaran_berhasil', $data);
	}
	function auth_register(){
	    $this->form_validation->set_rules('npm', 'NPM', 'required|xss_clean|numeric|exact_length[13]');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
        $this->form_validation->set_rules('namaLengkap', 'Nama Lengkap', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
        
        $npmDump = preg_replace( '/[^0-9]/', '',$this->input->post('npm'));
        if($this->form_validation->run() != false){
            if(strlen($npmDump) == 13){
                $account = [
        			'npm' => $this->input->post('npm',TRUE),
        			'namaLengkap' => $this->input->post('namaLengkap',TRUE),
        			'email'	=> $this->input->post('email',TRUE),
        			'password' => $this->encryption->encrypt($this->input->post('password',TRUE)),
        			'email_verification_code' => md5($this->input->post('email',TRUE))
        		];
        		if($this->M_Email->cek_email($account['email']) == false){
        		    if($this->M_Auth->Cek_npm($this->input->post('npm')) > 0){
            		    $message = "NPM sudah terdaftar, silahkan tunggu email konfirmasi atau hubungi aslab";
            		}
            		else {
            		    if($this->M_Email->sendVerificatinEmail($this->input->post('email'),$this->input->post('email'))){
                			if($this->M_Auth->try($account) == true){
                				$message = 'Pendaftaran Berhasil, silahkan cek email untuk konfirmasi!';
                			}
                			else {
                				$message = 'Pendaftaran gagal, silahkan coba ulang';
                			}	
                		}
                		else {
                			$message = 'Pendaftaran gagal, silahkan coba lagi!. Gunakan Email selain student.';
                		}
            		}
        		}
        		else {
        		    $message = "Pendaftaran gagal, Email sudah terdaftar! gunakan yang lain!";
        		}
            }
            else {
                $message = "NPM anda tidak benar!";
            }
        }
        else {
            $message = validation_errors();
        }
        
		
		
		
		$this->pendaftaran_berhasil($message);
	}
	
	function lupa_password(){
	    $this->load->view('auth/LupaPassword', FALSE);
	}
	
	function auth_lupa_password(){
	    $email = $this->input->post('email');
	    if($this->M_Auth->Cek_npm($this->input->post('npm')) > 0){
    	    if($this->M_Email->cek_email($email) == true){
    	        if($this->M_Email->cekNPM($this->input->post('npm')) > 0){
    	        
    	            if($this->M_Email->recoveryPassword($email,$this->input->post('npm'))){
        	            $error =  "Cek email kamu untuk membuat password baru!";   
        	        }
        	        else {
        	            $error = "Maaf kami gagal memverifikasi email anda!"; 
        	        }
    	        }
    	        else {
    	            $error = "NPM anda tidak terdaftar!";
    	        }
    	        
    	    }
    	    else {
    	        $error = "Email anda tidak terdaftar!";
    	    }
	    }
	    else {
	        $error = "NPM anda tidak terdaftar!";
	    }
	    $data['errormsg'] = $error; 
	    $this->load->view('auth/verifikasi_berhasil', $data); 
	}
	
	function new_password(){
	    $data = [
	        'npm' => $this->input->get('kode'),
	    ];
	    $this->session->set_userdata($data);
	    $this->load->view('auth/newPassword', $data);
	}
	function new_password_process(){
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
        $password = $this->input->post('password', TRUE);
        $npm = $this->session->npm;
        
        if($this->M_Email->cekNPM($this->encryption->decrypt($npm)) > 0){
            if($this->form_validation->run()){
        	    if($this->M_Email->update_password($this->encryption->decrypt($npm),$this->encryption->encrypt($password))){
        	        $error =  "Password berhasil diubah, silahkan login!"; 
        		}else{
        		 	$error = "Maaf kami gagal mengubah password!"; 
        		}
            }
            else {
                $error = validation_errors();
            }
        }
        else {
            $error = "NPM tidak ada";
        }
        
	    
		$data['errormsg'] = $error; 
		$this->session->sess_destroy();
		$this->load->view('auth/verifikasi_berhasil', $data);  
	}

	  

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
