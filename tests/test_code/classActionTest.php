<?php
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/'.'../../pages/actions/user_functions.php';
require_once dirname(__FILE__).'/'.'../../pages/actions/class_functions.php';
require_once dirname(__FILE__).'/'.'../../pages/models/CompleteMsg.class.php';

class classActionTest extends TestCase {

    /**
     * @dataProvider additionProvider4insertClass
     */
    public function testinsertClass($error, $name) {
        global $mysqli;
        $classFunctions = new ClassFunctions();

        $mysqli->autocommit(false);

        $completeMsg = $classFunctions->insertClass($name);

        $mysqli->rollback();
        $mysqli->autocommit(true);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4findTagsinClass
     */
    public function testfindTagsinClass($error, $class_id) {
        $classFunctions = new ClassFunctions();

        $completeMsg = $classFunctions->findTagsinClass($class_id);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4insertTags
     */
    public function testinsertTags($error, $class_id, $tags) {
        global $mysqli;
        $classFunctions = new ClassFunctions();

        $mysqli->autocommit(false);

        $completeMsg = $classFunctions->insertTags($class_id, $tags);

        $mysqli->rollback();
        $mysqli->autocommit(true);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4updateTags
     */
    public function testupdateTags($error, $class_id, $tags) {
        global $mysqli;
        $classFunctions = new ClassFunctions();

        $mysqli->autocommit(false);

        $completeMsg = $classFunctions->updateTags($class_id, $tags);

        $mysqli->rollback();
        $mysqli->autocommit(true);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4insertTa4Class
     */
    public function testinsertTa4Class($error, $tas, $classId, $onid, $dbType) {
        global $mysqli;
        $classFunctions = new ClassFunctions();

        $mysqli->autocommit(false);

        $completeMsg = $classFunctions->insertTa4Class($tas, $classId, $onid, $dbType);

        $mysqli->rollback();
        $mysqli->autocommit(true);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4checkUser4Students
     */
    public function testcheckUser4Students($error, $osuId) {
        $classFunctions = new ClassFunctions();

        $completeMsg = $classFunctions->checkUser4Students($osuId);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4deleteClasses4Tas
     */
    public function testdeleteClasses4Tas($error, $class_Id, $role) {
        global $mysqli;
        $classFunctions = new ClassFunctions();

        $mysqli->autocommit(false);

        $completeMsg = $classFunctions->deleteClasses4Tas($class_Id, $role);

        $mysqli->rollback();
        $mysqli->autocommit(true);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4updateClasses
     */
    public function testupdateClasses($error, $class_Id, $name) {
        global $mysqli;
        $classFunctions = new ClassFunctions();

        $mysqli->autocommit(false);

        $completeMsg = $classFunctions->updateClasses($class_Id, $name);

        $mysqli->rollback();
        $mysqli->autocommit(true);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    /**
     * @dataProvider additionProvider4selectClasses4Students
     */
    public function testselectClasses4Students($error, $userId, $classesData, $role) {
        global $mysqli;
        $classFunctions = new ClassFunctions();

        $completeMsg = $classFunctions->selectClasses4Students($userId, $classesData, $role);

        $mysqli->rollback();
        $mysqli->autocommit(true);

        $this->assertNotEmpty($completeMsg);
        $this->assertEquals($error, $completeMsg->isError);

    }

    public function additionProvider4insertClass()
    {
        return [
            [0, "CS 561"],
            [0, NULL],
            [0, ""]
        ];
    }

    public function additionProvider4findTagsinClass()
    {
        return [
            [1, "CS 561"],
            [1, NULL],
            [0, 1]
        ];
    }

    public function additionProvider4insertTags()
    {
        return [
            [0, 1, ["lecture", "quiz"]],
            [1, NULL, ["lecture", "quiz"]]
        ];
    }

    public function additionProvider4updateTags()
    {
        return [
            [0, 1, ["lecture", "quiz"]],
            [1, NULL, ["lecture", "quiz"]]
        ];
    }

    public function additionProvider4insertTa4Class()
    {
        return [
            [1, ["90001", "90002"], 10000, "90010", "update"],
            [0, ["900000001", "900000002"], 3, "900000010", "insert"]
        ];
    }

    public function additionProvider4checkUser4Students()
    {
        return [
            [0, "900000001"],
            [0, "900000002"]
        ];
    }

    public function additionProvider4deleteClasses4Tas()
    {
        return [
            [0, 1, 0],
            [1, NULL, 0],
            [1, 1, NULL],
            [0, 1, 1]
        ];
    }

    public function additionProvider4updateClasses()
    {
        return [
            [0, 1, "0"],
            [1, NULL, "0"],
            [0, 1, "NULL"],
            [0, 1, "1"]
        ];
    }


    public function additionProvider4selectClasses4Students()
    {
        return [
            [0, "900000001", [1, 2], 0],
            // [0, "900000001", [1, 2], 1],
            // [0, "900000001", [1, 2], 0],
            // [0, "900000001", [1, 2], 0]
        ];
    }
	
}
?>