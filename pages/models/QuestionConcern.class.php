<?php
	class QuestionConcern{
		public $first_name;
		public $last_name;
		public $user_id;

		public function __construct($first_name, $last_name, $user_id){
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->user_id = $user_id;
		}
	}
?>
