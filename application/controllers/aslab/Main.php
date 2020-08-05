<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
        $this->load->model('M_Aslab');
        $this->load->model('M_Api');
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard | ELABLTE',
			'content' => 'aslab/Main',
			'jumlahTugas' => $this->M_Aslab->count_tugas(),
			'tugasYangTerkumpul' => $this->M_Aslab->count_hasiltugas(),
			'jumlahKelas' => $this->M_Aslab->count_kelas(),
			'reportTerbaru' => $this->M_Api->get_report(),
			'jumlahReport' => $this->M_Api->count_report()
		];
		$this->load->view('template/template', $data, FALSE);
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/aslab/Main.php */