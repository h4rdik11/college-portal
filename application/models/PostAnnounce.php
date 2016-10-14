<?php
	
	/**
	* 
	*/
	class PostAnnounce extends MY_Model
	{
		
		const DB_TABLE = 'announcements';
		const DB_TABLE_PK = 'ann_no';
		const COURSE_CODE = 'course_code';
		const SEM = 'sem';

		public $ann_no;
		public $date;
		public $subject;
		public $message;
		public $file_name;
		public $file;
		public $course_code;
		public $sem;
		public $teacher_id;

		public function getAnnouncements($data){
			$query = $this->db->order_by('date', 'DESC')->get_where($this::DB_TABLE, array(
				$this::COURSE_CODE => $data['course_code'],
				$this::SEM => $data['sem'],
			));

			$ret_val = [];
			$class = get_class($this);
			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$ret_val[] = $model;
			}
			return $ret_val;
		}
	}