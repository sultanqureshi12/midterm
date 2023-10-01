<?php

$args=[

   'category_name' =>'blog',

];

$query= new WP_Query($args);
?>

<?php if($query->have_posts()):?>
<?php while ($query->have_posts()): $query->the_post();?>
	<?php the_title();?>
	<?php the_content();?>

	<?php endwhile; ?>
	<?php endif; ?>