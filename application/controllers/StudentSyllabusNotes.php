<?php

	/**
	* 
	*/
	class StudentSyllabusNotes extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('student/header');
			$this->load->view('student/syllabus_notes');
			$this->load->view('student/footer');
		}

		public function getSub(){
			$arr['sem'] = $this->input->get('sem');
			$roll = $this->session->user;
			$this->load->model('Student');
			$data = $this->Student->getCourseSem($roll);
			foreach($data as $value){
				$arr['course'] = $value->course_code;
			}
			$this->load->model('Subjects');
			$ret_sub = $this->Subjects->retSubs($arr);
			$this->output->set_content_type('application/json')->set_output(json_encode($ret_sub));
		}

		public function getSyllabus(){
			$arr['sem'] = $this->input->get('sem');
			$arr['subject'] = $this->input->get('subject');
			$roll = $this->session->user;
			$this->load->model('Student');
			$data = $this->Student->getCourseSem($roll);
			foreach($data as $value){
				$arr['course'] = $value->course_code;
			}
			$this->load->model('PostSyllabus');
			$ret_val = $this->PostSyllabus->displaySyllabus($arr);
			$this->output->set_content_type('application/json')->set_output(json_encode($ret_val));
		}

		public function getNotes(){
			$arr['sem'] = $this->input->get('sem');
			$arr['subject'] = $this->input->get('subject');
			$roll = $this->session->user;
			$this->load->model('Student');
			$data = $this->Student->getCourseSem($roll);
			foreach($data as $value){
				$arr['course'] = $value->course_code;
			}
			$this->load->model('PostNotes');
			$ret_val = $this->PostNotes->displayNotes($arr);
			$this->output->set_content_type('application/json')->set_output(json_encode($ret_val));
		}
	}