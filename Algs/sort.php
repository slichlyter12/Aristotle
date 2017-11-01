

<?php
class Question
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
	
	public function getId()
	{
		return $this->id;
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
	
	//sort questions by decreasing value of key
	public static function sortQuestions($questions)
	{
		echo "Before Sort:".'<br>';//print out the keys used for sorting
		for($i = 0;$i < sizeof($questions);$i++)
		{
			echo $questions[$i]->getIntIndex().'<br>';
		}
		
		for($i = 0;$i < sizeof($questions) - 1;$i++)
		{
			for($j = $i + 1;$j < sizeof($questions);$j++)
			{
				if($questions[$j]->getIntIndex() > $questions[$i]->getIntIndex())
				{
					$temp = $questions[$i];
					$questions[$i] = $questions[$j];
					$questions[$j] = $temp;
				}
			}
		}
		$idArray = array();
		echo "After Sort:".'<br>';
		for($i = 0;$i < sizeof($questions);$i++)
		{
			$idArray[$i] = $questions[$i]->getId();
			echo $questions[$i]->getIntIndex().'<br>';//print out the keys to see if it is in a decreasing order
		}
		
		return $idArray;//return an array of questionIds
	}
	
}
	//creat objs to test
	$createdDate1 = "2017-10-12T23:58:29+00:00";
	$createdDate2 = "2017-10-11T19:24:25+00:00";
	$createdDate3 = "2017-10-13T07:15:43+00:00";
	$createdDate4 = "2017-10-13T02:55:16+00:00";
	$createdDate5 = "2017-10-13T11:17:24+00:00";
	$createdDate6 = "2017-10-13T14:15:11+00:00";
	
	$expectedAnsDate1 = gmdate('c');
	$expectedAnsDate2 = "2017-10-15T20:58:29+00:00";
	$expectedAnsDate3 = "2017-10-14T20:58:29+00:00";
	$expectedAnsDate4 = gmdate('c');
	$expectedAnsDate5 = "2017-10-14T20:58:29+00:00";
	$expectedAnsDate6 = "2017-10-14T20:58:29+00:00";
	$dateNow = gmdate('c');
	
	$q1 = new Question(1,32,$createdDate1,$expectedAnsDate1);
	$q2 = new Question(2,48,$createdDate2,$expectedAnsDate2);
	$q3 = new Question(3,64,$createdDate3,$expectedAnsDate3);
	$q4 = new Question(4,5,$createdDate4,$expectedAnsDate4);
	$q5 = new Question(5,13,$createdDate5,$expectedAnsDate5);
	$q6 = new Question(6,154,$createdDate6,$expectedAnsDate6);
	
	//put all question objs into an array
	$questions = array ($q1,$q2,$q3,$q4,$q5,$q6);
	
	
	//call the method to sort the array of questions
	$sortedQuestions = Question::sortQuestions($questions);
	
	//print out the id of questions after sorting
	for($i = 0;$i < sizeof($questions);$i++)
	{
		echo $sortedQuestions[$i];
	}
?>
