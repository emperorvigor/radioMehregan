<?php get_header(); ?>
<section id="content" role="main">
<div id="postdiv">
<div>
	<?php blankslate_child_assosiatedPosts(false); ?>
</div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<div>
	<?php blankslate_child_assosiatedPosts(true); ?>
</div>
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
<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>