<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Student Questions</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/css/normalize.css">
	<link rel="stylesheet" href="lib/css/skeleton.css">
	<link type="text/css" rel="stylesheet" href="lib/css/jquery.pagewalkthrough.css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/react/15.4.2/react.min.js"></script>
	<script src="https://cdn.bootcss.com/react/15.4.2/react-dom.min.js"></script>
	<script src="https://cdn.bootcss.com/babel-standalone/6.22.1/babel.min.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/css/jquery.timepicker.min.css" />
	<script type="text/javascript" src="lib/js/jquery.timepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/myDialog.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/questionsTable.css" />
	<script type="text/javascript" src="js/base.js"></script>
	<script type="text/javascript" src="js/myDialog.js"></script>
	<script type="text/javascript" src="js/timePicker.js"></script>
	<script type="text/javascript" src="js/logout.js"></script>
	<script type="text/javascript" src="js/studentQuestions.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109657627-3"></script>
	<script type="text/javascript" src="lib/js/jquery.pagewalkthrough.min.js"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-109657627-3');
	</script>

</head>
<body>
<div id="main" class="container">
	<div class="title row ">
		<div id="titleTag" class="twelve columns">
			<img class="back" src="images/svg/back.svg" onclick="window.location.href='./studentDashboard.php'"/>
			<h4>Student Question List</h4>	<!--page title-->
			<p class="classNav"></p>
			<div class="user"></div><!--user info-->
			<div id="toTA" class="panel"></div>
		</div>
	</div>
	<div id="postBtn" class="funcs row">
		<div class="twelve columns">
			<input class="openQFormDialog" type="button" value="Post A New Question">
		</div>
	</div>
	<div id="questionList" class="data row">
		<div class="twelve columns">
			<table class="u-full-width">
				<thead>
					<tr>
						<th style="width:28%">Title</th>
						<th style="width:22%">Poster</th>
						<th style="width:20%">Post Time</th>
						<th style="width:15%">Status</th>
						<th style="width:10%">Members</th>
						<th style="width:5%"></th>
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

<div id="dialog">	<!--split dialog out -->
	<div class="container largeBox questionDetail">
		<span class="close"></span>
		<div class="title row">
			<div class="twelve columns">
				<h5></h5>
				<p></p>
			</div>
		</div>
		<div class="concern row">
			<div class="twelve columns">
			</div>
		</div>
	</div>

	<div class="container largeBox questionToModify">
		<span class="close"></span>
		<div class="title row">
			<div class="twelve columns">
				<h5>Modifiy A Question</h5>
			</div>
		</div>
		<form name="ALL_QUESTIONS" class="post_ques">
			<div class="row">
				<div class="six columns">
				    <input name="ID" type="text" id="idInput" value="" style="display:none;" required/>
					<label for="titleInput">Question Title</label>
					<input name="TITLE" class="u-full-width" type="text" value="" id="titleInput" disabled="" required/><span></span>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<label for="questextsInput">Description</label>
					<textarea name="DESCRIPTION" class="quesArea" placeholder="" id="questextsInput" required></textarea><span></span>
				</div>
			</div>
			<div class="row timeSelect">
				<div class="twelve columns " >
					<label for="timeSelect">When Coming to Office Hour</label>
<!-- 					<label>
						<input class="nowRadioBtn" name="AVAILABLE_TIME" type="radio" value="now" checked="checked" /> Now<br/>
					</label> -->
					<div class="row" >
						<div class="eight columns">
							<label>
<!-- 								<input class="laterRadioBtn" name="AVAILABLE_TIME" type="radio" value=""/> -->
								<span> At:</span>
								<input name="AVAILABLE_TIME" id="timeDetailInput" class="timeDetailInput" type="text" disabled="disabled" required/><span></span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<input class="submitBtn button-primary" type="button" value="Save"/>		<!--action:createNewQuestion & questionList-->
				</div>
			</div>
		</form>
	</div>

	<div id="questionDiv" class="container largeBox questionForm">
		<span class="close"></span>
		<div class="title row">
			<div class="twelve columns">
				<h5>Post A New Question</h5>
			</div>
		</div>
		<form name="QUESTIONS" class="post_ques">
			<div class="row">
				<div class="six columns">
					<label for="titleInput">Question Title</label>
					<input name="TITLE" class="u-full-width" type="text" id="titleInput" required/><span></span>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<label for="questextsInput">Description</label>
					<textarea name="DESCRIPTION" class="quesArea" placeholder="" id="questextsInput" required></textarea><span></span>
				</div>
			</div>
			<div class="row timeSelect">
				<div class="twelve columns " >
					<label for="timeSelect">Planned Arrival Time:</label>
					<label>
						<input class="nowRadioBtn" name="AVAILABLE_TIME" type="radio" value="now" checked="checked" /> Now<br/>
					</label>
					<div class="row" >
						<div class="eight columns">
							<label>
								<input class="laterRadioBtn" name="AVAILABLE_TIME" type="radio" value=""/>
								<span> Later:</span>
								<input id="timeDetailInput" class="timeDetailInput" type="text" disabled="disabled" required/><span></span>
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row tagSelect">
				<div class="twelve columns " >
					<label for="tagSelect">Please choose a tag</label>
					<div class="row" >

					</div>
				</div>
			</div>

			<div class="row">
				<div class="twelve columns">
					<input class="submitBtn button-primary" type="button" value="Save"/>		<!--action:createNewQuestion & questionList-->
				</div>
			</div>
		</form>
	</div>
</div>
<div id="mask"></div>
<div id="toast"></div>
</body>
</html>
