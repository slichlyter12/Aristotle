var expect = chai.expect;
var should = chai.should();

describe("test base.js", () => {

    it("should set and get sessionStorage", (done) => {
        setSession('key1', 1);
        expect(getSession('key1')).to.equal("1");
        expect(getSession('key1')).not.to.equal(1);
        expect(getSession('key1')).not.to.equal(undefined);
        setSession('key2', "1");
        expect(getSession('key2')).to.equal("1");
        expect(getSession('key2')).not.to.equal(1);
        done();
    });
    it("should get parameter in URL", (done) => {
        var url = window.location.href;
        if(url.indexOf("?") === -1) {
            url += "?key1=113813&key2=akfh34asfh&key3=akfhajf";
            window.location.href = url;
        }
        expect(getUrlParam('key1')).to.equal("113813");
        expect(getUrlParam('key2')).to.equal("akfh34asfh");
        expect(getUrlParam('key3')).to.equal("akfhajf");
        done();
    });
});
