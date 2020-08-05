<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->library('encryption');
        $this->load->model('M_Aslab');
        $this->load->model('M_Tugas');
	}

	public function master()
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
            
        $crud->required_fields('deadLine','idKelas','kodeTugas','pertemuan');
        $crud->field_type('pertemuan','enum',array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16));
        
        // CALLBACK ADD FIELD
        $crud->callback_add_field('deadLine', function () {
            return '<input type="datetime-local" id="example-datepicker" name="deadLine" class="form-control input-datepicker">';
        });

        $crud->callback_add_field('idKelas',array($this, 'callback_list_kelas'));

        $crud->callback_add_field('kodeTugas', function() {
        	return '<input type="text" id="kodeTugas" value="'.date('H').'TUGAS'.date('d').date('Y').date('m').strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 2)).'" name="kodeTugas" class="form-control" readonly>';
        });

        // CALLBACK EDIT FIELD
        $crud->callback_edit_field('idKelas',array($this, 'callback_list_kelas'));

        $crud->callback_edit_field('deadLine', function ($value) {
            $tgl = date("Y-m-d\TH:i", strtotime($value));
            return '<input type="datetime-local" id="example-datepicker" name="deadLine" value="'.$tgl.'" class="form-control input-datepicker">';
        });

        $crud->callback_edit_field('kodeTugas', function($value,$row) {
        	return '<input type="text" id="kodeTugas" value="'.$value.'" name="kodeTugas" class="form-control" readonly>';
        });

        $crud->callback_read_field('idKelas',array($this, 'callback_view_column_kelas'));
        $crud->callback_column('idKelas',array($this, 'callback_view_column_kelas'));
        // $crud->callback_column('aslab',array($this, 'callback_view_column_aslab'));
    
        $crud->change_field_type('dibuat','invisible');

		$crud->callback_before_insert(array($this,'callback_dibuat'));

		$crud->add_action('List', '', 'aslab/ListTugas/master', 'fa-book');

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

	public function callback_list_kelas($valuee){
		$lk = $this->M_Aslab->get_kelas();
		$listKelas = '';
		$no = 0;
		foreach ($lk as $value) {
		        $namaMKul = $this->detail($value['idMataKuliah'],'mk');
    			$namaMKul = $namaMKul[0]['namaMKuliah'].' '.$value['tahun'].$value['hurufKelas'];
		    if($valuee == $value['idKelas']){
    			$listKelas .=  '<option value="'.$value['idKelas'].'" selected>'.$namaMKul.'</option>';
		    }else {
    			$listKelas .=  '<option value="'.$value['idKelas'].'">'.$namaMKul.'</option>';
		    }
			
		}

		return '
			<select name="idKelas" class="form-control">
				'.$listKelas.'
			</select>
		';
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

	


}

/* End of file Tugas.php */
/* Location: ./application/controllers/aslab/Tugas.php */