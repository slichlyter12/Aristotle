/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in class table from data
function insertItemInClassList(data){
	var classStr = '';
	$obj = $('#main .data .classList');
	$obj.append('<button class="classes selectedClass" onclick="window.location.href=\'./studentQuestions.html?classId='+data.id+'\'">'+data.name+'</button>');
};

//insert a column in add class form from data
function insertItemInAddClassForm(selectedClassId, data){
	$obj = $('#dialog .checkbox div');
	var str = '';
	if(-1!=$.inArray(data.id, selectedClassId)) str = 'checked="checked"';
	$obj.append('<input type="checkbox" name="classes" class="classes" '+str+' value='+data.id+'>'+data.name);
};

function showUserLoginInfo(data){
	if(data==null) return;
	var str='';
	if(data.ROLE=='1') str='&nbsp;<a href="./ta.html">Switch to TA Dashboard</a>'
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

//action:getStudentsClasses
function getStudentsClasses(){
	var _selectedClassId = new Array();
	$.ajax({
		type: "get",
		url:"actions/query_class.php?category=student",
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

//action:getAllClasses
function getAllClasses(selectedClassId){
	$.ajax({
		type: "get",
		url:"actions/query_class.php?category=all",
		async:false,
		dataType:"json",
		success: function(data) {
			if(!data.ERROR){
				$('#dialog .checkbox div').html('');
				$.each(data.class_info,function(i,item){
					insertItemInAddClassForm(selectedClassId, item);
				});
			}else openToast(data.ERROR);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

//action:addClassForStudent
function addClassForStudent(){
	$.ajax({
		type: "post",
		url:"actions/addClassForStudent.php",
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
		$.formBox.openDialog('addClassForm');
	});
	//Show classes;
	selectedClassId = getStudentsClasses();
	getAllClasses(selectedClassId);

	//Add class (bind click event for post class button)
	$('#dialog .addClassForm .submitBtn').click(function(){
		if($('#dialog .addClassForm form').checkForm()==true){
			addClassForStudent();
			$('#dialog .addClassForm .close').trigger('click');
			selectedClassId = getStudentsClasses();
			getAllClasses(selectedClassId);
		}
	});
});