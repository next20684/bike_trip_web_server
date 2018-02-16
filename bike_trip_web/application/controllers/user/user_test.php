<?php

    class user_test extends CI_Controller {
    
        
        public function usernaja_get() {
           $arr['testResult'] = "testNaja";
		   echo json_encode($arr);
        }
        
       
    }
?>