/*THE ACTIONS INTERACTED WITH BACKEND*/



/**
 * calculate number of joined students
 * @param {object} data
 * @return {number}
 */
function studentJoinNumber(data) {
    if(data['students'] !== null) {
        return data['students'].length;
    }
    else {
        return 0;
    }
}

/**
 * generate a column in question table from data
 * @param {object} data
 * @return {string}
 */
function columnInQuestionTable(data) {
    var string = '<tr id="question_' + data['id'] + '">';
    string += '<td><a href="ta_question.html?question_id=' + data['id'] + '">' + data['title'] + '</a></td>';
    string += '<td>' + data['stdnt_first_name'] + ' ' + data['stdnt_last_name'] + '</td>';
    string += '<td>' + data['create_time'] + '</td>';
    //  if question is signed, show ta's name
    if (data['status'] === 'signed') {
        string += '<td>' + data['ta_first_name'] + ' ' + data['ta_last_name'] + '</td>';
    }
    else {
        string += '<td>' + data['status'] + '</td>';
    }
    string += '<td><span class="memberConut">' + studentJoinNumber(data) + '</span></td>';
    //  if question is proposed, show add buttion
    if (data['status'] === 'proposed') {
        string += '<td><span class="tableAddition"></span></td>';
    }
    else {
        string += '<td></td>';
    }
    string += '</tr>';
    return string;
}

/**
 * update user name
 * @param {string} name
 */
function updateUserName(name) {
	$("#logout_name").html(name);
}

/**
 * update user name
 * @param {string} class_id
 * @param {function} callback
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
 * @param {string} class_id
 * @param {function} callback
 */
 function assignQuestion(question_id, callback){
	$.ajax({
		type: "post",
		url:"actions/assign_question.php",
		async: true,
        data: {"question_id": question_id},
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
            $('#main .data table tbody').append(columnInQuestionTable(questions[i]));
            var question_str = JSON.stringify(questions[i]);
            setSession("question_" + questions[i]['id'], question_str);
        }
    });

    //  update user name 
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
