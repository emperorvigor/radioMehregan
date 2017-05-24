<?php get_header(); ?>
<section id="content" role="main" style="overflow:auto;">
	<div id="picMenu" style="float:right;">
		<p></p>
		<div id="first-row-pic">
			<a href="http://radiomehregan.org/Mode.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/1-1.png" /></a>
			<a href="http://radiomehregan.org/Video-2.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/1-2.png" /></a>
			<a href="http://radiomehregan.org/Ny-sida.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/1-3.png" /></a>
			<a href="http://radiomehregan.org/file-5.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/1-4.png" /></a>
		</div>
		<div id="second-row-pic">
			<a href="http://radiomehregan.org/Ny-sida-2.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/2-1.png" /></a>
			<a href="http://radiomehregan.org/Dikt.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/2-2.png" /></a>
			<a href="http://radiomehregan.org/Musik.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/2-3.png" /></a>
			<a href="http://radiomehregan.org/Saang.html"><img src="http://radiomehregan.com/wp-content/uploads/2014/08/2-4.png" /></a>
		</div>
	</div>
<div style="display:none;"><a href="#newsAnchor">Nyhet</a> | <a href="#articlesAnchor"> Artikel</a> | <a href="#freedomAnchor">Frihet</a></div>

	<div class="columndiv" id="leftcolumndiv">
<h1 id="newsAnchor" style="display:none;">NYHETER</h1>
		<?php 
			blankslate_child_getPosts('left', '', '');
		?>
	<a href="http://radiomehregan.com/tag/left/page/2/"><article style="text-align:center;font-size:.9em;"><h2>ادامه</h2></article></a>
	</div>

	<div class="columndiv">
<h1 id="articlesAnchor" style="display:none;">ARTIKLAR</h1>
		<?php 
			blankslate_child_getPosts('right', '', '');
		?>
	<a href="http://radiomehregan.com/tag/right/page/2/"><article style="text-align:center;font-size:.9em;"><h2>ادامه</h2></article></a>
	</div>

	<div class="columndiv" id="midcolumndiv">
<h1 id="freedomAnchor" style="display:none;">YTTRANDEFRIHET</h1>
		<?php 
			blankslate_child_getPosts('middle', '', '');
		?>
	<a href="http://radiomehregan.com/tag/middle/page/2/"><article style="text-align:center;font-size:.9em;"><h2>ادامه</h2></article></a>
	</div>
</section>
</div>
<?php get_footer(); ?>