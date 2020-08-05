<?php

function activity_log($aksi, $item, $status, $npm = null){
    $CI =& get_instance();
    if($CI->session->userdata('npm') == null){
    	$param['log_user'] = $npm;
    }else {
    	$param['log_user'] = $CI->session->userdata('npm');
    }
    
    $param['log_aksi'] = $aksi; //mengupload, menghapus, mengedit, login
    $param['log_item'] = $item; //tugas, profile, login
    $param['log_status'] = $status;
    //load model log
    $CI->load->model('m_log');

    //save to database
    $CI->m_log->save_log($param);

}
?> 