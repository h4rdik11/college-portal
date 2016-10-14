<?php

	/**
	* 
	*/
	class PostAssignments extends MY_Model
	{		
		const DB_TABLE = 't_assignment';
		const DB_TABLE_PK = 'sno';
		const SEM = 'sem';
		const COURSE_CODE = 'course_code';

		public $sno;
		public $a_id;
		public $course_code;
		public $sem;
		public $subject;
		public $file;
		public $path;
		public $date;
		public $due_date;

		public function getAssigns($data){
			$query = $this->db->order_by('due_date', 'DESC')->get_where($this::DB_TABLE, array(
				'sem'			=>	$data['sem'],
				'course_code'	=>	$data['course_code']
			));

			$ret_val = [];
			$class = get_class($this);
			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$ret_val[] = $model;
			}
			return $ret_val;
		}
	}