<?php

	/**
	* 
	*/
	class AdminNotice extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('admin/header');
			$this->load->view('admin/notices');
			$this->load->view('admin/footer');
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
                                       	
                	$data = array();
                    $data = array($this->upload->data());
					$submit_date = date('Y-m-d', strtotime(date('Y-m-d')));
			       	                    
                    $this->load->model('NoticeAdmin');
                    $assign = new NoticeAdmin;
                    $assign->subject = $subject;
                    $assign->message = $msg;
                    $assign->date = $submit_date;
                    $assign->file_name = $data[0]['file_name'];
                    $assign->file = $data[0]['full_path'];              
                    $assign->save();
                   

                   	redirect(base_url().'AdminNotice');
            }

		}

		public function getNotice(){
			$this->load->model('NoticeAdmin');
			$data = $this->NoticeAdmin->getJSON();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}


	}