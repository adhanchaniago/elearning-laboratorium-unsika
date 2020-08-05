<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListTugas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->library('encryption');
        $this->load->model('M_Aslab');
        $this->load->model('M_Tugas');
	}

	public function master($idTugas){
		$crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_table('tbl_hasiltugas');
        $crud->set_subject('Hasil Tugas '.$idTugas);
        
        $crud->columns('npm','tanggalKirim','namaFile');
        $crud
            ->display_as('npm', 'NPM')
            ->display_as('tanggalKirim', 'Tanggal Kirim')
            ->display_as('namaFile','Download File');
        $crud->where('idTugas',$idTugas);
        
        $crud->callback_column('namaFile',array($this,'_callback_nama_file'));
        $crud->unset_delete();
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_read();

        $output = $crud->render();
        $data = [
            'page_detail' => 'List Hasil Tugas',
            'title' => 'Dashboard - List Hasil Tugas | ELABLTE'
        ];
        $output->data = $data;
        $this->_example_output($output);
	}

	public function _example_output($output = null)
	{
		$this->load->view('template/template2.php',(array)$output);
	}

	function _callback_nama_file($value,$row){
        return "<a target='_blank' href='".base_url()."uploads/tugas/".$value."' >Download</a>";
    }






}

/* End of file ListTugas.php */
/* Location: ./application/controllers/aslab/ListTugas.php */