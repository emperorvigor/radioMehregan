<?php
	if(is_single){
		echo '<meta property="og:url"              content="' .  the_permalink() . '#a" />
			<meta property="og:type"               content="article" />
			<meta property="og:title"              content="' . the_title_attribute() . '" />
			<meta property="og:description"        content="' . the_excerpt() . '" />
			<meta property="og:image"              content="' . the_post_thumbnail() . '" />';
	} else {
		echo '<meta property="og:url"              content="http://radiomehregan.com" />
			<meta property="og:type"               content="website" />
			<meta property="og:title"              content="Persian title of Radio Mehregan" />
			<meta property="og:description"        content="Description of Radio Mehregan" />
			<meta property="og:image"              content="http://radiomehregan.com/wp-content/uploads/2016/10/logo-radio-Mehregan-652-02-5-768x350.png" />';
	}
?>