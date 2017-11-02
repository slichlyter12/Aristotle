function logout() {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "actions/logout.php", true);
	xmlhttp.onreadystatechange = function () {
		if(xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){
				console.log(xmlhttp.response);
				if (xmlhttp.responseText == "0") {
					window.location.href = "welcomePage.html";
				} else {
					console.log("Session not destroyed");
				}
			}
		}
	}
	xmlhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	xmlhttp.send();
}
