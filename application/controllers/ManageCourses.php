<?php

	/**
	* 
	*/
	class ManageCourses extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('admin/header');

			$this->load->view('admin/manage_course');

			$this->load->view('admin/footer');
		}


		public function addCourse(){
			$this->load->model('Courses');
			$course = new Courses;

			$post_data = file_get_contents('php://input');
			$data = json_decode($post_data);
			$course->course_name = $data->course_name;
			$course->course_code = $data->course_code;
			$course->department = $data->course_dept;
			$course->faculty = $data->course_fac;
			$course->save();

			echo "SUCCESS !!";

		}

		public function getCourse(){
			$this->load->model('Courses');
			$data = $this->Courses->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}