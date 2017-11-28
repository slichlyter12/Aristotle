<?php
require '../question.php'
use PHPUnit\Framework\TestCase;

class LogOutTest extends TestCase {
	
	/*
	 *	@dataProvider additionProvider
	*/
	public function testQuestionSort($id,$interests,$createdTime,$expectedAnsTime) {
		$test = new question($id,$interests,$createdTime,$expectedAnsTime);
		$index = $test->getIntIndex();
	}

	public function additionProvider(){
		return [
			[2131321321312312312312312343524524,21435246357434256247365874695124123,'2038-12-31 24:59:59','2038-12-31 24:59:59']
		];
	}
}

?>