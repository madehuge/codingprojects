<?php
/**
 * enginetemplates functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage enginetemplates
 * @since enginetemplates 1.0
 */
/**
 * enginetemplates only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}
if ( ! function_exists( 'enginetemplates_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own enginetemplates_setup() function to override in a child theme.
	 *
	 * @since enginetemplates 1.0
	 */
	function enginetemplates_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/enginetemplates
		 * If you're building a theme based on enginetemplates, use a find and replace
		 * to change 'enginetemplates' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'enginetemplates' );
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		/*
		 * Enable support for custom logo.
		 *
		 *  @since enginetemplates 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'enginetemplates' ),
				
			)
		);
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);
		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', enginetemplates_fonts_url() ) );
		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );
		// Load default block styles.
		add_theme_support( 'wp-block-styles' );
		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );
		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // enginetemplates_setup
add_action( 'after_setup_theme', 'enginetemplates_setup' );
/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since enginetemplates 1.0
 */





function enginetemplates_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'enginetemplates_content_width', 840 );
}
add_action( 'after_setup_theme', 'enginetemplates_content_width', 0 );
/**
 * Add preconnect for Google Fonts.
 *
 * @since enginetemplates 1.6
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function enginetemplates_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'enginetemplates-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'enginetemplates_resource_hints', 10, 2 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since enginetemplates 1.0
 */
function enginetemplates_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Right Sidebar', 'enginetemplates' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'enginetemplates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar( array(
		    'name'          => __( 'Blog Left Sidebar', 'themename' ),
		    'id'            => 'sidebar-left-blog',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h3 class="widget-title">',
		    'after_title'   => '</h3>',
	  )
	);
	register_sidebar(
		array(
			'name'          => __( 'Woocommerce Right Sidebar', 'enginetemplates' ),
			'id'            => 'sidebar-right-ws',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'enginetemplates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar( array(
		    'name'          => __( 'Woocommerce Left Sidebar', 'themename' ),
		    'id'            => 'sidebar-left-ws',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h3 class="widget-title">',
		    'after_title'   => '</h3>',
	  )
	);
}
add_action( 'widgets_init', 'enginetemplates_widgets_init' );

if ( ! function_exists( 'enginetemplates_fonts_url' ) ) :
	/**
	 * Register Google fonts for enginetemplates.
	 *
	 * Create your own enginetemplates_fonts_url() function to override in a child theme.
	 *
	 * @since enginetemplates 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function enginetemplates_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'enginetemplates' ) ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}
		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'enginetemplates' ) ) {
			$fonts[] = 'Montserrat:400,700';
		}
		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'enginetemplates' ) ) {
			$fonts[] = 'Inconsolata:400';
		}
		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}
		return $fonts_url;
	}
endif;
/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since enginetemplates 1.0
 */
function enginetemplates_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'enginetemplates_javascript_detection', 0 );
/**
 * Enqueues scripts and styles.
 *
 * @since enginetemplates 1.0
 */
