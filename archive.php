<?php get_header();?>

<section class="page-wrap">
	<div class="container">
		<div class="card">

<?php get_template_part('includes/section','archive');?>
<?php get_template_part('includes/section','carousel');?>
<?php echo do_shortcode('[project_slider]');?>


</div>

</div>
<?php the_posts_pagination();?>
</section>

<?php get_footer();?>