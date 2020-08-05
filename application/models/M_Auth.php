<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Auth extends CI_Model {

	//DATATABLES
    var $table = 'tbl_aslab'; 
    var $column_order = array(null,'username','namaLengkap'); 
    var $column_search = array('username','namaLengkap');
    var $order = array('idAslab' => 'desc');  
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
  
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    //DATATABLES


	function check($account){
		return $this->db->get_where('tbl_mahasiswa',$account);
	}

	function try($account){
		if($this->db->insert('tbl_mahasiswa', $account)){
		    return true;
		}
		else {
		    return false;
		}
	}

	function checkAslab($account){
		return $this->db->get_where('tbl_aslab',$account);
	}
	function tryAslab($account){
		return $this->db->insert('tbl_aslab', $account);
	}
	function Cek_npm($npm){
	    $this->db->where('npm',$npm);
	    $this->db->escape($npm);
	    return $this->db->get('tbl_mahasiswa')->num_rows();
	}
    function getMhs($npm){
        $this->db->where('npm',$npm);
        $this->db->escape($npm);
        return $this->db->get('tbl_mahasiswa');
    }
    function updateProfile($data,$npm){
        // $this->updateNPMTUGAS($data['npm']);
        $this->db->where('npm',$npm);
        $this->db->escape($npm);
        return $this->db->update('tbl_mahasiswa', $data);
    }
    function updateNPMTUGAS($npm,$npmlama){
        $this->db->set('npm',$npm);
        $this->db->escape($npm);
        $this->db->where('npm',$npmlama);
        return $this->db->update('tbl_hasiltugas');
    }
    // function cookie_check($cookie){
    //     $this->db->where('password', $cookie);
    //     $this->db->get('tbl_mahasiswa')->num_rows();
    // }
	

}

/* End of file M_Auth.php */
/* Location: ./application/models/M_Auth.php */
?>