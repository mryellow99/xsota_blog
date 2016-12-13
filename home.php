<?php get_header(); ?>
<div class="main">
<article class="left">
<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
        $link = get_permalink();
		echo "<div class=\"card\"><a href=\"{$link}\">";
        if ( has_post_thumbnail() ) {
		  the_post_thumbnail();
        } else {
          $template = get_template_directory_uri();
          echo "<img src=\"{$template}/images/noimage.jpg\" />";
        }
        $title = get_the_title();
        echo "<div class=\"post_heading\">";
        echo "<h2 class=\"post_title\">".$title."</h2>";
        echo "<p>".mb_substr(strip_tags($post-> post_content),0,60)."..."."</p>";
        echo "</div>";
		echo "</a></div>";
	}
} else {
	echo wpautop( '投稿が見つかりませんでした。' );
}

if (function_exists("pagination")) {
    pagination($additional_loop->max_num_pages);
}

echo "</article>";
get_sidebar();
echo "</div>";
get_footer();
?>
