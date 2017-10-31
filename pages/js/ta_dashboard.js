/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in class table from data
function insertColumnInClassTable(data) {
	var className = '#main .data .classList'
	$obj = $(className);
	if(data['role'] === '1')
		$obj.append("<button class='classes' id='class" + data['id']
			+ "'>" + data['name'] + "</button>");
}

//	update user name
function updateUserName(name) {
	$("#logout_name").html(name);
}

//action:getClassList
function getClassList(){
	$.ajax({
		type: "post",
		url:"actions/getClassList.php",
		async: true,
		dataType:"json",
		success: function(data) {
			if(data.ERROR==null){
				$('#main .data .classList').html('');
				$.each(data.CLASSES, function(i,item) {
					insertColumnInClassTable(item);
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

/*INIT*/
$('document').ready(function(){
	//	Make Fake data
	var json_data = {
		'user_info': {
			'id': '001',
			'osu_id': 'qud',
			'last_name': 'Qu',
			'first_name': 'Deqing',
			'role': '1',
			'session_data': 'ajfASDFafjhaf'
		},
		'class_info': [
			{ 'id': '1', 'name': 'CS561', 'role': '1' },
			{ 'id': '2', 'name': 'CS519', 'role': '1' },
			{ 'id': '3', 'name': 'CS290', 'role': '1' },
			{ 'id': '4', 'name': 'CS496', 'role': '1' },
			{ 'id': '5', 'name': 'CS507', 'role': '1' },
			{ 'id': '6', 'name': 'CS321', 'role': '1' },
			{ 'id': '7', 'name': 'CS344', 'role': '1' },
			{ 'id': '8', 'name': 'CS551', 'role': '1' }
		]
	};
	var classes = json_data['class_info'];
	//	show courses
	$('#main .data .classList').html('');
	for(i in classes) {
		insertColumnInClassTable(classes[i]);
	}

	//	update user name
	updateUserName(json_data['user_info']['first_name'] + ' ' + json_data['user_info']['last_name']);

	//	bind click event for class button
	$('.classes').click(function() {
		location.href = 'ta_class.html?class=' + $(this).attr('id').substring('class'.length);
	});
});
