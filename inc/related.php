<?php $category = get_the_category(); ?>
<div class="posts-related flex-container">
	<h3>More in <?php echo $category[0]->cat_name; ?></h3>
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
				// All post types
				url: "/news/wp-json/posts?filter[category_name]=" + cat,
				dataType: "json"
			})
			.done(function(json) {
				console.log('got the JSON');
				for (var i = 0; i < 3; i++) {
					relatedCompiled = _.template(
						'<div class="post-preview">' +
							'<div class="image" style="background-image: <%= featured_image.source %>"></div>' +
							'<h3><%= title %></h3>' +
						'</div>'
					);
					relatedTemplate = relatedCompiled(json[i]);
					$('.posts-related').append(relatedTemplate);
				};
			})
	}
	mitlib_related_posts();
</script>