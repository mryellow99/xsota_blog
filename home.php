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

echo "<div class=\"pagination\">";
global $wp_rewrite;
$paginate_base = get_pagenum_link(1);
if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
    $paginate_format = '';
    $paginate_base = add_query_arg('paged','%#%');
}
else{
    $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
    user_trailingslashit('page/%#%/','paged');;
    $paginate_base .= '%_%';
}
echo paginate_links(array(
    'base' => $paginate_base,
    'format' => $paginate_format,
    'total' => $wp_query->max_num_pages,
    'mid_size' => 4,
    'current' => ($paged ? $paged : 1),
    'prev_text' => '« 前へ',
    'next_text' => '次へ »',
));
echo "</div>";

echo "</article>";
get_sidebar();
echo "</div>";
get_footer();
?>
