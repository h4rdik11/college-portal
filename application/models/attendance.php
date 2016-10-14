<?php

	/**
	* 
	*/
	class Attendance extends MY_Model
	{
		const DB_TABLE = 'attendance';
		const DB_TABLE_PK = 'sno';
		const SEM = 'sem';
		const MONTH = 'month';
		const ROLL = 'roll_no';

		public $sno;
		public $roll_no;
		public $month;
		public $sem;
		public $sub_id;
		public $attended;
		public $total;
		public $percent;

	}