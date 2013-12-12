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
			<section id="article-detail">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h1 class="post-title"><?php the_title(); ?></h1>

				<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

				<div class="entry">
					<div class="post-content">
					<?php the_content(); ?>

					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
					
					<?php the_tags( 'Tags: ', ', ', ''); ?>
					</div>
				</div>
				
				<?php edit_post_link('Edit this entry','','.'); ?>
				
			</div>

			<?php //comments_template(); ?>

			<?php endwhile; endif; ?>
			</section>
		<?php
			$category = get_the_category();
			$cat_id = $category[0]->cat_ID;
			$cat_name = $category[0]->cat_name;
			$cat_link = get_category_link($category[0]->cat_ID);
			$args = array(
				'cat'=>$cat_id,
				'post__not_in'=>array($post->ID),
				'posts_per_page'=>RELATED_POSTS_NUMBER,
				'orderby'=>'post_date',
				//'caller_get_posts'=>1
				);
			
			$related_posts = new WP_Query($args);
			if($related_posts->have_posts()):?>
			<div class="folder-title"><h1>Các bài viết khác</h1></div>
		<?php
				while($related_posts->have_posts()):$related_posts->the_post();
			?>
				<section><!-- #2 -->
					<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
					<div class="illus"><a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a></div>
					<div class="meta">
						<div class="post-date"><?php the_time('d-m-Y');?></div> 
						<div class="post-cat"><a href="<?php echo $cat_link;?>"><?php echo $cat_name; ?></a></div>
					</div>
					<div class="desc"><?php the_excerpt();?></div>
					<a class="more-view" href="<?php the_permalink();?>">Xem thêm &gt;</a>
					<div class="clear"></div>
				</section>
			<?php
				endwhile;
			endif;
			wp_reset_postdata();
		?>	
		</article>
		
	</div><!--end of #content-->
	
	
<?php include(TEMPLATEPATH.'/inc/slideshow.php');?>
<?php get_footer(); ?>