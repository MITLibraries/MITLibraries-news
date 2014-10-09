<?php $category = get_the_category(); ?>
<div class="posts-related">
	<h3>More in <?php echo $category[0]->cat_name; ?></h3>
	<div class="flex-container space-between"></div>
</div>
<script>
	function mitlib_related_posts() {
		// Get the post type from a data attribute
		var cat = $('article').data('category'),
				i,
				relatedCompiled,
				relatedTemplate;
		console.log(cat);
		$.ajax({
				cache: true,
				// Filter by current post category
				url: "/news/wp-json/posts?filter[category_name]=" + cat,
				dataType: "json"
			})
			.done(function(json) {
				for (var i = 0; i < 3; i++) {
					relatedCompiled = _.template(
						'<div class="post-preview">' +
							'<h3><%= title %></h3>' +
						'</div>'
					);
					relatedTemplate = relatedCompiled(json[i]);
					$('.posts-related > .flex-container').append(relatedTemplate);
				};
			})
	}
	mitlib_related_posts();
</script>