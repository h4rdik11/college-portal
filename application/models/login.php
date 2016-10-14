<?php

	/**
	* 
	*/
	class Login extends CI_Model
	{
		
		public function verify($data)
		{
			$user = $data['user'];
			$pass = $data['pass'];
			$condition = "teacher_id =" . "'" . $user . "'AND password ="."'".$pass."'";
			$this->db->select('*');
			$this->db->from('teachers');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() == 1)
				return true;
			else 
				return false;
		}

		public function student_login($data){
			$user = $data['user'];
			$pass = $data['pass'];
			$condition = "s_id = "."'".$user."'AND password ="."'".$pass."'";
			$this->db->select('*');
			$this->db->from('students');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() == 1)
				return true;
			else
				return false;
		}

		public function admin_login($data){
			$user = $data['user'];
			$pass = $data['pass'];
			$condition = "admin_id = "."'".$user."'AND password ="."'".$pass."'";
			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() == 1)
				return true;
			else
				return false;
		}
	}