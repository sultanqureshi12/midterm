<?php get_header();?>


<section class="page-wrap">
<div class="container">
	
 
 <div class="row">
 	<div class="col-lg-6">
 		<h2> <?php the_title();?></h2>
 		<?php get_template_part('includes/section','content');?>

 </div>
 <div class="col-lg-6">
 	<h2>Send a query</h2>
 	     <?php get_template_part('includes/form','enquiry');?>
 	  </div>


</div>
</div>
</section>



<?php get_footer();?>

