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
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<div class="folder-title"><h1><?php single_cat_title(); ?></h1></div>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<div class="folder-title"><h1><?php single_tag_title(); ?></h1></div>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<div class="folder-title"><h1>Bài trong ngày <?php the_time('d-m-Y'); ?></h1></div>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<div class="folder-title"><h1>Bài trong tháng<?php the_time('m-Y'); ?></h1></div>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<div class="folder-title"><h1>Bài trong năm <?php the_time('Y'); ?></h1></div>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<div class="folder-title"><h1>Người Viết</h1></div>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<div class="folder-title"><h1>Các bài viết</h1></div>
			
			<?php } ?>
			
			<?php while (have_posts()) : the_post(); ?>
			<section class="archive"><!-- #1 -->
				<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
				<div class="illus"><a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a></div>
				<div class="meta"><div class="post-date"><?php the_time('d-m-Y');?></div> <div class="post-cat"><?php the_category();?></div></div>
				<div class="desc"><?php the_excerpt();?></div>
				<a class="more-view" href="<?php the_permalink();?>">Xem thêm &gt;</a>
				<div class="clear"></div>
			</section>
			<?php endwhile; ?>

			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>	
		<?php else : ?>

			<div class="folder-title"><h1>Nothing found</h1></div>

		<?php endif; ?>	
		</article>
		
	</div><!--end of #content-->

<?php include(TEMPLATEPATH.'/inc/slideshow.php');?>

<?php get_footer(); ?>