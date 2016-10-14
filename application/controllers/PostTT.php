<?php 

	/**
	* 
	*/
	class PostTT extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/timetable');
			$this->load->view('admin/footer');
		}

		public function getCourses(){
			$this->load->model('Courses');
			$data = $this->Courses->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function getTeacher(){
			$this->load->model('Teachers');
			$data = $this->Teachers->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		public function post_course_tt(){

			$config['upload_path']          = './uploads/time-table/course';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
            $course = $this->input->post('course');
            $sem = $this->input->post('sem');
            $date = date('Y-m-d', strtotime($this->input->post('date')));

            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors(' ', ' '));
                $this->session->set_userdata($error);
                redirect(base_url().'PostTT');
            }
            else
            {       
            		$data = array();
                    $data = array($this->upload->data());
                    $this->load->model('CourseTT');
                    $ob = new CourseTT;
                    $ob->course = $course;
                    $ob->sem = $sem;
                    $ob->date = $date;
                    $ob->file = $data[0]['file_name'];
                    $ob->file_path = $data[0]['full_path'];	                    
                    $ob->save();

                    redirect(base_url().'PostTT');
            }
		}

		public function post_teacher_tt(){

			$config['upload_path']          = './uploads/time-table/course';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
            $teacher = $this->input->post('teacher');
            $date = date('Y-m-d', strtotime($this->input->post('date')));

            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors(' ', ' '));
                $this->session->set_userdata($error);
                redirect(base_url().'PostTT');
            }
            else
            {       
            		$data = array();
                    $data = array($this->upload->data());
                    $this->load->model('TeacherTT');
                    $ob = new TeacherTT;
                    $ob->teacher_id = $teacher;
                    $ob->date = $date;
                    $ob->file = $data[0]['file_name'];
                    $ob->file_path = $data[0]['full_path'];	                    
                    $ob->save();

                    redirect(base_url().'PostTT');
            }
		}


	}