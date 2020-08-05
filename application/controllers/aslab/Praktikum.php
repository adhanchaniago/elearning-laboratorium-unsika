<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Praktikum extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->library('encryption');
    }

    function master() {
        $crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_table('tbl_matakuliah');
        $crud->set_subject('Praktikum');
        $crud->columns('namaMKuliah','jurusan');
        $crud
            ->display_as('namaMKuliah', 'Mata Kuliah')
            ->display_as('jurusan', 'Jurusan');
        $crud->field_type('jurusan','enum',array('Teknik Informatika', 'Sistem Informasi'));

        $output = $crud->render();
        $data = [
            'page_detail' => 'Manage Praktikum',
            'title' => 'Dashboard - List Praktikum | ELABLTE'
        ];
        $output->data = $data;
        $this->_example_output($output);
    }


    public function _example_output($output = null)
    {
        $this->load->view('template/template2.php',(array)$output);
    }

}

/* End of file Praktikum.php */
