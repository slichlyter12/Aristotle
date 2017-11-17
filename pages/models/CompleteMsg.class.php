<?php
	class CompleteMsg{
		public $isError;
		public $msg;
		public $data;

		public function __construct($isError, $msg, $data){
			$this->isError = $isError;
			$this->msg = $msg;
			$this->data = $data;
		}
	}
?>
