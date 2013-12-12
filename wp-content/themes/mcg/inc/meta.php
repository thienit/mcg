<?php 
	$category = get_the_category();
	$cat_name = $category[0]->cat_name;
	$cat_link = get_category_link($category[0]->cat_ID);
?>
<div class="meta"><div class="post-date"><?php the_time('d-m-Y')?></div> <div class="post-cat"><a href="<?php echo $cat_link;?>"><?php echo $cat_name; ?></a></div></div>