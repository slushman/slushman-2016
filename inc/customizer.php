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
add_action( 'customize_register', 'slushman_2016_register_panels' );
add_action( 'customize_register', 'slushman_2016_register_sections' );
add_action( 'customize_register', 'slushman_2016_register_fields' );

// Output custom CSS to live site
add_action( 'wp_head', 'slushman_2016_header_output' );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', 'slushman_2016_live_preview' );

// Enqueue scripts for the customizer controls
add_action( 'customize_controls_enqueue_scripts', 'slushman_2016_control_scripts' );

/**
 * Registers custom panels for the Customizer
 *
 * @see			add_action( 'customize_register', $func )
 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 		1.0.0
 *
 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
 */
function slushman_2016_register_panels( $wp_customize ) {

	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'slushman-2016' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'slushman-2016' ),
		)
	);

	/*
	// Theme Options Panel
	$wp_customize->add_panel( 'theme_options',
		array(
			'capability'  		=> 'edit_theme_options',
			'description'  		=> esc_html__( 'Options for Replace With Theme Name', 'slushman-2016' ),
			'priority'  		=> 10,
			'theme_supports'  	=> '',
			'title'  			=> esc_html__( 'Theme Options', 'slushman-2016' ),
		)
	);
	*/

} // slushman_2016_register_panels()

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
function slushman_2016_register_sections( $wp_customize ) {



	/*
	// New Section
	$wp_customize->add_section( 'new_section',
		array(
			'capability' 	=> 'edit_theme_options',
			'description' 	=> esc_html__( 'New Customizer Section', 'slushman-2016' ),
			'panel' 		=> 'theme_options',
			'priority' 		=> 10,
			'title' 		=> esc_html__( 'New Section', 'slushman-2016' )
		)
	);
	*/

} // slushman_2016_register_sections()

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
function slushman_2016_register_fields( $wp_customize ) {

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
			'description' 	=> esc_html__( 'Paste in the Google Tag Manager code here.', 'slushman-2016' ),
			'label' => esc_html__( 'Google Tag Manager', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label'  	=> esc_html__( 'Text Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'URL Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Email Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Date Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Checkbox Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Password Field', 'slushman-2016' ),
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
				'choice1' => esc_html__( 'Choice 1', 'slushman-2016' ),
				'choice2' => esc_html__( 'Choice 2', 'slushman-2016' ),
				'choice3' => esc_html__( 'Choice 3', 'slushman-2016' )
			),
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Radio Field', 'slushman-2016' ),
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
				'choice1' => esc_html__( 'Choice 1', 'slushman-2016' ),
				'choice2' => esc_html__( 'Choice 2', 'slushman-2016' ),
				'choice3' => esc_html__( 'Choice 3', 'slushman-2016' )
			),
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Select Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Textarea Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'input_attrs' => array(
				'class' => 'range-field',
				'max' => 100,
				'min' => 0,
				'step' => 1,
				'style' => 'color: #020202'
			),
			'label' => esc_html__( 'Range Field', 'slushman-2016' ),
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
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' => esc_html__( 'Select Page', 'slushman-2016' ),
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
				'description' 	=> esc_html__( '', 'slushman-2016' ),
				'label' => esc_html__( 'Color Field', 'slushman-2016' ),
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
				'description' 	=> esc_html__( '', 'slushman-2016' ),
				'label' => esc_html__( 'File Upload', 'slushman-2016' ),
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
				'description' 	=> esc_html__( '', 'slushman-2016' ),
				'label' => esc_html__( 'Image Field', 'slushman-2016' ),
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
				'description' 	=> esc_html__( '', 'slushman-2016' ),
				'label' => esc_html__( 'Media Field', 'slushman-2016' ),
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
				'description' 	=> esc_html__( '', 'slushman-2016' ),
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
			'choices' 		=> slushman_2016_country_list(),
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
				'AL' => esc_html__( 'Alabama', 'slushman-2016' ),
				'AK' => esc_html__( 'Alaska', 'slushman-2016' ),
				'AZ' => esc_html__( 'Arizona', 'slushman-2016' ),
				'AR' => esc_html__( 'Arkansas', 'slushman-2016' ),
				'CA' => esc_html__( 'California', 'slushman-2016' ),
				'CO' => esc_html__( 'Colorado', 'slushman-2016' ),
				'CT' => esc_html__( 'Connecticut', 'slushman-2016' ),
				'DE' => esc_html__( 'Delaware', 'slushman-2016' ),
				'DC' => esc_html__( 'District of Columbia', 'slushman-2016' ),
				'FL' => esc_html__( 'Florida', 'slushman-2016' ),
				'GA' => esc_html__( 'Georgia', 'slushman-2016' ),
				'HI' => esc_html__( 'Hawaii', 'slushman-2016' ),
				'ID' => esc_html__( 'Idaho', 'slushman-2016' ),
				'IL' => esc_html__( 'Illinois', 'slushman-2016' ),
				'IN' => esc_html__( 'Indiana', 'slushman-2016' ),
				'IA' => esc_html__( 'Iowa', 'slushman-2016' ),
				'KS' => esc_html__( 'Kansas', 'slushman-2016' ),
				'KY' => esc_html__( 'Kentucky', 'slushman-2016' ),
				'LA' => esc_html__( 'Louisiana', 'slushman-2016' ),
				'ME' => esc_html__( 'Maine', 'slushman-2016' ),
				'MD' => esc_html__( 'Maryland', 'slushman-2016' ),
				'MA' => esc_html__( 'Massachusetts', 'slushman-2016' ),
				'MI' => esc_html__( 'Michigan', 'slushman-2016' ),
				'MN' => esc_html__( 'Minnesota', 'slushman-2016' ),
				'MS' => esc_html__( 'Mississippi', 'slushman-2016' ),
				'MO' => esc_html__( 'Missouri', 'slushman-2016' ),
				'MT' => esc_html__( 'Montana', 'slushman-2016' ),
				'NE' => esc_html__( 'Nebraska', 'slushman-2016' ),
				'NV' => esc_html__( 'Nevada', 'slushman-2016' ),
				'NH' => esc_html__( 'New Hampshire', 'slushman-2016' ),
				'NJ' => esc_html__( 'New Jersey', 'slushman-2016' ),
				'NM' => esc_html__( 'New Mexico', 'slushman-2016' ),
				'NY' => esc_html__( 'New York', 'slushman-2016' ),
				'NC' => esc_html__( 'North Carolina', 'slushman-2016' ),
				'ND' => esc_html__( 'North Dakota', 'slushman-2016' ),
				'OH' => esc_html__( 'Ohio', 'slushman-2016' ),
				'OK' => esc_html__( 'Oklahoma', 'slushman-2016' ),
				'OR' => esc_html__( 'Oregon', 'slushman-2016' ),
				'PA' => esc_html__( 'Pennsylvania', 'slushman-2016' ),
				'RI' => esc_html__( 'Rhode Island', 'slushman-2016' ),
				'SC' => esc_html__( 'South Carolina', 'slushman-2016' ),
				'SD' => esc_html__( 'South Dakota', 'slushman-2016' ),
				'TN' => esc_html__( 'Tennessee', 'slushman-2016' ),
				'TX' => esc_html__( 'Texas', 'slushman-2016' ),
				'UT' => esc_html__( 'Utah', 'slushman-2016' ),
				'VT' => esc_html__( 'Vermont', 'slushman-2016' ),
				'VA' => esc_html__( 'Virginia', 'slushman-2016' ),
				'WA' => esc_html__( 'Washington', 'slushman-2016' ),
				'WV' => esc_html__( 'West Virginia', 'slushman-2016' ),
				'WI' => esc_html__( 'Wisconsin', 'slushman-2016' ),
				'WY' => esc_html__( 'Wyoming', 'slushman-2016' ),
				'AS' => esc_html__( 'American Samoa', 'slushman-2016' ),
				'AA' => esc_html__( 'Armed Forces America (except Canada)', 'slushman-2016' ),
				'AE' => esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'slushman-2016' ),
				'AP' => esc_html__( 'Armed Forces Pacific', 'slushman-2016' ),
				'FM' => esc_html__( 'Federated States of Micronesia', 'slushman-2016' ),
				'GU' => esc_html__( 'Guam', 'slushman-2016' ),
				'MH' => esc_html__( 'Marshall Islands', 'slushman-2016' ),
				'MP' => esc_html__( 'Northern Mariana Islands', 'slushman-2016' ),
				'PR' => esc_html__( 'Puerto Rico', 'slushman-2016' ),
				'PW' => esc_html__( 'Palau', 'slushman-2016' ),
				'VI' => esc_html__( 'Virgin Islands', 'slushman-2016' )
			),
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' 		=> esc_html__( 'State', 'slushman-2016' ),
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
				'AB' => esc_html__( 'Alberta', 'slushman-2016' ),
				'BC' => esc_html__( 'British Columbia', 'slushman-2016' ),
				'MB' => esc_html__( 'Manitoba', 'slushman-2016' ),
				'NB' => esc_html__( 'New Brunswick', 'slushman-2016' ),
				'NL' => esc_html__( 'Newfoundland and Labrador', 'slushman-2016' ),
				'NT' => esc_html__( 'Northwest Territories', 'slushman-2016' ),
				'NS' => esc_html__( 'Nova Scotia', 'slushman-2016' ),
				'NU' => esc_html__( 'Nunavut', 'slushman-2016' ),
				'ON' => esc_html__( 'Ontario', 'slushman-2016' ),
				'PE' => esc_html__( 'Prince Edward Island', 'slushman-2016' ),
				'QC' => esc_html__( 'Quebec', 'slushman-2016' ),
				'SK' => esc_html__( 'Saskatchewan', 'slushman-2016' ),
				'YT' => esc_html__( 'Yukon', 'slushman-2016' )
			),
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' 		=> esc_html__( 'State', 'slushman-2016' ),
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
				'ACT' 	=> esc_html__( 'Australian Capital Territory', 'slushman-2016' ),
				'NSW' 	=> esc_html__( 'New South Wales', 'slushman-2016' ),
				'NT' 	=> esc_html__( 'Northern Territory', 'slushman-2016' ),
				'QLD' 	=> esc_html__( 'Queensland', 'slushman-2016' ),
				'SA' 	=> esc_html__( 'South Australia', 'slushman-2016' ),
				'TAS' 	=> esc_html__( 'Tasmania', 'slushman-2016' ),
				'VIC' 	=> esc_html__( 'Victoria', 'slushman-2016' ),
				'WA' 	=> esc_html__( 'Western Australia', 'slushman-2016' )
			),
			'description' 	=> esc_html__( '', 'slushman-2016' ),
			'label' 		=> esc_html__( 'State', 'slushman-2016' ),
			'priority' 		=> 230,
			'section' 		=> 'contact_info',
			'settings' 		=> 'australia_state',
			'type' 			=> 'select'
		)
	);
	$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


	*/

} // slushman_2016_register_fields()

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
function slushman_2016_generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

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

} // slushman_2016_generate_css()

