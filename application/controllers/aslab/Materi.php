<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Aslab');
        $this->load->library('grocery_CRUD');
        $this->load->library('encryption');
        $this->load->helper('info');
    }

    function master() {
        $crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_table('tbl_materi');
        $crud->set_subject('Materi');
        $crud->columns('idMkuliah','dosen','namaFile');

        $crud->add_fields(array('idMkuliah','dosen','namaFile'));
        $crud->edit_fields(array('idMkuliah','dosen','namaFile'));

        $crud->set_relation('idMkuliah','tbl_matakuliah','namaMKuliah');

        $crud->set_field_upload('namaFile','uploads/materi');

        $crud
            ->display_as('idMkuliah', 'Mata Kuliah')
            ->display_as('jurusan', 'jurusan')
            ->display_as('namaFile', 'Download');

        $crud->callback_column('namaFile',array($this,'_callback_nama_file'));

        $output = $crud->render();
        $data = [
            'page_detail' => 'Manage Materi',
            'title' => 'Dashboard - List Praktikum | ELABLTE'
        ];
        $output->data = $data;
        $this->_example_output($output);
    }


    public function _example_output($output = null)
    {
        $this->load->view('template/template2.php',(array)$output);
    }

    function _callback_nama_file($value,$row){
        return "<a href='".base_url()."uploads/materi/".$value."'>Download</a>";
    }




}

/* End of file Materi.php */
/* Location: ./application/controllers/aslab/Materi.php */
?>