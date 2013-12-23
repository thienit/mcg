<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' - '; }
		      elseif (is_search()) {
		         echo '&quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name');
		         if(bloginfo('description')!='') {echo ' - '; bloginfo('description'); }
		      }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<!-- Hide this line for IE (needed for Firefox and others) -->
	<![if !IE]>
	<link rel="icon" href="<?php echo bloginfo('template_directory');?>/images/mcg.ico" type="image/x-icon" />
	<![endif]>
	<!-- This is needed for IE -->
	<link rel="shortcut icon" href="<?php echo bloginfo('template_directory');?>/images/mcg.ico" type="image/ico" />

	<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/reset.css' />
	<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/960.css'/>
	<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/text.css' />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

	<?php if(is_home() ):?>
		<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/home.css' />
		<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/nivo-slider.css' />
	<?php endif; ?>

	<?php if(is_single() || is_page() || is_archive() || is_search() ):?>
		<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/articles.css' />
	<?php endif; ?>
	
	<?php if(is_single()): ?>
		<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/product-detail.css' />
	<?php endif;?>
	
	<?php if(is_page()): ?>
		<link rel='stylesheet' href='<?php echo bloginfo('template_directory');?>/css/shopping-cart.css' />
	<?php endif;?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<div id="page-wrap">
		<div id="top-bar">
			<div class="container_16">
				<div class="grid_1">&nbsp;</div>
				<div class="grid_5 email">
					Email: <?php $page = get_page(EMAIL); echo $page->post_content;?>
				</div>
				<div class="grid_4 hotline">
					Hotline: <?php $page = get_page(HOTLINE); echo $page->post_content;?>
				</div>

				<div id="top-menu-wrapper">
					<?php wp_nav_menu(array('menu'=>'Top Menu','container'=>''));?>
				</div>
			</div>
		</div><!-- end of #top-bar -->
		<header>
			<div class="container_16">
				<div id="logo" class="grid_5">
					<?php lm_display_logo(); ?>
				</div><!-- end of #logo -->

				<div id="ad" class="grid_7">
				<?php 
					$page = get_page_by_path("top-ads");
					echo $page->post_content;
				?>
				</div><!-- end of #ad -->

				<div id="searching" class="grid_4">
					<?php get_search_form();?>
				</div><!-- end of #searching -->

				<div class="clear"></div>

				<div id="main-menu-wrapper" class="grid_16">
					<?php wp_nav_menu(array('menu'=>'Main Menu','container'=>''));?>
				</div><!-- end of #main-menu -->
			</div>
		</header>

		<nav>
			<div class="container_16">
				 <?php 
					$menu_name = 'shortcut_nav';

				    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
						$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

						$menu_items = wp_get_nav_menu_items($menu->term_id);

						$menu_list = '<ul class="grid_16" id="menu-' . $menu_name . '">';

						foreach ( (array) $menu_items as $key => $menu_item ) {
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($menu_item->ID));
							$image_src = $image[0];
						    $title = $menu_item->title;
						    $url = $menu_item->url;
						    $menu_list .= '<li><a href="' . $url . '"><img src="' .$image_src.'" alt="'.$title.'"/></a>
						    <a href="' . $url . '">' . $title . '</a></li>';
						}
						$menu_list .= '</ul>';
				    } else {
						$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
				    }
				    
				   	echo $menu_list;
				?>
			</div>
		</nav>
		<!-- <div id="header">
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<div class="description"><?php bloginfo('description'); ?></div>
		</div> -->