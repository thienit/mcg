<?php get_header(); ?>
	<div id="content" class="container_16">
		<div id="breadcrumbs" class="grid_16">
		<?php if(function_exists('bcn_display'))
	    {
	        bcn_display();
	    }?>
		</div>
		<div class="clear"></div>
		<?php get_sidebar(); ?>
		<article class="grid_12">
		<?php woocommerce_content(); ?>
		</article>
		
	</div><!--end of #content-->
<?php include(TEMPLATEPATH.'/inc/slideshow.php');?>
<?php get_footer(); ?>