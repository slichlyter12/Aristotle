/*THE ACTIONS INTERACTED WITH BACKEND*/

/**
 * generate a column DOM in class table
 * @param {object} data
 * @return {string}
 */
function columnInClassTable(data) {
	if(data['role'] === 1 && data['id'] !== undefined && data['name'] !== undefined) {
		return "<button class='classes' id='class_" + data['id']
			+ "'>" + data['name'] + "</button>";
	}
	else {
		return "";
	}
}

/**
 * update user name
 * @param {string} name
 */
function updateUserName(name) {
	$("#logout_name").html(name);
}

/**
 * call api - get: class list
 * @param {function} callback
 */
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
			// insertColumnInClassTable(classes[i]);
			$('#main .data .classList').append(columnInClassTable(classes[i]))
		}
	});

	//	update user name
	updateUserName(getSession('user_name'));

	//	bind click event for class button
	$('.classList').on("click", ".classes", function (){
		location.href = 'ta_class.php?class_id=' + $(this).attr('id').substring('class_'.length);
	});
});


$(function() {
    // Set up tour
    $('body').pagewalkthrough({
        name: 'introduction',
        steps: [{
           popup: {
               content: '<h3>Welcome!</h3>Start a tutorial?',
               type: 'modal'
           }
        }, {
            wrapper: '#titleTag h4',
            popup: {
                content: 'You are in the TA dashboard right now.',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: '#taClass span',
            popup: {
                content: 'Choose a class.',
                type: 'tooltip',
                position: 'bottom'
            }
        }, {
            wrapper: '#toStudent',
            popup: {
                content: 'Clike here go to student Dashboard.',
                type: 'tooltip',
                position: 'left'
            }
        }]
    });

    if(getSession('tutorial') == 1){
    	$('body').pagewalkthrough('show');
    }
    
});
