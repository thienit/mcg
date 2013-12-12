 <aside class="grid_4">
    <div id="cat" class="widget">
    <?php
        $category = get_the_category();
        $cat_id = $category[0]->cat_ID;
        $cat_name = $category[0]->cat_name;
        $args=array(
              'number' => 'null',
              'orderby' => 'name',
              'order' => 'ASC',
              'columns' => '1',
              'hide_empty' => '1',
              'parent' => '',
              'ids' => ''
         );
        echo do_shortcode('[product_categories number="12" parent="0"]');
    ?>
        <h1><?php single_cat_title("abc ",true);?></h1>
        <ul>
            <li><a href="#">Phòng khách</a>
                <ul>
                    <li><a href="#">Kệ ti vi và giá sách</a></li>
                    <li><a href="#">Sofa</a></li>
                    <li><a href="#">Tủ rượu, tủ trang trí</a></li>
                </ul>
            </li>
            <li><a href="#">Phòng ngủ</a>
                <ul>
                    <li><a href="#">Giường ngủ</a></li>
                    <li><a href="#">Tủ áo</a></li>
                    <li><a href="#">Bàn trang điểm</a></li>
                </ul>
            </li>
            <li><a href="#">Phòng ăn, tủ bếp</a>
                <ul>
                    <li><a href="#">Bộ bàn ăn</a></li>
                    <li><a href="#">Tủ bếp</a></li>
                    <li><a href="#">Quầy bar</a></li>
                </ul>
            </li>
            <li><a href="#">Phòng làm việc</a>
            </li>
            <li><a href="#">Phòng trẻ em</a>
            </li>
            <li><a href="#">Kệ trang trí, Kệ treo tường</a>
            </li>
        </ul>
    </div>

    <div id="promotion" class="widget">
        <h1>Khuyến mãi</h1>
        <div class="product">
            <a href="#"><img src="../images/products/pk2.jpg"/></a>
            <p class="product-name"><a href="#">Mẫu sản phẩm 3</a></p>
            <p class="old-price">10.990.000 VND</p>
            <p class="price">9.990.000 VND</p>
        </div>
        <div class="product">
            <a href="#"><img src="../images/products/pn3.jpg"/></a>
            <p class="product-name"><a href="#">Mẫu sản phẩm 3</a></p>
            <p class="old-price">12.990.000 VND</p>
            <p class="price">10.990.000 VND</p>
        </div>
        <div class="clear"></div>
    </div>
</aside>
