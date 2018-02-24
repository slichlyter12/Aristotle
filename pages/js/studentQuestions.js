/*THE ACTIONS INTERACTED WITH BACKEND*/
//get get parameter
function getGetParameter(name) { 
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
	var r = window.location.search.substr(1).match(reg); 
	if (r != null) return unescape(r[2]); 
	return null; 
} 

function showQuestionDetail(data){		//::TODO
/*
	if (data[9] == null){
		$('.questionDetail h5').html(data[2]);
	} else {
		$('.questionDetail h5').html(data[2] + "&nbsp; &nbsp; &nbsp;" + data[9]);
	}
	$('.questionDetail p').html(data[1]);
	$.formBox.openDialog('questionDetail');
*/

	if(data[9] == 1)//check whether this question is posted my the user
	{
		$.formBox.openDialog('questionToModify');
		$timeDetailInput.removeAttr('disabled');
		$('#idInput').attr('value',data[0]);
		$('#titleInput').attr('value',data[2]);
		$('#titleInput').attr('disabled',"disabled");
		$('#questextsInput').html(data[1]);
		
	}
	else
	{
		$.formBox.openDialog('questionDetail');
		$('.questionDetail h5').html(data[2]);
		$('.questionDetail p').html(data[1]);
	}
}

function showUserLoginInfo(data){
	if(data==null) return;
	var str='';
	if(data.ROLE=='1') $('#main .title .panel').append('<a href="./ta.php">Switch to TA Dashboard</a>');
	$('#main .title .user ').html('<img onclick="logout()" src="images/svg/logout.svg" /><span>'+data.FIRSTNAME+' '+data.LASTNAME+'</span>'+str);
}

//insert a column in question table from data
function insertColumnInQuestionTable(data){
	var tbodyClassName = '#main .data table tbody'
	$(tbodyClassName).append('<tr questionId="'+data.ID+'"></tr>');
	$obj = $(tbodyClassName + ' tr:last-child');
	$obj.append('<td onclick="getQuestionDetail('+data.ID+');">'+data.TITLE+'</td>')
		.append('<td>'+data.NAME+'</td>').append('<td>'+data.CREATE_TIME+'</td>')
		.append('<td>'+data.STATUS+'</td>')
		.append('<td><span class="memberConut">'+data.NUM_JOIN+'</span></td>');
	if(!data.ISMINE && !data.ISJOIN)
		$obj.append('<td><span class="tableAddition" onclick="joinInAQuestion('+data.ID+');"></span></td>');
	else if(data.ISMINE)
		$obj.append('<td><span></span></td>');
	else
		$obj.append('<td><span class="tableCancel" onclick="quitFromAQuestion('+data.ID+');"></span></td>');
}

function refreshAndMoveToAQuestion(id){
	var screenOffset = $('#main .data table tbody tr[questionId="'+id+'"]').offset().top - $(document).scrollTop();
	getQuestionList(); 
	$('html, body').animate({  
        	scrollTop: $('#main .data table tbody tr[questionId="'+id+'"]').offset().top - screenOffset 
       	}, 700); 
};

