<?php
/**
 * Enqueue script and styles 
 *
 * @package WordPress
 * @subpackage mytheme
 * @since mytheme 1.0
 */

 namespace mytheme\classes;
 
 class RegisterScripts{
    public function __construct(){
        add_action('wp_enqueue_scripts', array($this,'register_scripts'));
    }

    public function register_scripts(){
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css', array(), '5.3.1', 'all');
        wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.1', true);
    
         wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css' );
    }
 }
