<?php get_header();?>
<?php

$results = wp_remote_retrieve_body(wp_remote_get('https://api.openbrewerydb.org/v1/breweries'));

echo '<pre>';
print_r($results);
echo '</pre>';

die();
?>
<?php get_footer();?>