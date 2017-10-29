<?php
class question
{
	private $id;
	private $interests;
	private $createdTime;
	private $expectedAnsTime;
	
	function __construct($id,$interests,$createdTime,$expectedAnsTime)
	{
		$this->id = $id;
		$this->interests = $interests;
		$this->createdTime = $createdTime;
		$this->expectedAnsTime = $expectedAnsTime;
	}
	
	//return the key for sorting
	public function getIntIndex()
	{
		$second1 = strtotime(gmdate('c'));
		$second2 = strtotime($this->createdTime);
		$second3 = strtotime($this->expectedAnsTime);
		$index = $this->interests * 3600 / (($second1 - $second2) + $this->interests);
		if(abs($second1 - $second3) < 600)	
		{
			$index += 3600;
		}
		return $index;
	}
	
}
?>
