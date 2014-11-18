<?php 
// namespace DETP\Service;

/**
  *	Class Service
  * Base class for creating a webservice.  
**/
class Service {

	/*
	*	FUNCTION get_posts()
	*	@param 	$data
	*	@return array - $posts object
	*/
	public function get_posts() {
		$postArgs['posts_per_page']	= ( $_POST['options']['posts_per_page'] ? $_POST['options']['posts_per_page'] : 1 );
		$postArgs['post_type'] = ( $_POST['options']['post_type'][0] ? array($_POST['options']['post_type'][0]) : 'post' );
		$postQuery 	= new WP_Query($postArgs);

		foreach ( $postQuery->posts as $post ){
			$post->image = array(
				'full'		=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )
				,'large'	=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )
				,'medium'	=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' )
				,'thumb'	=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) )
			);

			// Member Meta
			$post->member_title = get_post_meta($post->ID, 'member_title', true);
			$post->member_phone = get_post_meta($post->ID, 'member_phone', true);
			$post->member_facebook = get_post_meta($post->ID, 'member_facebook', true);
			$post->member_twitter = get_post_meta($post->ID, 'member_twitter', true);
			$post->member_linkedin = get_post_meta($post->ID, 'member_linkedin', true);

			// Work Meta
			$post->project_name = get_post_meta($post->ID, 'project_name', true);
			$post->project_type = get_post_meta($post->ID, 'project_type', true);
			$post->project_date = get_post_meta($post->ID, 'project_date', true);

			$newPosts[] = $post;
		}

		$postQuery->newposts = $newPosts;

		echo json_encode($postQuery);
		die(0);
	}

	/*
	*	FUNCTION get_gallery()
	*	@param 	$data
	*	@return array - $gallery object
	*/
	public function get_gallery() {
		$galleryArgs = $_POST['options'] ? $_POST['options'] : array(
			'posts_per_page'		=>	'2'
		);
		$galleryArgs['post_type'] = array('gallery');
		$galleryQuery 	= new WP_Query($galleryArgs);

		foreach ( $galleryQuery->posts as $post ){
			$post->image = array(
				'full'		=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )
				,'large'	=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )
				,'medium'	=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' )
				,'thumb'	=> wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) )
			);

			$newPosts[] = $post;
		}

		$galleryQuery->newposts = $newPosts;

		echo json_encode($galleryQuery);
		die(0);
	}

	/*
	*	FUNCTION get_options()
	*	@param 	$data
	*	@return array - service options
	*/
	public function get_options($options = false ) {
		$options = $_POST['options'] ? $_POST['options'] : $options;
		return $options; 
	}

	/*
	*	FUNCTION get_data()
	*	@param 
	*	@return array - data object
	*/
	public function get_data(){}

	/*
	*	FUNCTION get_JSON()
	*	@param $data - data to be jsonified
	*/
	public function get_JSON( $data = "yes" ){
		$json = json_encode($data);
		return $json;
	}

}