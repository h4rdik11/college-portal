<?php

	/**
	* 
	*/
	class UploadMarks extends MY_Model
	{
		
		const DB_TABLE = 'marks';
		const DB_TABLE_PK = 'sno';

		public $sno;
		public $roll_no;
		public $sub_id;
		public $course;
		public $sem;
		public $internal1;
		public $internal2;
		public $assignment;
		public $total;

		public function input_marks($data){
			for($i=0; $i<count($data); $i++){
				$this->db->insert($this::DB_TABLE, $data[$i]);
				$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
			}
		}
	}