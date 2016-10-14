<?php
	
	/**
	* 
	*/
	class Announce extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('teacher/header');
			$this->load->view('teacher/post_announce');
			$this->load->view('teacher/footer');
		}

		public function announcement_upload(){
			$config['upload_path']          = './uploads/announcements';
            $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|ppt|pptx|txt';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
            $subject = $this->input->post('subject');
            $msg = $this->input->post('msg');
            $course = $this->input->post('course');
            $sem = $this->input->post('sem');

            if ( ! $this->upload->do_upload('userfile') && !$subject && !$msg && !$course && !$sem)
            {
                    $this->load->model('PostAnnounce');
    				$data = $this->PostAnnounce->getJSON();
    				$this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
            else if($subject && $msg && $course && $sem){
                    $this->load->helper('date');
                    
                    $submit_date = date('Y-m-d', strtotime(date('Y-m-d')));
                    $user = $this->session->user;
                    $this->load->model('Teachers');
                    $t_name = $this->Teachers->getTeacher($user);
                    foreach($t_name as $value){
                        $teacher = $value->teacher_id;
                    }

                    $this->load->model('PostAnnounce');
                    $assign = new PostAnnounce;
                    $assign->subject = $subject;
                    $assign->message = $msg;
                    $assign->course_code = $course;
                    $assign->sem = $sem;
                    $assign->date = $submit_date;
                    $assign->teacher_id = $teacher;                     
                    $assign->save();

                    redirect(base_url().'Announce');
            }
            else
            {
            		$this->load->helper('date');
            		
            		$submit_date = date('Y-m-d', strtotime(date('Y-m-d')));
                    $user = $this->session->user;
                    $this->load->model('Teachers');
                    $t_name = $this->Teachers->getTeacher($user);
                    foreach($t_name as $value){
                        $teacher = $value->teacher_id;
                    }

            		$data = array();
                    $data = array($this->upload->data());
                    $this->load->model('PostAnnounce');
                    $assign = new PostAnnounce;
                    $assign->subject = $subject;
                    $assign->message = $msg;
                    $assign->course_code = $course;
                    $assign->sem = $sem;
                    $assign->date = $submit_date;
                    $assign->file_name = $data[0]['file_name'];
                    $assign->file = $data[0]['full_path'];
                    $assign->teacher_id = $teacher;	                    
                    $assign->save();

                   	redirect(base_url().'Announce');
            }

		}

        public function getCourses(){
            $this->load->model('Courses');
            $data = $this->Courses->getJSON();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function announce_download(){
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