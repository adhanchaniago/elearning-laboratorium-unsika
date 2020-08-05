<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTugas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->library('encryption');
        $this->load->model('M_Aslab');
        $this->load->model('M_Tugas');
	}

	public function master($idKelas)
	{
		$crud = new grocery_CRUD();
        $crud->set_theme('bootstrap');
        $crud->set_table('tbl_tugas');
        $crud->set_subject('Tugas');
        $crud->fields('idKelas','kodeTugas','pertemuan','deadLine','dibuat');
        $crud->columns('deadLine','idKelas','kodeTugas','pertemuan');
        $crud
            ->display_as('idKelas', 'Kelas')
            ->display_as('deadLine', 'Deadline')
            ->display_as('kodeTugas', 'Kode Tugas')
            ->display_as('pertemuan', 'Pertemuan')
            ->display_as('dibuat', 'Waktu dibuat');
        
        
        $crud->callback_read_field('idKelas',array($this, 'callback_view_column_kelas'));
        $crud->callback_column('idKelas',array($this, 'callback_view_column_kelas'));
        // $crud->callback_column('aslab',array($this, 'callback_view_column_aslab'));
    
        $crud->change_field_type('dibuat','invisible');

		$crud->callback_before_insert(array($this,'callback_dibuat'));

		$crud->add_action('List', '', 'aslab/ListTugas/master', 'fa-book');
		
		$crud->add_action('Download', '', 'aslab/DataTugas/download', 'fa-download');
		
		$crud->unset_add();
		$crud->unset_delete();
		
		$crud->where('idKelas',$idKelas);

        $output = $crud->render();
        $data = [
            'page_detail' => 'Manage Tugas',
            'title' => 'Dashboard - Manage Tugas | ELABLTE'
        ];
        $output->data = $data;
        $this->_example_output($output);
	}

	public function _example_output($output = null)
	{
		$this->load->view('template/template2.php',(array)$output);
	}

	public function callback_dibuat($post_array){
		$post_array['dibuat'] = date('Y-m-d H:i:s');
    	return $post_array;
	}


	public function callback_view_column_kelas($value){
		return $this->detail($value,'kl');
	}
	
	public function callback_view_column_aslab($value){
	    return $this->detail($value, 'as')[0]['namaLengkap'];
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
    
    function download($id){
        $this->load->library('zip');
        $dataTugas = $this->M_Tugas->get_tugas_all($id);
        $listTugas = null;
        foreach($dataTugas as $dt){
            $listTugas = $_SERVER['DOCUMENT_ROOT'].'/uploads/tugas/'.$dt->namaFile;
            $extension = explode('.',$dt->namaFile);
            $this->zip->read_file($listTugas);
        }
        $this->zip->download('List Tugas.zip');
    }
	


}

/* End of file Tugas.php */
/* Location: ./application/controllers/aslab/Tugas.php */