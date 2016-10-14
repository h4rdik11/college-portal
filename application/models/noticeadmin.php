<?php

	/**
	* 
	*/
	class NoticeAdmin extends MY_Model
	{
		
		const DB_TABLE = 'admin_notices';
		const DB_TABLE_PK = 'n_id';

		public $n_id;
		public $date;
		public $subject;
		public $message;
		public $file_name;
		public $file;

		public function getNotice(){
			$query = $this->db->order_by('date', 'DESC')->limit('5')->get($this::DB_TABLE);
			$class = get_class($this);
			$ret_val = array();
			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$ret_val[] = $model;
			}
			return $ret_val;
		}
	}