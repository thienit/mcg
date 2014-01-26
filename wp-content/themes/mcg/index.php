<?php get_header(); ?>
	
	<section id="banner">
		<div class="container_16">
			<div id="banner_slider_wrap" class="grid_16">
			<?php
				global $post;
				$args = array('category'=>BANNER_CAT,'orderby'=>'post_date','order'=>'ASC','post_status'=>'any');
				$custom_posts = get_posts($args);
				foreach ($custom_posts as $post){
					echo $post->post_content;
				}
				wp_reset_postdata();
				
			?>
			</div>
		</div>
	</section>

<?php include(TEMPLATEPATH.'/inc/slideshow.php');?>

	<section id="product-tiles">
		<div class="container_16">
			<div class="grid_16">
				<h1>Sản phẩm</h1>
			</div>
			<div class="clear"></div>
			<?php
				$menu_name="home_product_cat";
				if(($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){
					$menu = wp_get_nav_menu_object($locations[$menu_name]);
					$menu_items = wp_get_nav_menu_items($menu->term_id);
					$count = 0;
					$submenu = false;
					foreach ($menu_items as $item) :
						if(!$item->menu_item_parent):
							$parent_id = $item->ID;
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID));
							$image_src=str_replace("-150x150","",$image[0]);//[thien.nguyen] Get full size
							$count_child=0;
							$parent_url = $item->url;
					?>
					<div class="grid_4">
						<img src="<?php echo $image_src; ?>" alt="<?php echo $item->title;?>"/>
						<ul>
							<li><a href="<?php echo $item->url;?>"><?php echo $item->title;?></a>
					<?php endif;
						if($parent_id==$item->menu_item_parent):
							if(!$submenu):
								$submenu = true;
							?>
								<ul class="sub-menu">
							<?php endif; ?>
							<?php $count_child++; if($count_child<=5):?>
									<li>
										<a href="<?php echo $item->url;?>"><?php echo $item->title;?></a>
									</li>
							<?php endif;?>
							<?php if(isset($menu_items[$count + 1]) && $menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu):?>
								</ul>
								<?php 
									$submenu = false; 
									endif;
						endif;?>

					<?php if( (isset($menu_items[$count + 1]) && !$menu_items[$count + 1]->menu_item_parent) 
								|| !isset($menu_items[$count + 1]) ): ?>
							</li>
						</ul>
						<div class="more-detail"><a href="<?php echo $parent_url?>">Xem thêm</a></div>
					</div>
					<?php endif;
						$count++;
					endforeach;
				}
				else {
					echo '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
				}
			?>
		</div>
	</section>

	<section id="articles">
		<div class="container_16">
			<div class="grid_16">
				<h1><?php echo get_cat_name(HOME_ARTICLE_CAT);?></h1>
			</div>
			<div class="clear"></div>
			<div class="grid_16">
			<?php
				global $post;
				$args = array('numberposts'=>3,'category'=>HOME_ARTICLE_CAT,'orderby'=>'post_date','order'=>'DESC');
				$custom_posts = get_posts($args);
				foreach ($custom_posts as $post) :setup_postdata($post) ?>
				<div class="art">
					<div class="illus">
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
					</div>
					<div class="title">
						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					</div>
					<div class="clear"></div>
					<div class="desc"><?php the_excerpt();?></div>
					<div class="more-detail"><a href="<?php the_permalink();?>">Xem thêm &gt;</a></div>
				</div>
			<?php endforeach; wp_reset_postdata();?>
				
			</div>
		</div>
	</section>

<?php get_footer(); ?>