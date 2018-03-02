<?php
require(APPPATH.'libraries/REST_Controller.php');

    class trip_master extends REST_Controller {
     
        public function __construct() {
            parent::__construct();
            
            //load user model
            $this->load->database();
            $this->load->model('trip');
            $this->load->library('encryption');
            $this->load->library('encrypt');
            $this->load->library('session');
            $this->load->helper('string');
        }
        
        function add_master_trip_post(){
//            print_r($_POST);
            $result = $this->trip->insert($_POST);
            
//            $this->response($result, REST_Controller::HTTP_OK);
             
                  if($result['status']){
                //set the response and exit
                $this->response([
                    'status' => $result['status'],
                    'trip_code' => $result['trip_cade']
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No user were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
            
        }
 
        
    }
?>