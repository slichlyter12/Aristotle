<?php
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/'.'../../pages/models/Class.class.php';
require_once dirname(__FILE__).'/'.'../../pages/models/Question.class.php';
require_once dirname(__FILE__).'/'.'../../pages/models/QuestionConcern.class.php';
require_once dirname(__FILE__).'/'.'../../pages/models/User.class.php';
require_once dirname(__FILE__).'/'.'../../pages/models/CompleteMsg.class.php';
require_once dirname(__FILE__).'/'.'../../pages/models/Tag.class.php';

class modelTest extends TestCase {

    /**
     * @dataProvider additionProvider4Class
     */
	public function testClass($id, $name, $role) {
		$classInfo = new ClassInfo($id, $name, $role);

		$this->assertNotEmpty($classInfo);

		$this->assertEquals($id, $classInfo->id);
		$this->assertEquals($name, $classInfo->name);
		$this->assertEquals($role, $classInfo->role);
	}

	/**
     * @dataProvider additionProvider4Question
     */
	public function testQuestion($id, $class_id, $stdnt_first_name, $stdnt_last_name, $stdnt_user_id, $create_time, $title, $description, $course_keywords, $preferred_time, $ta_first_name, $ta_last_name, $ta_user_id, $status) {
		$question = new Question($id, $class_id, $stdnt_first_name, $stdnt_last_name, $stdnt_user_id, $create_time, $title, $description, $course_keywords, $preferred_time, $ta_first_name, $ta_last_name, $ta_user_id, $status);

		$this->assertNotEmpty($question);

		$this->assertEquals($id, $question->id);
		$this->assertEquals($class_id, $question->class_id);
		$this->assertEquals($stdnt_first_name, $question->stdnt_first_name);
		$this->assertEquals($stdnt_last_name, $question->stdnt_last_name);
		$this->assertEquals($stdnt_user_id, $question->stdnt_user_id);
		$this->assertEquals($create_time, $question->create_time);
		$this->assertEquals($title, $question->title);
		$this->assertEquals($description, $question->description);
		$this->assertEquals($course_keywords, $question->course_keywords);
		$this->assertEquals($preferred_time, $question->preferred_time);
		$this->assertEquals($ta_first_name, $question->ta_first_name);
		$this->assertEquals($ta_last_name, $question->ta_last_name);
		$this->assertEquals($ta_user_id, $question->ta_user_id);
		$this->assertEquals($status, $question->status);
	}

	/**
     * @dataProvider additionProvider4QuestionConcern
     */
	public function testQuestionConcern($first_name, $last_name, $user_id) {
		$questionConcern = new QuestionConcern($first_name, $last_name, $user_id);

		$this->assertNotEmpty($questionConcern);

		$this->assertEquals($first_name, $questionConcern->first_name);
		$this->assertEquals($last_name, $questionConcern->last_name);
		$this->assertEquals($user_id, $questionConcern->user_id);
	}

 	/**
     * @dataProvider additionProvider4User
     */
	public function testUser($id, $osu_id, $last_name, $first_name, $role) {
		$user = new User($id, $osu_id, $last_name, $first_name, $role);

		$this->assertNotEmpty($user);

		$this->assertEquals($id, $user->id);
		$this->assertEquals($osu_id, $user->osu_id);		
		$this->assertEquals($last_name, $user->last_name);
		$this->assertEquals($first_name, $user->first_name);
		$this->assertEquals($role, $user->role);		
	}

	/**
     * @dataProvider additionProvider4CompleteMsg
     */
	public function testCompleteMsg($isError, $msg, $data) {
		$completeMsg = new CompleteMsg($isError, $msg, $data);

		$this->assertNotEmpty($completeMsg);

		$this->assertEquals($isError, $completeMsg->isError);
		$this->assertEquals($msg, $completeMsg->msg);		
		$this->assertEquals($data, $completeMsg->data);
	
	}

	/**
     * @dataProvider additionProvider4Tag
     */
	public function testTag($id, $class_id, $value, $comment) {
		$tagInfo = new TagInfo($id, $class_id, $value, $comment);

		$this->assertNotEmpty($tagInfo);

		$this->assertEquals($id, $tagInfo->id);
		$this->assertEquals($class_id, $tagInfo->class_id);		
		$this->assertEquals($value, $tagInfo->value);
		$this->assertEquals($comment, $tagInfo->comment);
	}

	public function additionProvider4Class()
    {
        return [
        	["1", "user1", "1"],
            ["0", "user2", "1"],
            ["-1", "user3", "1"],
            ["15", "!@#!@#!#", "-1"]
        ];
    }

    public function additionProvider4Question()
    {
        return [
            ["1", "1", "stdnt_first_name", "stdnt_last_name", "onid_id", "2017-10-05 18:30:25", "title", "This is a test!", "keyword one", "2017-10-06 19:30:25", "ta_first_name", "ta_last_name", "ta_onid_id", "1"],
            ["1", "100", "$#%GDFg", "$##FDG DF df", "onid_id", "2017-10-05 18:30:25", "Test", "This is a test, too!", "keyword,keywords", "2017-11-16 19:30:25", "ta_first_name", "ta_last_name", "ta_onid_id", "2"]
        ];
    }

    public function additionProvider4QuestionConcern()
    {
        return [
            ["@$#%$^%^&)(", "sdlmvoirg>?#@#>", "213AAFTRHTh565"],
            ["test_first_name", "test_last_name", "test_osu_id"]
        ];
    }

    public function additionProvider4User()
    {
        return [
            ["1", "!@#$%^&*(", "!123@#$%^&*(", "!@#$43%^&*(", "0"],
            ["1", "osuid123", "test_first_name", "test_last_name", "1"],
            ["1", "123", "3431", "0909", "2"],
            ["2", "test_osu_id", "test_first_name", "test_last_name", "3"],
            ["100000", "test_osu_id", "test_first_name", "test_last_name", "0"],
            ["1", "test_osu_id", "test_first_name", "test_last_name", "-1"],
            ["-1", "test_osu_id", "test_first_name", "test_last_name", "0"]
        ];
    }

    public function additionProvider4CompleteMsg()
    {
        return [
            ["@$#%$^%^&)(", "sdlmvoirg>?#@#>", "213AAFTRHTh565"],
            ["0", "Test is success!", "test_osu_id"]
        ];
    }

    public function additionProvider4Tag()
    {
        return [
            ["1", "1", "1", "lectue"],
            ["2", "1", "2", "quiz"]
        ];
    }

}
?>