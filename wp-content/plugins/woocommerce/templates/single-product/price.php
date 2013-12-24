<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<h1 class="price">
	<?php 
		if($product->get_price_html())
			echo $product->get_price_html();
		else
			echo '0 VNĐ';
	?>
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	</h1>
	
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
</div>