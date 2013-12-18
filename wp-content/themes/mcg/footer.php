		<footer>
			<div class="company-info ">
				<div class="container_16">
					<div class="menu grid_4">
						<p><?php 
							$term = get_term_by('id',FOOTER_MENU1,'product_cat',OBJECT);
							echo $term->name;
						?></p>
						<?php 
							$menu_name = 'shortcut_nav';

						    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
								$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

								$menu_items = wp_get_nav_menu_items($menu->term_id);

								$menu_list = '<ul>';

								foreach ( (array) $menu_items as $key => $menu_item ) {
								    $title = $menu_item->title;
								    $url = $menu_item->url;
								    $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
								}
								$menu_list .= '</ul>';
						    } else {
								$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
						    }
						    
						   	echo $menu_list;
						?>
					</div>
					<div class="menu grid_4">
						<p>MENU</p>
						<?php wp_nav_menu(array('menu'=>'Main Menu','depth'=>1,'container'=>'','menu_class'=>''));?>
						<ul>
						<?php
							$contact_page = get_page(CONTACT_PAGE);
							$contact_permalink = get_site_url() .'/'.$contact_page->post_name;
							echo '<li><a href="' .$contact_permalink. '">' .$contact_page->post_title. '</a></li>';
						?>
						</ul>
					</div>
					<div class="contact grid_6">
						<div class="hotline">Hotline: <?php $page = get_page(HOTLINE); echo $page->post_content;?></div>
						<div class="email">Email: <?php $page = get_page(EMAIL); echo $page->post_content;?></div>
					</div>
					<div class="clear"></div>
					<div class="grid_16">
						<?php
							$footer_page = get_page(FOOTER_PAGE);
							echo $footer_page->post_content;
						?>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="container_16">
					<div class="grid_16">
						<p>Designed and developed by Nathiwos (<a href="http://www.nathiwos.com">http://www.nathiwos.com</a>)</p>
					</div>
				</div>
			</div>
		</footer><!-- end of footer -->

	</div>

	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
	
</body>

</html>
