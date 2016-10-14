<?php 

	/**
	* 
	*/
	class PostNotes extends MY_Model
	{
		
		const DB_TABLE = 'notes';
		const DB_TABLE_PK = 'sno';

		public $sno;
		public $course;
		public $sem;
		public $subject;
		public $file_name;
		public $file_path;

		public function displayNotes($data){
			$arr = array(
				'sem'		=> 	$data['sem'],
				'course' 	=> 	$data['course'],
				'subject'	=> 	$data['subject']
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