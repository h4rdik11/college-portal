<?php

	/**
	* 
	*/
	class AttendanceUpload extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('teacher/header');
			$this->load->view('teacher/attendanceupload');
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


		public function attendance_upload(){
			$course = $this->input->post('course');
			$sem = $this->input->post('sem');
			$subject = $this->input->post('subject');
			$month = $this->input->post('month');
			$this->load->helper('file');
			$config['upload_path']          = './uploads/attendance';
            $config['allowed_types']        = 'xls|xlsx';
            $config['max_size']             = 6000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);
 			if($this->upload->do_upload('userfile')){
	 			$data = array();
	            $data = array($this->upload->data());
	            $file = $data[0]['full_path'];
	            $this->load->library('excel');
	            $objPHPExcel = PHPExcel_IOFactory::load($file); //loading file from full_path
		       	$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		       	foreach($cell_collection as $cell){
		       		$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		       		$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		       		$dataValue = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		       		if($row == 1){
		       			$header[$row][$column] = $dataValue;
		       		}
		       		else{
		       			$arr_data[$row][$column] = $dataValue;
		       		}
		       	}

		       	$index=0;
		       	foreach($arr_data as $value){
		       		$studentData[$index]['roll_no'] = $value['A'];
			       	$studentData[$index]['attended'] = $value['B'];
			       	$studentData[$index]['total'] = $value['C'];
			       	$studentData[$index]['percent'] = $value['D'];
			       	$index++;
		       	}

		       	$this->load->model('UploadAttendance');
		       	$upload_data = new UploadAttendance;
		       	for($i=0; $i<count($arr_data); $i++){
		       		$arr[$i] = array(
		       			'course' 		=> 		$course,
		       			'sem'			=> 		$sem,
		       			'sub_id'		=>		$subject,
		       			'month'			=>		$month,
		       			'roll_no'		=>		$studentData[$i]['roll_no'],
		       			'attended'		=>		$studentData[$i]['attended'],
		       			'total'			=>		$studentData[$i]['total'],
		       			'percent'		=>		$studentData[$i]['percent']
		       		);
		       	}
		       	$upload_data->input_atten($arr);
		       	redirect(base_url().'AttendanceUpload'); 	
 			} 
 			else{
 				$error = array('error' => $this->upload->display_errors(' ', ' '));
                $this->session->set_userdata($error);
                redirect(base_url().'AttendanceUpload');
 			}          
        	           	
		}

		public function getAttendance(){
			$post_data['course'] = $this->input->get('course');
			$post_data['sem'] = $this->input->get('sem');
			$post_data['subject'] = $this->input->get('subject');
			$post_data['month'] = $this->input->get('month');

			$this->load->model('UploadAttendance');
			$data = $this->UploadAttendance->displayAtt($post_data);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

	}
