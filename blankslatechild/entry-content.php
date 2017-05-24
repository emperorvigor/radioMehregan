<section class="entry-content">
<?php if ( is_single() ) : ?><div class="thumbContainer"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div><?php endif; ?>
<?php if ( !is_single() ) { echo '<p>' . the_excerpt() . '</p>'; } else { the_content(); } ?>

<div class="fb-share-button" data-href="<?php  the_permalink(); ?>#a" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php  the_permalink(); ?>#a&amp;src=sdkpreparse">اشتراک</a></div><br />

<?php if ( is_single() ) : ?><!-- <a class="customFacebook" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>#a&title=<?php echo get_the_date(); ?>" target="_blank"><img src="https://www.facebook.com/rsrc.php/v3/yq/r/5nnSiJQxbBq.png" width="16px" height="16px" />اشتراک</a> --><?php endif; ?>

<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>