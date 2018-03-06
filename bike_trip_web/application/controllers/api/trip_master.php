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
                    'trip_code' => $result['trip_code']
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'can not add master trip'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
            
        }
                function edit_master_trip_post(){
            $result = $this->trip->update($_POST); 
                  if($result['status']){
                //set the response and exit
                $this->response([
                    'status' => $result['status'],
                    'trip_code' => $result['trip_code']
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'can not edit master trip'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
            
        }
                 function select_id_master_trip_post(){
                 
            $result = $this->trip->select_by_id(null,$_POST['id']); 
            
                  if($result){
                //set the response and exit
//      array('trip_code','user_name','trip_type_code','trip_rights','trip_date','trip_start','trip_end','trip_name','trip_desc','trip_intro_img','trip_status');
                   $this->response([
                         'status' => TRUE,
                         'message' => 'was get MAster trip.',
                         'trip_code' => $result[0]['trip_code'],
                         'user_name' => $result[0]['user_name'],
                         'trip_type_code' => $result[0]['trip_type_code'],
                         'trip_rights' => $result[0]['trip_rights'],
                         'trip_date' => $result[0]['trip_date'],
                         'trip_start' => $result[0]['trip_start'],
                         'trip_end' => $result[0]['trip_end'],
                         'trip_name' => $result[0]['trip_name'],
                         'trip_desc' => $result[0]['trip_desc'],
                         'trip_intro_img' => $result[0]['trip_intro_img'],
                         'trip_status' => $result[0]['trip_status']
                     ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'can not select_id master trip'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
            
        }
 
        
    }
?>