/*THE ACTIONS INTERACTED WITH BACKEND*/

/**
 * insert a column in question table from data
 * @param {Object} data
 */
function insertColumnInQuestionTable(data){
    //  status == 'answered'
    // if (data['status'] === 'answered') {
    //     return;
    // }
    //  accquire variables
    var student_user_name = data['stdnt_first_name'] + ' ' + data['stdnt_last_name'];
    var student_join_number = 0;
    if(data['students'] !== null) {
        student_join_number = data['students'].length;
    }
    //  append elements
    var tbodyClassName = '#main .data table tbody';
	$(tbodyClassName).append('<tr></tr>');
	$obj = $(tbodyClassName + ' tr:last-child');
	$obj.append('<td>' + data['title'] + '</td>')
		.append('<td>' + student_user_name + '</td>')
        .append('<td>' + data['create_time'] + '</td>');
    //  if question is signed, show ta's name
    if (data['status'] === 'signed') {
        $obj.append('<td>' + data['ta_first_name'] + ' ' + data['ta_last_name'] + '</td>')
    }
    else {
        $obj.append('<td>' + data['status'] + '</td>')
    }
	$obj.append('<td><span class="memberConut">' + student_join_number + '</span></td>');
    //  if question is proposed, show add buttion
    if (data['status'] === 'proposed') {
        $obj.append('<td><span class="tableAddition"></span></td>');
    }
    else {
        $obj.append('<td></td>');
    }
}

/**
 * update user name
 * @param {String} name
 */
function updateUserName(name) {
	$("#logout_name").html(name);
}

/**
 * update user name
 * @param {String} class_id
 */
 function getQuestionList(class_id){
	$.ajax({
		type: "get",
		url:"actions/question_list.php?class_id=" + class_id,
		async: true,
		dataType:"json",
		success: function(data) {
            $('#main .data table tbody').html('');
            var questions = data["questions"];
            //Show questions
            for (i in questions) {
                insertColumnInQuestionTable(questions[i]);
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
//action:JoinInAQuestion
$('#main .data table .tableAddition').click(function(){
});
//action:deleteQuestionByOwner
$('#main .data table .tableRemove').click(function(){
});
*/

/**
 * get parameter value from URL
 * @param {String} key
 * @return {String} parameter value of key
 */
function getUrlParam(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)"); // construct regexp object
    var r = window.location.search.substr(1).match(reg);  //  matach target parameter
    if (r != null) return unescape(r[2]); return null;
}

/*INIT*/
$('document').ready(function(){

    //  require parameters in url
    var class_id = getUrlParam('class');
    getQuestionList(class_id);

    updateUserName(getSession('user_name'));
});
