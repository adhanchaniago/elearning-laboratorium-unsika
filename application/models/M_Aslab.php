<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Aslab extends CI_Model {

	//DATATABLES
    var $table = 'tbl_kelas'; 
    var $column_order = array(null, 'idMataKuliah','tahun','semester','hurufKelas','idAslab'); 
    var $column_search = array('tahun','semester','hurufKelas');
    var $order = array('idKelas' => 'desc');  
 
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

    //LIST
   	function get_nmMataKuliah($id){
   		$this->db->where('idMKuliah',$id);
   		return $this->db->get('tbl_matakuliah')->result_array();
    }
    function get_nmJurusanKuliah($id){
        $this->db->select('jurusan');
        $this->db->where('idMKuliah',$id);
        return $this->db->get('tbl_matakuliah')->result_array();
    }   
   	function get_nmAslab($id){
   		$this->db->select('namaLengkap');
   		$this->db->where('idAslab',$id);
   		return $this->db->get('tbl_aslab')->result_array();
   	}
   	function drop_kelas($id){
   		return $this->db->delete('tbl_kelas',array('idKelas'=>$id));
   	}

   	function get_MataKuliah(){
	   	return $this->db->get('tbl_matakuliah')->result_array();   
	}


	function create_kelas($data){
    	return $this->db->insert('tbl_kelas',$data);
    }

    function create_praktikum($data){
    	return $this->db->insert('tbl_matakuliah',$data);
    }

    function get_kelasById($id){
    	$this->db->where('idKelas',$id);
    	return $this->db->get('tbl_kelas')->result_array();
    }

    function get_kelas(){
    	return $this->db->get('tbl_kelas')->result_array();
    }

    function get_tugas($id){
        $this->db->where('idTugas',$id);
        return $this->db->get('tbl_tugas')->result_array();
    }
    function count_tugas(){
        return $this->db->get('tbl_tugas')->num_rows();
    }
    function count_hasiltugas(){
        return $this->db->get('tbl_hasiltugas')->num_rows();
    }
    function count_kelas(){
        return $this->db->get('tbl_kelas')->num_rows();
    }


}

/* End of file M_Aslab.php */
/* Location: ./application/models/M_Aslab.php */
?>