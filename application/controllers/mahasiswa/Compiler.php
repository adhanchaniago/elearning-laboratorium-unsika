<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Compiler extends CI_Controller {

	public function index()
	{
		$data = [
			'title' => 'Dashboard - List Compiler| ELABLTE',
			'content' => 'mahasiswa/compiler/list',
		];
		$this->load->view('template/template', $data, FALSE);
	}

	function java(){
		$data = [
			'title' => 'Dashboard - Java Compiler| ELABLTE',
			'content' => 'mahasiswa/compiler/show',
			'bahasa'=> 'java'
 		];
		$this->load->view('template/template', $data, FALSE);
	}

	function python(){
		$data = [
			'title' => 'Dashboard - Python Compiler| ELABLTE',
			'content' => 'mahasiswa/compiler/show',
			'bahasa'=> 'python'

		];
		$this->load->view('template/template', $data, FALSE);
	}

	function cplusplus(){
		$data = [
			'title' => 'Dashboard - C++ Compiler| ELABLTE',
			'content' => 'mahasiswa/compiler/show',
			'bahasa'=> 'cplusplus'
		];
		$this->load->view('template/template', $data, FALSE);
	}

	function php(){
		$data = [
			'title' => 'Dashboard - PHP Compiler| ELABLTE',
			'content' => 'mahasiswa/compiler/show',
			'bahasa'=> 'php'
		];
		$this->load->view('template/template', $data, FALSE);
	}

	function octave(){
		$data = [
			'title' => 'Dashboard - Octave/Matlab Compiler| ELABLTE',
			'content' => 'mahasiswa/compiler/show',
			'bahasa'=> 'octave'
		];
		$this->load->view('template/template', $data, FALSE);
	}

	function r(){
		$data = [
			'title' => 'Dashboard - R Compiler| ELABLTE',
			'content' => 'mahasiswa/compiler/show',
			'bahasa'=> 'r'
		];
		$this->load->view('template/template', $data, FALSE);
	}

}

/* End of file Compiler.php */
/* Location: ./application/controllers/mahasiswa/Compiler.php */