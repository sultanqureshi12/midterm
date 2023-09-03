<?php if(have_posts()): while(have_posts()): the_post();?>

	<div class="card mb-3 mt-3">
		<div class="card-body justify-content-center align-items-center">

	<?php if(has_post_thumbnail()):?>
		<img src="<?php the_post_thumbnail_url('small-blog');?>" style="width:280px ; height: 170px;">

	<?php endif;?>

	<h4><?php the_title();?></h4>

	<?php the_excerpt();?>
	<a href="<?php the_permalink();?>" class="btn btn-success">Read More</a>

	</div>
</div>

<?php endwhile;else:endif;?>
