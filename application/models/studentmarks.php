<?php 

	/**
	* 
	*/
	class StudentMarks extends MY_Model
	{
		const DB_TABLE = 'marks';
		const DB_TABLE_PK = 'sno';
		const SEM = 'sem';
		const ROLL = 'roll_no';

		public $sno;
		public $student_name;
		public $roll_no;
		public $sub_id;
		public $course;
		public $sem;	
		public $internal1;
		public $internal2;
		public $assignment;
		public $total;

		public function displayMarks($data){
			$arr = array(
				'sem'		=> 	$data['sem'],
				'course' 	=> 	$data['course'],
				'sub_id'	=> 	$data['subject']
			);
			$query = $this->db->get_where($this::DB_TABLE, $arr);
			$class = get_class($this);
			$ret_val = [];
			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$ret_val[] = $model;
			}
			return $ret_val;
		}
	}