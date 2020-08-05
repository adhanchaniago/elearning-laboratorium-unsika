<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_HasilTugas extends CI_Model {

	//DATATABLES
    var $table = 'tbl_hasiltugas'; 
    var $column_order = array(null,'idKelas','npm','tanggalKirim','namaFile'); 
    var $column_search = array('idKelas','tanggalKirim','namaFile');
    var $order = array('id' => 'desc');  
 
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
 
    function get_datatables($npm)
    {
        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('npm',$npm);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($npm)
    {
        $this->_get_datatables_query();
        $this->db->where('npm',$npm);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($npm)
    {
        $this->db->from($this->table);
        $this->db->where('npm',$npm);
        return $this->db->count_all_results();
    }
    //DATATABLES

    function drop_HasilTugas($id){
        return $this->db->delete('tbl_hasiltugas',array('id'=>$id));
    }

    function cekKode($kode){
        $this->db->where('kodeTugas',$kode);
        if($this->db->get('tbl_tugas')->result_array() !=null){
            $this->db->where('kodeTugas',$kode);
            return $this->db->get('tbl_tugas')->result_array();
        }
        else {
            return false;
        }
        // return $this->db->get('tbl_tugas')->result_array();
    }
    function get_detailTugas($kodeTugas){
        $this->db->where('kodeTugas',$kodeTugas);
        return $this->db->get('tbl_tugas')->result_array();
    }
    function add_HasilTugas($data){
        return $this->db->insert('tbl_hasiltugas', $data);
    }
    
    function get_HasilTugas($id){
        $this->db->where('id',$id);
        return $this->db->get('tbl_hasiltugas')->result_array();
    }
    function getDetailTugasById($id){
        $this->db->where('idTugas', $id);
        return $this->db->get('tbl_tugas')->result_array();
    }
    function checkTugasByNPM($npm,$idTugas){
        $this->db->where('npm',$npm);
        $this->db->where('idTugas',$idTugas);
        return $this->db->get('tbl_hasiltugas')->num_rows();
    }
}

/* End of file M_HasilTugas.php */
/* Location: ./application/models/M_HasilTugas.php */
?>