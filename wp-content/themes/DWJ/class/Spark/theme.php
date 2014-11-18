<?php
namespace SPARK;

class Theme {
	function __construct(){
		// add_action( 'init', array($this,'init_action') ); 

		$actions = array(
				'init'									=> array($this, 'init_action')
				// 'admin_init'							=> array($this, 'adminInit'),
				// 'admin_head'							=> array($this, 'adminHead'),
				,'save_post'							=> array($this, 'save_post')
				,'add_meta_boxes'						=> array(array($this, 'add_meta_boxes'), 0, 1)
				,'widgets_init'							=> array($this,'register_sidebars')
				// 'init'									=> array($this, 'myplugin_settings')
			);
		
		foreach($actions as $hook => $action)
			if(is_array($action[0]))
				call_user_func_array('add_action', array_merge(array($hook), $action));
			else
				add_action($hook, $action);

	}

	//Run all initialization tasks
	public function init_action(){
		$this->enqueue_scripts();
		$this->enqueue_styles();
		$this->register_nav_menus();
		$this->register_post_types();
		$this->register_sidebars();
		$this->register_ajax();

	}

	//Enqueue scripts using wp_enqueue_script
	public function enqueue_scripts(){
		wp_register_script( 'ejs', get_template_directory_uri().'/script/external/ejs/ejs_production.js', array('jquery'));
		wp_register_script( 'cycle', get_template_directory_uri().'/script/external/cycle2/jquery.cycle2.min.js', array('jquery'));
		wp_register_script( 'jquery_widget', get_template_directory_uri().'/script/external/jquery-ui-widget.js', array('jquery') );
		
		wp_enqueue_script( 'ejs' );
		wp_enqueue_script( 'cycle' );
		wp_enqueue_script( 'jquery_widget' );
		wp_localize_script( 'jquery_widget', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		
		wp_enqueue_script('detp_theme');
	}

	//Enqueue styles using wp_enqueue_style
	public function enqueue_styles(){
		wp_enqueue_style( 'main', get_template_directory_uri().'/style.css' );
	}

	//Register Nav Menus
	public function register_nav_menus(){
		register_nav_menus(array(
			"main_nav"		=>		"Main Site Navigation"
		));
	}

	public function register_sidebars(){
		$args = array(
			'name'          => __( 'Main Sidebar' ),
			'id'            => 'main-sidebar',
			'description'   => '',
		    'class'         => ''
		);

		register_sidebar( $args );
	}

	//Register Post Types
	public function register_post_types(){
		add_theme_support( 'post-thumbnails' );
		$teamArgs = array(
			'label'             => 'Team'
			,'public'			=> true
			,'show_in_menu'		=> true
			,'supports'         => array(
				'title', 'editor', 'author', 'thumbnail',
				'excerpt','custom-fields', 'revisions', 'page-attributes', 'post-formats'
			)
		);
	
		register_post_type('team', $teamArgs);

		$projectArgs = array(
			'label'             => 'Project'
			,'public'			=> true
			,'show_in_menu'		=> true
			,'supports'            => array(
				'title', 'editor', 'author', 'thumbnail',
				'excerpt','custom-fields', 'revisions', 'page-attributes', 'post-formats'
			)
		);
	
		register_post_type('project', $projectArgs);

		$galleryArgs = array(
			'label'             => 'Gallery'
			,'public'			=> true
			,'show_in_menu'		=> true
			,'supports'         => array('title', 'author', 'thumbnail', 'excerpt')
		);
	
		register_post_type('gallery', $galleryArgs);

		add_post_type_support('page', 'excerpt');

	}

	//Add Meta Boxes
	public function add_meta_boxes(){
		add_meta_box('meta_box', 'Member Info', array($this, 'show_member_meta_box'), 'team');
		add_meta_box('meta_box', 'Project Info', array($this, 'show_project_meta_box'), 'project');
	}

	public function save_post($post_id) {
		
		//Member Meta
		// if(isset($_POST['member_title']))
		// 	update_post_meta($post_id, 'member_title', $_POST['member_title']);

	}

	// Team Member meta box
	public function show_member_meta_box($post){
		// $member_title = get_post_meta($post->ID, 'member_title', true);
?>
		<ul>
<!-- 			<li>
				<label for="member_title">Team Position</label>
				<input type="text" id="member_title" class="widefat" name="member_title" value="<?php echo $member_title; ?>">				
			</li> -->
		</ul>

<?php	}

	// Project Meta Box
	public function show_project_meta_box($post){
		$project_type = get_post_meta($post->ID, 'project_type', true);
		// $project_date = get_post_meta($post->ID, 'project_date', true);
?>
		<ul>
<!-- 			<li>
				<label for="project_type">Type</label>
				<input type="text" id="project_type" class="widefat" name="project_type" value="<?php echo $project_type; ?>">				
			</li> -->
		</ul>

<?php	}

	//Register AJAX
	public function register_ajax(){
		$service = new \Service(); 

        add_action("wp_ajax_get_posts", array($service, 'get_posts'));
        add_action("wp_ajax_nopriv_get_posts", array($service, 'get_posts'));

        add_action("wp_ajax_get_gallery", array($service, 'get_gallery'));
        add_action("wp_ajax_nopriv_get_gallery", array($service, 'get_gallery'));
	}

}

$detpTheme = new Theme();