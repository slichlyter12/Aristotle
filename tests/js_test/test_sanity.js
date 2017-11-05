var expect = chai.expect;
var should = chai.should();

describe("sanity check", () => {

    it("does math ok", (done) => {
        expect(1 + 1).to.equal(2);
        expect(1 + 1).not.to.equal(1);
        done();
    });
    it("supports the usual JS objects", (done) => {
        expect(typeof "blah").to.equal("string");
        expect(typeof {}).to.equal("object");
        done();
    });
});
