<?php

	/**
	* 
	*/
	class ManageStudents extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('admin/header');

			$this->load->view('admin/manage_students');

			$this->load->view('admin/footer');
		}

		public function addStudent(){
			$this->load->model('Student');
			$stud = new Student;

			$post_data = file_get_contents('php://input');
			$captureData = json_decode($post_data);
			$stud->s_id = $captureData->student_id;
			$stud->roll_no = $captureData->roll;
			$stud->course_code = $captureData->course;
			$stud->stu_name = $captureData->name;
			$stud->sem = $captureData->semester;
			$stud->password = $captureData->password;
			$stud->save();
			echo "SUCCESS !!!";

		}

		public function getStudent(){
			$this->load->model('Student');
			$data = $this->Student->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}