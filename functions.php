<?php

//loading javascript and bootstrap and slick slider

function register_bootstrap() {
   

    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), false, 'all');

    wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css', array('slick-css'), 
    false, 'all');
    
    wp_enqueue_script( 'slick-script', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 
    array(), false , true);
}
add_action('wp_enqueue_scripts', 'register_bootstrap');

function register_jquery() {
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js', array(), '3.7.0', true);
}
add_action('wp_enqueue_scripts', 'register_jquery');

//loading stylesheets

function register_stylesheet() {
	 wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.2', 'all');
     wp_enqueue_style('main', get_template_directory_uri() . '/main.css', array(), '1.2', 'all');
     wp_enqueue_script('main_js',get_template_directory_uri().'/js/main.js',NULL, 1.0,true);
}
add_action('wp_enqueue_scripts', 'register_stylesheet');

//add short codes




add_shortcode('shortcode','myfun');

function myfun(){
    return date('l jS \of F Y h:i:s A');
}

add_shortcode('users_data', 'myuserfun');

function myuserfun($atts){
    $attributes= shortcode_atts(
        array(
          'id'=>'1',

        ),
       $atts
    );

    $api_url='https://jsonplaceholder.typicode.com/users/'.$attributes['id'];
    $user_data=wp_remote_get($api_url);
$responsebody=wp_remote_retrieve_body($user_data);

$result =json_decode($responsebody, true);

$user_name=esc_html($result['name']);
$company_name=$result['company']['name'];

$output ="<div><p>Name: $user_name</p><p>Company Name: $company_name</p>";

// foreach($result as $data){
//     $output.= $data->id." ".$data->name."<br>";
// }
// $output = "<div> Name: $result->: $result->company</div>";
return $output;
}




//theme options

add_theme_support('post-thumbnails');
add_theme_support('custom-background');

//customize images

add_image_size('blog-large', 800, 400, false);
add_image_size('small-blog', 200,200,true);

//adding menu

register_nav_menus(

       array(

        'top-menu'=>'Top Menu Location',

        'mobile-menu'=>'Mobile Menu Location',

       )
);

add_action('wp_ajax_enquiry','enquiry_form');
add_action('wp_ajax_nopriv_enquiry','enquiry_form');

function enquiry_form(){

    if(wp_verify_nonce($_POST['nonce'],'ajax-nonce'))
    {
        wp_send_json_error('nonce is incorrect', 401);
        die();
    }

    $myformdata= [];
    wp_parse_str($_POST['enquiry'],$myformdata);

    $admin_email =get_option('admin_email');

    $headers[]='content-type: text/html;charset=UTF-8';
    $headers[]= 'From: My Website <'.$admin_email.'>';
    $headers[]= 'Reply-to: '.$myformdata['email'];

    $send_to=$admin_email;

    $subject= 'Enquiry from:'.$myformdata['fname'].''.$myformdata['lname'];

    $message='';

    foreach($myformdata as $index=>$field)
    {
      $message .='<strong>'.$index.'</strong>:'.$field.'<br/>';
    }

try{
    if(wp_mail($send_to,$subject,$message,$headers)){
        wp_send_jason_success('Email Sent');
    }

    else{
        wp_send_json_error('Email Error');
    }
}

catch(exception $e)
{
    wp_send_json_error($e->getmessage());
}

    wp_send_json_success($fname);
}

//hooks

add_action('save_post','log_when_saved');

function log_when_saved($post_id){

    if(!(wp_is_post_revision($post_id))||(wp_is_post_autosave($post_id))){
        return;
    }

    $post_log=get_stylesheet_directory().'/post_log.txt';
    $message=get_the_title($post_id).'was just saved';

    if(file_exists($post_log)){
        $file=fopen($post_log,'a');
        fwrite($file,$message."\n");
    }else{
        $file=fopen($post_log,'w');
        fwrite($file,$message."\n");
    }
    fclose($file);

}

add_action('template_redirect','members_only');

