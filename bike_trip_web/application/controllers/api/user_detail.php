<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require(APPPATH.'libraries/REST_Controller.php');

    class user_detail extends REST_Controller {
     
        public function __construct() {
            parent::__construct();
            
            //load user model
            $this->load->database();
            $this->load->model('user');
            $this->load->library('encryption');
            $this->load->library('encrypt');
            $this->load->library('session');
            $this->load->helper('string');
        }
        
        public function userdesc_post(){
            $appsessionId = $this->post('sessionId');
            $userData = $this->session->userdata('userData');
            $userName = $this->post('userName');
            
           $message = "App secId : ".$appsessionId." Web SecId : ".$userData['session_id'];
           $this->response(array('message' =>$message), REST_Controller::HTTP_OK);
        }
        public function get_userdesc_post(){
          
            $userName = $this->post('user_name');
            
//            $appsessionId =$userData['session_id'];//test done
            
            if($userName<>''){
                    $users = $this->user->getRow_user_desc($userName);
                     if(!empty($users)){
                     //set the response and exit
//                         $users[0]['status']=TRUE;
//                         $users[0]['message']='was get user.';
//                     $this->response($users, REST_Controller::HTTP_OK);
//                     
                     $this->response([
                         'status' => TRUE,
                         'message' => 'was get user.',
                         'user_name' => $users[0]['user_name'],
                         'reg_date' => $users[0]['reg_date'],
                         'user_desc_id' => $users[0]['user_desc_id'],
                         'full_name' => $users[0]['full_name'],
                         'birth_day' => $users[0]['birth_day'],
                         'tel_no' => $users[0]['tel_no'],
                         'mail' => $users[0]['mail'],
                         'remark' => $users[0]['remark'],
                         'district_code' => $users[0]['district_code'],
                         'district_name' => $users[0]['district_name'],
                         'province_code' => $users[0]['province_code'],
                         'province_name' => $users[0]['province_name']
                     ], REST_Controller::HTTP_OK);
                 }else{
                     //set the response and exit
                     $this->response([
                         'status' => FALSE,
                         'message' => 'No user were found.'
                     ], REST_Controller::HTTP_NOT_FOUND);
                 }                
            }else{
                  $this->response([
                         'status' => FALSE,
                         'message' => 'No user sent'
                     ], REST_Controller::HTTP_NOT_FOUND);
            }
//           $message = "App secId : ".$appsessionId." Web SecId : ".$userData['session_id'];
//           $this->response(array('message' =>$message), REST_Controller::HTTP_OK);
        }
    }
    ?>