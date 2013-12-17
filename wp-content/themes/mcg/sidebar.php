 <aside class="grid_4">
    <div id="cat" class="widget">
        <h1><?php 
            // single_cat_title("",true);
            $category = get_the_category();
            $cat_id = $category[0]->cat_ID;
            $cat_name = $category[0]->cat_name;
            echo $cat_name;
        ?></h1>
        <?php  
            $menu_name="main_nav";
            if(($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){
                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                $count = 0;
                $count_parent=0;
                $submenu = false;
                echo '<ul>';
                $parent_lv1 = 88;
                foreach ($menu_items as $item) :
                    if($item->menu_item_parent == $parent_lv1):
                        $parent_id = $item->ID;
                        $count_parent++;
                        $count_child=0;
                        $parent_url = $item->url;
                ?>

                <li><a href="<?php echo $item->url;?>"><?php echo $item->title;?></a>
                <?php endif;
                    if($parent_id==$item->menu_item_parent):
                        if(!$submenu):
                            $submenu = true;
                        ?>
                            <ul class="sub-menu">
                        <?php endif; ?>
                        <?php $count_child++;?>
                                <li>
                                    <a href="<?php echo $item->url;?>"><?php echo $item->title;?></a>
                                </li>
                        <?php if($menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu):?>
                            </ul>
                            <?php $submenu = false; endif;
                    endif;?>

                <?php if($menu_items[$count + 1]->menu_item_parent == $parent_lv1): ?>
                </li>

                <?php endif;
                    $count++;
                    if($count_parent >7) {
                        break;
                    }
                endforeach;
                echo '</ul>';
            }
            else {
                echo '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
            }
        ?>
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
