/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in class table from data
function insertItemInClassList(data){
	var classStr = '';
	$obj = $('#main .data .classList');
	$obj.append('<button class="classes selectedClass" onclick="window.location.href=\'./studentQuestions.php?classId='+data.id+'\'">'+data.name+'</button>');
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
	if(data.ROLE=='1') $('#main .title .panel').append('<a href="./ta.php">Switch to TA Dashboard</a>');
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
			else showError(data.MESSAGE);
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
			}else showError(data.MESSAGE);
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
			}else showError(data.MESSAGE);
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
			if(!data.ERROR) showInfo(data.MESSAGE);
			else showError(data.MESSAGE);
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
			//alert(JSON.stringify($('#dialog .addClassForm form').serializeForm()));
			addClassForStudent();
			$('#dialog .addClassForm .close').trigger('click');
			selectedClassId = getStudentsClasses();
			getAllClasses(selectedClassId);
		}
	});
});

function getElementsByClassName(n) {
    var classElements = [],allElements = document.getElementsByTagName('*');
    for (var i=0; i< allElements.length; i++ )
   {
       if (allElements[i].className == n ) {
           classElements[classElements.length] = allElements[i];
        }
   }
   return classElements;
}

$(function() {

	var walkthrough = [{
           popup: {
               content: '<h3>Welcome!</h3>Start a tutorial?',
               type: 'modal'
           }
        }, {
            wrapper: '#titleTag h4',
            popup: {
                content: 'You are in the student dashboard right now.',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: '#addBtn button',
            popup: {
                content: 'Click to add a class.',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: '#addBtn button',
            popup: {
                content: 'Click to check answered questions.',
                type: 'tooltip',
                position: 'bottom'
            }
        }];

    var selectedClassElements = getElementsByClassName('classes selectedClass');
    if(selectedClassElements.length > 0){
    	
		walkthrough.push({
             wrapper: '#addBtn span',
             popup: {
                 content: 'Choose a class to post a question.',
                 type: 'tooltip',
                 position: 'bottom'
             }
        });    	
    }

    if(getSession('role') == 'ta'){
    	walkthrough.push({
            wrapper: '#toTa',
            popup: {
                content: 'Clike here go to ta Dashboard.',
                type: 'tooltip',
                position: 'left'
            }
        });
    }

    // Set up tour
    $('body').pagewalkthrough({
        name: 'introduction',
        steps: walkthrough
    });

	if(getSession('tutorial') == 1){
    	$('body').pagewalkthrough('show');
    }
});
