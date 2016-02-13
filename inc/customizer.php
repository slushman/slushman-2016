<?php
/**
 * Replace With Theme Name Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		https://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	DocBlock
 */

// Register panels, sections, and controls
add_action( 'customize_register', 'function_names_register_panels' );
add_action( 'customize_register', 'function_names_register_sections' );
add_action( 'customize_register', 'function_names_register_fields' );

// Output custom CSS to live site
add_action( 'wp_head', 'function_names_header_output' );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', 'function_names_live_preview' );

// Enqueue scripts for the customizer controls
add_action( 'customize_controls_enqueue_scripts', 'function_names_control_scripts' );

/**
 * Registers custom panels for the Customizer
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function function_names_register_panels( $wp_customize ) {

	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'text-domain' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'text-domain' ),
		)
	);

	/*
	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'text-domain' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'text-domain' ),
		)
	);
	*/

} // function_names_register_panels()

/**
 * Registers custom sections for the Customizer
 *
 * Existing sections:
 *
 * Slug 				Priority 		Title
 *
 * title_tagline 		20 				Site Identity
 * colors 				40				Colors
 * header_image 		60				Header Image
 * background_image 	80				Background Image
 * nav 					100 			Navigation
 * widgets 				110 			Widgets
 * static_front_page 	120 			Static Front Page
 * default 				160 			all others
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function function_names_register_sections( $wp_customize ) {



	/*
	// New Section
	$wp_customize->add_section( 'new_section',
		array(
			'capability' 	=> 'edit_theme_options',
			'description' 	=> esc_html__( 'New Customizer Section', 'text-domain' ),
			'panel' 		=> 'theme_options',
			'priority' 		=> 10,
			'title' 		=> esc_html__( 'New Section', 'text-domain' )
		)
	);
	*/

} // function_names_register_sections()

