<?php
	class User{
		public $id;
		public $osu_id;
		public $last_name;
		public $first_name;
		public $role;

		public function __construct($id, $osu_id, $last_name, $first_name, $role){
			$this->id = $id;
			$this->osu_id = $osu_id;
			$this->last_name = $last_name;
			$this->first_name = $first_name;
			$this->role = $role;
		}
	}
?>
