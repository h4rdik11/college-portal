<?php

	/**
	* 
	*/
	class UploadAttendance extends MY_Model
	{
		
		const DB_TABLE = 'attendance';
		const DB_TABLE_PK = 'sno';

		public $sno;
		public $roll_no;
		public $month;
		public $course;
		public $sem;
		public $sub_id;
		public $attended;
		public $total;
		public $percent;

		public function input_atten($data){
			for($i=0; $i<count($data); $i++){
				$this->db->insert($this::DB_TABLE, $data[$i]);
				$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
			}
		}

		public function displayAtt($data){
			$arr = array(
				'sem'		=> 	$data['sem'],
				'course' 	=> 	$data['course'],
				'sub_id'	=> 	$data['subject'],
				'month'		=>	$data['month']
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