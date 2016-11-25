<?php
/* widget */
function arphabet_widgets_init() {

    register_sidebar( array(
        'name' => 'Home right sidebar',
        'id' => 'home_right_1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="rounded">',
        'after_title' => '</h4>',
    ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

/* 自作ウィジェット */
class My_Widget extends WP_Widget {
    /**
     * Widgetを登録する
     */
    function __construct() {
        $widget_ops = array('description' => 'プロフィールを設定できます');
        parent::__construct(
            "profile", //base ID
            "プロフィール",
            $widget_ops
        );
    }
    /**
     * 表側の Widget を出力する
     *
     * @param array $args  
     * @param array $instance
     */
    function widget($args, $instance) {
        // ウィジェットの表示処理を記述
        $my_name = $instance['my_name'];
        $my_text = $instance['my_text'];
        echo $args['before_widget'];
        echo $args['before_title'];
        echo "プロフィール";
        echo $args['after_title'];
        echo "<p>name: ${my_name}</p>";
        echo "<p>text: ${my_text}</p>";

        echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
        // ウィジェットの設定の更新処理を記述。主にセキュリティを考えたサニタイズ用
        return $new_instance;
    }
    function form($instance) {
        // ウィジェットの設定用フォーム
        $myname_value = $instance['my_name'];
        $myname_name = $this->get_field_name('my_name');
        $myname_id = $this->get_field_id('my_name');

        $text_value = esc_attr($instance['my_text']);
        $text_name = $this->get_field_name('my_text');
        $text_id = $this->get_field_id('my_text');
        
        echo "<p>";
        echo "<label for=\"{$myname_id}\">名前:</label>";
        echo "<input class=\"widefat\" id=\"{$myname_id}\" name=\"{$myname_name}\" type=\"text\" value=\"{$myname_value}\">";
        echo "</p>";

        echo "<p>";
        echo "<label for=\"{$text_id}\">紹介文:</label>";
        echo "<textarea rows=\"3\" wrap=\"hard\" class=\"widefat\" id=\"{$text_id}\" name=\"{$text_name}\">{$text_value}</textarea>";
        echo "</p>";
    }
}
add_action('widgets_init',create_function('', 'return register_widget("My_Widget");'));


/* アイキャッチ画像 */
add_theme_support( 'post-thumbnails' );

/* カスタムヘッダー */
$custom_header_defaults = array(
    'default-image'          => get_template_directory_uri().'/images/defalut_header.jpg',
    'width'                  => 1920,
    'flex-width'             => true,
    'height'                 => 180,
    'flex-height'            => true,
    'header-text'            => true,//ヘッダー画像上にテキストをかぶせる
);
add_theme_support( 'custom-header', $custom_header_defaults );


/* ページ送り */
function pagination($pages = '', $range = 1)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><div class=\"pagination-box\"><span class=\"page-of\">Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div></div>\n";
     }
}

?>