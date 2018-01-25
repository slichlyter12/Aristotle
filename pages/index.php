<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/login_page/style.css">
		<link rel="icon" type="image/png" href="./images/login_page/logo.png">
	</head>
	
	<body>
		<main>
			<div id="logo" onclick="location="./index.php""></div>
			<h1>Aristotle</h1>
			<link rel="stylesheet" type="text/css" href="./css/login_page/home-style.css">
			<div class="tagline">A site for students to post your question of the courses and help TAs to manage their office hours.</div>
			<form action="login" method="post"><input class="btn" type="submit" value="Log in" autofocus></form>
			<footer></footer>
		</main>
	</body>
	<script>
		var hdrs =  document.getElementsByTagName("H1");
			if (hdrs && hdrs.length) {
				if (!document.title) {
					document.title = hdrs[0].innerText;
				}
			hdrs[0].addEventListener('click', function(e) { if (e.offsetX < 0) location = '/home'; });
			}
	</script>
</html>
