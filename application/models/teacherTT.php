<?php 

	/**
	* 
	*/
	class TeacherTT extends MY_Model
	{
		
		const DB_TABLE = 'teacher_tt';
		const DB_TABLE_PK = 'sno';

		public $sno;
		public $teacher_id;
		public $date;
		public $file;
		public $file_path;

		public function getTT(){
			$query = $this->db->order_by('date', 'DESC')->get_where($this::DB_TABLE);

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