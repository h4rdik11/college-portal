<?php

	 /**
	 * 
	 */
	 class TeacherCtlr extends CI_Controller
	 {
	 	
	 	public function index()
	 	{
	 		
	 		$this->load->view('teacher/header');
	 			$this->load->view('teacher/teacher');
	 		$this->load->view('teacher/footer');

	 	}
	 }