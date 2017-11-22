// Uncomment if using Node
// var chai = require('chai');
var assert = chai.assert;
var expect = chai.expect;

//  data1 has two joined student, and is signed
var data1 = {"id":1,"class_id":1,"stdnt_first_name":"Jack","stdnt_last_name":"Chan",
    "stdnt_user_id":1,"create_time":"2017-10-05 18:30:25","title":"test","description":"Why ?",
    "course_keywords":"1,2","preferred_time":"2017-10-06 08:30:00","ta_first_name":"Teng",
    "ta_last_name":"Li","ta_user_id":18,"status":"signed",
    "students":[{"first_name":"Jianchang","last_name":"Bi","user_id":13},
    {"first_name":"Jet","last_name":"Li","user_id":3}]};
//  data2 has no joined student, and is proposed
var data2 = {"id":47,"class_id":1,"stdnt_first_name":"Tyrion","stdnt_last_name":"Lannister",
    "stdnt_user_id":8,"create_time":"2017-10-14 23:25:00","title":"TEST",
    "description":"TEST and more","course_keywords":null,"preferred_time":"2017-10-14 21:59:00",
    "ta_first_name":null,"ta_last_name":null,"ta_user_id":null,"status":"proposed","students":null};
//  data3 has one joined student, and is proposed
var data3 = {"id":48,"class_id":1,"stdnt_first_name":"Tyrion","stdnt_last_name":"Lannister",
    "stdnt_user_id":8,"create_time":"2017-10-14 23:35:17","title":"dsadsadsadsa",
    "description":"dsadsadsadsad","course_keywords":null,"preferred_time":"2017-10-14 21:30:00",
    "ta_first_name":null,"ta_last_name":null,"ta_user_id":null,"status":"proposed",
    "students":[{"first_name":"Jianchang","last_name":"Bi","user_id":13}]};
//  data4 has no joined student, and is signed
var data4 = {"id":59,"class_id":1,"stdnt_first_name":"Tyrion","stdnt_last_name":"Lannister",
    "stdnt_user_id":8,"create_time":"2017-10-16 15:16:12","title":"Title_Question",
    "description":"Description","course_keywords":null,"preferred_time":"2017-10-16 15:16:12",
    "ta_first_name":"Teng","ta_last_name":"Li","ta_user_id":18,"status":"signed","students":null};

var data_error = {};

var result1 = '<tr id="question_1"><td><a href="ta_question.html?question_id=1">test</a></td><td>Jack Chan</td><td>2017-10-05 18:30:25</td><td>Teng Li</td><td><span class="memberConut">2</span></td><td></td><td><span class="tableDelete"></span></td></tr>';
var result2 = '<tr id="question_47"><td><a href="ta_question.html?question_id=47">TEST</a></td><td>Tyrion Lannister</td><td>2017-10-14 23:25:00</td><td>proposed</td><td><span class="memberConut">0</span></td><td><span class="tableAssign"></span></td><td><span class="tableDelete"></span></td></tr>';
var result3 = '<tr id="question_48"><td><a href="ta_question.html?question_id=48">dsadsadsadsa</a></td><td>Tyrion Lannister</td><td>2017-10-14 23:35:17</td><td>proposed</td><td><span class="memberConut">1</span></td><td><span class="tableAssign"></span></td><td><span class="tableDelete"></span></td></tr>';
var result4 = '<tr id="question_59"><td><a href="ta_question.html?question_id=59">Title_Question</a></td><td>Tyrion Lannister</td><td>2017-10-16 15:16:12</td><td>Teng Li</td><td><span class="memberConut">0</span></td><td></td><td><span class="tableDelete"></span></td></tr>';

describe('ta_class.js', function() {
  it('should calculate join student number when there are joined students', function(done) {
      assert.equal(studentJoinNumber(data1), 2);
      done();
  });

  it('should calculate join student number when there are no join students', function(done) {
      assert.equal(studentJoinNumber(data2), 0);
      done();
  });

  it('should not calculate join student number with input error', function(done) {
      assert.equal(studentJoinNumber(data_error), 0);
      done();
  });

  it('should generate table column when there are joined students and is signed', function(done) {
      assert.equal(columnInQuestionTable(data1), result1);
      done();
  });

  it('should generate table column when there are no joined students and is proposed', function(done) {
      assert.equal(columnInQuestionTable(data2), result2);
      done();
  });

  it('should generate table column when there are joined students and is proposed', function(done) {
      assert.equal(columnInQuestionTable(data3), result3);
      done();
  });

  it('should generate table column when there are no joined students and is signed', function(done) {
      assert.equal(columnInQuestionTable(data4), result4);
      done();
  });

  it('should not generate table column with input error', function(done) {
      assert.equal(columnInQuestionTable(data_error), "");
      done();
  });

});
