<?php
/**
 * Template-part for displaying social media icons in subheader.
 *
 * @package MITLibraries-News
 * @since 1.0
 */

?>

<ul class="sIcons hidden-xs anotherMenu clearfix pull-right">
	<li class="sub soc">
		<a title="subscribe" href="/news/subscribe/" >
		Subscribe to news
		</a>
		</li>
		<li class="tw soc">
		<a title="twitter"  href="//twitter.com/mitlibraries" class="twitterLink">
		<span class="si_twitter image_on"></span>
		<span class="si_twitterBlue image_off"></span>
		</a>
		</li>
		<li class="fb soc">
		<a title="facebook"  href="//libraries.mit.edu/facebook" class="facebookLink">
		<span class="si_facebook image_on"></span>
		<span class="si_facebookBlue image_off"></span>
		 </a>
		</li>
		<li class="ig soc">
		<a title="Instagram"  href="//instagram.com/mitlibraries/">
		<span class="si_instagram image_on"></span>
		<span class="si_instagramBlue image_off"></span>
		</a>
		</li>
		 <li class="sf">
		<?php get_search_form( 'true' ); ?>
			</li>
		</ul>
