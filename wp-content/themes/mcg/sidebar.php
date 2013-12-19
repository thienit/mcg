 <aside class="grid_4">
    <div id="cat" class="widget">
        <h1><?php 
            $url = explode('/',$_SERVER['REQUEST_URI']);
            $term_id;
            $term_name;
            if($url[2]=='product-category') {
                $term = get_term_by('slug',$url[3],'product_cat',OBJECT);
            } else if($url[2]=='category') {
                $term = get_term_by('slug',$url[3],'category',OBJECT);
            } else if($url[2]=='product') {
               $cats = get_the_terms( $post->ID, 'product_cat' ) ;
               
               foreach ($cats as $cat) {
                   if($cat->term_id != FEATURED_PRODUCT_CAT) {
                        $term = get_term_super_parent($cat->term_id,'product_cat');
                        break;
                   }
               }
            } else if(is_single()) {
                $cats = get_the_terms( $post->ID,'category');

                foreach ($cats as $cat) {
                   if($cat->term_id != FEATURED_PRODUCT_CAT) {
                        $term = get_term_super_parent($cat->term_id,'category');
                        break;
                   }
               }
            } 
            if(isset($term) && $term->term_id != 0) {
                $term_id = $term->term_id;
                $term_name = $term->name;
            } else {
                $menu_name="main_nav";
                if(($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){
                    $menu = wp_get_nav_menu_object($locations[$menu_name]);
                    $menu_items = wp_get_nav_menu_items($menu->term_id);
                    if(isset($menu_items[1])) {
                        $term_id = $menu_items[1]->object_id;
                        $term_name = $menu_items[1]->title;
                    }
                }
            }
            echo $term_name;
        ?></h1>
        <ul>
        <?php  
            $menu_name="main_nav";
            if(($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){
                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                $count = 0;
                $parent_lv1 = $term_id;
                foreach ($menu_items as $item) :
                    if($item->post_parent == $parent_lv1):
                        $parent_id = $item->object_id;
                        $parent_url = $item->url;
                ?>

                <li><a href="<?php echo $item->url;?>"><?php echo $item->title;?></a>
                <?php endif;
                    if($parent_id!= 0 && $parent_id==$item->post_parent):
                        if(!$submenu):
                            $submenu = true;
                        ?>
                            <ul class="sub-menu">
                        <?php endif; ?>
                        
                                <li>
                                    <a href="<?php echo $item->url;?>"><?php echo $item->title;?></a>
                                </li>
                        <?php if(isset($menu_items[$count + 1]) && $menu_items[$count + 1]->post_parent != $parent_id && $submenu):?>
                            </ul>
                            <?php $submenu = false; 
                            endif;
                    endif;?>

                <?php if(isset($menu_items[$count + 1]) && $menu_items[$count + 1]->post_parent == $parent_lv1): ?>
                </li>

                <?php endif;
                    $count++;
                endforeach;
            }           
        ?>
        </ul>
    </div>
    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>


    <?php endif; ?>

    <div id="promotion" class="widget">
        <h1>Khuyến mãi</h1>
        <?php
            global $post;
            $args = array(
               'post_type' => 'product',
               'post_status' => 'publish',
               'ignore_sticky_posts'   => 1,
               'posts_per_page' => 5,
               'orderby' => 'post_date',
               'order' => 'desc',
               'meta_query' => array(
                    array(
                        'key' => '_visibility',
                        'value' => array('catalog', 'visible'),
                        'compare' => 'IN'
                    ),
                    array(
                        'key' => '_sale_price',
                        'value' =>  0,
                        'compare'   => '>',
                        'type'      => 'NUMERIC'
                    )
                )
            );
            $loop = new WP_Query($args);
            $count=0;
            while($loop->have_posts()):$loop->the_post();$_product;
                if(function_exists( 'get_product' )) {
                    $_product = get_product($loop->post->ID);
                }else {
                    $_product = new WC_Product($loop->post->ID);
                }
            ?>
            <div class="product-item">
                <a href="<?php the_permalink();?>">
                <?php
                    if(has_post_thumbnail()){
                        the_post_thumbnail();
                    }
                ?>
                </a>
                <p class="product-item-name"><a href="<?php the_permalink();?>"><?php the_title();?></a></p>
                <p class="price"><?php echo $_product->get_price_html();?></p>
            </div>
        <?php
            if($count++ >= SALE_PRODUCTS_NUMBER) break;

            endwhile;
            wp_reset_postdata();

            
        ?>
        <div class="clear"></div>
    </div>
</aside>
