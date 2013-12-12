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

				<div class="folder-title"><h1>Kết quả tìm kiếm</h1></div>

				<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

				<?php while (have_posts()) : the_post(); ?>
					<section>
						<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
						<div class="illus"><a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a></div>
						<div class="meta"><div class="post-date"><?php the_time('d-m-Y');?></div> <div class="post-cat"><?php the_category();?></div></div>
						<div class="desc"><?php the_excerpt();?></div>
						<div class="clear"></div>
					</section>

				<?php endwhile; ?>

				<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

			<?php else : ?>

				<div class="folder-title"><h1>Kết quả tìm kiếm</h1></div>
				<section>
					<div class="illus" style="background-color:#ffff;"><img src="<?php echo bloginfo('template_directory');?>/images/pagenotfound.png" alt="Page Not Found" /></div>
					<div class="desc">Rất tiếc! Không tìm thấy tài liệu liên quan tới <?php echo '&quot;'.wp_specialchars($s).'&quot; ';?>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
					</div>
					<div class="clear"></div>
				</section>
			<?php endif; ?>
		</article>
	</div><!--end of #content-->

<?php include(TEMPLATEPATH.'/inc/slideshow.php');?>
<?php get_footer(); ?>