function members_only(){
    if(is_page('secret-page')&& ! is_user_logged_in()){
        do_action('user_redirected',date("F j,Y, g:i a"));
        wp_redirect(home_url());
        die();
    }
}

add_action('user_redirected','logged_when_accessed');
function logged_when_accessed($date){
    $access_log= get_stylesheet_directory().'/post_log.txt';
    $message='Someone tried to access super secret page on '.$date;

    if(file_exists('access_log')){
        $file=fopen($access_log,'a');
        fwrite($file,$message."\n");
    }
    else{
        $file=fopen($access_log,'w');
        fwrite($file,$message."\n");
    }
}

// add_action( 'wp_enqueue_scripts', 'slick_register_styles' );
// function slick_register_styles() {
// wp_enqueue_style( 'slick-css', untrailingslashit( get_template_directory_uri() ) . '/assets/src/library/css/slick.css', [], false, 'all' );
// wp_enqueue_style( 'slick-theme-css', untrailingslashit( get_template_directory_uri() ) . '/assets/src/library/css/slick-theme.css', ['slick-css'], false, 'all' );
// wp_enqueue_script( 'carousel-js', untrailingslashit( get_template_directory_uri() ) . '/assets/src/carousel/index.js', ['jquery', 'slick-js'], filemtime( untrailingslashit( get_template_directory() ) . '/assets/src/carousel/index.js' ), true );
// }

function slickslider(){?>

    <script type="text/javascript">
        
        jQuery(document).ready(function(){
            jQuery('.card').slick({

                 // autoplay: true,
                 // autoplaySpeed: 1000,
                 //    slidesToShow: 3,
                 //    slidesToScroll: 1,
                 dots: true,
   infinite: true,
   speed: 300,
   slidesToShow: 2,
   slidesToScroll: 2,
   responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]

            });
        });
    </script>
    <?php


}
add_action('wp_footer','slickslider');

function project_slider_shortcode(){
    $args= array(
    'post_type'=>'project',
     'post_status'=>array('publish')
    );

    $query = new WP_Query($args);

    if ($query->have_posts()){
        ob_start();
        $output='';
        $output.='<div class="project-outer-container slick-class">';
        while ($query->have_posts()){
            $query->the_post();
            $output.='<div class="project-container">
            <div class="project-block">
            <div class="archive-page-thumbnails w-full">'.get_thepost_thumbnail(get_the_ID(),'blog-thumbnail').'<?div>
            <div class="project-info">
            <h3>'.get_the_title().'</h3><p>'.get_the_excerpt().'</p><a href="'.the_permalink().'" class="btn btn-success">Read More</a>
            </div>
            </div>
            </div>';


        }
         $output.='</div>';
             // Restore the global post data
        wp_reset_postdata();
        ob_get_clean();
        return $output;
    }
}
add_shortcode('project_slider', 'project_slider_shortcode');

add_action('init','register_brewery_cpt');
function register_brewery_cpt(){
    register_post_type('brewery',[
        'label'=> 'Breweries',
        'public' => true,
        'capability_type' => 'post'
    ]);
}

add_action('wp_ajax_nopriv_get_breweries_from_api','get_breweries_from_api');
add_action('wp_ajax_get_breweries_from_api','get_breweries_from_api');

$file = get_stylesheet_directory().'/report.txt';

function get_breweries_from_api(){
    $current_page = (!empty($_POST['current_page'])) ? $_POST['current_page'] : 1;
    $breweries = [];
    $results = wp_remote_retrieve_body(wp_remote_get('https://api.openbrewerydb.org/breweries/?page=' . $current_page . '&per_page=50'));
file_put_contents($file,"current_page:". $current_page. "\n\n", FILE_APPEND);

    $results =json_decode($results);

if(! is_array($results) || empty($results)){
    return false;
}

$current_page= $current_page+1;
wp_remote_post(admin_url('admin-ajax.php?action=get_breweries_from_api'),[
    'blocking'=>false,
    'sslverify'=>false,
'body' =>[
    'current_page'=>$current_page,
]
]);
}



