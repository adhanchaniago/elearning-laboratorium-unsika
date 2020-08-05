<?php 

if( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('info'))
{
    function info($tipe){
        $CI =& get_instance();
        $CI->db->from('tbl_labdata');
        $CI->db->where('name', $tipe);
        $query = $CI->db->get();
        return $query->row();
    }
}


