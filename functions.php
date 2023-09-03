<?php

//loading javascript and bootstrap

function register_bootstrap() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', array(), '5.3.1', 'all');
    wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.1', true);
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
}
add_action('wp_enqueue_scripts', 'register_stylesheet');

//add short codes

add_shortcode('shortcode','myfun');

function myfun(){
    return date('l jS \of F Y h:i:s A');
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

    // if(wp_verify_nonce($_POST['nonce'],'ajax-nonce'))
    // {
    //     wp_send_json_error('nonce is incorrect', 401);
    //     die();
    // }

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

