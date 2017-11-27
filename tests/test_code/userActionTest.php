<?php
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/'.'../../pages/actions/user_functions.php';
require_once dirname(__FILE__).'/'.'../../pages/actions/class_functions.php';
require_once dirname(__FILE__).'/'.'../../pages/models/CompleteMsg.class.php';

class userActionTest extends TestCase {

	public function testSql() {
        $userFunctions = new UserFunctions();
		$tmpsql = $userFunctions->checkUserByClassSql();

		$this->assertNotEmpty($tmpsql);
	}

    /**
     * @dataProvider additionProvider4filterUserbyOnids
     */
    public function testfilterUserbyOnids($error, $tas) {
        $userFunctions = new UserFunctions();

        $completeMsg = $userFunctions->filterUserbyOnids($tas);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4insertTabyOnids
     */
    public function testinsertTabyOnids($error, $tas) {
        global $mysqli;
        $userFunctions = new UserFunctions();

        $mysqli->autocommit(false);

        $completeMsg = $userFunctions->insertTabyOnids($tas);

        $mysqli->rollback();
        $mysqli->autocommit(true);
        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4checkUserByClass
     */
    public function testcheckUserByClass($error, $osu_id, $class_id, $r_role) {
        $userFunctions = new UserFunctions();

        $completeMsg = $userFunctions->checkUserByClass($osu_id, $class_id, $r_role);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4findTasinClass
     */
    public function testfindTasinClass($error, $class_id, $r_role) {
        $userFunctions = new UserFunctions();

        $completeMsg = $userFunctions->findTasinClass($class_id, $r_role);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    public function additionProvider4filterUserbyOnids()
    {
        return [
            [0, ["900000001", "900000002"]],
            [1, [NULL]],
            [0, ["900000001"]]
        ];
    }

    public function additionProvider4insertTabyOnids()
    {
        return [
            [1, ["900000001", "900000002"]],
            [1, [NULL]],
            [0, ["tatata", "tatatata2"]]
        ];
    }

    public function additionProvider4checkUserByClass()
    {
        return [
            [0, "900000001", 1, 0],
            [1, NULL, 1, 0],
            [1, "900000001", NULL, 0]
        ];
    }

    public function additionProvider4findTasinClass()
    {
        return [
            [0, 1, 1],
            [1, NULL, 0],
            [1, 2, NULL],
            [0, 2, 0]
        ];
    }
	
}
?>