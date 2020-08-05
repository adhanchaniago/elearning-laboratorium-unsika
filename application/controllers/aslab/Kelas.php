<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
	
    public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
        $this->load->library('encryption');

        $this->load->model('M_Aslab');
    }
    
    function master() {
        $crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_table('tbl_kelas');
        $crud->set_subject('Kelas');
        $crud->columns('idMataKuliah','tahun','semester','hurufKelas','idAslab','idAslab2');
        $crud
            ->display_as('idMataKuliah', 'Mata Kuliah')
            ->display_as('tahun', 'Tahun')
            ->display_as('semester','Semester')
            ->display_as('idAslab','Aslab 1')
            ->display_as('idAslab2','Aslab 2');
        $crud->required_fields('idMataKuliah','tahun','semester','hurufKelas','idAslab');
        $crud->field_type('hurufKelas','enum',array('A','B','C','D','E','F','G','H','I'));

        // $crud->callback_edit_field('idMataKuliah', array($this, 'callback_form_matakuliah'));

        $crud->set_relation('idMataKuliah', 'tbl_matakuliah', 'namaMKuliah');
        $crud->set_relation('idAslab','tbl_aslab','namaLengkap');
        $crud->set_relation('idAslab2','tbl_aslab','namaLengkap');
        $crud->add_action('List Tugas', '', 'aslab/DataTugas/master', 'fa-book');
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

	function detail($id, $action){
		$data = 0;
		if($action == 'mk'){
			$data = $this->M_Aslab->get_nmMataKuliah($id);
		}
		elseif ($action == 'as') {
			$data = $this->M_Aslab->get_nmAslab($id);
		}
		elseif ($action == 'jr') {
			$data = $this->M_Aslab->get_nmJurusanKuliah($id);
		}
		elseif ($action == 'kl') {
			$kelas = $this->M_Aslab->get_kelasById($id);
			$namaMKul = $this->M_Aslab->get_nmMataKuliah($kelas[0]['idMataKuliah']);
			$data = $namaMKul[0]['namaMKuliah'].' '.$kelas[0]['tahun'].' '.$kelas[0]['hurufKelas'];
		}
		return $data;
	}
	

}

/* End of file Kelas.php */
/* Location: ./application/controllers/aslab/Kelas.php */
