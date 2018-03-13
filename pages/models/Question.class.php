<?php
	class Question{
		public $id;
		public $class_id;
		public $stdnt_first_name;
		public $stdnt_last_name;
		public $stdnt_user_id;
		public $create_time;
		public $title;
		public $description;
		public $course_keywords;
		public $preferred_time;
		public $ta_first_name;
		public $ta_last_name;
		public $ta_user_id;
		public $status;
		public $students;

		public function __construct($id, $class_id, $stdnt_first_name, $stdnt_last_name, $stdnt_user_id, $create_time, $title, $description, $course_keywords, $preferred_time, $ta_first_name, $ta_last_name, $ta_user_id, $status, $answer_time, $comment){
			$this->id = $id;
			$this->class_id = $class_id;
			$this->stdnt_first_name = $stdnt_first_name;
			$this->stdnt_last_name = $stdnt_last_name;
			$this->stdnt_user_id = $stdnt_user_id;
			$this->create_time = $create_time;
			$this->title = $title;
			$this->description = $description;
			$this->course_keywords = $course_keywords;
			$this->preferred_time = $preferred_time;
			$this->ta_first_name = $ta_first_name;
			$this->ta_last_name = $ta_last_name;
			$this->ta_user_id = $ta_user_id;
			$this->status = $status;
			$this->answer_time = $answer_time;
			$this->comment = $comment;
		}
	}
?>
