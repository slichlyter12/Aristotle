function createCourse () {
	var courseObj = {};
	courseObj.classId = document.getElementsByName("CLASSID")[0].value;
	courseObj.courseName = document.getElementsByName("NAME")[0].value.trim();
	courseTAs = document.getElementsByName("TAS")[0].value.trim();
	courseTags = document.getElementsByName("Tags")[0].value.trim();
	

	if(courseObj.courseName != null && courseObj.courseName != "" 
		&& courseTAs != null && courseTAs != ""
		&& courseTags != null && courseTags != ""){
		courseObj.courseTAs = courseTAs.split(" ");
		courseObj.courseTags = courseTags.split(" ");

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

function displayCurrentCourses(classId) {
	$.ajax({
		type: "get",
		url:"actions/edit_Class.php?class_id="+classId,
		async:false,
		dataType:"json",
		success: function(data) {
			if(!data.ERROR){
				document.getElementsByName("NAME")[0].value = data.DATA[0].class_name;
				document.getElementsByName("TAS")[0].value = data.DATA[0].ta_names;
				document.getElementsByName("Tags")[0].value = data.DATA[0].tag_names;
				document.getElementsByName("CLASSID")[0].value = data.DATA[0].c_id;
				$.formBox.openDialog('addClassForm');
			}else openToast(data.ERROR);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
}

function updateUserName(name) {
	$("#logout_name").html(name);
}

//insert a column in class table from data
function insertItemInClassList(data){
	var classStr = '';
	$obj = $('#main .data .classList');
	$obj.append('<button class="classes selectedClass" onclick="displayCurrentCourses('+data.id+')">'+data.name+'</button>');
};

//insert a column in add class form from data
function insertItemInAddClassForm(selectedClassId, data){
	$obj = $('#dialog .checkbox div');
	var str = '';
	if(-1!=$.inArray(data.id, selectedClassId)) str = 'checked="checked"';
	$obj.append('<span class="classCheckBox" '+str+' ><input type="checkbox" name="classes" '+str+' value='+data.id+'>'+data.name+'</span>');
	$obj.children(".classCheckBox").last().click(function(){
		if(!$(this).attr('checked')) {
			$(this).attr('checked','checked');
			$(this).children('input').attr('checked','checked');
		} else {
			$(this).removeAttr('checked');
			$(this).children('input').removeAttr('checked');
		}
	});
};

function showUserLoginInfo(data){
	if(data==null) return;
	var str='';
	$('#main .title .user ').html('<img onclick="logout()" src="images/svg/logout.svg" /><span>'+data.FIRSTNAME+' '+data.LASTNAME+'</span>'+str);
}

function getLoginInfo(){
	$.ajax({
		type: "post",
		url:"actions/checkUserType.php",
		async:false,
		dataType:"json",
		success: function(data) {
			if(data.ERROR==0) showUserLoginInfo(data.DATA.USERINFO);
			else openToast(data.MESSAGE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
}

//action:getAdminClasses
function getAdminClasses(){
	var _selectedClassId = new Array();
	$.ajax({
		type: "get",
		url:"actions/query_class.php?category=admin",
		async:false,
		dataType:"json",
		success: function(data) {
			if(!data.ERROR){
				$('#main .data .classList').html('');
				$.each(data.class_info,function(i,item){
					insertItemInClassList(item);
					_selectedClassId[i]=item.id;
				});
			}else openToast(data.ERROR);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
	return _selectedClassId;
};

//action:addClassForAdmin
function addClassForAdmin(){
	$.ajax({
		type: "post",
		url:"actions/addClassForAdmin.php",
		async:false,
		data:$('#dialog .addClassForm form').serializeForm(),
		dataType:"json",
		success: function(data) {
			openToast(data.MESSAGE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
}

var selectedClassId = new Array();
/*INIT*/
$('document').ready(function(){
	getLoginInfo();
	var selectedClassId;
	//bind click event for add class button
	$('.openAddClassFormDialog').click(function(){
		document.getElementsByName("CLASSID")[0].value = "";
		$.formBox.openDialog('addClassForm');
	});
	//Show classes;
	selectedClassId = getAdminClasses();

	//  update user name
    updateUserName(getSession('user_name'));

	//Add class (bind click event for post class button)
	$('#dialog .addClassForm .submitBtn').click(function(){
		if($('#dialog .addClassForm form').checkForm()==true){
			addClassForAdmin();
			$('#dialog .addClassForm .close').trigger('click');
			selectedClassId = getAdminClasses();
		}
	});
});
