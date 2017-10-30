<?php
	class ClassInfo{
		public $id;
		public $name;
		public $role;

		public function __construct($id, $name, $role){
			$this->id = $id;
			$this->name = $name;
			$this->role = $role;
		}
	}
?>