/**
 * This will output the custom WordPress settings to the live theme's WP head.
 *
 * Used by hook: 'wp_head'
 *
 * @access 		public
 * @see 		add_action( 'wp_head', $func )
 * @since 		1.0.0
 */
function slushman_2016_header_output() {

	?><!-- Customizer CSS -->
	<style type="text/css"><?php

		// pattern:
		// slushman_2016_generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
		//
		// background-image example:
		// slushman_2016_generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


	?></style><!-- Customizer CSS --><?php

} // slushman_2016_header_output()

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Used by hook: 'customize_preview_init'
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function slushman_2016_live_preview() {

	wp_enqueue_script( 'slushman_2016_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '', true );

} // slushman_2016_live_preview()

/**
 * Used by customizer controls, mostly for active callbacks.
 *
 * @hook		customize_controls_enqueue_scripts
 *
 * @access 		public
 * @see 		add_action( 'customize_preview_init', $func )
 * @since 		1.0.0
 */
function slushman_2016_control_scripts() {

	wp_enqueue_script( 'slushman_2016_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.min.js', array( 'jquery', 'customize-controls' ), false, true );

} // slushman_2016_control_scripts()

/**
 * Returns TRUE based on which link type is selected, otherwise FALSE
 *
 * @param 	object 		$control 			The control object
 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
 */
function slushman_2016_states_of_country_callback( $control ) {

	$country_setting = $control->manager->get_setting('country')->value();

	//wp_die( print_r( $radio_setting ) );
	//wp_die( print_r( $control->id ) );

	if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
	if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
	if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
	if ( 'default_state' === $control->id && ! slushman_2016_custom_countries( $country_setting ) ) { return true; }

	return false;

} // slushman_2016_states_of_country_callback()

/**
 * Returns true if a country has a custom select menu
 *
 * @param 		string 		$country 			The country code to check
 *
 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
 */
function slushman_2016_custom_countries( $country ) {

	$countries = array( 'US', 'CA', 'AU' );

	return in_array( $country, $countries );

} // slushman_2016_custom_countries()


/**
 * Returns an array of countries or a country name.
 *
 * @param 		string 		$country 		Country code to return (optional)
 *
 * @return 		array|string 				Array of countries or a single country name
 */
function slushman_2016_country_list( $country = '' ) {

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

} // slushman_2016_country_list()

