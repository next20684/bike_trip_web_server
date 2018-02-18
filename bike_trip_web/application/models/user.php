<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
    
    
    /*
     * Fetch user data
     */
    function getRows($userName = ""){
        if(!empty($userName)){
            $query = $this->db->where('user_name = "'.$userName.'" COLLATE utf8_bin');
//             $query = $this->db->get_where('us_user', array('user_name' => $userName));
            $query = $this->db->get('us_user');
//             return $query->row_array();
            return $query->result_array();
        }else{
            $query = $this->db->get('us_user');
            return $query->result_array();
        }
    }
        function getRow_user_desc($userName = ""){
        if(!empty($userName)){
            $query = $this->db->where('user_name = "'.$userName.'" COLLATE utf8_bin');
//             $query = $this->db->get_where('us_user', array('user_name' => $userName));
            $query = $this->db->get('vw_user_info');
//             return $query->row_array();
            return $query->result_array();
        }else{
            $query = $this->db->get('us_user');
            return $query->result_array();
        }
    }
    function authen_user($userName ,$password){
        $this->db->where('ACTIVE = "Y"');
        $this->db->where('user_name = "'.$userName.'" COLLATE utf8_bin');
        $this->db->where('password = "'.$password.'" COLLATE utf8_bin');
//             $query = $this->db->get_where('us_user', array('user_name' => $userName));
            $query = $this->db->get('us_user');
//             return $query->row_array();
            return $query->result_array();
        
    }
    
}
?>