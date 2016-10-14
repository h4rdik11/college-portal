<?php

	/**
	* 
	*/
	class StudentAttendance extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('student/header');
				$this->load->view('student/attendance_display');
			$this->load->view('student/footer');
		}

		public function getAttendance(){
			$sem = $this->input->get('sem');
			$month = $this->input->get('month');
			$roll = $this->session->user;
			$this->load->model('Attendance');
			$data = $this->Attendance->getAttendance($sem, $month, $roll);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}