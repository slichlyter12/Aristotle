function createCourse () {
	function createCourse () {
	var courseObj = {};
	courseObj.courseName = document.getElementsByName("NAME")[0].value;
	courseTAs = document.getElementsByName("TAS")[0].value;
	courseObj.courseTAs = courseTAs.split(" ");
	console.log(courseObj);
	var str = JSON.stringify(courseObj);
	str = "x=" + encodeURIComponent(str);
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "actions/createCourse.php", true);
	xmlhttp.onreadystatechange = function () {
		if(xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){
				
			}
		}
	}
	xmlhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(str);
	
}

}



function displayCurrentCourses() {
	
	
}
