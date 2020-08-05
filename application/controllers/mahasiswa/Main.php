<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_HasilTugas');
		$this->load->model('M_Aslab');
		$this->load->library('encryption');
		sesi();
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard | ELABLTE',
			'content' => 'mahasiswa/main',
			'dtable' => 'mahasiswa/dtable_get_list'
		];
		$this->load->view('template/template', $data, FALSE);
	}

	function dtable_get_list(){
		$list = $this->M_HasilTugas->get_datatables($this->session->npm);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

        		$no++;
	            $row = array(); 
	            $tugas_det = $this->getDetailTugas($field->idTugas);
	            $row[] = $no;
	            $row[] = $this->detail($field->idKelas,'kl');
	            $row[] = $tugas_det[0]['pertemuan'];
	            $row[] = $field->tanggalKirim;
	            $row[] = '
	            	<a class="btn btn-sm btn-danger m-1" href="javascript:void(0)" title="Hapus" onclick="deleteTugas('."'".$this->encryption->encrypt($field->id)."'".')"><i class="fa fa-trash"></i></a>
	            	<a class="btn btn-sm btn-primary m-1" href="'.base_url().'uploads/tugas/'.$field->namaFile.'" title="Download"><i class="fa fa-download"></i></a>
	        			';
	 
	            $data[] = $row;

        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_HasilTugas->count_all($this->session->npm),
            "recordsFiltered" => $this->M_HasilTugas->count_filtered($this->session->npm),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}
	
	function getDetailTugas($idtugas){
	    $data = $this->M_HasilTugas->getDetailTugasById($idtugas);
	    return $data;
	}

	function dtable_drop_row(){
	    $id = $this->encryption->decrypt($this->input->post('Id'));
	    $getFile = $this->M_HasilTugas->get_HasilTugas($id);
	    if(unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/tugas/'.$getFile[0]['namaFile'])){
	        if($this->M_HasilTugas->drop_HasilTugas($id)){
    			return true;
    		}
	    }
	    else {
	        return false;
	    }
		
	}

	function detail($id, $action){
		$data = 0;
		if($action == 'mk'){
			$data = $this->M_Aslab->get_nmMataKuliah($id);
		}
		elseif ($action == 'as') {
			$data = $this->M_Aslab->get_nmAslab($id);
		}
		elseif ($action == 'kl') {
			$kelas = $this->M_Aslab->get_kelasById($id);
			$namaMKul = $this->M_Aslab->get_nmMataKuliah($kelas[0]['idMataKuliah']);
			$data = $namaMKul[0]['namaMKuliah'].' '.$kelas[0]['tahun'].' '.$kelas[0]['hurufKelas'];
		}
		return $data;
	}
	
// 	function hapus($id){
// 	    $getFile = $this->M_HasilTugas->get_HasilTugas($id);
// 	    echo $getFile[0]['namaFile'];
// 	    //if(unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/tugas/tugas_158245114219.pdf'));
// 	}


}

/* End of file Main.php */
/* Location: ./application/controllers/Mahasiswa/Main.php */
?>