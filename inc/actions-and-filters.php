<?php

/**
 * A class of helpful theme functions
 *
 * @package DocBlock
 * @author Slushman <chris@slushman.com>
 */
class slushman_2016_Actions_and_Filters {

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->loader();

	}

	/**
	 * Loads all filter and action calls
	 */
	private function loader() {

		add_action( 'init', array( $this, 'disable_emojis' ) );
		add_action( 'after_setup_theme', array( $this, 'more_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'more_scripts_and_styles' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'login_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_and_styles' ) );
		add_filter( 'post_mime_types', array( $this, 'add_mime_types' ) );
		add_filter( 'upload_mimes', array( $this, 'custom_upload_mimes' ) );
		add_filter( 'body_class', array( $this, 'page_body_classes' ) );
		//add_action( 'wp_head', array( $this, 'background_images' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'excerpt_read_more' ) );
		add_filter( 'mce_buttons_2', array( $this, 'add_editor_buttons' ) );
		add_filter( 'wpseo_breadcrumb_single_link', array( $this, 'unlink_private_pages' ), 10, 2 );
		add_filter( 'wp_seo_get_bc_title', array( $this, 'remove_private' ) );
		add_filter( 'manage_page_posts_columns', array( $this, 'page_template_column_head' ), 10 );
		add_action( 'manage_page_posts_custom_column', array( $this, 'page_template_column_content' ), 10, 2 );
		add_filter( 'get_search_form', array( $this, 'make_search_button_a_button' ) );
		add_filter( 'style_loader_src', array( $this, 'remove_cssjs_ver' ), 10, 2 );
		add_filter( 'script_loader_src', array( $this, 'remove_cssjs_ver' ), 10, 2 );
		add_filter( 'embed_oembed_html', array( $this, 'youtube_add_id_attribute' ), 99, 4 );

	} // loader()

	/**
	 * Additional theme setup
	 */
	public function more_setup() {

		register_nav_menus( array(
			'social' => esc_html__( 'Social Links', 'slushman-2016' )
		) );

		add_theme_support( 'yoast-seo-breadcrumbs' );

	} // more_setup()

	/**
	 * Enqueues scripts and styles for the admin
	 */
	public function admin_scripts_and_styles( $hook ) {

		wp_enqueue_style( 'scriptname-admin', get_stylesheet_directory_uri() . '/admin.css' );

		// if ( 'nav-menus.php' != $hook ) { return; } // Page-specific scripts & styles after this

	} // admin_scripts_and_styles()

	/**
	 * Enqueues additional scripts and styles
	 */
	public function more_scripts_and_styles() {

		wp_enqueue_style( 'dashicons' );
		wp_enqueue_script( 'scriptname-search', get_template_directory_uri() . '/js/hidden-search.min.js', array(), '20150807', true );
		// wp_enqueue_style( 'scriptname-fonts', $this->fonts_url(), array(), null );
		wp_enqueue_style( 'gridly', 'https://cdnjs.cloudflare.com/ajax/libs/gridly/1.1.0/gridly.min.css', array(), null, true );

	} // more_scripts_and_styles()

	/**
	 * Enqueues scripts and styles for the login page
	 */
	function login_scripts() {

		wp_enqueue_style( 'scriptname-login', get_stylesheet_directory_uri() . '/login.css', 10, 2 );
		wp_enqueue_script( 'enquire', '//cdnjs.cloudflare.com/ajax/libs/enquire.js/2.1.2/enquire.min.js', array(), '20150804', true );

	} // login_scripts()




	/**
	 * Add core editor buttons that are disabled by default
	 *
	 * @param 	array 		$buttons 		The current buttons
	 *
	 * @return 	array 						The modified buttons
	 */
	function add_editor_buttons( $buttons ) {

		$buttons[] = 'superscript';
		$buttons[] = 'subscript';

		return $buttons;

	} // add_editor_buttons()

	/**
	 * Adds PDF as a filter for the Media Library
	 *
	 * @param 	array 		$post_mime_types 		The current MIME types
	 *
	 * @return 	array 								The modified MIME types
	 */
	public function add_mime_types( $post_mime_types ) {

	    $post_mime_types['application/pdf'] = array( esc_html__( 'PDFs', 'slushman-2016' ), esc_html__( 'Manage PDFs', 'slushman-2016' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
	    $post_mime_types['text/x-vcard'] 	= array( esc_html__( 'vCards', 'slushman-2016' ), esc_html__( 'Manage vCards', 'slushman-2016' ), _n_noop( 'vCard <span class="count">(%s)</span>', 'vCards <span class="count">(%s)</span>' ) );

	    return $post_mime_types;

	} // add_mime_types

	/**
	 * Creates a style tag in the header with the background image
	 *
	 * @return 		mixed 			Style tag
	 */
	public function background_images() {

		global $slushman_2016_themekit;

		$output = '';
		$image 	= $slushman_2016_themekit->get_thumbnail_url( get_the_ID(), 'full' );

		if ( ! $image ) {

			$image = get_theme_mod( 'default_bg_image' );

		}

		if ( empty( $image ) ) { return; }

		?><style>
			@media screen and (min-width:768px){
				.site-content{background-image:url(<?php echo esc_url( $image ); ?>);
			}
		</style><!-- Background Images --><?php

	} // background_images()

	/**
	 * Adds support for additional MIME types to WordPress
	 *
	 * @param 		array 		$existing_mimes 			The existing MIME types
	 *
	 * @return 		array 									The modified MIME types
	 */
	public function custom_upload_mimes( $existing_mimes = array() ) {

		// add your extension to the array
		$existing_mimes['vcf'] = 'text/x-vcard';

		return $existing_mimes;

	} // custom_upload_mimes()

	/**
	 * Removes WordPress emoji support everywhere
	 */
	function disable_emojis() {

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	} // disable_emojis()

	/**
	 * Limits excerpt length
	 *
	 * @param 	int 		$length 			The current word length of the excerpt
	 *
	 * @return 	int 							The word length of the excerpt
	 */
	public function excerpt_length( $length ) {

		if ( is_home() || is_front_page() ) {

			return 30;

		}

		return $length;

	} // excerpt_length()

	/**
	 * Customizes the "Read More" text for excerpts
	 *
	 * @global   			$post 		The post object
	 *
	 * @param 	mixed 		$more 		The current "read more"
	 *
	 * @return 	mixed 					The modifed "read more"
	 */
	public function excerpt_read_more( $more ) {

		global $post;

		$return = sprintf( '... <a class="moretag read-more" href="%s">', esc_url( get_permalink( $post->ID ) ) );
		$return .= esc_html__( 'Read more', 'slushman-2016' );
		$return .= '<span class="screen-reader-text">';
		$return .= sprintf( esc_html__( ' about %s', 'slushman-2016' ), $post->post_title );
		$return .= '</span></a>';

		return $return;

	} // excerpt_read_more()

	/**
	 * Properly encode a font URLs to enqueue a Google font
	 *
	 * @return 	mixed 		A properly formatted, translated URL for a Google font
	 */
	public function fonts_url() {

		$return 	= '';
		$families 	= '';
		$fonts[] 	= array( 'font' => 'Oxygen', 'weights' => '400,700', 'translate' => esc_html_x( 'on', 'Oxygen font: on or off', 'slushman-2016' ) );

		foreach ( $fonts as $font ) {

			if ( 'off' == $font['translate'] ) { continue; }

			$families[] = $font['font'] . ':' . $font['weights'];

		}

		if ( ! empty( $families ) ) {

			$query_args['family'] 	= urlencode( implode( '|', $families ) );
			$query_args['subset'] 	= urlencode( 'latin,latin-ext' );
			$return 				= add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		}

		return $return;

	} // fonts_url()

	/**
	 * Converts the search input button to an HTML5 button element
	 *
	 * @hook 		get_search_form
	 *
	 * @param 		mixed  		$form 			The current form HTML
	 *
	 * @return 		mixed 						The modified form HTML
	 */
	public function make_search_button_a_button( $form ) {

		$form = '<form action="' . esc_url( home_url( '/' ) ) . '" class="search-form" method="get" role="search" >
				<label class="screen-reader-text" for="site-search">' . _x( 'Search for:', 'label' ) . '</label>
				<input class="search-field" id="site-search" name="s" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" title="' . esc_attr_x( 'Search for:', 'label' ) . '" type="search" value="' . get_search_query() . '"  />
				<button type="submit" class="search-submit">
					<span class="screen-reader-text">'. esc_attr_x( 'Search', 'submit button' ) .'</span>
					<span class="dashicons dashicons-search"></span>
				</button>
			</form>';

		return $form;

	} // make_search_button_a_button()

	/**
	 * Adds classes to the body tag.
	 *
	 * @global 	$post						The $post object
	 *
	 * @param 	array 		$classes 		Classes for the body element.
	 *
	 * @return 	array 						The modified body class array
	 */
	public function page_body_classes( $classes ) {

		global $post;

		if ( empty( $post->post_content ) ) {

			$classes[] = 'content-none';

		} else {

			$classes[] = $post->post_name;

		}

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {

			$classes[] = 'group-blog';

		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {

			$classes[] = 'hfeed';

		}

		return $classes;

	} // page_body_classes()

	/**
	 * The content for each column cell
	 *
	 * @param 		string 		$column_name 		The name of the column
	 * @param 		int 		$post_ID 			The post ID
	 *
	 * @return 		mixed 							The cell content
	 */
	public function page_template_column_content( $column_name, $post_ID ) {

		if ( 'page_template' !== $column_name ) { return; }

		$slug 		= get_page_template_slug( $post_ID );
		$templates 	= get_page_templates();
		$name 		= array_search( $slug, $templates );

		if ( ! empty( $name ) ) {

			echo '<span class="name-template">' . $name . '</span>';

		} else {

			echo '<span class="name-template">' . esc_html( 'Default', 'slushman-2016' ) . '</span>';

		}

	} // page_template_column_content()

	/**
	 * Adds the page template column to the columns on the page listings
	 *
	 * @param 	array 		$defaults 			The current column names
	 *
	 * @return 	array           				The modified column names
	 */
	public function page_template_column_head( $defaults ) {

		$defaults['page_template'] = esc_html( 'Page Template', 'slushman-2016' );

	    return $defaults;

	} // page_template_column_head()

	/**
	 * Removes query strings from static resources
	 * to increase Pingdom and GTMatrix scores.
	 *
	 * Does not remove query strings from Google Font calls.
	 *
	 * @param 	string 		$src 			The resource URL
	 *
	 * @return 	string 						The modifed resource URL
	 */
	function remove_cssjs_ver( $src ) {

		if ( empty( $src ) ) { return; }
		if ( strpos( $src, 'https://fonts.googleapis.com' ) ) { return; }

		if ( strpos( $src, '?ver=' ) ) {

			$src = remove_query_arg( 'ver', $src );

		}

		return $src;

	} // remove_cssjs_ver()

	/**
	 * Removes the "Private" text from the private pages in the breadcrumbs
	 *
	 * @param 	string 		$text 			The breadcrumb text
	 *
	 * @return 	string 						The modified breadcrumb text
	 */
	public function remove_private( $text ) {

		$check = stripos( $text, 'Private: ' );

		if ( is_int( $check ) ) {

			$text = str_replace( 'Private: ', '', $text );

		}

		return $text;

	} // remove_private()

	/**
	 * Unlinks breadcrumbs that are private pages
	 *
	 * @param 	mixed 		$output 		The HTML output for the breadcrumb
	 * @param 	array 		$link 			Array of link info
	 *
	 * @return 	mixed 						The modified link output
	 */
	public function unlink_private_pages( $output, $link ) {

		if ( ! isset( $link['url'] ) || empty( $link['url'] ) ) { return $output; }

		$id 		= url_to_postid( $link['url'] );
		$options 	= WPSEO_Options::get_all();

		if ( $options['breadcrumbs-home'] !== $link['text'] && 0 === $id ) {

			$output = '<span rel="v:child" typeof="v:Breadcrumb">' . $link['text'] . '</span>';

		}

		return $output;

	} // unlink_private_pages()

	/**
	 * Adds the video ID as the ID attribute on the iframe
	 *
	 * @param 		string 		$html 			The current oembed HTML
	 * @param 		string 		$url 			The oembed URL
	 * @param 		array 		$attr 			The oembed attributes
	 * @param 		int 		$post_id 		The post ID
	 *
	 * @return 		string 						The modified oembed HTML
	 */
	public function youtube_add_id_attribute( $html, $url, $attr, $post_id ) {

		$check = strpos( $url, 'youtu' );

		if ( ! $check ) { return $html; }

		$id 	= explode( 'watch?v=', $url );
		$html 	= str_replace( 'allowfullscreen>', 'allowfullscreen id="video-' . $id[1] . '">', $html );

		return $html;

	} // youtube_add_id_attribute

} // class

/**
 * Make an instance so its ready to be used
 */
$slushman_2016_actions_and_filters = new slushman_2016_Actions_and_Filters();
