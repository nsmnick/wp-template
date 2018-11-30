<?php
// Define constants.
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT.'/images');


// Disable front end wp admin menu.
add_filter('show_admin_bar', '__return_false');


// Prevent user enumeration
if (!is_admin() && isset($_SERVER['REQUEST_URI'])) {
	if (preg_match('/(wp-comments-post)/', $_SERVER['REQUEST_URI']) === 0 && !empty($_REQUEST['author'])) {
		openlog('wordpress('.$_SERVER['HTTP_HOST'].')', LOG_NDELAY|LOG_PID,LOG_AUTH);
		syslog(LOG_INFO, "Attempted user enumeration from {$_SERVER['REMOTE_ADDR']}");
		closelog();
		wp_die('Forbidden');
	}
}


// Frontend styles.
function enqueue_style() {
	wp_enqueue_style('core', THEMEROOT.'/css/styles.css', false);
	wp_enqueue_style('core', THEMEROOT.'/css/slick.css', false);
}
add_action('wp_enqueue_scripts', 'enqueue_style');


// Frontend scripts.
function enqueue_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('custom-script', THEMEROOT.'/js/script.min.js', array( 'jquery' ), false, true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');


// Custom menus.
function custom_init() {
	register_nav_menu('main-menu', 'Primary Menu');
	register_nav_menu('footer-menu', 'Footer Menu');
}
add_action('init', 'custom_init');


// Enable thumbnail support for this theme.
add_theme_support('post-thumbnails');


// Enable custom login styles.
/*
function custom_login() {
	echo '<link rel="stylesheet" href="'.THEMEROOT.'/css/login.css" />';
}
add_action('login_head', 'custom_login');
*/


// Tell Admin about required plugins for this theme.
function show_required_plugins() {
	$plugin_messages = array();

	include_once (ABSPATH . 'wp-admin/includes/plugin.php');

	// Download the Advanced Custom Fields plugin.
	if (!is_plugin_active( 'advanced-custom-fields/acf.php' )) {
		$plugin_messages[] = 'This theme requires you to install the Advanced Custom Fields plugin, <a href="https://en-gb.wordpress.org/plugins/advanced-custom-fields/">download it from here</a>.';
	}

	// Download the Advanced Custom Fields Repeater field plugin.
	if (!is_plugin_active( 'acf-repeater/acf-repeater.php' )) {
		$plugin_messages[] = 'This theme requires you to install the Advanced Custom Fields Repeater field plugin, <a href="http://www.advancedcustomfields.com/add-ons/repeater-field/">download it from here</a>.';
	}

	if (count($plugin_messages) > 0) {
		echo '<div id="message" class="error">';

		foreach ($plugin_messages as $message) {
			echo '<p><strong>'.$message.'</strong></p>';
		}

		echo '</div>';
	}
}
add_action('admin_notices', 'show_required_plugins');


// Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', function($the_template) {

	foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") ) {
			return TEMPLATEPATH . "/single-{$cat->slug}.php";
		}
	}
	return $the_template;

});


// Custom sidebars.
if (function_exists('register_sidebar')) {
	register_sidebar(
		array(
			'name' => 'Default Sidebar'
			, 'id' => 'default-sidebar'
			, 'description' => 'Default Sidebar'
			, 'before_widget' => '<div>'
			, 'after_widget' => '</div>'
			, 'before_title' => '<p>'
			, 'after_title' => '</p>'
		)
	);
	register_sidebar(
		array(
			'name' => 'Blog Sidebar'
			, 'id' => 'blog'
			, 'description' => 'Blog Sidebar'
			, 'before_widget' => '<div class="widget %2$s">'
			, 'after_widget' => '</div>'
			, 'before_title' => '<p class="widget-title">'
			, 'after_title' => '</p>'
		)
	);
}


// Displays post meta data.
function entry_meta() {
	if (is_sticky() && is_home() && ! is_paged()) {
		printf('<span class="sticky-post">%s</span>', 'Featured');
	}

	$format = get_post_format();
	if (current_theme_supports('post-formats', $format)) {
		printf(
			'<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>'
			, sprintf('<span class="screen-reader-text">%s </span>', 'Format')
			, esc_url(get_post_format_link($format))
			, get_post_format_string($format)
		);
	}

	if (in_array(get_post_type(), array('post', 'attachment'))) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
							$time_string
							, esc_attr(get_the_date('c'))
							, get_the_date()
						);

		printf(
			'<span class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>'
			, esc_url(get_permalink())
			, $time_string
		);
	}

	if ('post' == get_post_type()) {
		if (is_singular() || is_multi_author()) {
			printf(
				'<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>'
				, ' by'
				, esc_url(get_author_posts_url(get_the_author_meta('ID')))
				, get_the_author()
			);
		}
	}
}


// Post excerpt settings.
function custom_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function new_excerpt_more($more) {
	return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');


// Remove the retarded 10px Wordpress adds to image containers with a caption.
function shorten_img_caption_shortcode_width($caption_width) {
	return $caption_width - 10;
}
add_filter('img_caption_shortcode_width', 'shorten_img_caption_shortcode_width');


// Create styles for responsive page hero images.
function get_page_hero_image_css($image) {
	if ($image) {
		$css = '<style>'
					.'.page-hero { background-image: url(\''.$image['sizes']['large'].'\') }'
					.'@media (min-width: 990px) {.page-hero { background-image: url(\''.$image['url'].'\') }}'
				.'</style>';
		return $css;
	}
	return '';
}
function get_post_hero_image_css() {
	if (has_post_thumbnail()) {
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
		$full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		$css = '<style>'
					.'.page-hero { background-image: url(\''.$large_image_url[0].'\') }'
					.'@media (min-width: 990px) {.page-hero { background-image: url(\''.$full_image_url[0].'\') }}'
				.'</style>';
		return $css;
	}
	return '';
}


// Force Gravity forms Javascript to load in footer and not before.
//add_filter( 'gform_init_scripts_footer', '__return_true' );


// Default fields for Advanced Custom Fields.
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page-blocks',
		'title' => 'Page Blocks',
		'fields' => array (
			array (
				'key' => 'field_55018041c8946',
				'label' => 'Page Blocks',
				'name' => 'page_blocks',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5501804cc8947',
						'label' => 'id',
						'name' => 'id',
						'type' => 'text',
						'column_width' => 10,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55018075c8948',
						'label' => 'class',
						'name' => 'class',
						'type' => 'text',
						'column_width' => 10,
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55018088c8949',
						'label' => 'content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_type',
					'operator' => '!=',
					'value' => 'posts_page',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-hero',
		'title' => 'Page Hero',
		'fields' => array (
			array (
				'key' => 'field_5501825ea7193',
				'label' => 'Page Hero Image',
				'name' => 'page_hero_image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_5501828ba7194',
				'label' => 'Page Hero Content',
				'name' => 'page_hero_content',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

