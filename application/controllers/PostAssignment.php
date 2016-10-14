<?php

	/**
	* 
	*/
	class PostAssignment extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('teacher/header');
	 			$this->load->view('teacher/post_assign');
	 		$this->load->view('teacher/footer');
		}

		public function teacher_upload(){

			$config['upload_path']          = './uploads/assignments/teacher';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|ppt|pptx|txt';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
            $course = $this->input->post('course');
            $sem = $this->input->post('sem');
            $due_date = date('Y-m-d', strtotime($this->input->post('date')));
            $assign_id = $this->input->post('a_id');
            $subject = $this->input->post('subject');

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $this->load->model('PostAssignments');
    				$data = $this->PostAssignments->getJSON();
    				$this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            else
            {       
                    print_r($_POST);
            		$this->load->helper('date');
            		$submit_date = date('Y-m-d', strtotime(date('Y-m-d')));
            		$data = array();
                    $data = array($this->upload->data());
                    $this->load->model('PostAssignments');
                    $ob = new PostAssignments;
                    $ob->sem = $sem;
                    $ob->due_date = $due_date;
                    $ob->date = $submit_date;
                    $ob->path = $data[0]['full_path'];
                    $ob->file = $data[0]['file_name'];
                    $ob->a_id = $assign_id;
                    $ob->course_code = $course;
                    $ob->subject = $subject;	                    
                    $ob->save();

                    redirect(base_url().'PostAssignment');
            }
		}

        public function getCourses(){
            $this->load->model('Courses');
            $data = $this->Courses->getJSON();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function getSubjects(){
            $this->load->model('Subjects');
            $data = $this->Subjects->getJSON();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function getAid(){
            $this->load->model('PostAssignments');
            $data = $this->PostAssignments->getJSON();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function assign_download(){
            //$post_data = file_get_contents('php://input');
            //$data = json_decode($post_data);
            $data['url'] = $this->input->get('url');
            $data['file_name'] = $this->input->get('file');
            $this->load->helper('file');

            $mime = get_mime_by_extension($data['url']);

            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($data['url'])).' GMT');
            header('Cache-Control: private',false);
            header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="'.$data['file_name'].'"');  // Add the file name
            header('Content-Length: '.filesize($data['url'])); // provide file size
            header('Connection: close');
            readfile($data['url']); // push it out
            exit();

        }

        public function getAssigns(){
            $post_data = file_get_contents('php://input');
            $data = json_decode($post_data);

            $this->load->model('StudentAssignment');
            $data2 = $this->StudentAssignment->getAssignID($data->id);
            $this->output->set_content_type('application/json')->set_output(json_encode($data2)); 
        }
	}