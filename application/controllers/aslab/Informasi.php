<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->library('encryption');
        $this->load->helper('info');
    }

    function master() {
        $crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_table('tbl_labdata');
        $crud->set_subject('Informasi');
        $crud->columns('name','value');
        $crud
            ->display_as('name', 'Info')
            ->display_as('value', 'Isi');
        $crud->field_type('value','text');
        $output = $crud->render();
        $data = [
        	'page_detail' => 'Manage Informasi',
            'title' => 'Dashboard - Informasi | ELABLTE'
        ];
        $output->data = $data;
        $this->_example_output($output);
    }


    public function _example_output($output = null)
    {
        $this->load->view('template/template2.php',(array)$output);
    }

}

/* End of file Informasi.php */
/* Location: ./application/controllers/aslab/Informasi.php */