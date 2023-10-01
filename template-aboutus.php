<?php get_header();?>

<section class="page-wrap">
    <div class="container">
        <h1><?php the_title();?></h1>

        <?php if(has_post_thumbnail()):?>
            <img src="<?php the_post_thumbnail_url('full');?>" style="width:280px ; height: 170px;">
        <?php endif;?>

        <?php get_template_part('includes/section','content');?>


    </div>

</section>
<div> <?php get_template_part('includes/section','resetapi');?></div>

<?php get_footer();?>