function showClassList(data){
	$("#main .title .classNav").append('Course:');
	$("#main .title .classNav").append('<select/>');
	$.each(data.class_info,function(i,item){
		$str='';
		if (item.id==getGetParameter('classId')) $str='selected';
		$("#main .title .classNav select").append('<option value='+item.id+' '+$str+'>'+item.name+'</option>');
	});
	$("#main .title .classNav select").change(function(){
		var classId = $(this).children('option:selected').val();
		window.location.href='./studentQuestions.php?classId='+classId;
	});
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
	$.ajax({
		type: "get",
		url:"actions/query_class.php?category=student",
		async:false,
		dataType:"json",
		success: function(data) {
			if(!data.ERROR) showClassList(data);
			else showError(data.MESSAGE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

//action:getQuestionList
function getQuestionList(){
	var classid = getGetParameter('classId');
	$.ajax({
		type: "get",
		url:"actions/getQuestionList.php?classid="+classid,
		async: false,
		dataType:"json",
		success: function(data) {
			if(data.ERROR == 0){
				$('#main .data table tbody').html('');
				data = data.DATA;
				$.each(data.QUESTIONS, function(i,item) {
					insertColumnInQuestionTable(item);
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

//action:getQuestionDetail
function getQuestionDetail(questionId){
	var classid = getGetParameter('classId');
	$.ajax({
		type: "get",
		url:"actions/getQuestionDetail.php?classid="+classid+"&questionid="+questionId,
		async: false,
		dataType:'json',
		success: function(data) {
			if(data.ERROR == 0){
				//$('.timeDetailInput').timepicker({ 'scrollDefault': 'now' }).timepicker('setTime', new Date());
				showQuestionDetail(data.DATA.QUESTION);
			}else showError(data.MESSAGE);		
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

//action:modifyAQuestion
function modifyAQuestion(){
	classid = getGetParameter('classId');
	$.ajax({
		type: "post",
		url:"actions/modifyAQuestion.php?classid="+classid,
		async: false,
		data:$('#dialog .questionToModify form').serializeForm(),
		dataType:'json',
		success: function(data) {
			openToast(data.MESSAGE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

//action:createNewQuestion
function createNewQuestion(){
	classid = getGetParameter('classId');
	$("#dialog .tagSelect .row .newTagInput").removeAttr("disabled");
	$.ajax({
		type: "post",
		url:"actions/addNewQuestion.php?classid="+classid,
		async: false,
		data:$('#dialog .questionForm form').serializeForm(),
		dataType:'json',
		success: function(data) {
      var currentURL = window.location.href;
      window.location.href = 'https://prometheus.eecs.oregonstate.edu/token?asid=6077469967005125&then=' + currentURL;
			showInfo(data.MESSAGE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

//action:JoinInQuestion
function joinInAQuestion(id){
	classid = getGetParameter('classId');
	$str = '{"id":'+id+'}';
	$.ajax({
		type: "post",
		url:"actions/joinInQuestion.php?classid="+classid,
		async: false,
		data: $str,
		dataType:'json',
		success: function(data) {
			if(data.ERROR == 0) {
				showInfo(data.MESSAGE);
				refreshAndMoveToAQuestion(id);
			}
			else if(data.MESSAGE!=null) showError(data.MESSAGE);

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

//action:QuitFromQuestion
function quitFromAQuestion(id){
	classid = getGetParameter('classId');
	$str = '{"id":'+id+'}';
	$.ajax({
		type: "post",
		url:"actions/quitFromQuestion.php?classid="+classid,
		async: false,
		data: $str,
		dataType:'json',
		success: function(data) {
			if(data.ERROR == 0)	{
				showInfo(data.MESSAGE);
				refreshAndMoveToAQuestion(id);
			}
			else if(data.MESSAGE!=null) showError(data.MESSAGE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

function setInputDisable(value){
	if(value == 0){
		$("#dialog .tagSelect .row .newTagInput").removeAttr("disabled");
		$("#dialog .tagSelect .row .newTagInput").attr("value",'');
	}
	else{
		$("#dialog .tagSelect .row .newTagInput").attr("disabled","disabled");
		$("#dialog .tagSelect .row .newTagInput").removeClass("illegalValue");
		$("#dialog .tagSelect .row .newTagInput").attr("value",'new tag');
	}
}

//action:getTagList
function getTagList(){
	var class_id = getGetParameter('classId');
	var col = 3;
	$('#dialog .tagSelect .row').html('');
	$.ajax({
		type: "get",
		url:"actions/show_tags.php?class_id="+class_id,
		async: false,
		dataType:"json",
		success: function(data) {
			if(!data.ERROR){
				data = data.DATA[0];
				$("#dialog .tagSelect .row").append('<table class="ten columns">')
				$.each(data.tag_info, function(i,item) {
					if((i % col) == 0){
						$("#dialog .tagSelect .row").append("</br><tr>");
					}

					$("#dialog .tagSelect .row").append('<td class="three columns"><input name="tag" type="radio" value="'+item.comment+'" onclick="setInputDisable(\''+item.value+'\');"/><b>'+item.comment+'</b></td>')

					if((i % col) == col - 1){
						$("#dialog .tagSelect .row").append("</tr>");
					}
				});

				if(data.tag_info.length % col != 0){
					$("#dialog .tagSelect .row").append("</tr>");
				}

				$("#dialog .tagSelect .row").append('<tr>')
				$("#dialog .tagSelect .row").append('<td class="ten columns"><input name="tag" type="radio" value="0" onclick="setInputDisable(\'0\');" checked/><b >New tag &nbsp; &nbsp;</b><input name="newTag" class="newTagInput" type="text" value=""/></td>');
				$("#dialog .tagSelect .row").append('</tr>')
				$("#dialog .tagSelect .row").append('</table>')
			}else showError(data.MESSAGE);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});

};

/*INIT*/
$('document').ready(function(){
	getLoginInfo();
	//bind click event for add question button
	$('.openQFormDialog').click(function(){

		if (document.getElementById("questionDiv")) {
        		document.getElementById("questionDiv").style.height = window.innerHeight + "px";
    		}

		$timeDetailInput.attr('disabled',true);
		$.formBox.openDialog('questionForm');
		//time picker plugin
		//$('.timeDetailInput').timepicker({ 'scrollDefault': 'now' }).timepicker('setTime', new Date());
	});
	
	getStudentsClasses();
	//Show questions
	getQuestionList();

	//Init the Timepicker
	getAvailableTime();

	//Init tags
	getTagList();

	//Add question (bind click event for post question button)
	$('#dialog .questionForm .submitBtn').click(function(){
		if($('#dialog .questionForm form').checkForm()==true){
			createNewQuestion();
			getTagList();
			$('#dialog .questionForm .close').trigger('click');
			getQuestionList();
		}
	});
	
	$('#dialog .questionToModify .submitBtn').click(function(){
		if($('#dialog .questionToModify form').checkForm()==true){
			modifyAQuestion();
			$('#dialog .questionToModify .close').trigger('click');
			getQuestionList();
			//alert(JSON.stringify($('#dialog .questionToModify form').serializeForm()));
		}
	});

});


$(function() {
    // Set up tour
    $('body').pagewalkthrough({
        name: 'introduction',
        steps: [{
           popup: {
               content: '<h3>Welcome!</h3>Start a tutorial?',
               type: 'modal'
           }
        }, {
            wrapper: '#titleTag img',
            popup: {
                content: 'Go back to student dashboard.',
                type: 'tooltip',
                position: 'right'
            }
        }, {
            wrapper: '#titleTag p select',
            popup: {
                content: 'Choose another class.',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: '#postBtn input',
            popup: {
                content: 'Click button to post a question.',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: '#questionList tbody tr',
            popup: {
                content: 'Check question information and add a liked question.',
                type: 'tooltip',
                position: 'top'
            }
        }, {
            wrapper: '#toTA',
            popup: {
                content: 'Clike here go to TA Dashboard.',
                type: 'tooltip',
                position: 'left'
            }
        }]
    });

    if(getSession('tutorial') == 1){
    	$('body').pagewalkthrough('show');
    }
    
});

