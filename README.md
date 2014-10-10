[MIT Libraries News](http://libraries.mit.edu/news/)
====

The MIT Libraries News blog, running on Wordpress. It is a child theme of the main MIT Libraries theme, running on [libraries.mit.edu](http://libraries.mit.edu).

__Note: This theme is in development, and not currently in use.__


## TO DOs

1. When importing ACF fields, current ACF fields must be deleted. Any posts that use those fields must then be updated, after the import, in order to ensure their data is displayed properly. This is particularly important for custom field content that appears on the homepage—the News posts WP API call will fail if those posts are not updated after the new ACF fields are imported.
2. Build `bibliotech` post type.
3. Build `bibliotech` RSS feed.
4. Rename default post type as News/events(?)