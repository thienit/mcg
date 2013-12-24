<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$terms = get_the_terms( $product->$post->ID, 'product_cat' ) ;
$featured_cat = get_term_by('slug','featured','product_cat');
$categories = '';
foreach ($terms as $term ) {
	if($term->term_id != $featured_cat->term_id){
		$categories = $categories. $term->slug .',';
	}
}
$categories = substr($categories,0,-1);
// echo $categories;

// $related = $product->get_related( $posts_per_page );

// if ( sizeof( $related ) == 0 ) return;

// echo "<pre>";
// print_r($product);
// echo "</pre>";

// $args = apply_filters('woocommerce_related_products_args', array(
$args = array(
	'post_type'				=> 'product',
	'product_cat' => $categories,
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> RELATED_POSTS_NUMBER,
	'orderby' 				=> $orderby,
	//'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= 4;

if ( $products->have_posts() ) : ?>
<section>
	<div class="related products">

		<h1><?php _e( 'Related Products', 'woocommerce' ); ?></h1>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>
	</div>
<?php 
	foreach ($terms as $term ) {
		if($term->term_id != $featured_cat->term_id){
			echo '<a class="more-view" href="'.get_term_link($term,'product_cat').'">Xem thêm &gt;</a>';
			break;
		}
	}
?>
<section>
<?php endif;

wp_reset_postdata();
