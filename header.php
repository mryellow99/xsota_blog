<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title(); ?></title>
<meta name="description" content="<?php bloginfo( 'description' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
<!-- custom header -->
<?php $header_image = get_header_image(); 
if ( ! empty( $header_image ) ) : ?>
<div id="header">
  <img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>"  />
<!--  <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1> -->
</div>
<? else : ?>
<div id="header">
  <img src="<?php echo get_template_directory_uri().'/images/defalut_header.jpg' ?>" alt="<?php bloginfo('name'); ?>" />
<!--  <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>-->
</div>
<?php endif; ?>
<div class="nav">
<?php wp_nav_menu(); ?>
</div>
</header>