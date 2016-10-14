<?php 

	/**
	* 
	*/
	class AdminModel extends MY_Model
	{
		
		const DB_TABLE = 'admin';
		const DB_TABLE_PK = 'sno';
		const USER = 'admin_id';
		const PASS = 'password';

		public $sno;
		public $admin_id;
		public $password;
		public $name;

		
	}