	<?php


	/**
	* 
	*/
	class Student extends MY_Model
	{
		
		const DB_TABLE = 'students';
		const DB_TABLE_PK = 'sno';
		const S_ID = 's_id';

		public $sno;
		public $s_id;
		public $roll_no;
		public $stu_name;
		public $course_code;
		public $sem;
		public $password;

		public function insertStudent($data){
			$this->db->insert($this::DB_TABLE,$data);
		}

		public function getCourseSem($user){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::S_ID => $user,
			));

			$return_arr = array();
			$class = get_class($this);

			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$return_arr[] = $model;
			}

			return $return_arr;
		}
	}