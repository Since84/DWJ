<?php
wp_head();

$context 				= Timber::get_context();
$context['menu'] 		= new TimberMenu();

//Get Pages
$homepage 				= get_page_by_title('Home' );
if ( $homepage ) { $context['home_post']	= new TimberPost( $homepage->ID ); }

$missionpage 				= get_page_by_title('Our Mission' );
if ( $missionpage ) { $context['mission_post']	= new TimberPost( $missionpage->ID ); }


Timber::render('views/home.html.twig', $context);

wp_footer(); 
?>