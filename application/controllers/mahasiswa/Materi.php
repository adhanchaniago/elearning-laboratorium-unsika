<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			//Do your magic here
			$this->load->helper(array('form', 'url'));
			$this->load->model('M_Materi');
			$this->load->model('M_Aslab');
			sesi();
	}

	public function List()
	{
		$data = [
			'title' => 'Dashboard - List Materi | ELABLTE',
			'content' => 'mahasiswa/materi/list',
			'dtable' => 'mahasiswa/materi/dtable_get_list'
		];
		$this->load->view('template/template', $data, FALSE);
	}
	function dtable_get_list(){
		$list = $this->M_Materi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $namaMK = $this->detail($field->idMkuliah,'mk');
            $row = array(); 
            $row[] = $no;
            $row[] = $namaMK[0]['namaMKuliah'];;
            $row[] = $field->dosen;
            $row[] = '
            	<a class="btn btn-sm btn-primary m-1" href="'.base_url().'uploads/materi/'.$field->namaFile.'" title="Download"><i class="fa fa-download"></i></a>
        			';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Materi->count_all(),
            "recordsFiltered" => $this->M_Materi->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
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

}

/* End of file Materi.php */
/* Location: ./application/controllers/mahasiswa/Materi.php */
?>