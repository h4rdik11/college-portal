<?php

	/**
	* 
	*/
	class StudentAssignment extends MY_Model
	{
		
		const DB_TABLE = 's_assignment';
		const DB_TABLE_PK = 'sno';
		const A_ID = 'a_id';
		const ROLL = 'roll_no';

		public $sno;
		public $dos;
		public $roll_no;
		public $student;
		public $course_code;
		public $a_id;
		public $sem;
		public $file_name;
		public $file_path;

		public function getAssignID($id){
			$query = $this->db->get_where($this::DB_TABLE,array(
				$this::A_ID => $id
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

		public function getSubmitted($roll){
			$query = $this->db->order_by('dos', 'DESC')->get_where($this::DB_TABLE,array(
				$this::ROLL => $roll
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