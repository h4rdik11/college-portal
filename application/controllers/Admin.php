<?php 

	class Admin extends CI_Controller{

		public function index(){

			$this->load->view("admin/login_header");

			$this->load->view('admin/index');

			$this->load->view('admin/login_footer');

		}

		public function login(){
			$data['user'] = $this->input->post('user');
			$data['pass'] = $this->input->post('pass');

			$this->load->model('Login');
			if($this->Login->admin_login($data)){
				$config = array(
				'user' 		=> 	$data['user'],
				'logged_in'	=>	true

				);
				$this->session->set_userdata($config);
				$this->load->view('admin/header');
				$this->load->view('admin/footer');
			}
		}

		public function notices(){

			$this->load->view("header");

			$this->load->view('ADMIN/notices');

			$this->load->view('footer');

		}

	}