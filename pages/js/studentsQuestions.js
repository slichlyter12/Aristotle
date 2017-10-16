/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in question table from data
function insertColumnInQuestionTable(data){
	var tbodyClassName = '#main .data table tbody'
	$(tbodyClassName).append('<tr></tr>');
	$obj = $(tbodyClassName + ' tr:last-child');
	$obj.append('<td>'+data.TITLE+'</td>')
		.append('<td>'+data.NAME+'</td>').append('<td>'+data.CREATE_TIME+'</td>')
		.append('<td>'+data.STATUS+'</td>')
		.append('<td><span class="memberConut">'+data.NUM_JOIN+'</span></td>')
		.append('<td><span class="tableAddition"></span></td>');
}

//action:getQuestionList
function getQuestionList(){
	$.ajax({
		type: "get",
		url:"actions/getQuestionList.php",
		async: true,
		dataType:"json",
		success: function(data) {
			$('#main .data table tbody').html('');
			$.each(data.QUESTIONS, function(i,item) {
				insertColumnInQuestionTable(item);
			});
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
		beforeSend: function(XMLHttpRequest) {
			XMLHttpRequest.setRequestHeader("UserId", "900000008");
		},
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

/*
//action:JoinInAQuestion
$('#main .data table .tableAddition').click(function(){
});
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