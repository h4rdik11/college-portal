<?php

	/**
	* 
	*/
	class Courses extends MY_Model
	{
		
		const DB_TABLE = 'courses';
		const DB_TABLE_PK = 'sno';

		public $sno;
		public $course_name;
		public $course_code;
		public $department;
		public $faculty;
	}