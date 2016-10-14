<?php

	/**
	* 
	*/
	class AssignSubmit extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('student/header');
				$this->load->view('student/assign_upload');
			$this->load->view('student/footer');
		}

		public function student_upload()
        {
                $config['upload_path']          = './uploads/assignments/student';
                $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|ppt|pptx|txt';
                $config['max_size']             = 6000;
                $config['max_width']            = 1920;
                $config['max_height']           = 1080;

                $this->load->library('upload', $config);
                $a_id = $this->input->post('a_id');
                $user = $this->session->user;
                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors(' ', ' '));
                        $this->session->set_userdata($error);
                        redirect(base_url().'AssignSubmit');
                }
                else
                {
                        $this->load->helper('date');
                        $submit_date = date('Y-m-d', strtotime(date('Y-m-d')));
                        $this->load->model('Student');
                        $details = $this->Student->getCourseSem($user);
                        foreach($details as $value){
                            $student['name'] = $value->stu_name;
                            $student['sem'] = $value->sem;
                            $student['course_code'] = $value->course_code;
                        }
                		$data = array();
                        $data = array($this->upload->data());
                        $this->load->model('StudentAssignment');
                        $assign = new StudentAssignment;
                        $assign->roll_no = $user;
                        $assign->a_id = $a_id;
                        $assign->student = $student['name'];
                        $assign->course_code = $student['course_code'];
                        $assign->sem = $student['sem'];
                        $assign->dos = $submit_date;
	                    $assign->file_name = $data[0]['file_name'];
	                    $assign->file_path = $data[0]['full_path'];	                    
                        $assign->save();
                        
                        redirect(base_url().'AssignSubmit');
                }
        }

        public function availableAssigns(){
            $user = $this->session->user;
            $this->load->model('Student');
            $details = $this->Student->getCourseSem($user);
            foreach($details as $value){
                $data['sem'] = $value->sem;
                $data['course_code'] = $value->course_code;
            }
            $this->load->model('PostAssignments');
            $assigns = $this->PostAssignments->getAssigns($data);
            $this->output->set_content_type('application/json')->set_output(json_encode($assigns));
        }

        /* Populating Submitted Assignments Table in student's view */
        public function getSubmittedAssigns(){
            $user = $this->session->user;
            $this->load->model('StudentAssignment');
            $assigns = new StudentAssignment;
            $data = $assigns->getSubmitted($user);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        /* End */

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

  	
  	}