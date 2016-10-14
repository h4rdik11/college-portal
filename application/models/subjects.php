<?php

	class Subjects extends MY_Model{

		const DB_TABLE = 'subjects';
		const DB_TABLE_PK = 'sno';
		const SUB_SEM = 'sem';
		const TEACHER = 'teacher_id';
		const COURSE = 'course_code';

		public $sno;
		public $s_name;
		public $course_code;
		public $sem;
		public $teacher_id;

		public function updateSub($id, $data){
			$this->db->where('sno', $id);
			$this->db->update('subjects', $data);
		}

		/* GET COURSE AND SEM TAUGHT BY TEACHER = $teacher */
		public function getTeacher($teacher){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::TEACHER => $teacher,
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

		public function getSubs($teacher, $data){

			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::TEACHER  => $teacher,
				$this::COURSE	=> $data['course'],
				$this::SUB_SEM	=> $data['sem']
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

		public function retSubs($data){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::COURSE	=> $data['course'],
				$this::SUB_SEM	=> $data['sem']
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