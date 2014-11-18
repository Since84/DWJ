<?php
global $post;
wp_head();

$imageSource = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

$context 				= Timber::get_context();
$context['menu'] 		= new TimberMenu();

//Get Pages
$context['site_title']	= get_bloginfo( 'name' );
$context['excerpt']		= get_the_excerpt();
$context['post'] 		= new TimberPost();
$context['feat_image']	= $imageSource[0];
$context['sidebar'] 	= Timber::get_sidebar('sidebar.php');

Timber::render('views/page.html.twig', $context);

wp_footer(); 
?>