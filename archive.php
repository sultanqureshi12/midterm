<?php get_header();?>

<section class="page-wrap">
	<div class="container">

<?php get_template_part('includes/section','archive');?>

<?php the_posts_pagination();?>
</div>
</section>

<?php get_footer();?>