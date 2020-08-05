<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
        $this->load->library('encryption');
    }
    
    function master() {
        $crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $this->load->config('grocery_crud');
        $crud->set_table('tbl_mahasiswa');
        $crud->set_subject('Mahasiswa');
        $crud->columns('npm','namaLengkap','email','active_status');
        $crud
            ->display_as('npm', 'NPM')
            ->display_as('namaLengkap', 'Nama Lengkap')
            ->display_as('email','Email')
            ->display_as('active_status','Status');
        $crud->field_type('active_status','enum',array('active','noactive'));

        $crud->callback_before_insert(array($this,'encrypt_password_callback'));
        $crud->callback_before_update(array($this,'encrypt_password_callback'));
        $crud->callback_edit_field('password',array($this,'decrypt_password_callback'));
        $crud->callback_read_field('password',array($this,'decrypt_password_callback_read'));

        $crud->unset_add();
        $output = $crud->render();
        $data = [
            'page_detail' => 'Manage Mahasiswa',
            'title' => 'Dashboard - List Mahasiswa | ELABLTE'
        ];
        $output->data = $data;
        $this->_example_output($output);
    }
    
    public function _example_output($output = null)
	{
		$this->load->view('template/template2.php',(array)$output);
	}

    function encrypt_password_callback($post_array)
    {
     
        $post_array['password'] = $this->encryption->encrypt($post_array['password']);
        return $post_array;
    }
     
    function decrypt_password_callback($value)
    {
     
        $decrypted_password = $this->encryption->decrypt($value);
        return "<input type='password' class='form-control' name='password' value='".$decrypted_password."' />";
    }
    function decrypt_password_callback_read($value)
    {
     
        $decrypted_password = $this->encryption->decrypt($value);
        return $decrypted_password;
    }

}