function enginetemplates_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'enginetemplates-fonts', enginetemplates_fonts_url(), array(), null );
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
	// Theme stylesheet.
	wp_enqueue_style( 'enginetemplates-style', get_stylesheet_uri() );
	// Theme block stylesheet.
	wp_enqueue_style( 'enginetemplates-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'enginetemplates-style' ), '20181230' );
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'enginetemplates-ie', get_template_directory_uri() . '/css/ie.css', array( 'enginetemplates-style' ), '20160816' );
	wp_style_add_data( 'enginetemplates-ie', 'conditional', 'lt IE 10' );
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'enginetemplates-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'enginetemplates-style' ), '20160816' );
	wp_style_add_data( 'enginetemplates-ie8', 'conditional', 'lt IE 9' );
	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'enginetemplates-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'enginetemplates-style' ), '20160816' );
	wp_style_add_data( 'enginetemplates-ie7', 'conditional', 'lt IE 8' );
	// Style woocommerce stylesheet.
	wp_enqueue_style( 'enginetemplates-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array( 'enginetemplates-style' ), '20160816' );
	// Style FontAwesome stylesheet.
	wp_enqueue_style( 'enginetemplates-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', array( 'enginetemplates-style' ), '20160816' );
	// Style custom stylesheet.
	wp_enqueue_style( 'enginetemplates-custom', get_template_directory_uri() . '/css/custom.css', array( 'enginetemplates-style' ), '20160816' );
	// Load the html5 shiv.
	wp_enqueue_script( 'enginetemplates-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'enginetemplates-html5', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'enginetemplates-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'enginetemplates-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}
	wp_enqueue_script( 'jquery-typed', get_template_directory_uri() . '/js/typed.js', array( 'jquery' ), '20181230', true );
	wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery-2.2.4.min.js', array( 'jquery' ), '20181230', true );
	wp_enqueue_script( 'enginetemplates-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20181230', true );
	wp_enqueue_script( 'enginetemplates-jquery', get_template_directory_uri() . '/js/jquery.min.js', array( 'jquery' ), '20181230', true  );
	wp_enqueue_script( 'enginetemplates-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20181230', true );
	wp_localize_script(
		'enginetemplates-script',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'enginetemplates' ),
			'collapse' => __( 'collapse child menu', 'enginetemplates' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'enginetemplates_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since enginetemplates 1.6
 */
function enginetemplates_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'enginetemplates-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20181230' );
	// Add custom fonts.
	wp_enqueue_style( 'enginetemplates-fonts', enginetemplates_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'enginetemplates_block_editor_styles' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @since enginetemplates 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function enginetemplates_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'enginetemplates_body_classes' );
/**
 * Converts a HEX value to RGB.
 *
 * @since enginetemplates 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since enginetemplates 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function enginetemplates_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}
	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'enginetemplates_content_image_sizes_attr', 10, 2 );
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since enginetemplates 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function enginetemplates_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'enginetemplates_post_thumbnail_sizes_attr', 10, 3 );
/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since enginetemplates 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function enginetemplates_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'enginetemplates_widget_tag_cloud_args' );

/**
 * Add sidebar left 
 */
function wpb_widgets_init() {

	register_sidebar( array(

		 'name' => 'Right Menu',

		 'id' => 'right-menu-widget',

		 'before_widget' => '<div class="right-menu">',

		 'after_widget' => '</div>',

		 'before_title' => '<h2 class="title-widget">',

		 'after_title' => '</h2>',
	 ) );
	register_sidebar( array(

		 'name' => 'Header Top Left',

		 'id' => 'header-top-left',

		 'before_widget' => '<div class="head-left-custom"">',

		 'after_widget' => '</div>',

		 'before_title' => '<h2 class="title-widget">',

		 'after_title' => '</h2>',
	 ) );
	register_sidebar( array(

		 'name' => 'Header Top Right',

		 'id' => 'header-top-right',

		 'before_widget' => '<div class="head-left-custom">',

		 'after_widget' => '</div>',

		 'before_title' => '<h2 class="title-widget">',

		 'after_title' => '</h2>',
	 ) );
	}
add_action( 'widgets_init', 'wpb_widgets_init' );
// Hook Bottom
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Bottom 1',
        'id'   => 'footer-1-widget',
        'description'   => 'Footer 1 widget position.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Bottom 2',
        'id'   => 'footer-2-widget',
        'description'   => 'Footer 2 widget position.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Bottom 3',
        'id'   => 'footer-3-widget',
        'description'   => 'Footer 3 widget position.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
    register_sidebar(array(
        'name' => 'Bottom 4',
        'id'   => 'footer-4-widget',
        'description'   => 'Footer 3 widget position.',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}
//Copyright widget
if (function_exists('register_sidebar')) {
register_sidebar( array(
'name' => 'Copyright',
'id' => 'copyright-widget',
'before_widget' => '<div class="top-head-widget">',
'after_widget' => '</div>',
'before_title' => '<h2 class="title-widget">',
'after_title' => '</h2>',
) );
}

//Optimize source code => Remove CSS libs
function smartwp_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );


 wp_dequeue_style('elementor-animations');
 wp_dequeue_style('enginetemplates-fonts');
 wp_dequeue_style('elementor-icons-fa-solid-css');
}
//Optimize source code => Remove JS libs
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css' );
add_action( 'wp_print_scripts', 'pp_deregister_javascript', 99 );
function pp_deregister_javascript() {
	wp_deregister_script( 'pp-del-avatar-script' );
}



// Customize Color Options
function ltheme_customize_register( $wp_customize ) {
    
	// Top Header Custom
	$wp_customize->add_setting('lt_top_header_bg_color', array(
		'default' => '#004C87',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_top_header_link_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',

	));

	$wp_customize->add_setting('lt_top_header_link_hover_color', array(
		'default' => '#004C87',
		'transport' => 'refresh',
	));
	
	$wp_customize->add_setting('lt_top_header_text_color', array(
		'default' => '#006ec3',
		'transport' => 'refresh',
	));


	// Header Custom
	$wp_customize->add_setting('lt_header_bar_bg_color', array(
		'default' => '#521384',
		'transport' => 'refresh',
	));

	// Menu Custom
	$wp_customize->add_setting('lt_text_menu_color', array(
		'default' => '#004C87',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_link_menu_color', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_link_menu_hover_color', array(
		'default' => '#ff1686',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_link_menu_item_color', array(
		'default' => '#000000',
		'transport' => 'refresh',
	));

	// Footer Custom

	$wp_customize->add_setting('lt_footer_color', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_footer_link_color', array(
		'default' => '#ff1686',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_footer_link_hover_color', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_footer_bg_color', array(
		'default' => '#111111',
		'transport' => 'refresh',
	));


	// copyright Custom
	$wp_customize->add_setting('lt_copyright_color', array(
		'default' => '#ff1686',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_copyright_link_color', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_copyright_link_hover_color', array(
		'default' => '#ff1686',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_copyright_bg_color', array(
		'default' => '#521384',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting('lt_bg_color', array(
		'default' => '#004C87',
		'transport' => 'refresh',
	));
	
	// Create Section
	$wp_customize->add_section('lt_custom_colors', array(
		'title' => __('Custom Color Variables', 'ltheme'),
		'priority' => 3,
	));

	// Create Section background
	$wp_customize->add_section('lt_background_colors', array(
		'title' => __('Background Colors', 'ltheme'),
		'priority' => 2,
	));


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_link_color_control', array(
		'label' => __('Top Head', 'ltheme'),
		'description' => __('Background Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_top_header_bg_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_btn_color_control', array(
		'description' => __('Text Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_top_header_text_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_btn_hover_color_control', array(
		'description' => __('Link color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_top_header_link_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_bg_color_control', array(
		'description' => __('Link hover color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_top_header_link_hover_color',
	) ) );


	// Header Bar Control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_header_color_control', array(
		'label' => __('Header Bar', 'ltheme'),
		'description' => __( 'Background Color', 'ltheme' ),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_header_bar_bg_color',
	) ) );


	// Menu Control

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_menu_color_control', array(
		'label' => __('Menu Custom', 'ltheme'),
		'description' => __('Text color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_text_menu_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_header_bg_color_control', array(
		'description' => __( 'Link color', 'ltheme' ),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_link_menu_color',	
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_menu_hover_color_control', array(
		'description' => __('Selected/hover link color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_link_menu_hover_color',
	) ) );


	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_menu_item_color_control', array(
		'label' => __('Sub Menu Custom', 'ltheme'),
		'description' => __('Text color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_link_menu_item_color',
	) ) );

	// Footer Control

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_footer_color_control', array(
		'label' => __('Footer Custom', 'ltheme'),
		'description' => __('Text Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_footer_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_footer_link_color_control', array(
		'description' => __('Link Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_footer_link_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_footer_link_hover_color_control', array(
		'description' => __('Link Hover Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_footer_link_hover_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_footer_bg_color_control', array(
		'description' => __('Background Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_footer_bg_color',
	) ) );


	// copyright Control

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_copyright_color_control', array(
		'label' => __('Copyright Custom', 'ltheme'),
		'description' => __('Text Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_copyright_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_copyright_link_color_control', array(
		'description' => __('Link Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_copyright_link_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_copyright_link_hover_color_control', array(
		'description' => __('Link Hover Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_copyright_link_hover_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_copyright_bg_color_control', array(
		'description' => __('Background Color', 'ltheme'),
		'section' => 'lt_custom_colors',
		'settings' => 'lt_copyright_bg_color',
	) ) );
	
	// background body Control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lt_bg_color_control', array(
		'description' => __('Background Color', 'ltheme'),
		'section' => 'lt_background_colors',
		'settings' => 'lt_bg_color',
	) ) );


}

add_action('customize_register', 'ltheme_customize_register');


// Output Customize CSS
function ltheme_customize_css() { ?>

	<style type="text/css">
		
		body {
			background-color: <?php echo get_theme_mod('lt_bg_color'); ?>;
		}

		.top-head {
			background-color: <?php echo get_theme_mod('lt_top_header_bg_color'); ?>;
		}
		.top-head,
		.top-head ul li,
		.top-head ul li i,
		.top-head p,
		.top-head .textwidget {
			color: <?php echo get_theme_mod('lt_top_header_text_color'); ?>;
		}
		.top-head a {
			color: <?php echo get_theme_mod('lt_top_header_link_color'); ?>;
		}

		.top-head a:hover {
			color: <?php echo get_theme_mod('lt_top_header_link_hover_color'); ?>;
		}


		header.site-header {
			background-color: <?php echo get_theme_mod('lt_header_bar_bg_color'); ?>;
		}

		.main-navigation .primary-menu {
			color: <?php echo get_theme_mod('lt_text_menu_color'); ?>;
		}

		.main-navigation .primary-menu > li > a {
			color: <?php echo get_theme_mod('lt_link_menu_color'); ?>;
		}
		
		.main-navigation .primary-menu li li a {
			color: <?php echo get_theme_mod('lt_link_menu_item_color'); ?>;
		}


		body .main-navigation li:hover > a, 
		body .main-navigation li.focus > a, 
		body .main-navigation li.current-menu-item > a, 
		body .main-navigation li.current-menu-parent > a {
			color: <?php echo get_theme_mod('lt_link_menu_hover_color'); ?>;
		}

		.main-footer,
		.main-footer h2,
		.main-footer p,
		.main-footer .textwidget,
		.main-footer ul li {
			color: <?php echo get_theme_mod('lt_footer_color'); ?>;
		}
		.main-footer a {
			color: <?php echo get_theme_mod('lt_footer_link_color'); ?>;
		}

		.main-footer a:hover {
			color: <?php echo get_theme_mod('lt_footer_link_hover_color'); ?>;
		}

		.main-footer {
			background-color: <?php echo get_theme_mod('lt_footer_bg_color'); ?>;
		}


		.site-footer,
		.site-footer p {
			color: <?php echo get_theme_mod('lt_copyright_color'); ?>;
		}
		.site-footer a {
			color: <?php echo get_theme_mod('lt_copyright_link_color'); ?>;
		}

		.site-footer a:hover {
			color: <?php echo get_theme_mod('lt_copyright_link_hover_color'); ?>;
		}

		.site-footer {
			background-color: <?php echo get_theme_mod('lt_copyright_bg_color'); ?>;
		}

	</style>

<?php }


add_action('wp_head', 'ltheme_customize_css');


// Custom Background Color
$args = array(
	'default-color' => '000000',
	'default-image' => '%1$s/images/background.jpg',
);
add_theme_support( 'custom-background', $args );


// Custom Site Title

add_theme_support('custom-logo');

function yourPrefix_custom_logo_setup()
{
    $defaults = array(
        'height' => 207,
        'width' => 276,
        'flex-height' => false,
        'flex-width' => false,
        'header-text' => array('site-title', 'yourPrefix-site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'yourPrefix_custom_logo_setup');


// Slogan

function showtitle_slogan() {
$showttlslogan = get_theme_mod('display_site_title');
    if ($showttlslogan == true) {
        ?>  
        <style type="text/css">
        .site-title { display:none;}
        </style>
    <?php
    }
}
add_action('wp_head', 'showtitle_slogan');



function my_customize_register() {     
  global $wp_customize;
  $wp_customize->remove_section( 'colors' );  //Modify this line as needed  
}

add_action( 'customize_register', 'my_customize_register', 11 );


// Section Access Pro

add_action( 'customize_register', 'gltheme_theme_customizer' );

function gltheme_theme_customizer( $wp_customize ) {

	class gltheme_Customize_Heading_Control extends WP_Customize_Control {

		public $type  = 'heading_1';

		public function render_content() {

			if ( ! empty( $this->label ) ) {
				if ( $this->type == 'heading_1' ) {

					echo '<h3 class="gltheme-heading-1-' . esc_attr( $this->color ) . '">' . esc_html( $this->label ) . '<h3>';

				} elseif ( $this->type == 'heading_2' ) { ?>

					<h3 class="gltheme-heading-2">
						<?php echo esc_html( $this->label ); ?>
					</h3>
				<?php
				}
			}

			if ( ! empty( $this->description ) ) {
				?>
				<p class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></p>
				<?php
			}

		} // render_content.

	} // Class gltheme_Customize_Heading_Control.

	class gltheme_Text_Control extends WP_Customize_Control {

		public $control_text = '';

		public function render_content() {

			if ( ! empty( $this->label ) ) {
				?>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<?php
			}

			if ( ! empty( $this->description ) ) {
				?>
				<span class="customize-control-description">
					<?php echo wp_kses_post( $this->description ); ?>
				</span>
				<?php
			}

			if ( ! empty( $this->control_text ) ) {
				?>
				<span class="gltheme-text-control-content">
					<?php echo wp_kses_post( $this->control_text ); ?>
				</span>
				<?php
			}

		}

	}

}