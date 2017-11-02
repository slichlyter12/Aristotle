/*THE ACTIONS INTERACTED WITH BACKEND*/

/**
 * update user name
 * @param {String} name
 */
function updateUserName(name) {
	$("#logout_name").html(name);
}

function updateQuesionTitle(title) {
	$("#question_title").append('<h5>' + title + '</h5>');
}

function updateQuesionTime(time) {
	$("#question_time").append('<p>' + time + '</p>');
}

function updateQuesionDesc(desc) {
	$("#question_desc").append('<p>' + desc + '</p>');
}

function addStudent(name) {
	$obj = $('#main .data .studentList');
	$obj.append("<button class='students'>" + name + "</button>");
}

/*INIT*/
$('document').ready(function(){

    //  require parameters in url
    var question_id = getUrlParam('question_id');
    var question_str = getSession('question_' + question_id);
	var question = JSON.parse(question_str);
	updateQuesionTitle(question['title']);
	updateQuesionTime(question['create_time'])
	updateQuesionDesc(question['description']);
	addStudent(question['stdnt_first_name'] + ' ' + question['stdnt_last_name']);
	for (i in question['students']) {
		addStudent(question['students'][i]['first_name'] + ' ' + question['students'][i]['first_name']);
	}
    updateUserName(getSession('user_name'));

});
