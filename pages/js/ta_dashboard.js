/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in class table from data
function insertColumnInClassTable(data) {
	var className = '#main .data .classList'
	$obj = $(className);
	if(data['role'] === 1)
		$obj.append("<button class='classes' id='class_" + data['id']
			+ "'>" + data['name'] + "</button>");
}

//	update user name
function updateUserName(name) {
	$("#logout_name").html(name);
}

//action:getClassList
function getClassList(callback){
	$.ajax({
		type: "get",
		url:"actions/query_class.php?category=ta",
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



/*INIT*/
$('document').ready(function(){

	//	show courses
	getClassList((data) => {
		var classes = data['class_info'];
		$('#main .data .classList').html('');
		for(i in classes) {
			insertColumnInClassTable(classes[i]);
		}
	});

	//	update user name
	var user_name = getSession("user_name");
	updateUserName(user_name['first_name'] + ' ' + user_name['last_name']);

	//	bind click event for class button
	$('.classList').on("click", ".classes", function (){
		location.href = 'ta_class.html?class_id=' + $(this).attr('id').substring('class_'.length);
	});
});
