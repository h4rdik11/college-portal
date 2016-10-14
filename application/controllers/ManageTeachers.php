<?php

	/**
	* 
	*/
	class ManageTeachers extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('admin/header');

			$this->load->view('admin/manage_teacher');

			$this->load->view('admin/footer');
		}

		public function addTeacher(){
			$this->load->model('Teachers');
			$add = new Teachers;

			$post_data = file_get_contents('php://input');
			$data = json_decode($post_data);
			
			$add->teacher_id = $data->id;
			$add->name = $data->name;
			$add->desig = $data->desig;
			$add->password = $data->password;
			$add->email = $data->email;
			$add->dept = $data->dept;

			$add->save();
			echo('SUCCESS !!');

		}

		public function getTeacher(){
			$this->load->model('Teachers');
			$teachers = new Teachers;
			$data = $this->Teachers->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}