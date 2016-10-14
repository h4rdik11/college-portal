<?php

	class Teachers extends MY_Model{

		const DB_TABLE = 'teachers';
		const DB_TABLE_PK = 'sno';
		const TCH_USER = 'teacher_id';

		public $sno;
		public $teacher_id;
		public $name;
		public $desig;
		public $password;
		public $email;
		public $dept;

		/* GET TEACHER DETAILS */
		public function getTeacher($user){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::TCH_USER	=> 	$user
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