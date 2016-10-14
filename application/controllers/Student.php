<?php

	/**
	* 
	*/
	class Student extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view('student/header');
			$this->load->view('student/footer');
		}
	}