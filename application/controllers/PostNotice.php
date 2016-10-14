<?php

	/**
	* 
	*/
	class PostNotice extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('teacher/header');
			$this->load->view('teacher/post_notice');
			$this->load->view('teacher/footer');			
		}
		public function notice_upload(){
			$config['upload_path']          = './uploads/notices';
            $config['allowed_types']        = 'doc|docx|pdf|xls|xlsx|txt';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
 			$subject = $this->input->post('subject');
			$msg = $this->input->post('msg');
	        /* Retrieving the data from db when user fields are not set */
            if ( ! $this->upload->do_upload('userfile'))
            {       
                    $error = array('error' => $this->upload->display_errors(' ', ' '));
                    $this->session->set_userdata($error);
                    redirect(base_url().'PostNotice');
            }
            else/* Putting data into db when file is set */
            {

            		$this->load->helper('date');
            		$user = $this->session->user;
			        $this->load->model('Teachers');
			        $t_name = $this->Teachers->getTeacher($user);
			        foreach($t_name as $value){
			            $teacher = $value->teacher_id;
			        }
                    $this->load->model('Subjects');
                    $classes = $this->Subjects->getTeacher($teacher);
                    foreach($classes as $value){
                    	
                    	$data = array();
	                    $data = array($this->upload->data());
						$submit_date = date('Y-m-d', strtotime(date('Y-m-d')));
				       	                    
	                    $this->load->model('PostNotices');
	                    $assign = new PostNotices;
	                    $assign->subject = $subject;
	                    $assign->message = $msg;
	                    $assign->course_code = $value->course_code;
	                    $assign->sem = $value->sem;
	                    $assign->date = $submit_date;
	                    $assign->file_name = $data[0]['file_name'];
	                    $assign->file = $data[0]['full_path'];
	                    $assign->teacher_id = $teacher;	                    
	                    $assign->save();
                    }

                   	redirect(base_url().'PostNotice');
            }

		}

        public function get_notice(){
            $this->load->model('PostNotices');
            $data = $this->PostNotices->getJSON();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function notice_download(){
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