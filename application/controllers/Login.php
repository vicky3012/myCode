<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
    }
	
	public function index()
	{
		$data = array();
		$this->loadView('login',$data);
	}
	
	public function register()
	{
		$data = array();
		$this->loadView('registration',$data);
	}
	
	public function registration()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[255]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[255]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean|is_unique[users.email]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[10]|is_unique[users.mobile]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		if ($this->form_validation->run() == FALSE)
		{
			if(form_error('first_name')){
				echo json_encode(array('status'=>0, 'message'=>strip_tags(form_error('first_name'))));
			}
			elseif(form_error('last_name')){
				echo json_encode(array('status'=>0, 'message'=>strip_tags(form_error('last_name'))));
			}
			elseif(form_error('email')){
				echo json_encode(array('status'=>0, 'message'=>strip_tags(form_error('email'))));
			}
			elseif(form_error('mobile')){
				echo json_encode(array('status'=>0, 'message'=>strip_tags(form_error('mobile'))));
			}
			elseif(form_error('password')){
				echo json_encode(array('status'=>0, 'message'=>strip_tags(form_error('password'))));
			}
			elseif(form_error('confirm_password')){
				echo json_encode(array('status'=>0, 'message'=>strip_tags(form_error('confirm_password'))));
			}
		}
		else
		{
			$data = array(
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'mobile'=>$this->input->post('mobile'),
				'password'=>sha1($this->input->post('password')),
			);
			$this->login->insertAry('users',$data);
			echo json_encode(array('status'=>1, 'message'=>'Registered Successfull.'));
		}
	}
	
	public function check_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if(!isset($username) || empty($username)){
			echo json_encode(array('status'=>0, 'message'=>'Username is required.'));
		}
		elseif(!isset($password) || empty($password)){
			echo json_encode(array('status'=>0, 'message'=>'Password is required.'));
		}
		else{
			if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
				$where = array('mobile'=>$username);
			}else{
				$where = array('email'=>$username);
			}
			$result = $this->login->getRow('users',$where);
			if(isset($result) && !empty($result)){
				if($result->password == sha1($password)){
					if($result->status == 1){
						$session_data = array(
											'id'=>$result->id,
											'email'=>$result->email,
											'mobile'=>$result->mobile,
											'first_name'=>$result->first_name,
											'last_name'=>$result->last_name,
										);
						$this->session->set_userdata(['usersession'=>$session_data]);
						echo json_encode(array('status'=>1, 'message'=>'logged in successfully.'));
					}else{
						echo json_encode(array('status'=>0, 'message'=>'You are not authorized to login please conact to administrator.'));
					}
				}else{
					echo json_encode(array('status'=>0, 'message'=>'password not match.'));
				}
			}else{
				echo json_encode(array('status'=>0, 'message'=>'Username not found.'));
			}
		}
	}	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
		
		public function loadView($page,$data)
	{
		//$this->load->view('header',$data);
		$this->load->view($page,$data);
		//$this->load->view('footer',$data);
	}
}
