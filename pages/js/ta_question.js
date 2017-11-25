/*THE ACTIONS INTERACTED WITH BACKEND*/

/**
 * update user name
 * @param {String} name
 */
function updateUserName(name) {
	$("#logout_name").html(name);
}

function updateQuesionTitle(title, tag) {
	if (tag == null){
		tag = "";
	}
	$("#question_title").append('<h5>' + title + '&nbsp; &nbsp; &nbsp;'+ tag +'</h5>');
}

function updateQuesionTime(time) {
	$("#question_time").append('<p>' + time + '</p>');
}

function updateQuesionDesc(desc) {
	$("#question_desc").append('<p>' + desc + '</p>');
}

function addStudent(name) {
	$('#main .data .studentList').append("<p class='students'>" + name + "</p>");
}

/*INIT*/
$('document').ready(function(){

    //  require parameters in url
    var question_id = getUrlParam('question_id');
    var question_str = getSession('question_' + question_id);
	var question = JSON.parse(question_str);
	updateQuesionTitle(question['title'], question['course_keywords']);
	updateQuesionTime(question['create_time'])
	updateQuesionDesc(question['description']);
	addStudent(question['stdnt_first_name'] + ' ' + question['stdnt_last_name']);
	for (i in question['students']) {
		addStudent(question['students'][i]['first_name'] + ' ' + question['students'][i]['first_name']);
	}
    updateUserName(getSession('user_name'));

});


function A(){}
