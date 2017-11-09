<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @covers Email
 */
final class QuestionTest extends TestCase
{

    public function testCase1(): void 		//same likes, same expectedAnsDate, different createdDate
    {
		//--------------------------------------------------------//
		$createdDate1 = "2017-10-29T23:58:29+00:00";
		$createdDate2 = "2017-10-28T19:24:25+00:00";
		$expectedAnsDate1 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate2 = "2017-11-15T20:58:29+00:00";
		
		$q1 = new Question(1,1,$createdDate1,$expectedAnsDate1);
		$q2 = new Question(2,1,$createdDate2,$expectedAnsDate2);
		$questions = array ($q1,$q2);
		
        $this->assertEquals(
            array("1","2"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate3 = "2017-10-28T23:58:29+00:00";
		$createdDate4 = "2017-10-29T19:24:25+00:00";
		$expectedAnsDate3 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate4 = "2017-11-15T20:58:29+00:00";
		
		$q3 = new Question(3,13,$createdDate3,$expectedAnsDate3);
		$q4 = new Question(4,13,$createdDate4,$expectedAnsDate4);
		$questions = array ($q3,$q4);
		
        $this->assertEquals(
            array("4","3"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate5 = "2017-10-28T23:58:29+00:00";
		$createdDate6 = "2017-10-29T19:24:25+00:00";
		$expectedAnsDate5 = gmdate('c');
		$expectedAnsDate6 = gmdate('c');
		
		$q5 = new Question(5,13,$createdDate5,$expectedAnsDate5);
		$q6 = new Question(6,13,$createdDate6,$expectedAnsDate6);
		$questions = array ($q5,$q6);
		
        $this->assertEquals(
            array("6","5"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate7 = "2017-10-29T23:58:29+00:00";
		$createdDate8 = "2017-10-28T19:24:25+00:00";
		$expectedAnsDate7 = gmdate('c');
		$expectedAnsDate8 = gmdate('c');
		
		$q7 = new Question(7,13,$createdDate7,$expectedAnsDate7);
		$q8 = new Question(8,13,$createdDate8,$expectedAnsDate8);
		$questions = array ($q7,$q8);
		
        $this->assertEquals(
            array("7","8"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
    }
	
	 public function testCase2(): void 		//same likes, same createdDate, different expectedAnsDate
    {
		//--------------------------------------------------------//
		$createdDate1 = "2017-10-29T23:58:29+00:00";
		$createdDate2 = "2017-10-29T23:58:29+00:00";
		$expectedAnsDate1 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate2 = gmdate('c');
		
		$q1 = new Question(1,9,$createdDate1,$expectedAnsDate1);
		$q2 = new Question(2,9,$createdDate2,$expectedAnsDate2);
		$questions = array ($q1,$q2);
		
        $this->assertEquals(
            array("2","1"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate3 = "2017-10-29T23:58:29+00:00";
		$createdDate4 = "2017-10-29T23:58:29+00:00";
		$expectedAnsDate3 = gmdate('c');
		$expectedAnsDate4 = "2017-11-15T20:58:29+00:00";
		
		$q3 = new Question(3,13,$createdDate3,$expectedAnsDate3);
		$q4 = new Question(4,13,$createdDate4,$expectedAnsDate4);
		$questions = array ($q3,$q4);
		
        $this->assertEquals(
            array("3","4"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
    }
	
	public function testCase3(): void 		//same likes, same createdDate, same expectedAnsDate
    {
		//--------------------------------------------------------//
		$createdDate1 = "2017-10-29T23:58:29+00:00";
		$createdDate2 = "2017-10-29T23:58:29+00:00";
		$expectedAnsDate1 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate2 = "2017-11-15T20:58:29+00:00";
		
		$q1 = new Question(1,10,$createdDate1,$expectedAnsDate1);
		$q2 = new Question(2,9,$createdDate2,$expectedAnsDate2);
		$questions = array ($q1,$q2);
		
        $this->assertEquals(
            array("1","2"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate3 = "2017-10-29T23:58:29+00:00";
		$createdDate4 = "2017-10-29T23:58:29+00:00";
		$expectedAnsDate3 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate4 = "2017-11-15T20:58:29+00:00";
		
		$q3 = new Question(3,10,$createdDate3,$expectedAnsDate3);
		$q4 = new Question(4,11,$createdDate4,$expectedAnsDate4);
		$questions = array ($q3,$q4);
		
        $this->assertEquals(
            array("4","3"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate5 = "2017-10-29T23:58:29+00:00";
		$createdDate6 = "2017-10-29T23:58:29+00:00";
		$expectedAnsDate5 = gmdate('c');
		$expectedAnsDate6 = gmdate('c');
		
		$q5 = new Question(5,13,$createdDate5,$expectedAnsDate5);
		$q6 = new Question(6,14,$createdDate6,$expectedAnsDate6);
		$questions = array ($q5,$q6);
		
        $this->assertEquals(
            array("6","5"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate7 = "2017-10-29T23:58:29+00:00";
		$createdDate8 = "2017-10-29T23:58:29+00:00";
		$expectedAnsDate7 = gmdate('c');
		$expectedAnsDate8 = gmdate('c');
		
		$q7 = new Question(7,15,$createdDate7,$expectedAnsDate7);
		$q8 = new Question(8,14,$createdDate8,$expectedAnsDate8);
		$questions = array ($q7,$q8);
		
        $this->assertEquals(
            array("7","8"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
    }
	
	public function testCase4(): void 		//batch tests
    {
		//--------------------------------------------------------//
		$createdDate1 = "2017-10-24T23:58:29+00:00";
		$createdDate2 = "2017-10-25T23:58:29+00:00";
		$createdDate3 = "2017-10-26T23:58:29+00:00";
		$createdDate4 = "2017-10-27T23:58:29+00:00";
		$createdDate5 = "2017-10-28T23:58:29+00:00";
		$createdDate6 = "2017-10-29T23:58:29+00:00";
		$createdDate7 = "2017-10-30T23:58:29+00:00";
		$createdDate8 = "2017-10-31T23:58:29+00:00";
		$expectedAnsDate1 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate2 = gmdate('c');
		$expectedAnsDate3 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate4 = gmdate('c');
		$expectedAnsDate5 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate6 = gmdate('c');
		$expectedAnsDate7 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate8 = gmdate('c');
		
		$q1 = new Question(1,128,$createdDate1,$expectedAnsDate1);
		$q2 = new Question(2,16,$createdDate2,$expectedAnsDate2);
		$q3 = new Question(3,64,$createdDate3,$expectedAnsDate3);
		$q4 = new Question(4,16,$createdDate4,$expectedAnsDate4);
		$q5 = new Question(5,32,$createdDate5,$expectedAnsDate5);
		$q6 = new Question(6,16,$createdDate6,$expectedAnsDate6);
		$q7 = new Question(7,16,$createdDate7,$expectedAnsDate7);
		$q8 = new Question(8,16,$createdDate8,$expectedAnsDate8);
		$questions = array ($q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8);
		
        $this->assertEquals(
            array("8","6","4","2","1","3","5","7"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
		//--------------------------------------------------------//
		$createdDate11 = "2017-10-24T23:58:29+00:00";
		$createdDate12 = "2017-10-28T23:58:29+00:00";
		$createdDate13 = "2017-10-26T23:58:29+00:00";
		$createdDate14 = "2017-10-29T23:58:29+00:00";
		$createdDate15 = "2017-10-28T23:58:29+00:00";
		$createdDate16 = "2017-10-30T23:58:29+00:00";
		$createdDate17 = "2017-10-30T23:58:29+00:00";
		$createdDate18 = "2017-10-31T23:58:29+00:00";
		$expectedAnsDate11 = gmdate('c');
		$expectedAnsDate12 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate13 = gmdate('c');
		$expectedAnsDate14 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate15 = gmdate('c');
		$expectedAnsDate16 = "2017-11-15T20:58:29+00:00";
		$expectedAnsDate17 = gmdate('c');
		$expectedAnsDate18 = "2017-11-15T20:58:29+00:00";
		
		$q11 = new Question(11,16,$createdDate11,$expectedAnsDate11);
		$q12 = new Question(12,16,$createdDate12,$expectedAnsDate12);
		$q13 = new Question(13,16,$createdDate13,$expectedAnsDate13);
		$q14 = new Question(14,16,$createdDate14,$expectedAnsDate14);
		$q15 = new Question(15,16,$createdDate15,$expectedAnsDate15);
		$q16 = new Question(16,28,$createdDate16,$expectedAnsDate16);
		$q17 = new Question(17,16,$createdDate17,$expectedAnsDate17);
		$q18 = new Question(18,16,$createdDate18,$expectedAnsDate18);
		$questions = array ($q11,$q12,$q13,$q14,$q15,$q16,$q17,$q18);
		
        $this->assertEquals(
            array("17","15","13","11","18","16","14","12"),
            Question::sortQuestions($questions)
        );
		//--------------------------------------------------------//
		
    }
}