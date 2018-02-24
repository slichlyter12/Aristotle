<?php

	if (isset($_SESSION["role"]) && $_SESSION["role"] == "ta") {
		echo header("Location: index.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>TA Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/css/normalize.css">
	<link rel="stylesheet" href="lib/css/skeleton.css">
	<link type="text/css" rel="stylesheet" href="lib/css/jquery.pagewalkthrough.css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/myDialog.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="css/classList.css" />
	<script type="text/javascript" src="js/base.js"></script>
	<!-- <script type="text/javascript" src="js/myDialog.js"></script> -->
	<script type="text/javascript" src="js/logout.js"></script>
	<script type="text/javascript" src="js/ta_dashboard.js"></script>
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
	<div class="title row">
		<div id="titleTag" class="twelve columns">
			<h4>TA Dashboard</h4>			<!--page title-->
      <!-- <div>
        <a href='https://prometheus.eecs.oregonstate.edu/token?asid=6077469967005125&then=http://web.engr.oregonstate.edu/~lichlyts/cs561/pages/ta.php'>Get Token</a>
        <br>
      </div> -->
			<div class="user">			<!--user info-->
				<img onclick="logout()" src="images/svg/logout.svg" /> <!--action:logout-->
				<span id="logout_name" style="float:right">XXX</span>
			</div>
			<div id="toStudent" class="panel"><a href="studentDashboard.php">Switch to Student Dashboard</a></div>
		</div>
	</div>
	<div class="funcs row" >
		<div class="four columns">
			<h5 class="subTitle">All Courses</h5>
			<!--<input class="searchInput" type="text" placeholder="Search"/>-->
		</div>
	</div>

	<div class="data row">
		<div id="taClass" class="twelve columns">
			<span class="classList"></span>
		</div>
	</div>
</div>

</body>
</html>

<script>

</script>
