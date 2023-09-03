<?php if(have_posts()): while(have_posts()): the_post();?>

	<?php echo get_the_date('l jS F, Y');?>
	<?php echo "<br><br>";?>
	<?php the_content();?>

	<?php
	$fname = get_the_author_meta('first_name');
	$lname = get_the_author_meta('last_name');

	?>
	<p>Posted by <?php echo $fname ; ?> <?php echo $lname; ?></p>



<?php

	$tags= get_the_tags();
	foreach($tags as $tag):?>

		<a href="<?php get_tag_link($tag->term_id);?> " class="btn btn-success">

		<?php echo $tag->name;?>

	</a>
	<?php endforeach;?>

	<?php comments_template();?>
	<?php endwhile;else:endif;?>
