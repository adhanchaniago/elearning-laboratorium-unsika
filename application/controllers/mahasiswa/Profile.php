<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Auth');
		$this->load->library('encryption');
        sesi();
	}

	public function index()
	{
		$npm = $this->session->npm;
		$data = $this->M_Auth->getMhs($npm)->row();
		$data = [
			'title' => 'Dashboard - Profil | ELABLTE',
			'content' => 'mahasiswa/profil/detail',
			'data' => $data
		];
		$this->load->view('template/template', $data, FALSE);
	}

	function update(){
	    $this->form_validation->set_rules('npm', 'NPM', 'required|xss_clean|numeric|exact_length[13]');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
        $this->form_validation->set_rules('namaLengkap', 'Nama Lengkap', 'required|xss_clean|regex_match[/^[A-Za-z ]+$/]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
        
        if(($this->form_validation->run() != false)) {
            $data = $this->input->post(NULL,TRUE);
    		$data = $this->security->xss_clean($data);
    		$data['email_verification_code'] = md5($this->input->post('email',TRUE));
    		$data['password'] = $this->encryption->encrypt($this->input->post('password',TRUE));
    
    		if($this->session->npm == $data['npm']){
    			if($this->M_Auth->updateProfile($data,$this->session->npm) && $this->M_Auth->updateNPMTUGAS($data['npm'],$this->session->npm)){
    				$this->session->set_flashdata('suksesupdate', 'Berhasil update!');
    				$this->session->set_userdata('npm', $this->input->post('npm'));
                    activity_log('mengedit', 'profil', 'berhasil');
    				redirect(base_url('mahasiswa/profile'));
    			}
    			else {
    				$this->session->set_flashdata('gagalupdate', 'Gagal di update! Silahkan hubungi cp!');
                    activity_log('mengedit', 'profil', 'gagal');
    				redirect(base_url('mahasiswa/profile'));
    			}
    		}
    		else{
    			if($this->M_Auth->getMhs($data['npm'])->num_rows() > 0){
    				$this->session->set_flashdata('gagalupdate', 'NPM tersebut telah terdaftar! Jika anda merasa npm tersebut milik anda, silahkan hubungi cp!');
                    activity_log('mengedit', 'profil', 'gagal');
    				redirect(base_url('mahasiswa/profile'));
    			}
    			else {
    				if($this->M_Auth->updateProfile($data,$this->session->npm) && $this->M_Auth->updateNPMTUGAS($data['npm'],$this->session->npm)){
        				$this->session->set_flashdata('suksesupdate', 'Berhasil update!');
        				$this->session->set_userdata('npm', $this->input->post('npm'));
                        activity_log('mengedit', 'profil', 'berhasil');
        				redirect(base_url('mahasiswa/profile'));
        			}
        			else {
        				$this->session->set_flashdata('gagalupdate', 'Gagal di update! Silahkan hubungi cp!');
                        activity_log('mengedit', 'profil', 'gagal');
        				redirect(base_url('mahasiswa/profile'));
        			}
    			}
    
    		}
        }
		else {
		    $this->session->set_flashdata('gagalupdate', validation_errors());
            activity_log('mengedit', 'profil', 'gagal');
        	redirect(base_url('mahasiswa/profile'));
		}
		
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/mahasiswa/Profile.php */