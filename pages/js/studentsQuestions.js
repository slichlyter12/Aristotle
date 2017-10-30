/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in question table from data
function insertColumnInQuestionTable(data){
	var tbodyClassName = '#main .data table tbody'
	$(tbodyClassName).append('<tr></tr>');
	$obj = $(tbodyClassName + ' tr:last-child');
	$obj.append('<td>'+data.TITLE+'</td>')
		.append('<td>'+data.NAME+'</td>').append('<td>'+data.CREATE_TIME+'</td>')
		.append('<td>'+data.STATUS+'</td>')
		.append('<td><span class="memberConut">'+data.NUM_JOIN+'</span></td>');
	if(data.ISMINE=='0'&&data.ISJOIN=='0')
		$obj.append('<td><span class="tableAddition" onclick="joinInAQuestion('+data.ID+');"></span></td>');
	else if(data.ISMINE=='1')
		$obj.append('<td><span></span></td>');
	else
		$obj.append('<td><span class="tableCancel" onclick="quitFromAQuestion('+data.ID+');"></span></td>');

}

//action:getQuestionList
function getQuestionList(){
	$.ajax({
		type: "get",
		url:"actions/getQuestionList.php",
		async: true,
		dataType:"json",
		success: function(data) {
			if(data.ERROR==null){
				$('#main .data table tbody').html('');
				$.each(data.QUESTIONS, function(i,item) {
					insertColumnInQuestionTable(item);
				});
			}else
				openToast(data.ERROR);
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
	$.ajax({
		type: "post",
		url:"actions/addNewQuestion.php",
		async: false,
		data:$('#dialog .questionForm form').serializeForm(),
		dataType:'text',
		success: function(data) {
			openToast(data);
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
	$str = '{"id":'+id+'}';
	$.ajax({
		type: "post",
		url:"actions/joinInQuestion.php",
		async: false,
		data: $str,
		dataType:'json',
		success: function(data) {
			openToast(data.MESSAGE);
			if(!data.ERROR){
				alert(data.DATA);
			}
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
	$str = '{"id":'+id+'}';
	$.ajax({
		type: "post",
		url:"actions/quitFromQuestion.php",
		async: false,
		data: $str,
		dataType:'json',
		success: function(data) {
			openToast(data.MESSAGE);
			if(!data.ERROR){
				alert(data.DATA);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};


/*
//action:deleteQuestionByOwner
$('#main .data table .tableRemove').click(function(){
});
*/

/*INIT*/
$('document').ready(function(){
	//bind click event for add question button
	$('.openQFormDialog').click(function(){
		$.formBox.openDialog('questionForm');
		//time picker plugin
		$('.timeDetailInput').timepicker({ 'scrollDefault': 'now' }).timepicker('setTime', new Date());
	});

	//Show questions
	getQuestionList();
	//Init the Timepicker
	getAvailableTime();

	//Add question (bind click event for post question button)
	$('#dialog .questionForm .submitBtn').click(function(){
		if($('#dialog .questionForm form').checkForm()==true){
			//alert(JSON.stringify($('#dialog .questionForm form').serializeForm()));			//For test
			createNewQuestion();
			$('#dialog .questionForm .close').trigger('click');
			getQuestionList();
		}
	});

});