/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in class table from data
function insertColumnInClassTable(data){
	var className = '#main .data .classList'
	$obj = $(className);
	if(data.ISSELECT=='1')
		$obj.append('<button class="classes selectedClass">'+data.NAME+'</button>');
	else
		$obj.append('<button class="classes">'+data.NAME+'</button>');
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
	//bind click event for add class button
	$('.openAddClassFormDialog').click(function(){
		$.formBox.openDialog('addClassForm');
	});
	//Show classes
	getClassList();
	
	//Add class (bind click event for post class button)
	$('#dialog .addClassForm .submitBtn').click(function(){
		if($('#dialog .addClassForm form').checkForm()==true){
			//alert(JSON.stringify($('#dialog .addClassForm form').serializeForm()));			//For test
			createNewClass();
			$('#dialog .addClassForm .close').trigger('click');
			getClassList();
		}
	});
});