/**
 * Registers controls/fields for the Customizer
 *
 * Note: To enable instant preview, we have to actually write a bit of custom
 * javascript. See live_preview() for more.
 *
 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
 * 		'transport' => 'postMessage'
 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function function_names_register_fields( $wp_customize ) {

	// Enable live preview JS for default fields
	$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	// Site Identity Section Fields

	// Google Tag Manager Field
	$wp_customize->add_setting(
		'tag_manager',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'tag_manager',
		array(
			'description' 	=> esc_html__( 'Paste in the Google Tag Manager code here.', 'text-domain' ),
			'label' => esc_html__( 'Google Tag Manager', 'text-domain' ),
			'priority' => 90,
			'section' => 'title_tagline',
			'settings' => 'tag_manager',
			'type' => 'textarea'
		)
	);
	$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';




	/*
	// Fields & Controls

	// Text Field
	$wp_customize->add_setting(
		'text_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'text_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label'  	=> esc_html__( 'Text Field', 'text-domain' ),
			'priority' => 10,
			'section'  	=> 'new_section',
			'settings' 	=> 'text_field',
			'type' 		=> 'text'
		)
	);
	$wp_customize->get_setting( 'text_field' )->transport = 'postMessage';



	// URL Field
	$wp_customize->add_setting(
		'url_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'url_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'URL Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'url_field',
			'type' => 'url'
		)
	);
	$wp_customize->get_setting( 'url_field' )->transport = 'postMessage';



	// Email Field
	$wp_customize->add_setting(
		'email_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'email_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Email Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'email_field',
			'type' => 'email'
		)
	);
	$wp_customize->get_setting( 'email_field' )->transport = 'postMessage';

	// Date Field
	$wp_customize->add_setting(
		'date_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'date_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Date Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'date_field',
			'type' => 'date'
		)
	);
	$wp_customize->get_setting( 'date_field' )->transport = 'postMessage';


	// Checkbox Field
	$wp_customize->add_setting(
		'checkbox_field',
		array(
			'default'  	=> 'true',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'checkbox_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Checkbox Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'checkbox_field',
			'type' => 'checkbox'
		)
	);
	$wp_customize->get_setting( 'checkbox_field' )->transport = 'postMessage';




	// Password Field
	$wp_customize->add_setting(
		'password_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'password_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Password Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'password_field',
			'type' => 'password'
		)
	);
	$wp_customize->get_setting( 'password_field' )->transport = 'postMessage';



	// Radio Field
	$wp_customize->add_setting(
		'radio_field',
		array(
			'default'  	=> 'choice1',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'radio_field',
		array(
			'choices' => array(
				'choice1' => esc_html__( 'Choice 1', 'text-domain' ),
				'choice2' => esc_html__( 'Choice 2', 'text-domain' ),
				'choice3' => esc_html__( 'Choice 3', 'text-domain' )
			),
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Radio Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'radio_field',
			'type' => 'radio'
		)
	);
	$wp_customize->get_setting( 'radio_field' )->transport = 'postMessage';



	// Select Field
	$wp_customize->add_setting(
		'select_field',
		array(
			'default'  	=> 'choice1',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'select_field',
		array(
			'choices' => array(
				'choice1' => esc_html__( 'Choice 1', 'text-domain' ),
				'choice2' => esc_html__( 'Choice 2', 'text-domain' ),
				'choice3' => esc_html__( 'Choice 3', 'text-domain' )
			),
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Select Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'select_field',
			'type' => 'select'
		)
	);
	$wp_customize->get_setting( 'select_field' )->transport = 'postMessage';



	// Textarea Field
	$wp_customize->add_setting(
		'textarea_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'textarea_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Textarea Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'textarea_field',
			'type' => 'textarea'
		)
	);
	$wp_customize->get_setting( 'textarea_field' )->transport = 'postMessage';



	// Range Field
	$wp_customize->add_setting(
		'range_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'range_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'input_attrs' => array(
				'class' => 'range-field',
				'max' => 100,
				'min' => 0,
				'step' => 1,
				'style' => 'color: #020202'
			),
			'label' => esc_html__( 'Range Field', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'range_field',
			'type' => 'range'
		)
	);
	$wp_customize->get_setting( 'range_field' )->transport = 'postMessage';



	// Page Select Field
	$wp_customize->add_setting(
		'select_page_field',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'select_page_field',
		array(
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' => esc_html__( 'Select Page', 'text-domain' ),
			'priority' => 10,
			'section' => 'new_section',
			'settings' => 'select_page_field',
			'type' => 'dropdown-pages'
		)
	);
	$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';



	// Color Chooser Field
	$wp_customize->add_setting(
		'color_field',
		array(
			'default'  	=> '#ffffff',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_field',
			array(
				'description' 	=> esc_html__( '', 'text-domain' ),
				'label' => esc_html__( 'Color Field', 'text-domain' ),
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'color_field'
			),
		)
	);
	$wp_customize->get_setting( 'color_field' )->transport = 'postMessage';



	// File Upload Field
	$wp_customize->add_setting( 'file_upload' );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'file_upload',
			array(
				'description' 	=> esc_html__( '', 'text-domain' ),
				'label' => esc_html__( 'File Upload', 'text-domain' ),
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'file_upload'
			),
		)
	);



	// Image Upload Field
	$wp_customize->add_setting(
		'image_upload',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'image_upload',
			array(
				'description' 	=> esc_html__( '', 'text-domain' ),
				'label' => esc_html__( 'Image Field', 'text-domain' ),
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'image_upload'
			)
		)
	);
	$wp_customize->get_setting( 'image_upload' )->transport = 'postMessage';



	// Media Upload Field
	// Can be used for images
	// Returns the image ID, not a URL
	$wp_customize->add_setting(
		'media_upload',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'media_upload',
			array(
				'description' 	=> esc_html__( '', 'text-domain' ),
				'label' => esc_html__( 'Media Field', 'text-domain' ),
				'mime_type' => '',
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'media_upload'
			)
		)
	);
	$wp_customize->get_setting( 'media_upload' )->transport = 'postMessage';




	// Cropped Image Field
	$wp_customize->add_setting(
		'cropped_image',
		array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'cropped_image',
			array(
				'description' 	=> esc_html__( '', 'text-domain' ),
				'flex_height' => '',
				'flex_width' => '',
				'height' => '1080',
				'priority' => 10,
				'section' => 'new_section',
				'settings' => 'cropped_image',
				width' => '1920'
			)
		)
	);
	$wp_customize->get_setting( 'cropped_image' )->transport = 'postMessage';


	// Country Select Field
	$wp_customize->add_setting(
		'country',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'country',
		array(
			'choices' 		=> function_names_country_list(),
			'description' 	=> esc_html__( '', 'tillotson' ),
			'label' 		=> esc_html__( 'Country', 'tillotson' ),
			'priority' 		=> 250,
			'section' 		=> 'contact_info',
			'settings' 		=> 'country',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'country' )->transport = 'postMessage';


	// US States Select Field
	$wp_customize->add_setting(
		'us_state',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'us_state',
		array(
			'choices' => array(
				'AL' => esc_html__( 'Alabama', 'text-domain' ),
				'AK' => esc_html__( 'Alaska', 'text-domain' ),
				'AZ' => esc_html__( 'Arizona', 'text-domain' ),
				'AR' => esc_html__( 'Arkansas', 'text-domain' ),
				'CA' => esc_html__( 'California', 'text-domain' ),
				'CO' => esc_html__( 'Colorado', 'text-domain' ),
				'CT' => esc_html__( 'Connecticut', 'text-domain' ),
				'DE' => esc_html__( 'Delaware', 'text-domain' ),
				'DC' => esc_html__( 'District of Columbia', 'text-domain' ),
				'FL' => esc_html__( 'Florida', 'text-domain' ),
				'GA' => esc_html__( 'Georgia', 'text-domain' ),
				'HI' => esc_html__( 'Hawaii', 'text-domain' ),
				'ID' => esc_html__( 'Idaho', 'text-domain' ),
				'IL' => esc_html__( 'Illinois', 'text-domain' ),
				'IN' => esc_html__( 'Indiana', 'text-domain' ),
				'IA' => esc_html__( 'Iowa', 'text-domain' ),
				'KS' => esc_html__( 'Kansas', 'text-domain' ),
				'KY' => esc_html__( 'Kentucky', 'text-domain' ),
				'LA' => esc_html__( 'Louisiana', 'text-domain' ),
				'ME' => esc_html__( 'Maine', 'text-domain' ),
				'MD' => esc_html__( 'Maryland', 'text-domain' ),
				'MA' => esc_html__( 'Massachusetts', 'text-domain' ),
				'MI' => esc_html__( 'Michigan', 'text-domain' ),
				'MN' => esc_html__( 'Minnesota', 'text-domain' ),
				'MS' => esc_html__( 'Mississippi', 'text-domain' ),
				'MO' => esc_html__( 'Missouri', 'text-domain' ),
				'MT' => esc_html__( 'Montana', 'text-domain' ),
				'NE' => esc_html__( 'Nebraska', 'text-domain' ),
				'NV' => esc_html__( 'Nevada', 'text-domain' ),
				'NH' => esc_html__( 'New Hampshire', 'text-domain' ),
				'NJ' => esc_html__( 'New Jersey', 'text-domain' ),
				'NM' => esc_html__( 'New Mexico', 'text-domain' ),
				'NY' => esc_html__( 'New York', 'text-domain' ),
				'NC' => esc_html__( 'North Carolina', 'text-domain' ),
				'ND' => esc_html__( 'North Dakota', 'text-domain' ),
				'OH' => esc_html__( 'Ohio', 'text-domain' ),
				'OK' => esc_html__( 'Oklahoma', 'text-domain' ),
				'OR' => esc_html__( 'Oregon', 'text-domain' ),
				'PA' => esc_html__( 'Pennsylvania', 'text-domain' ),
				'RI' => esc_html__( 'Rhode Island', 'text-domain' ),
				'SC' => esc_html__( 'South Carolina', 'text-domain' ),
				'SD' => esc_html__( 'South Dakota', 'text-domain' ),
				'TN' => esc_html__( 'Tennessee', 'text-domain' ),
				'TX' => esc_html__( 'Texas', 'text-domain' ),
				'UT' => esc_html__( 'Utah', 'text-domain' ),
				'VT' => esc_html__( 'Vermont', 'text-domain' ),
				'VA' => esc_html__( 'Virginia', 'text-domain' ),
				'WA' => esc_html__( 'Washington', 'text-domain' ),
				'WV' => esc_html__( 'West Virginia', 'text-domain' ),
				'WI' => esc_html__( 'Wisconsin', 'text-domain' ),
				'WY' => esc_html__( 'Wyoming', 'text-domain' ),
				'AS' => esc_html__( 'American Samoa', 'text-domain' ),
				'AA' => esc_html__( 'Armed Forces America (except Canada)', 'text-domain' ),
				'AE' => esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'text-domain' ),
				'AP' => esc_html__( 'Armed Forces Pacific', 'text-domain' ),
				'FM' => esc_html__( 'Federated States of Micronesia', 'text-domain' ),
				'GU' => esc_html__( 'Guam', 'text-domain' ),
				'MH' => esc_html__( 'Marshall Islands', 'text-domain' ),
				'MP' => esc_html__( 'Northern Mariana Islands', 'text-domain' ),
				'PR' => esc_html__( 'Puerto Rico', 'text-domain' ),
				'PW' => esc_html__( 'Palau', 'text-domain' ),
				'VI' => esc_html__( 'Virgin Islands', 'text-domain' )
			),
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' 		=> esc_html__( 'State', 'text-domain' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'us_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'us_state' )->transport = 'postMessage';


	// Canadian States Select Field
	$wp_customize->add_setting(
		'canada_state',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'canada_state',
		array(
			'choices' => array(
				'AB' => esc_html__( 'Alberta', 'text-domain' ),
				'BC' => esc_html__( 'British Columbia', 'text-domain' ),
				'MB' => esc_html__( 'Manitoba', 'text-domain' ),
				'NB' => esc_html__( 'New Brunswick', 'text-domain' ),
				'NL' => esc_html__( 'Newfoundland and Labrador', 'text-domain' ),
				'NT' => esc_html__( 'Northwest Territories', 'text-domain' ),
				'NS' => esc_html__( 'Nova Scotia', 'text-domain' ),
				'NU' => esc_html__( 'Nunavut', 'text-domain' ),
				'ON' => esc_html__( 'Ontario', 'text-domain' ),
				'PE' => esc_html__( 'Prince Edward Island', 'text-domain' ),
				'QC' => esc_html__( 'Quebec', 'text-domain' ),
				'SK' => esc_html__( 'Saskatchewan', 'text-domain' ),
				'YT' => esc_html__( 'Yukon', 'text-domain' )
			),
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' 		=> esc_html__( 'State', 'text-domain' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'canada_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'canada_state' )->transport = 'postMessage';


	// Australian States Select Field
	$wp_customize->add_setting(
		'australia_state',
		array(
			'default'  	=> '',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(
		'australia_state',
		array(
			'choices' => array(
				'ACT' 	=> esc_html__( 'Australian Capital Territory', 'text-domain' ),
				'NSW' 	=> esc_html__( 'New South Wales', 'text-domain' ),
				'NT' 	=> esc_html__( 'Northern Territory', 'text-domain' ),
				'QLD' 	=> esc_html__( 'Queensland', 'text-domain' ),
				'SA' 	=> esc_html__( 'South Australia', 'text-domain' ),
				'TAS' 	=> esc_html__( 'Tasmania', 'text-domain' ),
				'VIC' 	=> esc_html__( 'Victoria', 'text-domain' ),
				'WA' 	=> esc_html__( 'Western Australia', 'text-domain' )
			),
			'description' 	=> esc_html__( '', 'text-domain' ),
			'label' 		=> esc_html__( 'State', 'text-domain' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'australia_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


	*/

} // function_names_register_fields()

