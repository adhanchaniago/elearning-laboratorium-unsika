<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_HasilTugas');
		sesi();
	}

	public function upload()
	{
		$data = [
			'title' => 'Dashboard - Upload Tugas | ELABLTE',
			'content' => 'mahasiswa/tugas/upload',
			'js' => 'mahasiswa/tugas/js'
		];
		$this->load->view('template/template', $data, FALSE);
	}

	function cekKode($kode){
		if($this->M_HasilTugas->cekKode($kode)){
			$kode = $this->M_HasilTugas->cekKode($kode);
			if(date('Y-m-d H:i:s') < $kode[0]['deadLine']){
			    if($this->M_HasilTugas->checkTugasByNPM($this->session->npm, $kode[0]['idTugas']) == 0 ){
    				$message = [
    					'status' => true,
    					'message' => 'Kode ditemukan! Anda bisa mengirim tugas'
    				];
    				echo json_encode($message);
			    }
			    else {
			        $message = [
    					'status' => false,
    					'message' => 'Anda sudah mengirim tugas, hapus dulu tugas yang sudah diupload pada kode tugas ini baru upload ulang'
    				];
    				echo json_encode($message);
			    }
			}
			else {
				$message = [
					'status' => false,
					'message' => 'Anda sudah melewati waktu yang ditentukan'
				];
				echo json_encode($message);
			}
			
		}
		else{
			$message = [
				'status' => false,
				'message' => 'Kode tidak ditemukan'
			];
			echo json_encode($message);
		}
		// $dat = $this->M_HasilTugas->cekKode($kode);
		// echo json_encode($dat);
	}
	function cekKodeN($kode){
	    $detailTugas = $this->M_HasilTugas->get_detailTugas($kode);
		if($this->M_HasilTugas->cekKode($kode)){
			$kode = $this->M_HasilTugas->cekKode($kode);
			if(date('Y-m-d H:i:s') < $kode[0]['deadLine']){
			    if($this->M_HasilTugas->checkTugasByNPM($this->session->npm, $kode[0]['idTugas']) == 0 ){
    				$message = [
    					'status' => true,
    					'message' => 'Kode ditemukan! Anda bisa mengirim tugas'
    				];
    				return json_encode($message);
    			}
    			else {
    				$message = [
    					'status' => false,
    					'message' => 'Anda sudah mengirim tugas, hapus dulu tugas yang sudah diupload pada kode tugas ini baru upload ulang'
    				];
    				return json_encode($message);
    			}
			    
			}
			else {
    			$message = [
    					'status' => false,
    					'message' => 'Anda sudah melewati waktu yang ditentukan'
    				];
    				return json_encode($message);
			}
			
		}
		else{
			$message = [
				'status' => false,
				'message' => 'Kode tidak ditemukan'
			];
			return json_encode($message);
		}
		// $dat = $this->M_HasilTugas->cekKode($kode);
		// echo json_encode($dat);
	}

	function upload_proses(){
		$detailTugas = $this->M_HasilTugas->get_detailTugas($this->input->post('idTugas'));
		$statusTugas = json_decode($this->cekKodeN($this->input->post('idTugas')));
		if($detailTugas && $statusTugas->status){

			$nmfile = "tugas_".time().rand(1,255);
			$config['upload_path'] = './uploads/tugas/';//path folder
			$config['allowed_types'] = 'pdf|docx|rar|zip|apk'; //type yang dapat diakses bisa anda sesuaikan
			$config['file_name'] = $nmfile;
			$config['max_size']     = '10000';
			$config['remove_spaces'] = true;
			$this->load->library('upload',$config);


			if(!empty($_FILES['file_tugas']['name']))
			{
				if(!$this->upload->do_upload('file_tugas'))
				{
					$this->session->set_flashdata('tidakbolehuploadtugas', 'Tugas Gagal diupload! Ekstensi tidak diterima/Ukuran file terlalu besar.' );
					redirect(base_url('mahasiswa/tugas/upload'));
				}  
				else
				{
					$upload_data = $this->upload->data();
					$file = $upload_data['file_name'];
				}
			}
			

			$idTugas		= $detailTugas[0]['idTugas'];
			$idKelas		= $detailTugas[0]['idKelas'];
			$npm			= $this->session->npm;
			$tanggalKirim 	= date('Y-m-d H:i:s');
			$namaFile		= $file;
            if($file == NULL){
                	$this->session->set_flashdata('tidakbolehuploadtugas', 'Tugas Gagal diupload! File Gagal diupload, silahkan coba lagi menggunakan laptop!' );
					redirect(base_url('mahasiswa/tugas/upload'));
            }

			$tambahData = [
				'idTugas' 		=> $idTugas,
				'idKelas'		=> $idKelas,
				'npm'			=> $npm,
				'tanggalKirim'	=> $tanggalKirim,
				'namaFile'		=> $namaFile
			];
			// var_dump($tambahData);
			if($this->M_HasilTugas->add_HasilTugas($tambahData)){
			    $this->session->set_flashdata('uploadtugas', 'Tugas Berhasil diupload!' );
			    activity_log('mengupload', 'tugas', 'berhasil');
				redirect(base_url('mahasiswa/main'));
			}
			else {
			    $this->session->set_flashdata('tidakbolehuploadtugas', 'Tugas Gagal diupload!' );
			    activity_log('mengupload', 'tugas', 'gagal');
				redirect(base_url('mahasiswa/tugas/upload'));
			}

			
		}
		else {
			$this->session->set_flashdata('tidakbolehuploadtugas', $statusTugas->message );
			activity_log('mengupload', 'tugas', 'gagal');
			redirect(base_url('mahasiswa/tugas/upload'));
			
		}
	}

}

/* End of file Tugas.php */
/* Location: ./application/controllers/mahasiswa/Tugas.php */
?>