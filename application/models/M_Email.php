<?php
class M_Email extends CI_Model {
            

    function verifyEmailAddress($verificationcode){
        
        $data = array(
            'active_status' => 'active'
        );
        
        $this->db->where('email', $verificationcode);
        return $this->db->update('tbl_mahasiswa', $data);
    }
    
    function sendVerificatinEmail($email,$verificationText){
        $this->load->library('encryption');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.labkompunsika.com',
            'smtp_port' => 465,
            'smtp_user' => 'admin@labkompunsika.com', // change it to yours
            'smtp_pass' => 'LABKOMPUNSIKA', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('admin@labkompunsika.com', "Admin Asisten Laboratorium");
        $this->email->to($email);  
        $this->email->subject("Verification Email");
        $this->email->message("Halo, <br>
        Untuk verifikasi silahkan klik link ini\n\n http://elearning.labkompunsika.com/verify?verifCode=".$this->encryption->encrypt($verificationText)."\n"."\n\n
        Terimakasih <br> Admin Asisten Laboratorium\n\n(Email Tidak Bisa Di Reply, silahkan hubungi (WA) 0895-3325-48343 (Dika) Bila tidak bisa login)");
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
    
    function recoveryPassword($email,$verificationText){

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.labkompunsika.com',
            'smtp_port' => 465,
            'smtp_user' => 'admin@labkompunsika.com', // change it to yours
            'smtp_pass' => 'LABKOMPUNSIKA', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('admin@labkompunsika.com', "Admin Asisten Laboratorium");
        $this->email->to($email);  
        $this->email->subject("Ganti Password");
        $this->email->message("Halo, <br>
        Untuk verifikasi silahkan klik link ini\n\n http://elearning.labkompunsika.com/new_password?kode=".$this->encryption->encrypt($verificationText)."\n"."\n\n
        Terimakasih <br> Admin Asisten Laboratorium");
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
    
    function cek_email($email){
        $this->db->where('email',$email);
        if($this->db->get('tbl_mahasiswa')->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    function update_password($npm,$newPass){
        $data = [
            'password' => $newPass
        ];
        $this->db->where('npm',$npm);
        $this->db->escape($npm);
        return $this->db->update('tbl_mahasiswa', $data);
    }
    
    function cekNPM($npm){
        $this->db->where('npm',$npm);
        return $this->db->get('tbl_mahasiswa')->num_rows();
    }
    
    function cekEmail($email){
        $this->db->where('email',$email);
        $this->db->get('tbl_mahasiswa')->num_rows();
    }
    
    
    
}
?>