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

					<div class="post" id="post-<?php the_ID(); ?>">
						<h1 class="post-title"><?php the_title(); ?></h1>
						<div class="entry">
							<div class="post-content">
							<?php the_content(); ?>

							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
							
							<?php the_tags( 'Tags: ', ', ', ''); ?>
							</div>
						</div>

						<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

					</div>
				<?php endwhile; endif; ?>
			</section>
		</article>
		
	</div><!--end of #content-->
<?php include(TEMPLATEPATH.'/inc/slideshow.php');?>
<?php get_footer(); ?>