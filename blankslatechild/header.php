<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<meta property="og:locale" content="fa_IR" />
<meta property="og:url"              content="<?php the_permalink(); ?>#a" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?php echo get_the_title(); ?> | <?php echo get_the_date(); ?>" />
<meta property="og:description"        content="<?php wp_trim_excerpt(); ?>" />
<meta property="og:image"              content="<?php the_post_thumbnail_url(); ?>" />

<?php if ( is_singular() ) { echo '<link rel="canonical" href="' . get_permalink() . '#a" />'; } else { echo '<link rel="canonical" href="' . get_permalink() . '" />'; } ?>

<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Facebook share-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "https://connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook share end -->

<div id="wrapper" class="hfeed">

<div id="headerbackground">
<header id="header" role="banner">
<div id="mrOverflow">
<div id="search">
<?php get_search_form(); ?>
</div>

<section id="branding">
<div id="site-title"><a href="http://radiomehregan.com"><img src="http://radiomehregan.org/img/Layout/logo-radio-version22.png" alt="Radio Mehregan"></a></div>
<div id="site-description"><?php bloginfo( 'description' ); ?></div>
</section>

<!-- Facebook like page -->
<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F%25D8%25B1%25D8%25A7%25D8%25AF%25DB%258C%25D9%2588-%25D9%2585%25D9%2587%25D8%25B1%25DA%25AF%25D8%25A7%25D9%2586%2F648029171916322&width=111&layout=button_count&action=like&show_faces=false&share=true&height=46&appId" width="30%" height="46" style="border:none;overflow:hidden;float:left;margin-top:10px;margin-left:10px;" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
<!-- Facebook like page end -->

</div>
<nav id="menu" role="navigation">
<div id="menuIconDiv"><div onclick="togglediv('menuDivForDisplay')">☰</div></div>
<div id="menuDivForDisplay"><?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
</div>
</nav>
</header>
</div>

<div id="headslidebackground">
<div id="headslide-container">
<?php if (is_active_sidebar('headerleftsidebar')) : ?>
	<div class="headerleftsidebar">
		<div class="margindivHeader">
			<?php dynamic_sidebar('headerleftsidebar'); ?>
<!-- test -->
			<ul id="newsFeedList">
<?php
	$args = array( 'numberposts' => '12' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo '<li class="recentNews"><a href="' . get_permalink($recent["ID"]) . '#a">' .   $recent["post_title"].'</a> </li> ';
	}
	wp_reset_query();
?>
</ul>
<!-- /test -->
		</div>
	</div>
<?php endif; ?>
<?php if (is_active_sidebar('headerrightsidebar')) : ?>
	<div class="headerrightsidebar">
		<?php dynamic_sidebar('headerrightsidebar'); ?>
	</div>
<?php endif; ?>
</div>

</div>
<div id="maincontainer">
<div id="contentbackground">