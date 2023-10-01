
<?php get_header();?>
<?php
require_once __DIR__ . '/src/Test.php';

if(file_exists(dirname(__FILE__). '/vendor/autoload.php')){
    require_once(dirname(__FILE__). '/vendor/autoload.php');
  }
  use Src\Test;
  $test1 = new Test(); 
  $test1->check();
  ?>
  
  

<div class="posts-carousel px-5">
   <!--Slide One-->
   <div class="card">
      <img width="350" height="233" src="https://via.placeholder.com/150" class="w-100" alt="alt-text">
      <div class="card-body">
         <h3 class="card-title">Your Post heading</h3>
         <p>Your Post Excerpt</p>
         <a href="#" class="btn btn-primary">View More</a>
      </div>
   </div>
   <!--Slide Two-->
   <div class="card">
      <img width="350" height="233" src="https://via.placeholder.com/150" class="w-100" alt="alt-text">
      <div class="card-body">
         <h3 class="card-title">Your Post heading</h3>
         <p>Your Post Excerpt</p>
         <a href="#" class="btn btn-primary">View More</a>
      </div>
   </div>
</div>

<?php get_footer();?>