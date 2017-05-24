<?php get_header(); ?>
<section id="content" role="main">
<div id="postdiv">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
<!-- IIIIIIIIWWWWIIIIIIII -->
</section>
<?php endwhile; endif; ?>
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
<?php get_sidebar(); ?>
<?php get_footer(); ?>