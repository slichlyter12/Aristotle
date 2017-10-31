/*THE ACTIONS INTERACTED WITH BACKEND*/

//insert a column in question table from data
function insertColumnInQuestionTable(data){
    var student_user_name = data['stdnt_first_name'] + ' ' + data['stdnt_last_name'];
    var student_join_number = 0;
    if(data['students'] !== null) {
        student_join_number = data['students'].length;
    }
    var tbodyClassName = '#main .data table tbody';
	$(tbodyClassName).append('<tr></tr>');
	$obj = $(tbodyClassName + ' tr:last-child');
	$obj.append('<td>' + data['title'] + '</td>')
		.append('<td>' + student_user_name + '</td>')
        .append('<td>' + data['create_time'] + '</td>')
		.append('<td>' + data['status'] + '</td>')
		.append('<td><span class="memberConut">' + student_join_number + '</span></td>')
		.append('<td><span class="tableAddition"></span></td>');
}

//action:getQuestionList
function getQuestionList(){
	$.ajax({
		type: "get",
		url:"actions/getQuestionList.php",
		async: true,
		dataType:"json",
		success: function(data) {
			if(data.ERROR==null){
				$('#main .data table tbody').html('');
				$.each(data.QUESTIONS, function(i,item) {
					insertColumnInQuestionTable(item);
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

//action:createNewQuestion
function createNewQuestion(){
	$.ajax({
		type: "post",
		url:"actions/addNewQuestion.php",
		async: false,
		data:$('#dialog .questionForm form').serializeForm(),
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

/*
//action:JoinInAQuestion
$('#main .data table .tableAddition').click(function(){
});
//action:deleteQuestionByOwner
$('#main .data table .tableRemove').click(function(){
});
*/

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); // construct regexp object
    var r = window.location.search.substr(1).match(reg);  //  matach target parameter
    if (r != null) return unescape(r[2]); return null;
}

/*INIT*/
$('document').ready(function(){

    //  require parameters in url
    var class_id = getUrlParam('class');

    //  fake data
    var json_data = {
    "questions": [
        {
            "id": 1,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 18:30:25",
            "title": "test",
            "description": "Why ?",
            "course_keywords": "1,2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": [
                {
                    "first_name": "Jet",
                    "last_name": "Li",
                    "user_id": 3
                }
            ]
        },
        {
            "id": 2,
            "class_id": 1,
            "stdnt_first_name": "Bruce",
            "stdnt_last_name": "Lee",
            "stdnt_user_id": 2,
            "create_time": "2017-10-06 11:37:13",
            "title": "test1",
            "description": "How ?",
            "course_keywords": "3",
            "preferred_time": "2017-10-07 08:30:00",
            "ta_first_name": "Bruce",
            "ta_last_name": "Lee",
            "ta_user_id": 2,
            "status": "signed",
            "students": [
                {
                    "first_name": "Daenerys",
                    "last_name": "Targaryen",
                    "user_id": 6
                },
                {
                    "first_name": "Jon",
                    "last_name": "Snow",
                    "user_id": 4
                }
            ]
        },
        {
            "id": 3,
            "class_id": 1,
            "stdnt_first_name": "Jaime",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 7,
            "create_time": "2017-10-07 12:20:35",
            "title": "test2",
            "description": "what ?",
            "course_keywords": "1,2,3",
            "preferred_time": "2017-10-08 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 4,
            "class_id": 1,
            "stdnt_first_name": "Daenerys",
            "stdnt_last_name": "Tyrion",
            "stdnt_user_id": 6,
            "create_time": "2017-10-08 13:30:23",
            "title": "test3",
            "description": "When ?",
            "course_keywords": null,
            "preferred_time": "2017-10-09 11:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": [
                {
                    "first_name": "Tyrion",
                    "last_name": "Lannister",
                    "user_id": 8
                }
            ]
        },
        {
            "id": 11,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 18:30:25",
            "title": "test1",
            "description": "Why ?",
            "course_keywords": "1,2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 12,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 19:30:25",
            "title": "test2",
            "description": "Why ?",
            "course_keywords": "1,2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 13,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 20:30:25",
            "title": "test3",
            "description": "Why ?",
            "course_keywords": "2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 14,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 21:30:25",
            "title": "test4",
            "description": "Why ?",
            "course_keywords": "2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 15,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 22:30:25",
            "title": "test5",
            "description": "Why ?",
            "course_keywords": "2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 16,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 17:20:25",
            "title": "test6",
            "description": "Why ?",
            "course_keywords": "1,2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 17,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 16:30:25",
            "title": "test7",
            "description": "Why ?",
            "course_keywords": "1,2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 18,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 15:30:25",
            "title": "test8",
            "description": "Why ?",
            "course_keywords": "1,2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 19,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 14:30:25",
            "title": "test9",
            "description": "Why ?",
            "course_keywords": "1,2",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 20,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 13:30:25",
            "title": "test10",
            "description": "Why ?",
            "course_keywords": "1",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 21,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 12:30:25",
            "title": "test1",
            "description": "Why ?",
            "course_keywords": "1",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 22,
            "class_id": 1,
            "stdnt_first_name": "Jack",
            "stdnt_last_name": "Chan",
            "stdnt_user_id": 1,
            "create_time": "2017-10-05 11:30:25",
            "title": "test12",
            "description": "Why ?",
            "course_keywords": "1",
            "preferred_time": "2017-10-06 08:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "answered",
            "students": null
        },
        {
            "id": 47,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-14 23:25:00",
            "title": "TEST",
            "description": "TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST",
            "course_keywords": null,
            "preferred_time": "2017-10-14 21:59:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 48,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-14 23:35:17",
            "title": "dsadsadsadsa",
            "description": "dsadsadsadsad",
            "course_keywords": null,
            "preferred_time": "2017-10-14 21:30:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 49,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-14 23:51:56",
            "title": "sa'd'sa'd",
            "description": "sadsadsad",
            "course_keywords": null,
            "preferred_time": "2017-10-14 23:51:56",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 50,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-14 23:52:09",
            "title": "sadasd",
            "description": "asdsad",
            "course_keywords": null,
            "preferred_time": "2017-10-14 23:52:09",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 51,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-15 00:21:50",
            "title": "asdsad",
            "description": "sadsadsad",
            "course_keywords": null,
            "preferred_time": "2017-10-15 00:21:50",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 52,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-15 00:22:36",
            "title": "asds",
            "description": "sad",
            "course_keywords": null,
            "preferred_time": "2017-10-15 00:22:36",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 53,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-15 00:22:40",
            "title": "asd",
            "description": "sdsd",
            "course_keywords": null,
            "preferred_time": "2017-10-15 00:22:40",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 54,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-15 00:22:44",
            "title": "sadsadsd",
            "description": "sadsad",
            "course_keywords": null,
            "preferred_time": "2017-10-15 00:22:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 55,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-15 00:25:48",
            "title": "asdsad",
            "description": "sadsadsad",
            "course_keywords": null,
            "preferred_time": "2017-10-15 00:25:48",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 56,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-15 00:25:58",
            "title": "ts",
            "description": "ts",
            "course_keywords": null,
            "preferred_time": "2017-10-15 00:25:58",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 57,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-15 18:58:25",
            "title": "test 6666",
            "description": "6666666666",
            "course_keywords": null,
            "preferred_time": "2017-10-15 18:58:25",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 58,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-16 14:03:33",
            "title": "hahahahhaha",
            "description": "hahahah",
            "course_keywords": null,
            "preferred_time": "2017-10-16 15:00:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 59,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-16 15:16:12",
            "title": "Title_Question",
            "description": "Description",
            "course_keywords": null,
            "preferred_time": "2017-10-16 15:16:12",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 60,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-17 14:08:06",
            "title": "I would place a summary here.",
            "description": "And then my full question here",
            "course_keywords": null,
            "preferred_time": "2017-10-17 15:00:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 61,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-17 14:09:45",
            "title": "q",
            "description": "q",
            "course_keywords": null,
            "preferred_time": "2017-10-17 14:09:45",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 62,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-17 17:05:56",
            "title": "I have a question",
            "description": "This is my question",
            "course_keywords": null,
            "preferred_time": "2017-10-17 17:05:56",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 63,
            "class_id": 1,
            "stdnt_first_name": "Samuel",
            "stdnt_last_name": "Lichlyter",
            "stdnt_user_id": 11,
            "create_time": "2017-10-17 17:08:26",
            "title": "new question",
            "description": "another question",
            "course_keywords": null,
            "preferred_time": "2017-10-17 17:08:26",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 64,
            "class_id": 1,
            "stdnt_first_name": "Samuel",
            "stdnt_last_name": "Lichlyter",
            "stdnt_user_id": 11,
            "create_time": "2017-10-17 17:22:45",
            "title": "New Question",
            "description": "Another test question",
            "course_keywords": null,
            "preferred_time": "2017-10-17 17:22:45",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 65,
            "class_id": 1,
            "stdnt_first_name": "Tyrion",
            "stdnt_last_name": "Lannister",
            "stdnt_user_id": 8,
            "create_time": "2017-10-17 17:59:11",
            "title": "Test by Bi",
            "description": "contemt",
            "course_keywords": null,
            "preferred_time": "2017-10-17 17:59:11",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 66,
            "class_id": 1,
            "stdnt_first_name": "Jianchang",
            "stdnt_last_name": "Bi",
            "stdnt_user_id": 13,
            "create_time": "2017-10-17 18:06:22",
            "title": "sdsadsa",
            "description": "dsadsadsad",
            "course_keywords": null,
            "preferred_time": "2017-10-17 18:06:22",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 68,
            "class_id": 1,
            "stdnt_first_name": "Jianchang",
            "stdnt_last_name": "Bi",
            "stdnt_user_id": 13,
            "create_time": "2017-10-17 19:20:02",
            "title": "Title",
            "description": "Test",
            "course_keywords": null,
            "preferred_time": "2017-10-17 19:20:02",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 69,
            "class_id": 1,
            "stdnt_first_name": "Jianchang",
            "stdnt_last_name": "Bi",
            "stdnt_user_id": 13,
            "create_time": "2017-10-17 19:48:58",
            "title": "Hi",
            "description": "Testetst",
            "course_keywords": null,
            "preferred_time": "2017-10-17 20:00:00",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 70,
            "class_id": 1,
            "stdnt_first_name": "Deqing",
            "stdnt_last_name": "Qu",
            "stdnt_user_id": 15,
            "create_time": "2017-10-19 14:35:13",
            "title": "TestQ",
            "description": "TestDes",
            "course_keywords": null,
            "preferred_time": "2017-10-19 14:35:13",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 71,
            "class_id": 1,
            "stdnt_first_name": "Deqing",
            "stdnt_last_name": "Qu",
            "stdnt_user_id": 15,
            "create_time": "2017-10-19 14:37:13",
            "title": "SendByPostman",
            "description": "This is a question send by Postman",
            "course_keywords": null,
            "preferred_time": "2017-10-19 14:37:13",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 72,
            "class_id": 1,
            "stdnt_first_name": "Deqing",
            "stdnt_last_name": "Qu",
            "stdnt_user_id": 15,
            "create_time": "2017-10-19 14:38:33",
            "title": "SendByPostman",
            "description": "This is a question send by Postman",
            "course_keywords": null,
            "preferred_time": "2017-10-19 14:38:33",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 73,
            "class_id": 1,
            "stdnt_first_name": "Deqing",
            "stdnt_last_name": "Qu",
            "stdnt_user_id": 15,
            "create_time": "2017-10-19 14:39:04",
            "title": "SendByPostman",
            "description": "This is a question send by Postman",
            "course_keywords": null,
            "preferred_time": "2017-10-19 14:39:04",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        },
        {
            "id": 74,
            "class_id": 1,
            "stdnt_first_name": "Daniel",
            "stdnt_last_name": "Lin",
            "stdnt_user_id": 20,
            "create_time": "2017-10-23 20:34:11",
            "title": "Why am i in grad school",
            "description": "I need help plz thanks ",
            "course_keywords": null,
            "preferred_time": "2017-10-23 20:34:11",
            "ta_first_name": null,
            "ta_last_name": null,
            "ta_user_id": null,
            "status": "proposed",
            "students": null
        }]
    }
    var questions = json_data["questions"];
    //Show questions
    for (i in questions) {
        insertColumnInQuestionTable(questions[i]);
    }

});
