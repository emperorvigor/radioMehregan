<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_search() || is_archive() || is_page() ) : ?><div class="thumbContainer thumbDiv"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div><?php endif; ?>
<?php if ( is_search() || is_archive() || is_page() ) : ?><div class="searchExcerptContainer"><?php endif; ?>
<header>
<?php get_template_part( 'entry', 'meta' ); ?>
<?php if ( is_singular() || is_search() ) { 
		echo '<h1 class="entry-title" id="a">'; 
	} 
	else { 
		echo '<h2 class="entry-title">'; 
	} 
?>

<?php if(!is_single()) : ?><a href="<?php the_permalink(); ?>#a" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php endif; ?><?php the_title(); ?><?php if(!is_single()) : ?></a><?php endif; ?><?php if ( is_singular() || is_search()  ) { echo '</h1>'; } else { echo '</h2>'; } ?> 


</header>

<?php get_template_part( 'entry', 'content' ); ?>
<?php get_template_part( 'entry-footer' ); ?>
</article>