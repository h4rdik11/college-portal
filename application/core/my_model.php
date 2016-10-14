<?php

	class MY_Model extends CI_Model{

		const DB_TABLE = 'abstract';
		const DB_TABLE_PK = 'abstract';

		/*** CREATE ***/
		private function insert(){
			$this->db->insert($this::DB_TABLE, $this);
			$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
		}

		/*** UPDATE ***/
		private function update(){
			$this->db->update($this::DB_TABLE, $this, $this::DB_TABLE_PK);
		}

		/*** POPULATE ***/
		public function populate($row){
			foreach($row as $key => $value){
				$this->$key = $value;
			}
		}

		/*** LOAD FROM DB ***/
		public function load($id){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::DB_TABLE_PK => $id,
			));
			$this->populate($query->row());
			
		}

		/*** DELETE ***/
		public function delete(){
			$this->db->delete($this::DB_TABLE, array(
				$this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK},
			));
			unset($this->{$this::DB_TABLE_PK});
		}

		/*** SAVE ***/
		public function save(){
			if(isset($this->{$this::DB_TABLE_PK}))
				$this->update();
			else
				$this->insert();
		}

		/*** GET FUNCTION ***/
		public function get($limit = 0, $offset = 0){
			if($limit)
				$query = $this->db->get($this::DB_TABLE, $limit, $offset);
			else
				$query = $this->db->get($this::DB_TABLE);

			$ret_val = array();
			$class = get_class($this);
			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$ret_val[$row->{$this::DB_TABLE_PK}] = $model;
			}
			return $ret_val;
		}

		/*** GET JSON FUNCTION ***/
		public function getJSON($limit = 0, $offset = 0){
			if($limit)
				$query = $this->db->get($this::DB_TABLE, $limit, $offset);
			else
				$query = $this->db->get($this::DB_TABLE);

			$ret_val = array();
			$class = get_class($this);
			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$ret_val[] = $model;
			}
			return $ret_val;
		}


		/* GET SUBJECT ACCORDING TO SEMESTER */
		public function getSubject($val){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::SUB_SEM => $val,
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

		/* GET  MARKS DETAILS */
		public function getDetails($val, $user){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::SEM => $val,
				$this::ROLL => $user
			));
			$return_arr = array();
			$class =  get_class($this);

			foreach($query->result() as $row){
				$model = new $class;
				$model->populate($row);
				$return_arr[] = $model;
			}
			return $return_arr;
		}

		/* GET ATTENDANCE OF STUDENT */
		public function getAttendance($sem, $month, $roll){
			$query = $this->db->get_where($this::DB_TABLE, array(
				$this::SEM 	=> 	$sem,
				$this::MONTH 	=> 	$month,
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