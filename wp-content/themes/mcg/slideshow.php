<section id="slideshow">
	<div class="container_16">
		<!-- <div class="scrollling-control grid_16">
			<div class="left_round">&nbsp;</div>
			<div class="right_round">&nbsp;</div>
		</div> -->
		<div id="product-scrolling" class="grid_16">
		<?php 
			$args = array(
				'post_type'=>'product',
				'product_cat'=>'featured',
				'posts_per_page'=>FEATURED_POSTS_PER_PAGE,
				'orderby'=>'post_date'
				);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); $_product;
				if ( function_exists( 'get_product' ) ) {
					$_product = get_product( $loop->post->ID );
				} else {
					$_product = new WC_Product( $loop->post->ID );
				}
			?>
			<div class="contentBox">
				<div class="product">
					<a href="<?php echo get_permalink( $loop->post->ID ) ?>">
					<?php if ( has_post_thumbnail( $loop->post->ID ) ) echo get_the_post_thumbnail( $loop->post->ID, 'shop_thumbnail' ); else echo '<img src="' . $woocommerce->plugin_url() . '/assets/images/placeholder.png" alt="Placeholder" />'; ?>
					</a>
					<p class="product-name"><a href="<?php echo get_permalink( $loop->post->ID ) ?>">	<?php the_title();?></a></p>
					<p class="price"><?php echo $_product->get_price_html(); ?></p>
				</div>
			</div>
		<?php
			endwhile;
			wp_reset_postdata();
		?>
			
		</div><!-- end of .grid_16 -->
	</div>
</section><!-- end of #slideshow -->