/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in class table from data
function insertColumnInClassTable(data){
	var className = '#main .data .classList'
	$obj = $(className);
	if(data['role'] === '1')
		$obj.append("<button class='classes selectedClass' id='class" + data['id']
			+ "'>" + data['name'] + "</button>");
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

//action:createNewClass
function createNewClass(){
	$.ajax({
		type: "post",
		url:"actions/addNewClass.php",
		async: false,
		data:$('#dialog .addClassForm form').serializeForm(),
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

/*INIT*/
$('document').ready(function(){
	//	Make Fake data
	var json_data = {
		'user_info': {
			'id': '001',
			'osu_id': 'qud',
			'last_name': 'qu',
			'first_name': 'deqing',
			'role': '1',
			'session_data': 'ajfASDFafjhaf'
		},
		'class_info': [
			{ 'id': '1', 'name': 'CS561', 'role': '1' },
			{ 'id': '2', 'name': 'CS519', 'role': '0' },
			{ 'id': '3', 'name': 'CS290', 'role': '1' },
			{ 'id': '4', 'name': 'CS496', 'role': '1' },
			{ 'id': '5', 'name': 'CS507', 'role': '0' },
			{ 'id': '6', 'name': 'CS321', 'role': '1' },
			{ 'id': '7', 'name': 'CS344', 'role': '0' },
			{ 'id': '8', 'name': 'CS551', 'role': '1' }
		]
	};
	var classes = json_data['class_info'];
	$('#main .data .classList').html('');
	for(i in classes) {
		insertColumnInClassTable(classes[i]);
	}


	//bind click event for add class button
	// $('.openAddClassFormDialog').click(function(){
	// 	$.formBox.openDialog('addClassForm');
	// });

	//Show classes
	// getClassList();

	// //Add class (bind click event for post class button)
	// $('#dialog .addClassForm .submitBtn').click(function(){
	// 	if($('#dialog .addClassForm form').checkForm()==true){
	// 		//alert(JSON.stringify($('#dialog .addClassForm form').serializeForm()));			//For test
	// 		createNewClass();
	// 		$('#dialog .addClassForm .close').trigger('click');
	// 		getClassList();
	// 	}
	// });
});
