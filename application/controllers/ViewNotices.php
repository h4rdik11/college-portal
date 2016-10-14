<?php

	/**
	* 
	*/
	class ViewNotices extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('student/header');
			$this->load->view('student/notices');
			$this->load->view('student/footer');
		}

		public function getNotices(){
			$user = $this->session->user;
			$this->load->model('Student');
			$student = $this->Student->getCourseSem($user);
			foreach($student as $value){
				$data['course_code'] = $value->course_code;
				$data['sem'] = $value->sem;
			}

			$this->load->model('PostNotices');
			$notices = $this->PostNotices->getNotices($data);
			$this->output->set_content_type('application/json')->set_output(json_encode($notices));
		}

		public function getAnnouncements(){
			$user = $this->session->user;
			$this->load->model('Student');
			$student = $this->Student->getCourseSem($user);
			foreach($student as $value){
				$data['course_code'] = $value->course_code;
				$data['sem'] = $value->sem;
			}

			$this->load->model('PostAnnounce');
			$notices = $this->PostAnnounce->getAnnouncements($data);
			$this->output->set_content_type('application/json')->set_output(json_encode($notices));
		}
	}