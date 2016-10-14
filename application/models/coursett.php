<?php 

	/**
	* 
	*/
	class CourseTT extends MY_Model
	{
		
		const DB_TABLE = 'course_tt';
		const DB_TABLE_PK = 'sno';

		public $sno;
		public $course;
		public $sem;
		public $date;
		public $file;
		public $file_path;

		public function getTT($course){
			$query = $this->db->order_by('date', 'DESC')->limit('6')->get_where($this::DB_TABLE,array(
				'course' => $course
			));

			$ret_val = array();
			$class = get_class($this);
			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$ret_val[] = $model;
			}

			return $ret_val;

		}
	}