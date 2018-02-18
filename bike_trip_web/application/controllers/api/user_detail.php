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
            
           $message = "App secId : ".$appsessionId." Web SecId : ".$userData['session_id'];
           $this->response(array('message' =>$message), REST_Controller::HTTP_OK);
        }
    }
    ?>