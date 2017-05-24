<?php get_header(); ?>
<section id="content" role="main">
<div id="postdiv">
	<?php if ( have_posts() ) : ?>
	<!-- <header class="header">
		<h1 class="entry-title"><?php /* printf( __( 'Search Results for: %s', 'blankslate' ), get_search_query() );*/ ?></h1>
	</header> -->
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry' ); ?>
	<?php endwhile; ?>
	<?php get_template_part( 'nav', 'below' ); ?>
	<?php else : ?>
	<article id="post-0" class="post no-results not-found">
		<header class="header">
		<h2 class="entry-title"><?php _e( 'Nothing Found', 'blankslate' ); ?></h2>
		</header>
		<section class="entry-content">
		<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
		<?php get_search_form(); ?>
		</section>
	</article>
	<?php endif; ?>
</div>
<footer class="footer">
<div class="single-post-nav">
<?php get_template_part( 'nav', 'below-single' ); ?>
</div>
<?php if (is_active_sidebar('primary-widget-area')) : ?>
	<div class="primary-widget-area widget single-post-nav">
		<?php dynamic_sidebar('primary-widget-area'); ?>
	</div>
<?php endif; ?>
</footer>
</section>
<?php get_footer(); ?>