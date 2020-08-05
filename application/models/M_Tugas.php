<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Tugas extends CI_Model {

	//DATATABLES
    var $table = 'tbl_tugas'; 
    var $column_order = array(null, 'idKelas','kodeTugas','pertemuan','deadLine','dibuat'); 
    var $column_search = array('kodeTugas','pertemuan','dibuat');
    var $order = array('idTugas' => 'desc');  
 
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

    function create_tugas($data){
    	return $this->db->insert('tbl_tugas',$data);
    }
    function drop_tugas($id){
   		return $this->db->delete('tbl_tugas',array('idTugas'=>$id));
   	}
    function get_list_tugas($id){
        $this->db->where('idTugas',$id);
        return $this->db->get('tbl_hasiltugas')->result_array();
    }
    function get_tugas($id){
        $this->db->where('id',$id);
        return $this->db->get('tbl_hasiltugas')->result_array();
    }
    
    function get_tugas_all($id){
        $this->db->where('idTugas',$id);
        return $this->db->get('tbl_hasiltugas')->result();
    }

}

/* End of file M_Tugas.php */
/* Location: ./application/models/M_Tugas.php */
