describe("Loader test suite", function() {
	it("expects tautologies", function() {
		expect(true).toBe(true);
	});

	it("should have expected defaults", function() {
		var test = new Loader();
		expect( test.container ).toEqual('mitlibnews-container');
		expect( test.page ).toEqual(1);
		expect( test.pagesize ).toEqual(9);
		expect( test.postcontent ).toEqual('all');
	});

	it("should allow objects passed in definition", function() {
		var test = new Loader({container: 'foo', page: 3, pagesize: 5, postcontent: 'bar'});
		expect( test.container ).toEqual('foo');
		expect( test.page ).toEqual(3);
		expect( test.pagesize ).toEqual(5);
		expect( test.postcontent ).toEqual('bar');
	});

	it("should have container getter and setter methods", function() {
		var test = new Loader();
		expect( test.getContainer() ).toEqual('mitlibnews-container');
		expect( test.getContainer( test.setContainer('bar') ) ).toEqual('bar');
	});

	it("should have page getter and setter methods", function() {
		var test = new Loader();
		expect( test.getPage() ).toEqual(1);
		expect( test.getPage( test.setPage(2) ) ).toEqual(2);
	});

	it("should have pagesize getter and setter methods", function() {
		var test = new Loader();
		expect( test.getPagesize() ).toEqual(9);
		expect( test.getPagesize( test.setPagesize(12) ) ).toEqual(12);
	});

	it("should have postcontent getter and setter methods", function() {
		var test = new Loader();
		expect( test.getPostcontent() ).toEqual('all');
		expect( test.getPostcontent( test.setPostcontent('baz') ) ).toEqual('baz');
	});

	it("should build a query object", function() {
		var test = new Loader();
		defaultQuery = {
			page: 1,
			filter: {
				posts_per_page: 9,
			},
			type: ['post', 'bibliotech', 'spotlights']
		}
		expect( test.buildQuery() ).toEqual(defaultQuery);
	});
});