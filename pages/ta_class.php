<?php

	if (isset($_SESSION["role"]) && $_SESSION["role"] == "ta") {
		echo header("Location: index.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>TA Class Detail</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/css/normalize.css">
	<link rel="stylesheet" href="lib/css/skeleton.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/myDialog.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/questionsTable.css" />
  <script type="text/javascript" src="js/base.js"></script>
  <script type="text/javascript" src="js/myDialog.js"></script>
  <script type="text/javascript" src="js/timePicker.js"></script>
	<script type="text/javascript" src="js/ta_class.js"></script>
	<script type="text/javascript" src="js/logout.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109657627-3"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-109657627-3');
	</script>

	<!-- <script type="text/javascript" src="js/myDialog.js"></script> -->
	<!-- <script type="text/javascript" src="js/timePicker.js"></script> -->
	<!-- <script type="text/javascript" src="js/studentsQuestions.js"></script> -->

</head>
<body>
<div id="main" class="container">
	<div class="title row">
		<div class="twelve columns">
			<h4>TA Class Detail Page</h4>	<!--page title-->
			<p>Questions List.</p>
			<div class="user">					<!--user info-->
				<img onclick="logout()" src="images/svg/logout.svg" /> <!--action:logout-->
				<span id="logout_name">XXX</span>
			</div>
			<div class="panel"><a href="studentDashboard.php">Switch to Student Dashboard</a></div>
		</div>
	</div>
	<div class="data row">
		<div class="twelve columns">
			<table class="u-full-width">
				<thead>
					<tr>
						<th style="width:28%">Title</th>
						<th style="width:22%">Poster</th>
						<th style="width:20%">Post Time</th>
						<th style="width:15%">Status</th>
						<th style="width:10%">Members</th>
            <th></th>
            <th></th>
            <th></th>
						<!--<th class="tableBlock"></th> -->
					</tr>
				</thead>
				<tbody>
					<!--Questions list -->													<!--action:getQuestionList-->
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="dialog"> <!--split dialog out -->
  <div id="questionDiv" class="container largeBox questionForm"> 
    <span class="close"></span>
    <div class="title row">
      <div class="twelve columns">
        <h5>Answer The Question</h5>
      </div>
    </div>
    <div class="row">
        <div class="twelve columns">
        <h6></h6>
				<p></p>
        </div>
    </div>
    <form name="ANSWERS" class="post_ques">
      <div class="row">
        <div class="twelve columns">
          <label for="answerInput">Answer</label>
          <textarea name="ANSWER" class="quesArea" placeholder="" id="answerInput" required></textarea><span></span>
        </div>
      </div>
      <div class="row">
        <div class="twelve columns">
          <input class="submitBtn button-primary" type="button" value="Post"/>		<!--action:createNewQuestion & questionList-->
        </div>
      </div>
    </form>
  </div>
</div>
<div id="mask"></div>
<div id="toast"></div>
</body>
</html>
