<?php

	/**
	* 
	*/
	class ManageSubjects extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view("admin/header");

				$this->load->model('teachers');
				$teacher = new Teachers;
				$data['teachers'] = $teacher->get();

				$this->load->view('admin/assign_teacher', $data);

			$this->load->view('admin/footer');
		}

		public function getSub(){			
			$sem = $this->input->get('sem');

			$this->load->model('Subjects');
			$subs = $this->Subjects->getSubject($sem);
			$this->output->set_content_type('application/json')->set_output(json_encode($subs));
		}

		public function submitAssignment(){
			$this->load->model('Subjects');
			$assign = new Subjects;

			$post_data = file_get_contents('php://input');
			$data = json_decode($post_data);
			
			$vals = array(
				'teacher_id' => $data->teacher,
			);

			$assign->updateSub($data->subject, $vals);
			print_r($data);
		}

		public function getAssign(){
			$this->load->model('Subjects');
			$subAssign = new Subjects;
			$subs = $this->Subjects->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($subs));
		}

		public function addSubject(){
			$this->load->model('Subjects');
			$subs = new Subjects;

			$post_data = file_get_contents('php://input');
			$data = json_decode($post_data);
						
			$subs->s_name = $data->subject;
			$subs->course_code = $data->course;
			$subs->sem = $data->sem;

			$subs->save();
			print_r($data);
		}

		public function subSelect(){			
			$this->load->model('Subjects');
			$subSelect = $this->Subjects->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($subSelect));
		}

	}