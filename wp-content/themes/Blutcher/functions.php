<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
if (!session_id()) {
	session_start();
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('twentyseventeen');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	add_image_size('twentyseventeen-featured-image', 2000, 1200, true);

	add_image_size('twentyseventeen-thumbnail-avatar', 100, 100, true);

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top' => __('Top Menu', 'twentyseventeen'),
			'social' => __('Social Links Menu', 'twentyseventeen'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
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
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width' => 250,
			'height' => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	 */
	add_editor_style(array('assets/css/editor-style.css', twentyseventeen_fonts_url()));

	// Load regular editor styles into the new block-based editor.
	add_theme_support('editor-styles');

	// Load default block styles.
	add_theme_support('wp-block-styles');

	// Add support for responsive embeds.
	add_theme_support('responsive-embeds');

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x('Espresso', 'Theme starter content', 'twentyseventeen'),
				'file' => 'assets/images/espresso.jpg',
				// URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x('Sandwich', 'Theme starter content', 'twentyseventeen'),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x('Coffee', 'Theme starter content', 'twentyseventeen'),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __('Top Menu', 'twentyseventeen'),
				'items' => array(
					'link_home',
					// Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __('Social Links Menu', 'twentyseventeen'),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters('twentyseventeen_starter_content', $starter_content);

	add_theme_support('starter-content', $starter_content);
}
add_action('after_setup_theme', 'twentyseventeen_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width()
{

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod('page_layout');

	// Check if layout is one column.
	if ('one-column' === $page_layout) {
		if (twentyseventeen_is_frontpage()) {
			$content_width = 644;
		} elseif (is_page()) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if (is_single() && !is_active_sidebar('sidebar-1')) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters('twentyseventeen_content_width', $content_width);
}
add_action('template_redirect', 'twentyseventeen_content_width', 0);

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url()
{
	$fonts_url = '';

	/*
	 * translators: If there are characters in your language that are not supported
	 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
	 */
	$libre_franklin = _x('on', 'Libre Franklin font: on or off', 'twentyseventeen');

	if ('off' !== $libre_franklin) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode(implode('|', $font_families)),
			'subset' => urlencode('latin,latin-ext'),
			'display' => urlencode('fallback'),
		);

		$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
	}

	return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints($urls, $relation_type)
{
	if (wp_style_is('twentyseventeen-fonts', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter('wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init()
{
	register_sidebar(
		array(
			'name' => __('Blog Sidebar', 'twentyseventeen'),
			'id' => 'sidebar-1',
			'description' => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name' => __('Footer 1', 'twentyseventeen'),
			'id' => 'sidebar-2',
			'description' => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name' => __('Footer 2', 'twentyseventeen'),
			'id' => 'sidebar-3',
			'description' => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'twentyseventeen_widgets_init');

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more($link)
{
	if (is_admin()) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url(get_permalink(get_the_ID())),
		/* translators: %s: Post title. */
		sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'), get_the_title(get_the_ID()))
	);
	return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'twentyseventeen_excerpt_more');

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection()
{
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'twentyseventeen_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'twentyseventeen_pingback_header');

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap()
{
	if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
		return;
	}

	require_once get_parent_theme_file_path('/inc/color-patterns.php');
	$hue = absint(get_theme_mod('colorscheme_hue', 250));

	$customize_preview_data_hue = '';
	if (is_customize_preview()) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
<?php echo twentyseventeen_custom_colors_css();
?>
</style>
<?php
}
add_action('wp_head', 'twentyseventeen_colors_css_wrap');

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts()
{
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);

	// Theme stylesheet.
	wp_enqueue_style('twentyseventeen-style', get_stylesheet_uri(), array(), '20190507');

	// Theme block stylesheet.
	wp_enqueue_style('twentyseventeen-block-style', get_theme_file_uri('/assets/css/blocks.css'), array('twentyseventeen-style'), '20190105');

	// Load the dark colorscheme.
	if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
		wp_enqueue_style('twentyseventeen-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array('twentyseventeen-style'), '20190408');
	}

	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-mouse	');

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if (is_customize_preview()) {
		wp_enqueue_style('twentyseventeen-ie9', get_theme_file_uri('/assets/css/ie9.css'), array('twentyseventeen-style'), '20161202');
		wp_style_add_data('twentyseventeen-ie9', 'conditional', 'IE 9');
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style('twentyseventeen-ie8', get_theme_file_uri('/assets/css/ie8.css'), array('twentyseventeen-style'), '20161202');
	wp_style_add_data('twentyseventeen-ie8', 'conditional', 'lt IE 9');

	// Load the html5 shiv.
	wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '20161020');
	wp_script_add_data('html5', 'conditional', 'lt IE 9');

	wp_enqueue_script('twentyseventeen-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '20161114', true);

	$twentyseventeen_l10n = array(
		'quote' => twentyseventeen_get_svg(array('icon' => 'quote-right')),
	);

	if (has_nav_menu('top')) {
		wp_enqueue_script('twentyseventeen-navigation', get_theme_file_uri('/assets/js/navigation.js'), array('jquery'), '20161203', true);
		$twentyseventeen_l10n['expand'] = __('Expand child menu', 'twentyseventeen');
		$twentyseventeen_l10n['collapse'] = __('Collapse child menu', 'twentyseventeen');
		$twentyseventeen_l10n['icon'] = twentyseventeen_get_svg(
			array(
				'icon' => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_enqueue_script('twentyseventeen-global', get_theme_file_uri('/assets/js/global.js'), array('jquery'), '20190121', true);

	wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array('jquery'), '2.1.2', true);

	wp_localize_script('twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script('select2js', get_theme_file_uri('/assets/js/select2.min.js'), array('jquery'), '20220321', true);
	wp_enqueue_style('selecct2css', get_theme_file_uri('/assets/css/select2.min.css'), array(), '20220321');
}
add_action('wp_enqueue_scripts', 'twentyseventeen_scripts');

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles()
{
	// Block styles.
	wp_enqueue_style('twentyseventeen-block-editor-style', get_theme_file_uri('/assets/css/editor-blocks.css'), array(), '20190328');
	// Add custom fonts.
	wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);
}
add_action('enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles');

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr($sizes, $size)
{
	$width = $size[0];

	if (740 <= $width) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
		if (!(is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2);

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag($html, $header, $attr)
{
	if (isset($attr['sizes'])) {
		$html = str_replace($attr['sizes'], '100vw', $html);
	}
	return $html;
}
add_filter('get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
	if (is_archive() || is_search() || is_home()) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3);

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template($template)
{
	return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'twentyseventeen_front_page_template');

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args($args)
{
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	$args['format'] = 'list';

	return $args;
}
add_filter('widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args');

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function twentyseventeen_unique_id($prefix = '')
{
	static $id_counter = 0;
	if (function_exists('wp_unique_id')) {
		return wp_unique_id($prefix);
	}
	return $prefix . (string) ++$id_counter;
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path('/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');


add_filter('template_include', 'so_25789472_template_include');

function so_25789472_template_include($template)
{
	if (is_singular('product') && (has_term('combo-boxes', 'product_cat'))) {
		$template = get_stylesheet_directory() . '/woocommerce/single-product-combo.php';
	}
	if (is_singular('product') && (has_term('raw-meals', 'product_cat'))) {
		$template = get_stylesheet_directory() . '/woocommerce/single-product-rawmeals.php';
	}
	if (is_singular('product') && (has_term('treats', 'product_cat'))) {
		$template = get_stylesheet_directory() . '/woocommerce/single-product-treats.php';
	}
	if (is_singular('product') && (has_term('apothecary', 'product_cat'))) {
		$template = get_stylesheet_directory() . '/woocommerce/single-product-apothecary.php';
	}
	if (is_singular('product') && (has_term('sealed', 'product_cat'))) {
		$template = get_stylesheet_directory() . '/woocommerce/single-product-sealed.php';
	}
	if (is_singular('product') && (has_term('gifts', 'product_cat'))) {
		$template = get_stylesheet_directory() . '/woocommerce/single-product-gifts.php';
	}
	return $template;
}


if (!function_exists('show_specific_product_quantity')) {

	function show_specific_product_quantity($atts)
	{

		// Shortcode Attributes
		$atts = shortcode_atts(
			array(
				'id' => '',
				// Product ID argument
			),
			$atts,
			'product_qty'
		);

		if (empty($atts['id']))
			return;

		$stock_quantity = 0;

		$product_obj = wc_get_product(intval($atts['id']));
		$stock_quantity = $product_obj->get_stock_quantity();

		if ($stock_quantity > 0)
			return $stock_quantity;

	}

	add_shortcode('product_qty', 'show_specific_product_quantity');

}

/*
 * Product subscriptions
 */

function get_company_name($echo = false)
{

	if (function_exists('get_field'))
		$output = get_field('company', 'option');

	if (empty($output))
		$output = get_bloginfo('name');

	if ($echo)
		echo $output;
	else
		return $output;
}


function get_help_icon($content, $type = 'text', $echo = false)
{

	if ($type == 'image') {

		$class = 'covering-image';
		$content = "<img src='$content' alt='' />";

	} else
		$class = 'with-paddings';

	$output = "<span class='help-icon'>\n" .
		"<span class='help-icon-inner fa fa-question-circle'></span>\n" .
		($content ? "<span class='help-icon-hover $class'><span class='help-icon-hover-inner'>$content</span></span>\n" : "") .
		"</span>\n";

	if ($echo)
		echo $output;
	else
		return $output;
}

/*
 * Product subscriptions: Cart
 */

// Remove filters added by "WC Subscriptions" and "WC All Products For Subscriptions"
remove_filter('woocommerce_cart_item_price', array('WCS_ATT_Display_Cart', 'show_cart_item_subscription_options'), 1000, 3);
remove_filter('woocommerce_cart_item_subtotal', array('WC_Subscriptions_Switcher', 'add_cart_item_switch_direction'), 10, 3);

/* price moving*/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price ', 19);



// Minimum CSS to remove +/- default buttons on input field type number
add_action('wp_head', 'custom_quantity_fields_css');
function custom_quantity_fields_css()
{
	?>
<style>
.quantity input::-webkit-outer-spin-button,
.quantity input::-webkit-inner-spin-button {
    display: none;
    margin: 0;
}

.quantity input.qty {
    appearance: textfield;
    -webkit-appearance: none;
    -moz-appearance: textfield;
}
</style>
<?php
}


add_action('wp_footer', 'custom_quantity_fields_script');
function custom_quantity_fields_script()
{
	?>
<script type='text/javascript'>
jQuery(function($) {
    if (!String.prototype.getDecimals) {
        String.prototype.getDecimals = function() {
            var num = this,
                match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            if (!match) {
                return 0;
            }
            return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        }
    }
    // Quantity "plus" and "minus" buttons
    $(document.body).on('click', '.plus, .minus', function() {
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {
            if (max && (currentVal >= max)) {
                $qty.val(max);
            } else {
                $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
            }
        } else {
            if (min && (currentVal <= min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
            }
        }

        // Trigger change event
        $qty.trigger('change');
    });
});
</script>
<?php
}



// // insert the custom endpoints into the My Account menu
// add_filter( 'woocommerce_account_menu_items', 'tm_add_custom_endpoints' );
// function tm_add_custom_endpoints( $items ) {
//   $items['my-dogs'] = 'My Dogs';
//   return $items;
// } // end function    


function wpb_woo_my_account_order()
{
	$myorder = array(
		'dashboard' => __('Dashboard', 'woocommerce'),
		'orders' => __('My Orders', 'woocommerce'),
		'subscriptions' => __('My Subscriptions', 'woocommerce'),
		'edit-address' => __('My Addresses', 'woocommerce'),
		'payment-methods' => __('Payment Methods', 'woocommerce'),
		'edit-account' => __('My Details', 'woocommerce'),
		'my-dogs' => __('My Dogs', 'woocommerce'),
		'referral-link' => __('Refer a Friend', 'woocommerce'),
		'points-and-rewards' => __('My Credits', 'woocommerce'),
		'customer-logout' => __('Logout', 'woocommerce'),
		//'downloads'          => __( 'Download MP4s', 'woocommerce' ),
	);

	return $myorder;
}
add_filter('woocommerce_account_menu_items', 'wpb_woo_my_account_order');

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');
function woocommerce_custom_single_add_to_cart_text()
{
	global $product;
	if (has_term('combo-boxes', 'product_cat', $product->ID)) {
		return __('Add item', 'woocommerce');
	} else {
		return __('Add item', 'woocommerce');
	}
}

add_filter('woocommerce_get_order_item_totals', 'reordering_order_item_totals', 10, 3);
function reordering_order_item_totals($total_rows, $order, $tax_display)
{
	// 1. saving the values of items totals to be reordered
	$payment = $total_rows['payment_method'];
	$order_total = $total_rows['order_total'];

	// 2. remove items totals to be reordered
	unset($total_rows['payment_method']);
	unset($total_rows['order_total']);

	// 3 Reinsert removed items totals in the right order
	$total_rows['order_total'] = $order_total;
	$total_rows['payment_method'] = $payment;


	return $total_rows;
}

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available($rates)
{
	$free = array();

	foreach ($rates as $rate_id => $rate) {
		if ('free_shipping' === $rate->method_id) {
			$free[$rate_id] = $rate;
			break;
		}
	}

	return !empty($free) ? $free : $rates;
}

add_filter('woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100);


add_filter('woocommerce_shipping_package_name', 'woocommerce_replace_text_shipping_to_delivery', 10, 3);



add_action('wpo_wcpdf_before_html', function () {
	add_filter('woocommerce_de_add_delivery_time_to_product_title', 'remove_delivery_time_in_invoice_pdfs', 10, 3);
});

add_action('wpo_wcpdf_after_html', function () {
	remove_filter('woocommerce_de_add_delivery_time_to_product_title', 'remove_delivery_time_in_invoice_pdfs', 10, 3);
});

function remove_delivery_time_in_invoice_pdfs($return, $item_name, $item)
{
	return $item_name;
}
// add_filter('gettext', 'translate_reply');
// add_filter('ngettext', 'translate_reply');

// function translate_reply($translated) {
// $translated = str_ireplace('Shipping via Flat Rate', 'Shipping', $translated);
// return $translated;
// }

function add_checkout_script()
{ ?>

<script type="text/javascript">
jQuery(document).ajaxComplete(function() {
    jQuery('.shipping >th').html('Shipping');
    jQuery(".cfw-module .order-total th").html("Pay now");

    if (jQuery('.cfw-module table > tbody .one-off').length === 0) {
        jQuery('<tr class="one-off"><th colspan="2">One-off totals</th></tr>').insertBefore(
            '.cfw-module table > tbody > tr:first');
    }

    jQuery('.order-total.recurring-total th:first-child').html('Subscription total');
    jQuery('.cfw-module table tbody tr:nth-child(5) th').html("Subscription totals");

    jQuery('.order-total.recurring-total td .first-payment-date small').each(function() {
        var text = jQuery(this).text();
        jQuery(this).text(text.replace('First renewal', 'Next delivery'));
    });

});
</script>
<style type="text/css">
#cfw-totals-list tr.shipping.recurring-total td {
    text-align: right !important;
}
</style>

<?php
}
add_action('woocommerce_after_checkout_form', 'add_checkout_script');


add_filter('wpo_wcpdf_order_date', 'wpo_wcpdf_order_date_format', 10, 3);
function wpo_wcpdf_order_date_format($order_date, $order_date_mysql, $document)
{
	return date_i18n('d/m/Y, H:i:s', strtotime($order_date_mysql));
}

remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
add_action('woocommerce_before_add_to_cart_button', 'woocommerce_single_variation', 5);


// add_action( 'woocommerce_before_add_to_cart_quantity', 'wp_echo_qty_front_add_cart' );

function wp_echo_qty_front_add_cart()
{
	echo '<div class="qtylabel">Quantity </div>';
}

add_filter('wf_pklist_alter_pdf_file_name', 'wf_pklist_invoice_numebr_as_pdf_filename', 10, 3);
function wf_pklist_invoice_numebr_as_pdf_filename($name, $template_type, $order_ids)
{
	if ($template_type == 'invoice' && class_exists('Wf_Woocommerce_Packing_List_Public')) {
		if (Wf_Woocommerce_Packing_List_Public::module_exists('invoice')) {
			$name_arr = array();
			foreach ($order_ids as $order_id) {
				$order = (WC()->version < '2.7.0') ? new WC_Order($order_id) : new wf_order($order_id);
				$name_arr[] = Wf_Woocommerce_Packing_List_Invoice::generate_invoice_number($order, false); //do not force generate
			}
			$name = implode('-', $name_arr);
		}
	}
	return 'Invoice - ' . $name;
}

/*add_filter('wf_pklist_alter_pdf_file_name','wf_pklist_alter_pdf_file_name',10,3);
function wf_pklist_alter_pdf_file_name($name, $template_type, $order_ids)
{
	if($template_type=='packinglist')
	{
	
			$name='Packing Slip ';
	}
	return $name;
}*/


add_filter('wf_pklist_alter_pdf_file_name', 'wf_pklist_alter_pdf_file_name', 10, 3);
function wf_pklist_alter_pdf_file_name($name, $template_type, $order_ids)
{
	if ($template_type == 'packinglist' && class_exists('Wf_Woocommerce_Packing_List_Public')) {
		$name_arr = array();
		foreach ($order_ids as $order_id) {
			$order = (WC()->version < '2.7.0') ? new WC_Order($order_id) : new wf_order($order_id);
			$name_arr[] = Wf_Woocommerce_Packing_List_Invoice::generate_invoice_number($order, true);
		}
		if (count($order_ids) > 1) {
			$name = 'Packing_Slip _bulk_' . implode('-', $name_arr);
		} else {
			$name = 'Packing Slip ' . $name_arr[0];
		}
	}
	return $name;
}


function eg_remove_my_subscriptions_button($actions, $subscription)
{

	foreach ($actions as $action_key => $action) {
		switch ($action_key) {
			case 'change_payment_method': // Hide "Change Payment Method" button?
			case 'change_address': // Hide "Change Address" button?
			case 'switch': // Hide "Switch Subscription" button?
//			case 'resubscribe':		// Hide "Resubscribe" button from an expired or cancelled subscription?
//			case 'pay':			// Hide "Pay" button on subscriptions that are "on-hold" as they require payment?
//			case 'reactivate':		// Hide "Reactive" button on subscriptions that are "on-hold"?
//			case 'cancel':			// Hide "Cancel" button on subscriptions that are "active" or "on-hold"?
				unset($actions[$action_key]);
				break;
			default:
				error_log('-- $action = ' . print_r($action, true));
				break;
		}
	}

	return $actions;
}
add_filter('wcs_view_subscription_actions', 'eg_remove_my_subscriptions_button', 100, 2);

add_action('woocommerce_after_my_account', 'handsomebeardedguy_after_my_account');
add_action('woocommerce_subscription_details_after_subscription_table', 'handsomebeardedguy_after_my_account');

function handsomebeardedguy_after_my_account()
{
	echo '<script>
	jQuery(document).ready(function($) {
	$("td.subscription-actions a.cancel, table.shop_table.subscription_details a.cancel").on("click", function(e) {
		var confirmCancel = confirm("Please confirm that you would like to Cancel your subscription.")
		if (!confirmCancel) {
			e.preventDefault()
		}
	})

	$("td.subscription-actions a.suspend, table.shop_table.subscription_details a.suspend").on("click", function(e) {
		var confirmsuspend = confirm("Please confirm that you would like to Pause your subscription.")
		if (!confirmsuspend) {
			e.preventDefault()
		}
	})

	$("td.subscription-actions a.reactivate, table.shop_table.subscription_details a.reactivate").on("click", function(e) {
		var confirmsuspend = confirm("Please confirm that you would like to Reactivate your subscription.")
		if (!confirmsuspend) {
			e.preventDefault()
		}
	})

	$("td.subscription-actions a.skip_next, table.shop_table.subscription_details a.skip_next").on("click", function(e) {
		var confirmsuspend = confirm("Are you sure that you would like to skip your next delivery?")
		if (!confirmsuspend) {
			e.preventDefault()
		}
		else{
			alert("Thank you. Your next delivery will be skipped.");
		}
	})

	$("td.subscription-actions a.ship_now_keep_date, table.shop_table.subscription_details a.ship_now_keep_date").on("click", function(e) {
		var confirmsuspend = confirm("Are you ready for your delivery now? Please note: Your next delivery is kept at the original renewal date set. Be mindful if it is too soon.")
		if (!confirmsuspend) {
			e.preventDefault()
		}
		else{
			alert("Please note: Your next delivery is kept at the original renewal date set. Be mindful if it is too soon.");
		}
	})

	$("td.subscription-actions a.ship_now_recalculate, table.shop_table.subscription_details a.ship_now_recalculate").on("click", function(e) {
		var confirmsuspend = confirm("Are you ready for your delivery now? Please note: Your following delivery will be set at the same frequency from today.")
		if (!confirmsuspend) {
			e.preventDefault()
		}
		else{
			alert("Please note: Your following delivery will be set at the same frequency from today.");
		}
	})
})
</script>';
}

/*add_filter( 'woocommerce_loop_add_to_cart_link', 'custom_add_to_cart_button', 10, 2 );
function custom_add_to_cart_button($button,$product) {
	// Do not change the button for variable products
	if( $product->is_type('simple') ) return $button;

  // Get product ID, sku & add to cart url
		$product_id = $product->get_id();
		$product_sku = $product->get_sku();
		$product_url = $product->add_to_cart_url();

		// Quantity & text
		$quantity = isset( $args['quantity'] ) ? $args['quantity'] : 1;
		$text = $product->add_to_cart_text();
	// replace the button to be a link to the product detail page
	return '<a rel="nofollow" href="' . $product_url . '" data-quantity="' . $quantity . '" data-product_id="' . $product_id . '" data-product_sku="' . $product_sku . '" class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart" aria-label="Add to cart"><em>' . $text . '</em></a>
	';
}*/

add_filter('woocommerce_product_add_to_cart_text', 'bbloomer_change_select_options_button_text', 9999, 2);

function bbloomer_change_select_options_button_text($label, $product)
{
	if ($product->is_type('simple')) {
		return 'Add Item';
	}
	return $label;
}

function filter_woocommerce_loop_add_to_cart_link($args, $product)
{
	// Shop page & product type = simple
	if ($product->product_type === 'simple') {
		// Get product ID, sku & add to cart url
		$product_id = $product->get_id();
		$product_sku = $product->get_sku();
		$product_url = $product->add_to_cart_url();

		// Quantity & text
		$quantity = isset($args['quantity']) ? $args['quantity'] : 1;
		$text = $product->add_to_cart_text();

		$args = '<a id="cart_product_' . $product_id . '" rel="nofollow" href="' . $product_url . '" data-quantity="' . $quantity . '" data-product_id="' . $product_id . '" data-product_sku="' . $product_sku . '" class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart" aria-label="Add to cart"><em>' . $text . '</em></a>';
	}

	return $args;
}
add_filter('woocommerce_loop_add_to_cart_link', 'filter_woocommerce_loop_add_to_cart_link', 10, 2);

add_action('woocommerce_after_shop_loop_item', 'my_custom_quantity_field', 6);

function my_custom_quantity_field()
{
	global $product;

	if (!$product->is_sold_individually())
		woocommerce_quantity_input(
			array(
				'min_value' => apply_filters('woocommerce_quantity_input_min', 1, $product),
				'max_value' => apply_filters('woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product)
			)
		);
}

/*add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_display_sold_out_loop_woocommerce' );
 
function bbloomer_display_sold_out_loop_woocommerce() {
	global $product;
	if ( ! $product->is_in_stock() ) {
		echo '<span class="soldout">Out of Stock</span>';
		 
	}
}
*/
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 10);
function woocommerce_template_loop_stock()
{
	global $product;
	if (!$product->managing_stock() && !$product->is_in_stock())
		echo '<p class="stock out-of-stock">Out of Stock</p>';
}

add_filter('woocommerce_quantity_input_args', 'hide_quantity_input_field', 20, 2);
function hide_quantity_input_field($args, $product)
{
	// Here set your product categories in the array (can be either an ID, a slug, a name or an array)
	$categories = array('t-shirts', 'shoes');

	// Handling product variation
	$the_id = $product->is_type('variation') ? $product->get_parent_id() : $product->get_id();

	// Only on cart page for a specific product category
	if (!$product->get_stock_quantity() > 0) {
		$input_value = $args['input_value'];
		$args['min_value'] = $args['max_value'] = $input_value;
	}
	return $args;
}

/**
 * Post code popup responsible on the shop page and checkout
 */
require get_parent_theme_file_path('/inc/post-code-popup.php');
require get_parent_theme_file_path('/inc/subscribe-and-save.php');


add_filter('woocommerce_product_add_to_cart_text', 'product_cat_add_to_cart_button_text', 9999, 9999);
function product_cat_add_to_cart_button_text($text)
{

	// Only for a specific product category archive pages
	if (is_product_category(array('apothecary', 'gifts'))) {
		$text = __('Add to Box', 'woocommerce');
	}

	return $text;
}


class iWC_Orderby_Stock_Status
{
	public function __construct()
	{
		// Check if WooCommerce is active
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			add_filter('posts_clauses', array($this, 'order_by_stock_status'), 9999);
		}
	}
	public function order_by_stock_status($posts_clauses)
	{
		global $wpdb;
		// only change query on WooCommerce loops
		if (is_tax('product_brand') || is_woocommerce() && (is_shop() || is_product_category() || is_product_tag())) {
			$posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
			$posts_clauses['orderby'] = " istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
			$posts_clauses['where'] = " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
			// var_dump($posts_clauses); exit;
		}
		return $posts_clauses;
	}
}
new iWC_Orderby_Stock_Status;
/**
 * END - Order product collections by stock status, instock products first.
 */


// add_filter('woof_get_request_data', 'tbd_woof_get_meta_query', 999, 1 );
function tbd_woof_get_meta_query($meta_query)
{
	add_filter('is_woocommerce', '__return_true');
	$meta_query;
}
add_filter('posts_clauses', 'tbd_order_by_stock_status', 9999);
function tbd_order_by_stock_status($posts_clauses)
{
	global $wpdb;
	global $is_oos_last;

	if ($is_oos_last == 1 || $_GET['is_oos_last'] == 1 || is_woocommerce() && (is_shop() || is_product_category() || is_product_tag())) {
		$posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
		$posts_clauses['join'] .= " INNER JOIN {$wpdb->prefix}term_relationships term_rel ON {$wpdb->posts}.ID = term_rel.object_id INNER JOIN {$wpdb->prefix}termmeta termmeta1 ON termmeta1.term_id=term_rel.term_taxonomy_id ";
		$posts_clauses['orderby'] = " termmeta1.meta_value ASC, istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
		$posts_clauses['where'] = " AND term_rel.term_taxonomy_id IN (SELECT term_id FROM {$wpdb->prefix}term_taxonomy WHERE taxonomy='product_cat') AND termmeta1.meta_key = 'custom_order' AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
	}
	return $posts_clauses;
}
add_filter('woof_draw_products_get_args', 'tbd_woof_draw_products_get_args', 9999);
function tbd_woof_draw_products_get_args($args)
{
	$args['is_oos_last'] = 1;
	return $args;
}
// function woocommerce_template_loop_product_link_open() {
// 	global $product;

// 	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

// 	echo '<a class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
// }

if (!function_exists('wc_yotpo_show_buttomline_blaze')) {
	function wc_yotpo_show_buttomline_blaze($currentProduct = false)
	{
		try {
			if (!$currentProduct) {
				global $product;
				$currentProduct = $product;
			}
			global $product;
			$show_bottom_line = is_product() ? $currentProduct->get_reviews_allowed() == true : true;
			if ($show_bottom_line && !is_archive() && $currentProduct || $product) {
				$product_data = wc_yotpo_get_product_data($currentProduct);
				$yotpo_div = "
				<script>jQuery(document).ready(function() {
							jQuery('div.bottomLine').click(function() {
								if (jQuery('div#collapse_reviews_heading button').length) { 
									jQuery('div#collapse_reviews_heading button').click(); 
									document.getElementById('collapse_reviews_heading').scrollIntoView({ behavior: 'smooth', block: 'center' });
								}
							})
						})
				</script>
				<div class='yotpo bottomLine' 
							   data-product-id='" . $product_data['id'] . "'
							   data-url='" . $product_data['url'] . "' 
							   data-lang='" . $product_data['lang'] . "'></div>";
				echo $yotpo_div;
			}

		} catch (exception $e) {
		}
	}

}

//Custom Bulk action

add_filter('woocommerce_register_shop_order_post_statuses', 'blaze_register_custom_order_status');

function blaze_register_custom_order_status($order_statuses)
{

	// Add new Status must start with "wc-"
	$order_statuses['wc-packed-status'] = array(
		'label' => _x('Packed', 'Order status', 'woocommerce'),
		'public' => false,
		'exclude_from_search' => false,
		'show_in_admin_all_list' => true,
		'show_in_admin_status_list' => true,
		'label_count' => _n_noop('Packed <span class="count">(%s)</span>', 'Packed <span class="count">(%s)</span>', 'woocommerce'),
	);
	$order_statuses['wc-despatched-status'] = array(
		'label' => _x('Despatched', 'Order status', 'woocommerce'),
		'public' => false,
		'exclude_from_search' => false,
		'show_in_admin_all_list' => true,
		'show_in_admin_status_list' => true,
		'label_count' => _n_noop('Despatched <span class="count">(%s)</span>', 'Despatched <span class="count">(%s)</span>', 'woocommerce'),
	);
	return $order_statuses;
}
// ---------------------
// 2. Show Order Status in the Dropdown @ Single Order and "Bulk Actions" @ Orders

add_filter('wc_order_statuses', 'blaze_show_custom_order_status');

function blaze_show_custom_order_status($order_statuses)
{
	$order_statuses['wc-packed-status'] = _x('Packed', 'Order status', 'woocommerce');
	$order_statuses['wc-despatched-status'] = _x('Despatched', 'Order status', 'woocommerce');
	return $order_statuses;
}

add_filter('bulk_actions-edit-shop_order', 'blaze_get_custom_order_status_bulk');

function blaze_get_custom_order_status_bulk($bulk_actions)
{
	// Note: "mark_" must be there instead of "wc"
	$bulk_actions['mark_packed-status'] = 'Change status to Packed';
	$bulk_actions['mark_despatched-status'] = 'Change status to Despatched';
	return $bulk_actions;
}

add_action('woocommerce_after_shop_loop_item', 'wc_add_short_description', 99999);
/**
 * WooCommerce, Add Short Description to Products on Shop Page
 *
 * @link https://wpbeaches.com/woocommerce-add-short-or-long-description-to-products-on-shop-page
 */

//wrapping the product image on the div
add_action('woocommerce_before_shop_loop_item', function () {
	echo '<div class="product-thum" id="product_img">';
}, 99999);
add_action('woocommerce_before_shop_loop_item_title', function () {
	echo '</div>';
}, 99999);

//adding secondary image on the product image shop
function replacing_template_loop_product_thumbnail()
{
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 99999);
}
function wc_template_loop_product_replaced_thumb()
{
	global $product;

	$shop_image = get_field('bag_image', $product->get_id());

	if (!$shop_image) {
		return;
	}

	echo '<div class="hover-image_prod" id="hover_images"><div class="img-overlay"></div>';

	// If $shop_image is an integer, we'll assume it's an image ID
	if (is_numeric($shop_image)) {
		echo wp_get_attachment_image($shop_image, 'woocommerce_thumbnail');
	}
	// If $shop_image is a string, we'll assume it's an image URL
	else if (is_string($shop_image)) {
		echo '<img src="' . $shop_image . '" alt="Shop Image">';
	}

	echo '</div>';
}
add_action('woocommerce_before_shop_loop_item_title', 'wc_template_loop_product_replaced_thumb', 99999);
add_action('woocommerce_init', 'replacing_template_loop_product_thumbnail');

add_filter('woocommerce_product_add_to_cart_text', 'customizing_add_to_cart_button_text', 999999, 2);
add_filter('woocommerce_product_single_add_to_cart_text', 'customizing_add_to_cart_button_text', 99999, 2);
function customizing_add_to_cart_button_text($button_text, $product)
{
	$is_in_cart = false;

	foreach (WC()->cart->get_cart() as $cart_item)
		if ($cart_item['product_id'] == $product->get_id()) {
			$is_in_cart = true;
			break;
		}

	if ($is_in_cart)
		$button_text = __('Add more', 'woocommerce');


	return $button_text;
}


function woocommerce_custom_add_to_cart_class($html, $product, $args)
{
	// Define the classes to be added
	$class_to_append = "sticky_footer_show";

	// Check if product is in cart
	$in_cart = WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()));

	if ($in_cart != '') {
		// Append the extra class
		$args['class'] = $args['class'] . " {$class_to_append}";

		$html = sprintf(
			'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
			esc_url($product->add_to_cart_url()),
			esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
			esc_attr(isset($args['class']) ? $args['class'] : 'button'),
			isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
			esc_html($product->add_to_cart_text())
		);
	}

	// Return Add to cart button
	return $html;
}

add_filter("woocommerce_loop_add_to_cart_link", "woocommerce_custom_add_to_cart_class", 99999, 3);



add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments)
{
	ob_start();
	$items_count = WC()->cart->get_cart_contents_count();
	?>
<div id="mini-cart-count">
    <?php echo $items_count ? $items_count : '&nbsp;'; ?>
</div>
<?php
	$fragments['#mini-cart-count'] = ob_get_clean();
	return $fragments;
}


// get and display the subtotal of all ordered products
add_filter('wf_pklist_alter_subtotal', 'wt_pklist_alter_sub', 10, 3);
function wt_pklist_alter_sub($sub_total, $template_type, $order)
{

	if ($template_type == 'invoice') {

		$order_id = $order->get_id();
		// get the order object
		$order = new WC_Order($order_id);

		// get the order items
		$items = $order->get_items();

		// calculate the subtotal
		$sub_total = 0;
		foreach ($items as $item) {
			$product = $item->get_product();
			$price = $product->get_price();
			$quantity = $item->get_quantity();
			$sub_total += $price * $quantity;
		}
		// Check if $number1 has two decimal places
		if (abs($sub_total - round($sub_total, 2)) < 0.01) {
			$sub_total;
		} else {
			// Round $number1 to two decimal places
			$sub_total = number_format($sub_total, 2);
		}

	}

	return $sub_total;

}


//get and display discount total
add_filter('wf_pklist_alter_find_replace', 'wt_pklist_add_subtotal_shipping', 10, 6);
function wt_pklist_add_subtotal_shipping($find_replace, $template_type, $order)
{
	if ($template_type == 'invoice') {
		$order_id = $order->get_id();
		// get the order object
		$order = new WC_Order($order_id);

		// get the order items
		$items = $order->get_items();

		// calculate the subtotal
		$sub_total = 0;
		foreach ($items as $item) {
			$product = $item->get_product();
			$price = $product->get_price();
			$quantity = $item->get_quantity();
			$sub_total += $price * $quantity;
		}

		// Check if $number1 has two decimal places
		if (abs($sub_total - round($sub_total, 2)) < 0.01) {
			$sub_total;
		} else {
			// Round $number1 to two decimal places
			$sub_total = number_format($sub_total, 2);
		}

		$order = wc_get_order($order_id);
		$coupons = $order->get_used_coupons();

		if ($coupons) {
			foreach ($coupons as $coupon) {
				$coupon_obj = new WC_Coupon($coupon);
				$coupon_type = $coupon_obj->get_discount_type();
				$coupon_amount = $coupon_obj->get_amount();
				if ($coupon_type == 'percent') {
					$coupon_percent = $coupon_amount / 100;
					$discountTotal = $sub_total * $coupon_percent;
					$find_replace['[wk_pklist_cart_discount]'] = '-$' . number_format($discountTotal, 2); // get discount total
				} elseif ($coupon_type == 'fixed_cart') {
					// $coupon_percent = $coupon_amount / 100;
					$discountTotal = $sub_total - $coupon_amount;
					$find_replace['[wk_pklist_cart_discount]'] = '-$' . number_format($coupon_amount, 2); // get discount total
				} else {
					$find_replace['[wk_pklist_cart_discount]'] = '';
				}
			}
		} else {
			$find_replace['[wk_pklist_cart_discount]'] = '';
		}
	}
	return $find_replace;

}
//display item total price based on quantity and price
add_filter('wf_pklist_alter_item_total_formated', 'wt_pklist_item_total_formatted', 10, 6);
function wt_pklist_item_total_formatted($product_total_formated, $template_type, $product_total, $_product, $order_item, $order)
{
	if ($template_type == 'invoice') {

		$product = $order_item->get_product();
		$price = $product->get_price();
		$quantity = $order_item->get_quantity();
		$product_total_price = $price * $quantity;

		$product_total_formated = '$' . number_format($product_total_price, 2);
	}

	return $product_total_formated;
}

add_action('wp_enqueue_scripts', 'blz_tag_manager_script');
function blz_tag_manager_script()
{
	if (is_checkout()) {
		?>
<!-- Start Google Tag Manager -->
<script>
(function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'dataLayer', 'GTM-PNXWXT5');
</script>
<!-- End Google Tag Manager -->
<?php
	}
}

if (is_plugin_active('checkout-for-woocommerce/checkout-for-woocommerce.php')) {
	add_action('cfw_wp_head', 'blz_tag_manager_iframe');
}
function blz_tag_manager_iframe()
{
	?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PNXWXT5" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}