<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->load->view('welcome_message');
	}

	public function login(){
		$data['user'] = $this->input->post('user');
		$data['pass'] = $this->input->post('pass');

		$this->load->model('Login');
		if($this->Login->verify($data)){
			$config = array(
				'user' 		=> 	$data['user'],
				'logged_in'	=>	true

			);
			$this->session->set_userdata($config);
			$this->load->view('teacher/header');
			$this->load->view('teacher/teacher');
			$this->load->view('teacher/footer');
		}
		else{
			echo 'INVALID CREDENTIALS !!!';
		}
	}

	public function student_login(){
		$data['user'] = $this->input->post('user');
		$data['pass'] = $this->input->post('pass');

		$this->load->model('Login');
		if($this->Login->student_login($data)){
			$this->load->model('Student');
			$ret_val = $this->Student->getCourseSem($data['user']);
			foreach($ret_val as $value){
				$data['u_name'] = $value->stu_name;
			}
			$config = array(
				'user'		=> $data['user'],
				'u_name'	=> $data['u_name'],
				'logged_in'	=> true
			);
			$this->session->set_userdata($config);
			$this->load->view('student/header');
			$this->load->view('student/notices');
			$this->load->view('student/footer');
		}
		else{
			echo "INVALID CREDENTIALS !!";
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function getMCA(){
		$this->load->model('CourseTT');
		$data = $this->CourseTT->getTT('MCA');
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getTeacherTT(){
		$this->load->model('TeacherTT');
		$data = $this->TeacherTT->getTT();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getAdminNotice(){
		$this->load->model('NoticeAdmin');
		$data = $this->NoticeAdmin->getNotice();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
