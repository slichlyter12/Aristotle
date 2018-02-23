<?php

	$dir = dirname(__FILE__);
	require_once ($dir."/"."../db_config/conn2.php");
	require_once ($dir."/"."../models/Class.class.php");
	require_once ($dir."/"."../models/Tag.class.php");
	require_once ($dir."/"."../models/CompleteMsg.class.php");

	class ClassFunctions{

		public function insertClass($name){
			global $mysqli;
			$sql = "INSERT INTO t_class(name) VALUES (?)";
			
			//add the new course to the DB
			if ($statement = $mysqli->prepare($sql)) {
				$statement->bind_param('s', $name);
				$result = $statement->execute();
			}else {
				return new CompleteMsg(1, 'Create class error!', NULL);
			}
 
			return new CompleteMsg(0, "Create class success!", $mysqli->insert_id);
		}

		public function findTagsinClass($class_id){
			global $mysqli;
			//Check is current user a Student or is the user exist
			$sql = 'SELECT id, value, comment FROM t_keywords WHERE class_id = '.$class_id ;
		
			$result = $mysqli->query($sql);

			if($result) {
				$tags['tag_info'] = array();
				$i = 0;
				while($row = $result->fetch_assoc()){
					$tags['tag_info'][$i] = new TagInfo($row['id'], $class_id, $row['value'], $row['comment']);
					$i++;
				}
			}else {
				//complete($mysqli, 1, 'Please sign up first!', NULL);
				return new CompleteMsg(1, 'Find tags error!', NULL);
			}

			return new CompleteMsg(0, "Check tags success!", $tags);
		}


		public function insertTags($class_id, $tags){
			global $mysqli;
			$sql = 'INSERT INTO t_keywords (class_id, value, comment) VALUES ';

			$i=1;
			foreach ($tags as &$value) {
				if(trim($value) != ''){
					if($i > 1) 
						$sql = $sql .',';
					$sql = $sql .'('.$class_id.', "'.$value.'", "'.$value.'")';
					$i++;
				}
			}
			echo $sql;
			$result = $mysqli->query($sql);
			if(!$result) {
					return new CompleteMsg(1, 'Insert tags failed!', NULL);
			}
 
			return new CompleteMsg(0, "Create tags success!", NULL);
		}

		public function insertTag($class_id, $tag){
			global $mysqli;
			$sql = 'INSERT INTO t_keywords (class_id, value, comment) VALUES ('.$class_id.', "'.$tag.'", "'.$tag.'")';
		
			$result = $mysqli->query($sql);
			if(!$result) {
					return new CompleteMsg(1, 'Insert tag failed!', NULL);
			}
 
			return new CompleteMsg(0, "Create tag success!", NULL);
		}

		public function updateTags($class_id, $tags){
			global $mysqli;
			//Reset the selected classes
			$sql = 'DELETE FROM t_keywords WHERE class_id = '.$class_id;

			$result = $mysqli->query($sql);
			if(!$result) {
				return new CompleteMsg(1, 'Reset tags infomation failed!', NULL);
			}

			$this->insertTags($class_id, $tags);
	
			return new CompleteMsg(0,'Tags information updates success!', NULL);
		}


		public function insertTa4Class($tas, $classId, $onid, $dbType){
			global $mysqli;
			if(strcmp($dbType, "update") != 0){
				$taName = '"'.trim($onid).'"';
			}else{
				$taName = '';
			}
			
			foreach ($tas as &$value) {
				if($value !=''){
					if($taName != ''){
						$taName = $taName.',';
					}
					$taName = $taName.'"'.trim($value).'"';
				}
			}

			$user_sql = 'SELECT id, osu_id FROM t_user WHERE osu_id in ('.$taName .')';
			$user_result = $mysqli->query($user_sql);
			
			if($user_result) {
				$i=0;
				$role = 1;
				$sql = 'INSERT INTO r_user_class (user_id, class_id, role) VALUES ';
				while($row = $user_result->fetch_assoc()){
					$id = $row['id'];
					$osu_id = $row['osu_id'];
					if($i > 0) 
						$sql = $sql .',';
					if(strcmp($osu_id, $onid) != 0){
						$sql = $sql .'('.$id.', '.$classId.','. $role.')';
					}else{
							$sql = $sql .'('.$id.', '.$classId.', 2)';
					}
					$i++;
				}

				$result = $mysqli->query($sql);
				if(!$result) {
						return new CompleteMsg(1, 'Insert relationship failed!', NULL);
				}
			}else {
				return new CompleteMsg(1, 'Query user error!', NULL);
			}
			return new CompleteMsg(0, "Insert relationship success!", NULL);
		}


		public function checkUser4Students($osuId){
			global $mysqli;
			//Check is current user a Student or is the user exist
			$sql = 'SELECT role, id FROM t_user WHERE osu_id = "'.$osuId .'"';
			$result = $mysqli->query($sql);
			if($result) {
				if($row = $result->fetch_assoc()){
					$role = $row['role'];
					$userId = $row['id'];
					if(!($role=='0'||$role=='1' ||$role=='2')) {
						//complete($mysqli, 1, 'No permission!', NULL);
						return new CompleteMsg(1, 'No permission!', NULL);
					}
				}
			}else {
				//complete($mysqli, 1, 'Please sign up first!', NULL);
				return new CompleteMsg(1, 'Please sign up first!', NULL);
			}

			return new CompleteMsg(0, "Check user success!", $userId);
		}

		public function deleteClasses4Tas($class_Id, $role){
			global $mysqli;
			//Reset the selected classes
			$sql = 'DELETE FROM r_user_class WHERE class_id = '.$class_Id.' AND role='. $role;
			$result = $mysqli->query($sql);
			if(!$result) {
				return new CompleteMsg(1, 'Reset class infomation failed!', NULL);
			}

			return new CompleteMsg(0,'Class information updates success!', NULL);
		}

		public function updateClasses($class_Id, $name){
			global $mysqli;
			//Reset the selected classes
			$sql = 'UPDATE t_class SET name = "'.$name.'" WHERE id = '.$class_Id;
			$result = $mysqli->query($sql);
			if(!$result) {
				return new CompleteMsg(1, 'Reset class infomation failed!', NULL);
			}

			return new CompleteMsg(0,'Class information updates success!', NULL);
		}

		public function selectClasses4Students($userId, $classesData, $role){
			global $mysqli;
			//Reset the selected classes
			//Set auto commit to false
			$mysqli->autocommit(false);
			$sql = 'DELETE FROM r_user_class WHERE user_id = '.$userId.' AND role='. $role;
			$result = $mysqli->query($sql);
			if(!$result) {
				//Delete failed rollback
				$mysqli->rollback();
				return new CompleteMsg(1, 'Reset class infomation failed!', NULL);
			}

			$i=0;
			if(isset($classesData['classes'][$i])){
				$sql = 'INSERT INTO r_user_class (user_id, class_id, role) VALUES ';
				while( $classId = $classesData['classes'][$i]){
					if($i > 0) 
						$sql = $sql .',';							
					$sql = $sql .'('.$userId.', '.$classId.','. $role.')';
					$i++;
				}

				$result = $mysqli->query($sql);
					
				if(!$result) {
					//insert failed rollback
					$mysqli->rollback();
					return new CompleteMsg(1, 'Add class failed!', NULL);
				}
			}

			$mysqli->commit();
			$mysqli->autocommit(true);
			
			if($i == 0){
				return new CompleteMsg(0,'Please add your Class!', NULL);
			}else{
				return new CompleteMsg(0,'Please select a Class!', NULL);
			}
		}

	}
?>
