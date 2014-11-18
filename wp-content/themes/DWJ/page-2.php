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

//Quotes for Quote Scroller using Spark Scroller widget
$context['slides']		= array(
							0	=>	array(
									'author'	=> "Philosopher <span class='quote-author'>Jacob Bronowski</span>",
									'text'		=> "I once addressed, on a Christmas day many years ago, on behalf of the United Nations, an audience of about two thousand school children in London. ...in a moment of abandon, I said to them:  “This is how the world goes, you are going to have to make it different, you are going to have to stop listening to your parents.  If you go on obeying your parents, the world will never be a better place.”"
								)
							,1	=>	array(
									'author'	=> "Mathmetician <span class='quote-author'>Mero</span>",
									'text'		=> "In our culture science has won the authority that makes us accept as truth its results…even if they contradict our everyday intuition."
								)
							,2	=>	array(
									'author'	=> "Legal scholar <span class='quote-author'>Matsuda</span>",
									'text'		=> "Power at its peak is so quiet and obvious in its place of seized truth that it becomes, simply, truth rather than power."
								)
							,3	=>	array(
									'author'	=> "Writer <span class='quote-author'>Arundhati Roy</span>",
									'text'		=> "Because of the caste system, because of the fact that there is no social link between those who make the decisions and those who suffer the decisions, it [the government of India] just goes ahead and does what it wants. The people also assume that this is their lot, their karma, what was written.  It's quite an efficient way of doing things."
								)
							,4	=>	array(
									'author'	=> "Cognitive scientist <span class='quote-author'>Robert Ornstein</span>",
									'text'		=> "It is illusory to think that a person has one mind... .  We are not coherent. We do not always decide things reasonably.  We are unaware of how we decide and even 'who' is deciding for us."
								)
							,5	=>	array(
									'author'	=> "Statesman and Writer <span class='quote-author'>Vacley Havel</span>",
									'text'		=> "The dizzying development of science, with its unconditional faith in objective reality and complete dependence on general and rationally knowable laws, led to the birth of modern technological civilization.  It is the first civilization that spans the entire globe and binds together all societies, submitting them to a common global destiny.  At the same time, the relationship to the world that modern science fostered and shaped appears to have exhausted its potential.  The relationship is missing something.  It fails to connect with the most intrinsic nature of reality and with natural human experience. It produces a state of schizophrenia: man as an observer is becoming completely alienated from himself as a being."
								)
							,6	=>	array(
									'author'	=> "Biologist <span class='quote-author'>Paul Ehrlich</span>",
									'text'		=> "Strangely, scientific inquiry is suggesting the need for a quasi-religious transformation of modern culture."
								)
							,7	=>	array(
									'author'	=> "Philosopher <span class='quote-author'>Bronowski</span>",
									'text'		=> "I believe that we need to review the whole of our natural philosophy in the light of scientific knowledge that has arisen in the last fifty years.  It really is pointless to go on talking about what the world is like (as much of philosophy does) when           the modes of perception of the world which are accessible to us have so changed in character."
								)
						);

Timber::render('views/homepage.html.twig', $context);

wp_footer(); 
?>