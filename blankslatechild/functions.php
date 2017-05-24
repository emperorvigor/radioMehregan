<?php
	
	function blankslate_child_getPosts($tag, $categorys, $postsperpage){
		
		$theTagQuery = blankslate_child_createPostQuery($tag, $categorys, $postsperpage);

		if ( $theTagQuery->have_posts() ) :
			while ( $theTagQuery->have_posts() ) : $theTagQuery->the_post();
				echo blankslate_child_postHTMLTemplateGenerator(get_post());
			endwhile; endif;
	}
	
	function blankslate_child_getArrayOfCatIDFromString($stringofcategorys){
		
		$arrayofcategoryids = array();
		
		if($stringofcategorys == ''){
			return $arrayofcategoryids[] = $stringofcategorys;
		} else {
			$pieces = explode(",", $stringofcategorys);

			for($i = 0; $i < count($pieces); ++$i) {
				$idObj = get_category_by_slug($pieces[$i]);
				//error generated when idObj is empty/null/whetever it is
				$id = $idObj->term_id;
				$arrayofcategoryids[] = $id;
			}
			
			return $arrayofcategoryids;
		}
	}
	
	function blankslate_child_assosiatedPosts($beforeOrAfter){
		global $post;
		$currentPostID = $post->ID;
		$postTags = wp_get_post_tags($currentPostID, array( 'fields' => 'ids' ));
		$priorityTag = get_post_meta($currentPostID, 'priority_tag_select_a_main_tag', true);
		$beforeOrAfterArray = array();
		if($beforeOrAfter){
			$beforeOrAfterArray = array(
					'before' => array(
						'year'  => get_the_date('Y', $currentPostID),
						'month' => get_the_date('m', $currentPostID),
						'day'   => get_the_date('d', $currentPostID), 
						
					), 'inclusive' => true, //include current date
				);
		} elseif(!$beforeOrAfter){
			$beforeOrAfterArray = array(
					'after' => array(
						'year'  => get_the_date('Y', $currentPostID),
						'month' => get_the_date('m', $currentPostID),
						'day'   => get_the_date('d', $currentPostID), //exclude current date	
					),
				);
		} else { echo 'Error in previousAssosiatedPost, input must be after or before'; }
		
		if(empty($priorityTag)){
			$priorityTag = wp_get_post_tags($post->ID, array( 'fields' => 'ids' ));
		}
		$theTagQuery = new WP_Query( array(
			'posts_per_page' => 5,
			'no_found_rows'  => true,
			'tag__in' => $priorityTag,
			'date_query' => array($beforeOrAfterArray)
		));
		
		if ( $theTagQuery->have_posts() ) :
		while ( $theTagQuery->have_posts() ) : $theTagQuery->the_post();
			if($currentPostID != get_the_ID()){
				echo blankslate_child_postHTMLTemplateGenerator(get_post());
			}
		endwhile; endif;
	}
	
	function blankslate_child_createPostQuery($tag, $categories, $postsperpage){
		if($postsperpage == ''){ $postsperpage = get_option('posts_per_page'); }
		print_r($categories);
		$arrayofcategoryids = array();
		$arrayofcategoryids = blankslate_child_getArrayOfCatIDFromString(sanitize_text_field($categories));
		
			return $theTagQuery = new WP_Query( array(
				'posts_per_page' => sanitize_text_field($postsperpage),
				'no_found_rows'  => true,
				'tag'            => sanitize_text_field($tag),
				'category__and' => $arrayofcategoryids
			) );
	}
	
	function blankslate_child_postHTMLTemplateGenerator($post){
		
		$html = '
		<article id="post-' . $post->ID . '" ' . $post->post_class . '>
			<span class="entry-date">' . mysql2date(get_option('date_format'), $post->post_date) . '</span>
			<h2 class="entry-title">
				<a href="' . get_permalink($post->ID) . '#a" title="' . apply_filters( 'the_title', $post->post_title ) . '" rel="bookmark">' . apply_filters( 'the_title', $post->post_title ) . '</a>
			</h2>
			<section class="entry-content">
				<div class="thumbContainer' . ((is_single()) ? ' thumbDiv"' : '"');
				
				$html .= '>
					' . (has_post_thumbnail($post->ID) ? get_the_post_thumbnail($post->ID) : '') . '</div>
					<p>' . wp_trim_excerpt() . '</p>' . ((!is_home() && !is_category())  ?  ' <!-- <span class="readMoreSpan"><a href="' . get_permalink($post->ID) . '#a">LOL ادامه</a></span> -->' : '') . ' 
			</section>
			<span class="cat-links">
				' . get_the_category_list(', ', '', $post->ID) . '
			</span>
		</article>
		';
		return $html;
	}
	
	function blankslate_child_createRowDiv($content){
		//echo ' [i createRowDiv] ';
		return '<div class="rowdiv">' . $content . '</div>';
	}
	
	/*
	leftcolumndiv
	midcolumndiv
	*/
	function blankslate_child_createColumnDiv($idType, $content){
		//echo ' [i createColumnDiv] ';
		$idHtmlCode = (strlen($idType) > 0) ? ' id="' . $idType . '"' : ''; // förkortad IF
		return '<div class="columndiv"' . $idHtmlCode . '>' . $content . '</div>';
	}
	
	function blankslate_child_generateFullArticle($postQuery, $timestoloop){

		/*if ( $postQuery->have_posts() ) {
			while ( $postQuery->have_posts() ) {
				$postQuery->the_post();
				echo get_the_title();
			}*/
			
		if ( $postQuery->have_posts() ) {
			while ( $postQuery->have_posts() ) {
				$postQuery->the_post();
				get_template_part( 'entry' );
				}
 		} else {
			// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();

		/*$divsperrow = 0;
		$times_looped = 0;
		$wholeHTML[] = '';
		global $wp_query;
		$postQuery = $wp_query;
		$totalPosts = $postQuery->post_count; // Antalet poster som hämtas av WP_Query()
		//echo 'Total postas: ' . $totalPosts . ' <br />';
		if ( $totalPosts > $timestoloop ) {

			while ( $postQuery->have_posts() ) : $postQuery->the_post();
				
				$times_looped++;
				echo '<br /> [loopat antal innan if: ' . $times_looped . '] -> ' . $postQuery->ID;
				if ($times_looped > $timestoloop){
					//echo ' [loopat antal innanför if: ' . $times_looped . '] ';
					$articleHtml = blankslate_child_postHTMLTemplateGenerator(get_post());//$postQuery->the_post());
					
					$modulus = ($times_looped % 3); // 1, 2, 0, 1, 2 ...
					
					if ($modulus == 1) {
						//echo ' [modulus 1 ] ';
						$idType = ''; // Tar fram idType
					} else if ($modulus == 0) {
						//echo ' [modulus 0 ] ';
						$idType = 'leftcolumndiv'; // Tar fram idType
					} else {
						//echo ' [modulus else ] ';
						$idType = 'midcolumndiv'; // Tar fram idType
					}
					
					$columnHtml[] = blankslate_child_createColumnDiv($idType, $articleHtml);
	  
					if (($modulus == 0) || (($times_looped == $totalPosts) && ($totalPosts % 3 != 0))) { // Om totalt antal poster leder till att sista raden (row) inte har 3 kolumner.
						
						$rowHtml = blankslate_child_createRowDiv(implode($columnHtml));
						$columnHtml = array();
						
						$wholeHTML[] = $rowHtml; // printar ut raden	
					}
				}	
			endwhile;
		}
		return implode($wholeHTML);*/
	}
	
	//------ test meta box
/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function priority_tag_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function priority_tag_add_meta_box() {
	add_meta_box(
		'priority_tag-priority-tag',
		__( 'Priority tag', 'priority_tag' ),
		'priority_tag_html',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'priority_tag_add_meta_box' );

function priority_tag_html( $post) {
	wp_nonce_field( '_priority_tag_nonce', 'priority_tag_nonce' );
	$tags_array = get_tags( array('exclude' => '91, 92, 93') );?>

	<p>This tag will be the main tag. Used for sorting and presenting related posts.</p>

	<p>
		<label for="priority_tag_select_a_main_tag"><?php _e( 'Select a main tag', 'priority_tag' ); ?></label><br>
		<select name="priority_tag_select_a_main_tag" id="priority_tag_select_a_main_tag">
			<option <?php echo (priority_tag_get_meta( 'priority_tag_select_a_main_tag' ) === 'Uncategorized' ) ? 'selected' : '' ?>>Uncategorized</option>
			<?php foreach($tags_array as $value): ?>
				<option <?php echo (priority_tag_get_meta( 'priority_tag_select_a_main_tag' ) === $value->term_id . ' - ' . $value->name ) ? 'selected' : '' ?>><?php echo $value->term_id ?> - <?php echo $value->name ?></option>
			<?php endforeach ?>
		</select>
	</p><?php
}

function priority_tag_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['priority_tag_nonce'] ) || ! wp_verify_nonce( $_POST['priority_tag_nonce'], '_priority_tag_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['priority_tag_select_a_main_tag'] ) )
		update_post_meta( $post_id, 'priority_tag_select_a_main_tag', esc_attr( $_POST['priority_tag_select_a_main_tag'] ) );
}
add_action( 'save_post', 'priority_tag_save' );

/*
	Usage: priority_tag_get_meta( 'priority_tag_select_a_main_tag' )
*/

//----------- test meta box end

	//Registrera widgets
	function blankslate_child_widgetInit(){
		
		register_sidebar ( array(
			'name' => 'Header right sidebar',
			'id' => 'headerrightsidebar'
		));
		
		register_sidebar ( array(
			'name' => 'Header left sidebar',
			'id' => 'headerleftsidebar'
		));

		register_sidebar ( array(
			'name' => 'Footer sidebar',
			'id' => 'footersidebar'
		));
	}
	add_action('widgets_init', 'blankslate_child_widgetInit');

	//exclude pages from search	
	function SearchFilter($query) {
		if ($query->is_search) {
		$query->set('post_type', 'post');
		}
		return $query;
	}
	add_filter('pre_get_posts','SearchFilter');

	//Register scripts footer
	function my_scriptsFooter() {
		wp_enqueue_script(
			'main',
			get_stylesheet_directory_uri() . '/scripts/main.js'
		);
	}
	add_action( 'wp_footer', 'my_scriptsFooter' );

	//Register script head
	/*function my_scriptsHead() {
		wp_enqueue_script(
			'jquery',
			get_stylesheet_directory_uri() . '/scripts/jquery.min.js'
		);
	}
	add_action( 'wp_enqueue_script', 'my_scriptsHead' );*/

	// Replaces the excerpt "Read More" text by a link
	function new_excerpt_more($more) {
	       global $post;
		return '';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

function all_excerpts_get_more_link($post_excerpt) {
    return '' . $post_excerpt . '' . '<br ><p class="readmore"><a href="'. get_permalink($post->ID) . '#a">' . 'ادامه &raquo' . '</p>';
}
add_filter('wp_trim_excerpt', 'all_excerpts_get_more_link');

//------ Remove wordpress' canonical link
remove_action( 'wp_head', 'rel_canonical' );
?>