/**
 * This will generate a line of CSS for use in header output. If the setting
 * ($mod_name) has no defined value, the CSS will not be output.
 *
 * @access 		public
 * @since 		1.0.0
 *
 * @param 		string 		$selector 		CSS selector
 * @param 		string 		$style 			The name of the CSS *property* to modify
 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
 *
 * @return 		string 						Returns a single line of CSS with selectors and a property.
 */
function function_names_generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

	$return = '';
	$mod 	= get_theme_mod( $mod_name );

	if ( ! empty( $mod ) ) {

		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix . $mod . $postfix
		);

		if ( $echo ) {

			echo $return;

		}

	}

	return $return;

} // function_names_generate_css()

/**
 * This will output the custom WordPress settings to the live theme's WP head.
 *
 * Used by hook: 'wp_head'
 *
 * @access 		public
 * @see 		add_action( 'wp_head', $func )
 * @since 		1.0.0
 */
function function_names_header_output() {

	?><!-- Customizer CSS -->
	<style type="text/css"><?php

		// pattern:
		// function_names_generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
		//
		// background-image example:
		// function_names_generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


	?></style><!-- Customizer CSS --><?php

} // function_names_header_output()

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Used by hook: 'customize_preview_init'
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function function_names_live_preview() {

	wp_enqueue_script( 'function_names_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '', true );

} // function_names_live_preview()

/**
 * Used by customizer controls, mostly for active callbacks.
 *
 * @hook		customize_controls_enqueue_scripts
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function function_names_control_scripts() {

	wp_enqueue_script( 'function_names_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.min.js', array( 'jquery', 'customize-controls' ), false, true );

} // function_names_control_scripts()

/**
 * Returns TRUE based on which link type is selected, otherwise FALSE
 *
 * @param 	object 		$control 			The control object
 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
 */
function function_names_states_of_country_callback( $control ) {

	$country_setting = $control->manager->get_setting('country')->value();

	//wp_die( print_r( $radio_setting ) );
	//wp_die( print_r( $control->id ) );

	if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
	if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
	if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
	if ( 'default_state' === $control->id && ! function_names_custom_countries( $country_setting ) ) { return true; }

	return false;

} // function_names_states_of_country_callback()

/**
 * Returns true if a country has a custom select menu
 *
 * @param 		string 		$country 			The country code to check
 *
 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
 */
function function_names_custom_countries( $country ) {

	$countries = array( 'US', 'CA', 'AU' );

	return in_array( $country, $countries );

} // function_names_custom_countries()


/**
 * Returns an array of countries or a country name.
 *
 * @param 		string 		$country 		Country code to return (optional)
 *
 * @return 		array|string 				Array of countries or a single country name
 */
function function_names_country_list( $country = '' ) {

	$countries = array();

	$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'tillotson' );
	$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'tillotson' );
	$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'tillotson' );
	$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'tillotson' );
	$countries['AS'] = esc_html__( 'American Samoa', 'tillotson' );
	$countries['AD'] = esc_html__( 'Andorra', 'tillotson' );
	$countries['AO'] = esc_html__( 'Angola', 'tillotson' );
	$countries['AI'] = esc_html__( 'Anguilla', 'tillotson' );
	$countries['AQ'] = esc_html__( 'Antarctica', 'tillotson' );
	$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'tillotson' );
	$countries['AR'] = esc_html__( 'Argentina', 'tillotson' );
	$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'tillotson' );
	$countries['AW'] = esc_html__( 'Aruba', 'tillotson' );
	$countries['AC'] = esc_html__( 'Ascension Island', 'tillotson' );
	$countries['AU'] = esc_html__( 'Australia', 'tillotson' );
	$countries['AT'] = esc_html__( 'Austria (Österreich)', 'tillotson' );
	$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'tillotson' );
	$countries['BS'] = esc_html__( 'Bahamas', 'tillotson' );
	$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'tillotson' );
	$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'tillotson' );
	$countries['BB'] = esc_html__( 'Barbados', 'tillotson' );
	$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'tillotson' );
	$countries['BE'] = esc_html__( 'Belgium (België)', 'tillotson' );
	$countries['BZ'] = esc_html__( 'Belize', 'tillotson' );
	$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'tillotson' );
	$countries['BM'] = esc_html__( 'Bermuda', 'tillotson' );
	$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'tillotson' );
	$countries['BO'] = esc_html__( 'Bolivia', 'tillotson' );
	$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'tillotson' );
	$countries['BW'] = esc_html__( 'Botswana', 'tillotson' );
	$countries['BV'] = esc_html__( 'Bouvet Island', 'tillotson' );
	$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'tillotson' );
	$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'tillotson' );
	$countries['VG'] = esc_html__( 'British Virgin Islands', 'tillotson' );
	$countries['BN'] = esc_html__( 'Brunei', 'tillotson' );
	$countries['BG'] = esc_html__( 'Bulgaria (България)', 'tillotson' );
	$countries['BF'] = esc_html__( 'Burkina Faso', 'tillotson' );
	$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'tillotson' );
	$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'tillotson' );
	$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'tillotson' );
	$countries['CA'] = esc_html__( 'Canada', 'tillotson' );
	$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'tillotson' );
	$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'tillotson' );
	$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'tillotson' );
	$countries['KY'] = esc_html__( 'Cayman Islands', 'tillotson' );
	$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'tillotson' );
	$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'tillotson' );
	$countries['TD'] = esc_html__( 'Chad (Tchad)', 'tillotson' );
	$countries['CL'] = esc_html__( 'Chile', 'tillotson' );
	$countries['CN'] = esc_html__( 'China (中国)', 'tillotson' );
	$countries['CX'] = esc_html__( 'Christmas Island', 'tillotson' );
	$countries['CP'] = esc_html__( 'Clipperton Island', 'tillotson' );
	$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'tillotson' );
	$countries['CO'] = esc_html__( 'Colombia', 'tillotson' );
	$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'tillotson' );
	$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'tillotson' );
	$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'tillotson' );
	$countries['CK'] = esc_html__( 'Cook Islands', 'tillotson' );
	$countries['CR'] = esc_html__( 'Costa Rica', 'tillotson' );
	$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'tillotson' );
	$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'tillotson' );
	$countries['CU'] = esc_html__( 'Cuba', 'tillotson' );
	$countries['CW'] = esc_html__( 'Curaçao', 'tillotson' );
	$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'tillotson' );
	$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'tillotson' );
	$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'tillotson' );
	$countries['DG'] = esc_html__( 'Diego Garcia', 'tillotson' );
	$countries['DJ'] = esc_html__( 'Djibouti', 'tillotson' );
	$countries['DM'] = esc_html__( 'Dominica', 'tillotson' );
	$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'tillotson' );
	$countries['EC'] = esc_html__( 'Ecuador', 'tillotson' );
	$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'tillotson' );
	$countries['SV'] = esc_html__( 'El Salvador', 'tillotson' );
	$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'tillotson' );
	$countries['ER'] = esc_html__( 'Eritrea', 'tillotson' );
	$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'tillotson' );
	$countries['ET'] = esc_html__( 'Ethiopia', 'tillotson' );
	$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'tillotson' );
	$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'tillotson' );
	$countries['FJ'] = esc_html__( 'Fiji', 'tillotson' );
	$countries['FI'] = esc_html__( 'Finland (Suomi)', 'tillotson' );
	$countries['FR'] = esc_html__( 'France', 'tillotson' );
	$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'tillotson' );
	$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'tillotson' );
	$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'tillotson' );
	$countries['GA'] = esc_html__( 'Gabon', 'tillotson' );
	$countries['GM'] = esc_html__( 'Gambia', 'tillotson' );
	$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'tillotson' );
	$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'tillotson' );
	$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'tillotson' );
	$countries['GI'] = esc_html__( 'Gibraltar', 'tillotson' );
	$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'tillotson' );
	$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'tillotson' );
	$countries['GD'] = esc_html__( 'Grenada', 'tillotson' );
	$countries['GP'] = esc_html__( 'Guadeloupe', 'tillotson' );
	$countries['GU'] = esc_html__( 'Guam', 'tillotson' );
	$countries['GT'] = esc_html__( 'Guatemala', 'tillotson' );
	$countries['GG'] = esc_html__( 'Guernsey', 'tillotson' );
	$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'tillotson' );
	$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'tillotson' );
	$countries['GY'] = esc_html__( 'Guyana', 'tillotson' );
	$countries['HT'] = esc_html__( 'Haiti', 'tillotson' );
	$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'tillotson' );
	$countries['HN'] = esc_html__( 'Honduras', 'tillotson' );
	$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'tillotson' );
	$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'tillotson' );
	$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'tillotson' );
	$countries['IN'] = esc_html__( 'India (भारत)', 'tillotson' );
	$countries['ID'] = esc_html__( 'Indonesia', 'tillotson' );
	$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'tillotson' );
	$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'tillotson' );
	$countries['IE'] = esc_html__( 'Ireland', 'tillotson' );
	$countries['IM'] = esc_html__( 'Isle of Man', 'tillotson' );
	$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'tillotson' );
	$countries['IT'] = esc_html__( 'Italy (Italia)', 'tillotson' );
	$countries['JM'] = esc_html__( 'Jamaica', 'tillotson' );
	$countries['JP'] = esc_html__( 'Japan (日本)', 'tillotson' );
	$countries['JE'] = esc_html__( 'Jersey', 'tillotson' );
	$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'tillotson' );
	$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'tillotson' );
	$countries['KE'] = esc_html__( 'Kenya', 'tillotson' );
	$countries['KI'] = esc_html__( 'Kiribati', 'tillotson' );
	$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'tillotson' );
	$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'tillotson' );
	$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'tillotson' );
	$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'tillotson' );
	$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'tillotson' );
	$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'tillotson' );
	$countries['LS'] = esc_html__( 'Lesotho', 'tillotson' );
	$countries['LR'] = esc_html__( 'Liberia', 'tillotson' );
	$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'tillotson' );
	$countries['LI'] = esc_html__( 'Liechtenstein', 'tillotson' );
	$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'tillotson' );
	$countries['LU'] = esc_html__( 'Luxembourg', 'tillotson' );
	$countries['MO'] = esc_html__( 'Macau (澳門)', 'tillotson' );
	$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'tillotson' );
	$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'tillotson' );
	$countries['MW'] = esc_html__( 'Malawi', 'tillotson' );
	$countries['MY'] = esc_html__( 'Malaysia', 'tillotson' );
	$countries['MV'] = esc_html__( 'Maldives', 'tillotson' );
	$countries['ML'] = esc_html__( 'Mali', 'tillotson' );
	$countries['MT'] = esc_html__( 'Malta', 'tillotson' );
	$countries['MH'] = esc_html__( 'Marshall Islands', 'tillotson' );
	$countries['MQ'] = esc_html__( 'Martinique', 'tillotson' );
	$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'tillotson' );
	$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'tillotson' );
	$countries['YT'] = esc_html__( 'Mayotte', 'tillotson' );
	$countries['MX'] = esc_html__( 'Mexico (México)', 'tillotson' );
	$countries['FM'] = esc_html__( 'Micronesia', 'tillotson' );
	$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'tillotson' );
	$countries['MC'] = esc_html__( 'Monaco', 'tillotson' );
	$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'tillotson' );
	$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'tillotson' );
	$countries['MS'] = esc_html__( 'Montserrat', 'tillotson' );
	$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'tillotson' );
	$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'tillotson' );
	$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'tillotson' );
	$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'tillotson' );
	$countries['NR'] = esc_html__( 'Nauru', 'tillotson' );
	$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'tillotson' );
	$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'tillotson' );
	$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'tillotson' );
	$countries['NZ'] = esc_html__( 'New Zealand', 'tillotson' );
	$countries['NI'] = esc_html__( 'Nicaragua', 'tillotson' );
	$countries['NE'] = esc_html__( 'Niger (Nijar)', 'tillotson' );
	$countries['NG'] = esc_html__( 'Nigeria', 'tillotson' );
	$countries['NU'] = esc_html__( 'Niue', 'tillotson' );
	$countries['NF'] = esc_html__( 'Norfolk Island', 'tillotson' );
	$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'tillotson' );
	$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'tillotson' );
	$countries['NO'] = esc_html__( 'Norway (Norge)', 'tillotson' );
	$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'tillotson' );
	$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'tillotson' );
	$countries['PW'] = esc_html__( 'Palau', 'tillotson' );
	$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'tillotson' );
	$countries['PA'] = esc_html__( 'Panama (Panamá)', 'tillotson' );
	$countries['PG'] = esc_html__( 'Papua New Guinea', 'tillotson' );
	$countries['PY'] = esc_html__( 'Paraguay', 'tillotson' );
	$countries['PE'] = esc_html__( 'Peru (Perú)', 'tillotson' );
	$countries['PH'] = esc_html__( 'Philippines', 'tillotson' );
	$countries['PN'] = esc_html__( 'Pitcairn Islands', 'tillotson' );
	$countries['PL'] = esc_html__( 'Poland (Polska)', 'tillotson' );
	$countries['PT'] = esc_html__( 'Portugal', 'tillotson' );
	$countries['PR'] = esc_html__( 'Puerto Rico', 'tillotson' );
	$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'tillotson' );
	$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'tillotson' );
	$countries['RO'] = esc_html__( 'Romania (România)', 'tillotson' );
	$countries['RU'] = esc_html__( 'Russia (Россия)', 'tillotson' );
	$countries['RW'] = esc_html__( 'Rwanda', 'tillotson' );
	$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'tillotson' );
	$countries['SH'] = esc_html__( 'Saint Helena', 'tillotson' );
	$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'tillotson' );
	$countries['LC'] = esc_html__( 'Saint Lucia', 'tillotson' );
	$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'tillotson' );
	$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'tillotson' );
	$countries['WS'] = esc_html__( 'Samoa', 'tillotson' );
	$countries['SM'] = esc_html__( 'San Marino', 'tillotson' );
	$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'tillotson' );
	$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'tillotson' );
	$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'tillotson' );
	$countries['RS'] = esc_html__( 'Serbia (Србија)', 'tillotson' );
	$countries['SC'] = esc_html__( 'Seychelles', 'tillotson' );
	$countries['SL'] = esc_html__( 'Sierra Leone', 'tillotson' );
	$countries['SG'] = esc_html__( 'Singapore', 'tillotson' );
	$countries['SX'] = esc_html__( 'Sint Maarten', 'tillotson' );
	$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'tillotson' );
	$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'tillotson' );
	$countries['SB'] = esc_html__( 'Solomon Islands', 'tillotson' );
	$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'tillotson' );
	$countries['ZA'] = esc_html__( 'South Africa', 'tillotson' );
	$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'tillotson' );
	$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'tillotson' );
	$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'tillotson' );
	$countries['ES'] = esc_html__( 'Spain (España)', 'tillotson' );
	$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'tillotson' );
	$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'tillotson' );
	$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'tillotson' );
	$countries['SR'] = esc_html__( 'Suriname', 'tillotson' );
	$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'tillotson' );
	$countries['SZ'] = esc_html__( 'Swaziland', 'tillotson' );
	$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'tillotson' );
	$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'tillotson' );
	$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'tillotson' );
	$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'tillotson' );
	$countries['TJ'] = esc_html__( 'Tajikistan', 'tillotson' );
	$countries['TZ'] = esc_html__( 'Tanzania', 'tillotson' );
	$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'tillotson' );
	$countries['TL'] = esc_html__( 'Timor-Leste', 'tillotson' );
	$countries['TG'] = esc_html__( 'Togo', 'tillotson' );
	$countries['TK'] = esc_html__( 'Tokelau', 'tillotson' );
	$countries['TO'] = esc_html__( 'Tonga', 'tillotson' );
	$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'tillotson' );
	$countries['TA'] = esc_html__( 'Tristan da Cunha', 'tillotson' );
	$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'tillotson' );
	$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'tillotson' );
	$countries['TM'] = esc_html__( 'Turkmenistan', 'tillotson' );
	$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'tillotson' );
	$countries['TV'] = esc_html__( 'Tuvalu', 'tillotson' );
	$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'tillotson' );
	$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'tillotson' );
	$countries['UG'] = esc_html__( 'Uganda', 'tillotson' );
	$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'tillotson' );
	$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'tillotson' );
	$countries['GB'] = esc_html__( 'United Kingdom', 'tillotson' );
	$countries['US'] = esc_html__( 'United States', 'tillotson' );
	$countries['UY'] = esc_html__( 'Uruguay', 'tillotson' );
	$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'tillotson' );
	$countries['VU'] = esc_html__( 'Vanuatu', 'tillotson' );
	$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'tillotson' );
	$countries['VE'] = esc_html__( 'Venezuela', 'tillotson' );
	$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'tillotson' );
	$countries['WF'] = esc_html__( 'Wallis and Futuna', 'tillotson' );
	$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'tillotson' );
	$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'tillotson' );
	$countries['ZM'] = esc_html__( 'Zambia', 'tillotson' );
	$countries['ZW'] = esc_html__( 'Zimbabwe', 'tillotson' );

	if ( ! empty( $country ) ) {

		return $countries[$country];

	}

	return $countries;

} // function_names_country_list()

