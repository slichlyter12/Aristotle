<?php

	if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
		echo header("Location: index.php");
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="lib/css/normalize.css">
		<link rel="stylesheet" href="lib/css/skeleton.css">
		<link type="text/css" rel="stylesheet" href="lib/css/jquery.pagewalkthrough.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="lib/css/jquery.timepicker.min.css" />
		<script type="text/javascript" src="lib/js/jquery.timepicker.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/myDialog.css" />
		<link rel="stylesheet" type="text/css" href="css/base.css" />
		<link rel="stylesheet" type="text/css" href="css/classList.css" />
		<script type="text/javascript" src="js/adminDashboard.js"></script>
		<script type="text/javascript" src="js/base.js"></script>
		<script type="text/javascript" src="js/myDialog.js"></script>
		<script type="text/javascript" src="js/logout.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109657627-3"></script>
		<script type="text/javascript" src="lib/js/jquery.pagewalkthrough.min.js"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-109657627-3');
		</script>

		<?php
			SESSION_START();
			if ($_SESSION['role'] != "admin") {
				header("Location: index.php");
			}
		?>
	</head>
	<body>
		<div id="main" class="container">
			<div class="title row">
				<div id="titleTag" class="twelve columns">
					<h4>Admin Dashboard</h4>			<!--page title-->
					<div class="user">				<!--user info-->
						<img onclick="logout()" src="images/svg/logout.svg" /> <!--action:logout-->
						<span id="logout_name" style="float:right">XXX</span>
					</div>
				</div>
			</div>

			<div class="funcs row" >
				<div class="four columns">
					<h5 class="subTitle">Your Classes</h5>
					<input disabled class="searchInput" type="text" placeholder="Search"/>
				</div>
			</div>

			<div class="data row">
				<div id="addBtn" class="twelve columns">
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
							<input name="CLASSID" type="hidden"/>
							<input name="NAME" type="text" id="classCodeInput" placeholder="e.g. CS561 Software Engineering Methods" size="50" required/><span></span>
							<label>Add Teaching Assistant</label>
							<p>To add multiple separate by spaces ie. joe2 smart3 kim4</p>
							<input name="TAS" type="text" placeholder="ONID username(s)" size="50" required/><span></span>

							<label>Add Tag</label>
							<p>To add multiple separate by spaces ie. homework quiz exam</p>
							<input name="Tags" type="text" placeholder="Tag(s)" size="50" required/><span></span>

						</div>
					</div>
					<div class="row .checkBox">
						<!--<label>
							<input type="checkbox" name="NEEDADD" id="autoAddCBox" checked="checked"/>
							<span class="cbLabel">Add After Create</span>
						</label>-->
						<div class="twelve columns">
							<input name="SubmitButton" class="submitBtn button-primary" type="button" value="Submit" onclick="createCourse();"/>	<!--action:createNewClass & selectClass & getClassList & getSelectedClass-->
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="mask"></div>
		<div id="toast"></div>
	</body>
</html>
