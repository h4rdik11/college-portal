<?php

	/**
	* 
	*/
	class SyllabusNotes extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('teacher/header');
			$this->load->view('teacher/syllabusnotes');
			$this->load->view('teacher/footer');
		}

		public function getCourses(){
			$this->load->model('Courses');
			$data = $this->Courses->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function getSubs(){
			$post_data = file_get_contents('php://input');
			$data = json_decode($post_data);
			$arr['course'] = $data->course;
			$arr['sem'] = $data->sem;
			$user = $this->session->user;
			$this->load->model('Subjects');
			$subject = $this->Subjects->getSubs($user, $arr);
			$this->output->set_content_type('application/json')->set_output(json_encode($subject));
		}

		public function syllabus_upload(){

			$config['upload_path']          = './uploads/syllabus';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
            $course = $this->input->post('course');
            $sem = $this->input->post('sem');
            $subject = $this->input->post('subject');

            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors(' ', ' '));
                $this->session->set_userdata($error);
                redirect(base_url().'SyllabusNotes');
            }
            else
            {       
            		$data = array();
                    $data = array($this->upload->data());
                    $this->load->model('PostSyllabus');
                    $ob = new PostSyllabus;
                    $ob->sem = $sem;
                    $ob->file_path = $data[0]['full_path'];
                    $ob->file_name = $data[0]['file_name'];
                    $ob->course = $course;
                    $ob->subject = $subject;	                    
                    $ob->save();

                    redirect(base_url().'SyllabusNotes');
            }
		}

		public function notes_upload(){

			$config['upload_path']          = './uploads/notes';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
            $course = $this->input->post('course');
            $sem = $this->input->post('sem');
            $subject = $this->input->post('subject');

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors(' ', ' '));
                $this->session->set_userdata($error);
                redirect(base_url().'SyllabusNotes');
            }
            else
            {       
            		$data = array();
                    $data = array($this->upload->data());
                    $this->load->model('PostNotes');
                    $ob = new PostNotes;
                    $ob->sem = $sem;
                    $ob->file_path = $data[0]['full_path'];
                    $ob->file_name = $data[0]['file_name'];
                    $ob->course = $course;
                    $ob->subject = $subject;	                    
                    $ob->save();

                    redirect(base_url().'SyllabusNotes');
            }
		}

		public function getSyllabus(){
			$post_data['course'] = $this->input->get('course');
			$post_data['sem'] = $this->input->get('sem');
			$post_data['subject'] = $this->input->get('subject');

			$this->load->model('PostSyllabus');
			$data = $this->PostSyllabus->displaySyllabus($post_data);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function getNotes(){
			$post_data['course'] = $this->input->get('course');
			$post_data['sem'] = $this->input->get('sem');
			$post_data['subject'] = $this->input->get('subject');

			$this->load->model('PostNotes');
			$data = $this->PostNotes->displayNotes($post_data);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}