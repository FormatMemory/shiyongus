<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'bloge-promo-category', array(
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'title'          => __( 'Promo Section', 'bloge' ),
    'description'    => __( 'Recommended image for Promo section is 360*261', 'bloge' )

) );

/* feature cat selection */
$wp_customize->add_setting( 'bloge_theme_options[bloge-promo-cat]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['bloge-promo-cat'],
    'sanitize_callback' => 'absint'
) );

$wp_customize->add_control(
    new Bloge_Customize_Category_Dropdown_Control(
        $wp_customize,
        'bloge_theme_options[bloge-promo-cat]',
        array(
            'label'		=> __( 'Select Category', 'bloge' ),
            'section'   => 'bloge-promo-category',
            'settings'  => 'bloge_theme_options[bloge-promo-cat]',
            'type'	  	=> 'category_dropdown',
            'priority'  => 10
        )
    )
);

