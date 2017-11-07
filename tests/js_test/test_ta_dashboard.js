// Uncomment if using Node
// var chai = require('chai');
var assert = chai.assert;
var expect = chai.expect;


describe('ta_dashboard.js', function() {
  it('should generate column DOM with role equals to 1', function() {

    var data = {"id":1,"name":"CS561","role":1};
    assert.equal(columnInClassTable(data), "<button class='classes' id='class_1'>CS561</button>");
  });

  it('should not generate column DOM with role equals to 0', function() {

    var data = {"id":2,"name":"CS519","role":0};
    assert.equal(columnInClassTable(data), "");
  });

  it('should not generate column DOM without id', function() {

    var data = {"name":"CS519","role":0};
    assert.equal(columnInClassTable(data), "");
  });

  it('should not generate column DOM without name', function() {

    var data = {"id":2,"role":0};
    assert.equal(columnInClassTable(data), "");
  });
});
