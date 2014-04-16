	<div id="sidebar">
		<ul>
<?php if (function_exists('wp_theme_switcher')) { ?>
			<li><h2><?php _e('Themes'); ?></h2>
				<?php wp_theme_switcher(); ?>
			</li>
<?php } ?>
			<li><a href="http://libraries.mit.edu/"><img src="http://libraries.mit.edu/img/dome/gray-on-white.gif" class="centered" alt="MIT Libraries" /></a></li>
			<li>
				<p><a href="http://libraries.mit.edu/news">MIT Libraries News home</a><br>
			News from the <a href="http://libraries.mit.edu/">libraries</a> at <a href="http://web.mit.edu/">MIT</a>.</p>
			</li>
            
            <li><a href="http://libraries.mit.edu/calendar">Calendar of events</a></li>
			
			<li>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>
			
			
			
			<li><h2><?php _e('News topics'); ?></h2>
				<ul>
				<?php wp_list_cats('sort_column=name&hide_empty=1&optioncount=1'); ?>
				</ul>
			</li>
			
			<?php wp_list_pages('title_li=<h2>' . __('RSS Feeds') . '</h2>' ); ?>
			<ul>
				<li><img src="http://libraries.mit.edu/img/misc/rss.gif" alt="RSS">&nbsp;<a href="http://libraries.mit.edu/help/rss/">What is RSS?</a></li>
				</ul>

			
			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>				
				<?php get_links_list(); ?>

			<li>
			<?php /* If this is a category archive */ if (is_category()) { ?>
			<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>
			
			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives
			for the day <?php the_time('l, F jS, Y'); ?>.</p>
			
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives
			for <?php the_time('F, Y'); ?>.</p>

      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives
			for the year <?php the_time('Y'); ?>.</p>
			
		 <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p>You have searched the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives
			for <strong>'<?php echo wp_specialchars($s); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives.</p>

			<?php } ?>
			</li>

			
			
			<li><h2><?php _e('Archives'); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<ul><li><a href="http://libraries.mit.edu/about/news/news-briefs-archive.html">News before May 2005</a></li></ul>
			</li>

				<li><h2><?php _e('This site'); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>
					<li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>">WordPress</a></li>
					<?php wp_meta(); ?>
				</ul>
				</li>
			<?php } ?>
			
		</ul>
               
	</div>