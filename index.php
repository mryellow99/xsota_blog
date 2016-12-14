<?php
get_header();
echo "<div class=\"main\">";
echo "<article class=\"left\">";
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo "<article>";
        /*if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	}*/
        $title = get_the_title();
        echo "<h1>".$title."</h1>";
		echo the_content();
		echo "</article>";
	}
} else {
	echo wpautop( '投稿が見つかりませんでした。' );
}
echo "</article>";
get_sidebar();
echo "</div>";
get_footer();
?>
