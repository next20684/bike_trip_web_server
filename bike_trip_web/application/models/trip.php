<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends CI_Model {
     var $table_name = 'trip_master';
    var $primary_key = 'trip_code';
    var $fields_insert =array('trip_code','user_name','trip_type_code','trip_rights','trip_date','trip_start','trip_end','trip_name','trip_desc','trip_intro_img');
    
   function insert($arrayObj){
//       print_r ($arrayObj);
            $sql_fields='';
            $sql_value ='';
            
            foreach ($arrayObj as $key => $value) {
            $sql_fields .= "{$key}, ";
            $sql_value .= "'{$value}', ";
        }
        $sql_fields .= "trip_code,active";
        $sql_value .= "'".$this->get_trip_code($arrayObj['trip_type_code'])."'," . "'Y'";
        $sql = "INSERT INTO {$this->table_name} ({$sql_fields}) VALUES ({$sql_value})";
//         echo $sql;
         $result = $this->db->query($sql);
          return $result;
    }
    function get_trip_code($ty_code){
//        $arrayObj['trip_type_code']=1;
        $date = date("Ymd");
        $this->db->select('trip_code');
        $row = $this->db->get('trip_master');
        $amount_row= $row->num_rows()+1;
        $y=substr($date, 2, 2);
        $m=substr($date, 4, 2);
        $d=substr($date, 6, 2);
        $trip_code = "$ty_code"."$y"."$m"."$d"."$amount_row";
        return $trip_code;
    }
}
?>