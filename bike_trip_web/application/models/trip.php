<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends CI_Model {
     var $table_name = 'trip_master';
    var $primary_key = 'trip_code';
    var $fields_insert =array('trip_code','user_name','trip_type_code','trip_rights','trip_date','trip_start','trip_end','trip_name','trip_desc','trip_intro_img');
    var $fields_update =array('trip_type_code','trip_rights','trip_date','trip_start','trip_end','trip_name','trip_desc','trip_intro_img');
    
        function select_by_id($field = array(), $id)
    {
        $sql = "SELECT " . (empty($field) ? "*" : implode($field, ",")) . ' ';
        $sql .= "FROM {$this->table_name} ";
        $sql .= "WHERE {$this->primary_key} = '{$id}' ";
        $sql .= "AND (active='Y') ";
        
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    
   function insert($arrayObj){
//       print_r ($arrayObj);
            $sql_fields='';
            $sql_value ='';
            
            foreach ($arrayObj as $key => $value) {
            $sql_fields .= "{$key}, ";
            $sql_value .= "'{$value}', ";
        }
        $sql_fields .= "trip_code,active";
        $sql_fields .= ",trip_date";
        $trip_code = $this->get_trip_code($arrayObj['trip_type_code']);
        $sql_value .="'".$trip_code."'," . "'Y'";
        $date = date("Y-m-d");
        $sql_value .=",'".$date."'";
        $sql = "INSERT INTO {$this->table_name} ({$sql_fields}) VALUES ({$sql_value})";
//         echo $sql;
         $result = $this->db->query($sql);
          return array('status'=>$result,'trip_code'=>$trip_code);
    }

     function update($arrayObj)
    {
//        $this->adodb->debug;
        $sql = "UPDATE {$this->table_name} SET ";
        foreach ($arrayObj as $key => $value) {            
            if($this->primary_key != $key ){//ถ้าไม่ใช่ PK key
                $sql .= "$key='$value', ";
            }            
        }
        $sql .= "active='Y' ";
        $sql .= "WHERE {$this->primary_key} = '{$arrayObj[$this->primary_key]}' ";
//        echo $sql;
       $result = $this->db->query($sql);
       return array('status'=>$result,'trip_code'=>$arrayObj[$this->primary_key]);
    }
    function get_trip_code($ty_code){
//        $arrayObj['trip_type_code']=1;
        $date = date("Y-m-d");
        $this->db->select('trip_code');
        $this->db->where("trip_date = '".$date."'");
        $row = $this->db->get('trip_master');
        $amount_row= $row->num_rows()+1;
        $y=substr($date, 2, 2);
        $m=substr($date, 5, 2);
        $d=substr($date,8, 2);
        $amount_row = sprintf("%03d",$amount_row);
        $ty_code = sprintf("%02d",$ty_code);
        $trip_code = "$ty_code"."$y"."$m"."$d"."$amount_row";
        return $trip_code;
    }
}
?>