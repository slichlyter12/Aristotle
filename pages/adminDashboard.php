<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Class Management</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="lib/css/normalize.css">
		<link rel="stylesheet" href="lib/css/skeleton.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="lib/css/jquery.timepicker.min.css" />
		<script type="text/javascript" src="lib/js/jquery.timepicker.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/myDialog.css" />
		<link rel="stylesheet" type="text/css" href="css/base.css" />
		<link rel="stylesheet" type="text/css" href="css/classList.css" />
		<script type="text/javascript" src="js/adminDashboard.js"></script>
		<script type="text/javascript" src="js/base.js"></script>
		<script type="text/javascript" src="js/myDialog.js"></script>
		<script type="text/javascript" src="js/taClass.js"></script>
		<?php 
			SESSION_START(); 
			if ($_SESSION['role'] != "admin") {
				header("Location: welcomePage.html");	
			}
		?>
	</head>	
	<body>
		<div id="main" class="container">
			<div class="title row">
				<div class="twelve columns">
					<h4>Manage Classes</h4>			<!--page title-->
					<div class="user">				<!--user info-->
						<span>Logged in as: </span> <!-- should get this from the session-->
						<button id="logout" onclick="logout()">Logout</button> <!--action:logout-->
						<!--<span>config</span>-->
					</div>
				</div>
			</div>
			
			<div class="funcs row" >
				<div class="four columns">
					<h5 class="subTitle">Your Classes</h5>
					<input class="searchInput" type="text" placeholder="Search"/>
				</div>
			</div>

			<div class="data row">
				<div class="twelve columns">
					<button class="openAddClassFormDialog" ></button>
					<span class="classList"></span>
				</div>
			</div>
		</div>

		<div id="dialog">	<!--split dialog out -->
			<div class="container smallBox addClassForm">
				<span class="close"></span>
				<div class="title row">
					<div class="twelve columns">
						<h5>Add A New Class</h5>
					</div>
				</div>
				<form name="ADDCLASS" class="post_class">
					<div class="row">
						<div class="six columns">
							<label for="classCodeInput">Class Code and Class Name</label>
							<input name="NAME" type="text" id="classCodeInput" placeholder="e.g. CS561 Software Engineering Methods" required/><span></span>
							<label>Add Teaching Assistant</label>
							<p>To add multiple separate by spaces ie. joe2 smart3 kim4</p>
							<input placeholder="ONID username(s)"><span></span>
						</div>
					</div>
					<div class="row .checkBox">
						<!--<label>
							<input type="checkbox" name="NEEDADD" id="autoAddCBox" checked="checked"/>
							<span class="cbLabel">Add After Create</span>
						</label>-->
						<div class="twelve columns">
							<input class="submitBtn button-primary" type="button" value="Add"/>		<!--action:createNewClass & selectClass & getClassList & getSelectedClass-->
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="mask"></div>
		<div id="toast"></div>
	</body>
</html>
