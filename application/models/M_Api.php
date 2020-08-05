<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Api extends CI_Model {

	function add_report($report){
		return $this->db->insert('tbl_keluhan', ['keluhan_text' => $report]);
	}

	function get_report(){
		$this->db->limit(10);
		return $this->db->get('tbl_keluhan')->result_array();
	}
	function count_report(){
		return $this->db->get('tbl_keluhan')->num_rows();
	}

}

/* End of file M_Api.php */
/* Location: ./application/models/M_Api.php */