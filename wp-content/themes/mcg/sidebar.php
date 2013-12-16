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
        <div class="product-item">
            <a href="#"><img src="../images/products/pk2.jpg"/></a>
            <p class="product-item-name"><a href="#">Mẫu sản phẩm 3</a></p>
            <p class="old-price">10.990.000 VND</p>
            <p class="price">9.990.000 VND</p>
        </div>
        <div class="product-item">
            <a href="#"><img src="../images/products/pn3.jpg"/></a>
            <p class="product-item-name"><a href="#">Mẫu sản phẩm 3</a></p>
            <p class="old-price">12.990.000 VND</p>
            <p class="price">10.990.000 VND</p>
        </div>
        <div class="clear"></div>
    </div>
</aside>
