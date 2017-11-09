<?php
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/'.'../../pages/actions/check_user.php';
require_once dirname(__FILE__).'/'.'../../pages/actions/assign_question.php';
require_once dirname(__FILE__).'/'.'../../pages/actions/question_list.php';
require_once dirname(__FILE__).'/'.'../../pages/actions/query_class.php';

class actionTest extends TestCase {

	public function testSql() {
		$tmpsql = checkUserSql();

		$this->assertNotEmpty($tmpsql);
	}

    /**
     * @dataProvider additionProvider4CheckUserByQuestion
     */
    public function testCheckUserByQuestion($osu_id, $question_id, $r_role) {
        $user_info = checkUserByQuestion($osu_id, $question_id, $r_role);

        $this->assertNotEmpty($user_info);

        $this->assertEquals($osu_id, $user_info['user_info']->osu_id);
        $this->assertEquals($r_role, $user_info['class_info']->role);

    }

    /**
     * @dataProvider additionProvider4AssignQuestion
     */
    public function testAssignQuestion($osu_id, $first_name, $last_name, $question_id) {
        $excepted = assignQuestion($osu_id, $first_name, $last_name, $question_id);

        $this->assertFalse(!$excepted);

    }
	
    /**
     * @dataProvider additionProvider4QuestionList
     */
    public function testQuestionList($class_id) {

        $questions = questionList($class_id);

        $this->assertNotEmpty($questions);

    }

    /**
     * @dataProvider additionProvider4Class
     */
    public function testQueryClass($onid, $category) {

        $classes = quesyClass($onid, $category);

        $this->assertNotEmpty($classes);

    }

    public function additionProvider4CheckUserByQuestion()
    {
        return [
            ["lite", "1", "1"],
            ["900000007", "1", "1"]
        ];
    }
	
    public function additionProvider4AssignQuestion()
    {
        return [
            ["900000007", "Jaime", "Lannister", "1"],
            ["900000006", "Daenerys", "Targaryen", "1"]
        ];
    }

    public function additionProvider4QuestionList()
    {
        return [
            [1],
            [2],
            ["dsf"],
            [-1]
        ];
    }

    public function additionProvider4Class()
    {
        return [
            ["lite", "ta"],
            ["900000007", "student"],
            ["900000006", "all"],
        ];
    }

}
?>