<?php
require(APPPATH.'libraries/REST_Controller.php');

    class user_login extends REST_Controller {
     
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
        
        public function usernaja_get() {
            //returns all rows if the id parameter doesn't exist,
            //otherwise single row will be returned
            $id = $this->get('id');
            echo 'userID On Get : ' .$id .'|';
            $users = $this->user->getRows($id);
            
            //check if the user data exists
            if(!empty($users)){
                //set the response and exit
                $this->response($users, REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No user were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        
        public function authen_user_post() {
            //returns all rows if the id parameter doesn't exist,
            //otherwise single row will be returned
            $userName = $this->post('userName');
            $password = $this->post('password');
//             $this->encrypt->set_cipher('AES-256');
            $users = $this->user->authen_user($userName,$password);
            
            //check if the user data exists
            if(!empty($users)){
                //set the response and exit
               //echo json_encode($users);
			   //echo $users[0]["user_name"];
                $sess_id = random_string('unique', 32);
                $session_data = array(
                    'session_id' =>$sess_id,
                    'user_name' => $users[0]['user_name']
                );
                
                $this->session->set_userdata('userData',$session_data);
                
                $this->response([
				'status' => TRUE,
				'session_id' =>$sess_id,
				'user_name' => $users[0]['user_name'],
				'message' => 'Login OK'
				], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
					'session_id' =>'',
					'user_name' => '',
                    'message' => 'No user were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        
     
        
        
        function login_post(){
            $sess_id = random_string('unique', 32);
            $session_data = array(
                'session_id' =>$sess_id
            );
            
            $this->session->set_userdata('userData',$session_data);
            
            $this->response(array('session_id' =>$sess_id), REST_Controller::HTTP_OK);
        }
        function logout_post(){
            //             $this->session->unset_userdata(array('username','auth'));
            $this->session->unset_userdata('userData');
            $this->response(array('logout'=>TRUE), REST_Controller::HTTP_OK);
        }
        
        function get_user_desc_post(){
            
                $userData = $this->session->userdata('userData');
                if($userData['session_id']==$this->post('sessionId')){
                $this->response(array('user_name' =>$userData['user_name']), REST_Controller::HTTP_OK);
            }else{
                $this->response(array('message' =>'Fail'), REST_Controller::HTTP_OK);
                
            }
        }
        
        function check_sission_user($sessionId){
            
            $userData = $this->session->userdata('userData');
            
            if(!empty($userData)){
                if($userData['session_id']==$sessionId){
                   return true;
                }else{
                    return false;
                }
                
            }else{
                return false;
            }
        }
    }
?>