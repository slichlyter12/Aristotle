// Uncomment if using Node
// var chai = require('chai');
var assert = chai.assert;
var expect = chai.expect;


describe('ta_class.js', function() {
  it('should calculate join student number when there are join students', function() {
      var data = {
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
        };
      assert.equal(studentJoinNumber(data), 2);
  });

  it('should calculate join student number when there are no join students', function() {
      var data = {
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
        };
      assert.equal(studentJoinNumber(data), 0);
  });
});
