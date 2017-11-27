<?php
	class TagInfo{
		public $id;
		public $class_id;
		public $value;
		public $comment;

		public function __construct($id, $class_id, $value, $comment){
			$this->id = $id;
			$this->class_id = $class_id;
			$this->value = $value;
			$this->comment = $comment;
		}
	}
?>
