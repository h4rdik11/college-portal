<?php

	/**
	* 
	*/
	class Marks extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('student/header');
			$this->load->view('student/marks_display');
			$this->load->view('student/footer');
		}
		
		public function getMarks(){
			$sem = $this->input->get('sem');
			$user = $this->session->user;
			$this->load->model('StudentMarks');
			$model = new StudentMarks;
			$data = $model->getDetails($sem, $user);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} 

	}