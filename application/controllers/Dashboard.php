<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model', 'dashboard');
    }
	
	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['menu'] = 'Dashboard';
		$this->loadView('dashboard',$data);
	}
	
	public function list()
	{
		$data['title'] = 'List';
		$data['menu'] = 'List';
		$data['user_list'] = $this->dashboard->getRows('users');
		$this->loadView('list',$data);
	}
	
	public function add_user()
	{
		$data['title'] = 'Add User';
		$data['menu'] = 'List';
		//$data['user_list'] = $this->dashboard->getRows('users');
		$this->loadView('add_user',$data);
	}
	
	
	public function save_user()
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
			$this->dashboard->insertAry('users',$data);
			echo json_encode(array('status'=>1, 'message'=>'User Added Successfully.'));
		}
	}
	
	
	
	public function loadView($page,$data)
	{
		$this->load->view('header',$data);
		$this->load->view($page,$data);
		$this->load->view('footer',$data);
	}
}
