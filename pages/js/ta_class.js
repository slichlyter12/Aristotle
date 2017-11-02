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
	$(tbodyClassName).append('<tr id="question_' + data['id'] + '"></tr>');
	$obj = $(tbodyClassName + ' tr:last-child');
	$obj.append('<td><a href="ta_question.html?question_id=' + data['id'] + '">' + data['title'] + '</a></td>')
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
 * @param {Function} callback
 */
 function getQuestionList(class_id, callback){
	$.ajax({
		type: "get",
		url:"actions/question_list.php?class_id=" + class_id,
		async: true,
		dataType:"json",
		success: function(data) {
            callback(data);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(XMLHttpRequest.readyState);
			alert(textStatus);
		}
	});
};

/**
 * update user name
 * @param {String} class_id
 * @param {Function} callback
 */
 function assignQuestion(question_id, callback){
	$.ajax({
		type: "put",
		url:"actions/assign_question.php",
		async: true,
        data: {"question_id":question_id, "status": 3},
		dataType:"json",
		success: function(data) {
            callback(data);
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
    
    //  require parameters in url
    var class_id = getUrlParam('class_id');

    //  get questions in this class, implement elements operation in callback
    getQuestionList(class_id, (data) => {
        $('#main .data table tbody').html('');
        var questions = data["questions"];
        //Show questions
        for (i in questions) {
            insertColumnInQuestionTable(questions[i]);
            var question_str = JSON.stringify(questions[i]);
            setSession("question_" + questions[i]['id'], question_str);
        }
    });

    //
    updateUserName(getSession('user_name'));

    //  bind click event for assign class button
    $('#main .data table').on("click", ".tableAddition", function() {
        var question_id = $(this).parent().parent().attr('id').substring("question_".length);
        console.log("question_id = " + question_id);
        assignQuestion(question_id, (data) => {
            window.location.reload();
        });
    });
});
