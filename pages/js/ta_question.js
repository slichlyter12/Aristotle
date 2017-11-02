/*THE ACTIONS INTERACTED WITH BACKEND*/

/**
 * update user name
 * @param {String} name
 */
function updateUserName(name) {
	$("#logout_name").html(name);
}

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

    //  require parameters in url
    var question_id = getUrlParam('question_id');
    var question_str = getSession('question_' + question_id);
	var question = JSON.parse(question_str);
	console.log(question);

    updateUserName(getSession('user_name'));
});
