var window;

describe("Additional Posts suite", function() {
    it("should initialize", function() {
        var demo;
        demo = window.mitlibnews.loader;
        expect(demo.initialize()).toEqual(true);
        // Default values
        expect(demo.getPage()).toEqual(1);
        expect(demo.getPostcontent()).toEqual('all');
    });

    it("should be able to get and set pagination", function() {
        var demo;
        demo = window.mitlibnews.loader;
        demo.setPage(2);
        expect(demo.getPage()).toEqual(2);
    });

    it("should be able to build a query", function() {
        var demo, reference;
        demo = window.mitlibnews.loader;
        reference = {
            page: 2,
            filter: {
                posts_per_page: 12
            }
        };
        expect(demo.buildQuery(12)).toEqual(reference);
        reference = {
            page: 2,
            filter: {
                posts_per_page: 9
            }
        };
        expect(demo.buildQuery(9)).toEqual(reference);
    });
});
