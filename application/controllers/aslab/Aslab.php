<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aslab extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->library('encryption');
	}

    function master() {
        $crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_table('tbl_aslab');
        $crud->set_subject('Aslab');
        $crud->columns('username','namaLengkap');
        $crud
            ->display_as('username', 'Username')
            ->display_as('namaLengkap', 'Nama Lengkap');
        $crud->field_type('password', 'password');

        $crud->callback_before_insert(array($this,'encrypt_password_callback'));
        $crud->callback_before_update(array($this,'encrypt_password_callback'));
        $crud->callback_read_field('password',array($this,'decrypt_password_callback_read'));
        $crud->callback_edit_field('password',array($this,'decrypt_password_callback'));

        $output = $crud->render();
        $data = [
            'page_detail' => 'Manage Aslab',
            'title' => 'Dashboard - List Aslab | ELABLTE'
        ];
        $output->data = $data;
        $this->_example_output($output);
    }

    function encrypt_password_callback($post_array, $primary_key = null)
    {
     
        $key = 'super-secret-key';
        $post_array['password'] = $this->encryption->encrypt($post_array['password']);
        return $post_array;
    }
     
    function decrypt_password_callback($value)
    {
     
        $key = 'super-secret-key';
        $decrypted_password = $this->encryption->decrypt($value);
        return "<input class='form-control' type='password' name='password' value='".$decrypted_password."' />";
    }
    function decrypt_password_callback_read($value)
    {
     
        $decrypted_password = $this->encryption->decrypt($value);
        return $decrypted_password;
    }

    public function _example_output($output = null)
    {
        $this->load->view('template/template2.php',(array)$output);
    }

}

/* End of file Praktikum.php */
