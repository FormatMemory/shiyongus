<?php
defined('ABSPATH') or die("Please don't run this script.");

class Simple_Days_Customize {

  public static function register ( $wp_customize ) {
      //delete header textcolor control
    $wp_customize->remove_control("header_textcolor");
    $wp_customize->remove_control("background_color");
    $wp_customize->remove_control("display_header_text");

    $wp_customize->register_control_type( 'Simple_Days_Image_Select_Control' );


    get_template_part( 'inc/social', 'list' );
    $social = get_query_var('social_list');

    
    $wp_customize->add_panel( 'simple_days_setting', array(
      'priority'    => 0,
      'title'       => esc_html__('Simple Days settings', 'simple-days'),
    ));

    
    $wp_customize->add_section('simple_days_layout',array(
      'title' => esc_html__('Layout', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));

  // Add Settings and Controls for Layout.

    $wp_customize->add_setting( 'simple_days_menu_layout', array(
      'default'           => '1',
      'sanitize_callback' => 'sanitize_key'
    ));


    $wp_customize->add_setting( 'simple_days_sidebar_layout', array(
      'default'           => '3',
      'sanitize_callback' => 'sanitize_key'
    ) );
    $wp_customize->add_control( new Simple_Days_Image_Select_Control( $wp_customize, 'simple_days_sidebar_layout', array(
      'label'       => esc_html__( 'Sidebar Layout', 'simple-days' ),
      'section'     => 'simple_days_layout',
      'choices'     => array(
        '1' => array(
          'label' => esc_html__( 'Left Sidebar', 'simple-days' ),
          'url'   => '%ssidebar_left.png'
        ),
        '3'    => array(
          'label' => esc_html__( 'Right Sidebar', 'simple-days' ),
          'url'   => '%ssidebar_right.png'
        ),
        '0'    => array(
          'label' => esc_html__( 'No Sidebar', 'simple-days' ),
          'url'   => '%ssidebar_no.png'
        ),
      ),
    )));




  // Add Settings and Controls for Box Style.
    $wp_customize->add_setting( 'simple_days_box_style', array(
      'default'           => 'flat',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    )
  );
    $wp_customize->add_control( 'simple_days_box_style', array(
      'label'    => esc_html__( 'Box Style', 'simple-days' ),
      'section'  => 'simple_days_layout',
      'type'     => 'radio',
      'choices'  => array(
        'flat' => esc_html__( 'Flat', 'simple-days' ),
        'shadow' => esc_html__( 'Shadow', 'simple-days' ),
      ),
    )
  );









    $delimiter = '&#124;';
    $wp_customize->add_setting( 'simple_days_title_separator',array(
      'default'    => $delimiter,
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_title_separator',array(
      'label'   => esc_html__( 'the separator for the document title.', 'simple-days'),
      'section' => 'simple_days_layout',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       '&#124;' => esc_html('&#124;'),
       '&mdash;' => esc_html('&mdash;'),
       '&minus;' => esc_html('&minus;'),
       '&amp;' => esc_html('&amp;'),
       '&middot;' => esc_html('&middot;'),
       '&bull;' => esc_html('&bull;'),
       '&#58;' => esc_html('&#58;'),
       '&#166;' => esc_html('&#166;'),
       '&#43;' => esc_html('&#43;'),
       '&#47;' => esc_html('&#47;'),
       '&spades;' => esc_html('&spades;'),
       '&hearts;' => esc_html('&hearts;'),
       '&diams;' => esc_html('&diams;'),
       '&clubs;' => esc_html('&clubs;'),
       '&loz;' => esc_html('&loz;'),
       '&#8984;' => esc_html('&#8984;'),
       '&raquo;' => esc_html('&raquo;'),
       '&gt;' => esc_html('&gt;'),
       '&rarr;' => esc_html('&rarr;'),
       '&rArr;' => esc_html('&rArr;'),
       '&sim;' => esc_html('&sim;'),
       '&hellip;' => esc_html('&hellip;'),
     ),
    ));



    $wp_customize->add_setting( 'simple_days_one_column_post', array(
      'default'           => '',
      'sanitize_callback' => 'sanitize_text_field',
    )
  );
    $wp_customize->add_control( 'simple_days_one_column_post', array(
      'label'    => esc_html__( 'to be single column when you type post id.', 'simple-days' ),
      'description' => esc_html__(' Multiple id must be seperated by a comma.', 'simple-days'),
      'section'  => 'simple_days_layout',
      'type'    => 'text',
    )
  );


    
    $wp_customize->add_section('simple_days_layout_header',array(
      'title' => esc_html__('Layout', 'simple-days').esc_html__('(Header)', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));

    $wp_customize->add_control( new Simple_Days_Image_Select_Control( $wp_customize, 'simple_days_menu_layout', array(
      'label'       => esc_html__( 'Title and Menu Layout', 'simple-days' ),
      'section'     => 'simple_days_layout_header',
      'choices'     => array(
        '1' => array(
          'label' => esc_html__( 'One row Left Title Right Menu', 'simple-days' ),
          'url'   => '%smenu_1.png'
        ),
        '2'    => array(
          'label' => esc_html__( 'One row Left Menu Right Title', 'simple-days' ),
          'url'   => '%smenu_2.png'
        ),
        '3'    => array(
          'label' => esc_html__( 'Two rows Up Title Down Menu', 'simple-days' ),
          'url'   => '%smenu_3.png'
        ),
        '4' => array(
          'label' => esc_html__( 'Two rows Up Menu Down Title', 'simple-days' ),
          'url'   => '%smenu_4.png'
        ),
      ),
    )));

    $wp_customize->add_setting( 'simple_days_menu_layout_title_position', array(
      'default'           => 'center',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_menu_layout_title_position', array(
      'label'    => esc_html__( 'Title display position ( when Two rows )', 'simple-days' ),
      'section'  => 'simple_days_layout_header',
      'type'     => 'select',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'center' => esc_html__( 'Center', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
      ),
    ));
    $wp_customize->add_setting( 'simple_days_menu_layout_menu_position', array(
      'default'           => 'left',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_menu_layout_menu_position', array(
      'label'    => esc_html__( 'Menu display position ( when Two rows )', 'simple-days' ),
      'section'  => 'simple_days_layout_header',
      'type'     => 'select',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'center' => esc_html__( 'Center', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_sticky_header',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_sticky_header',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Sticky header', 'simple-days'),
      'section' => 'simple_days_layout_header',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_header_shadow',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_header_shadow',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Display header shadow', 'simple-days'),
      'section' => 'simple_days_layout_header',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_mobile_header_search',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_mobile_header_search',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Display search button in header for mobile user', 'simple-days'),
      'section' => 'simple_days_layout_header',
      'type' => 'checkbox',
    ));






    
    $wp_customize->add_section('simple_days_font_setting',array(
      'title' => esc_html__('Fonts','simple-days'),
      'panel' => 'simple_days_setting',
    ));


    $normal_fonts = array(
      'none' => '',
      'Arial, Helvetica, sans-serif' => esc_html('Arial, Helvetica, sans-serif'),
      '"Arial Black", Gadget, sans-serif' => esc_html('Arial Black, Gadget, sans-serif'),
      '"Comic Sans MS", cursive, sans-serif' => esc_html('Comic Sans MS, cursive, sans-serif'),
      '"Courier New", Courier, monospace' => esc_html('Courier New, Courier, monospace'),
      'Georgia, serif' => esc_html('Georgia, Helvetica, serif'),
      'Impact, Charcoal, sans-serif' => esc_html('Impact, Charcoal, sans-serif'),
      '"Lucida Console", Monaco, monospace' => esc_html('Lucida Console, Monaco, monospace'),
      '"Palatino Linotype", "Book Antiqua", Palatino, serif' => esc_html('Palatino Linotype, Book Antiqua, Palatino, serif'),
      '"Times New Roman", Times, serif' => esc_html('Times New Roman, Times, serif'),
      '"Trebuchet MS", Helvetica, sans-serif' => esc_html('Trebuchet MS, Helvetica, sans-serif'),
      'Verdana, Geneva, sans-serif' => esc_html('Verdana, Geneva, sans-serif'),
    );

    $google_font_effects = array(
      'none' => '',
      'anaglyph' => esc_html__('Anaglyph', 'simple-days'),
      'brick-sign' => esc_html__('Brick Sign', 'simple-days'),
      'canvas-print' => esc_html__('Canvas Print', 'simple-days'),
      'crackle' => esc_html__('Crackle', 'simple-days'),
      'decaying' => esc_html__('Decaying', 'simple-days'),
      'destruction' => esc_html__('Destruction', 'simple-days'),
      'distressed' => esc_html__('Distressed', 'simple-days'),
      'distressed-wood' => esc_html__('Distressed Wood', 'simple-days'),
      'emboss' => esc_html__('Emboss', 'simple-days'),
      'fire' => esc_html__('Fire', 'simple-days'),
      'fire-animation' => esc_html__('Fire Animation', 'simple-days'),
      'fragile' => esc_html__('Fragile', 'simple-days'),
      'grass' => esc_html__('Grass', 'simple-days'),
      'ice' => esc_html__('Ice', 'simple-days'),
      'mitosis' => esc_html__('Mitosis', 'simple-days'),
      'neon' => esc_html__('Neon', 'simple-days'),
      'outline' => esc_html__('Outline', 'simple-days'),
      'putting-green' => esc_html__('Putting Green', 'simple-days'),
      'scuffed-steel' => esc_html__('Scuffed Steel', 'simple-days'),
      'shadow-multiple' => esc_html__('Shadow Multiple', 'simple-days'),
      'splintered' => esc_html__('Splintered', 'simple-days'),
      'static' => esc_html__('Static', 'simple-days'),
      'stonewash' => esc_html__('Stonewash', 'simple-days'),
      '3d' => esc_html__('Three Dimensional', 'simple-days'),
      '3d-float' => esc_html__('Three Dimensional Float', 'simple-days'),
      'vintage' => esc_html__('Vintage', 'simple-days'),
      'wallpaper' => esc_html__('Wallpaper', 'simple-days'),
    );

    $wp_customize->add_setting( 'simple_days_web_safe_fonts_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_web_safe_fonts_info', array(
      'section' => 'simple_days_font_setting',
      'label' => esc_html__( 'Web Safe Fonts', 'simple-days' ),
      
    //'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Google Fonts', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));

    $wp_customize->add_setting( 'simple_days_font_body',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_body',array(
      'label'   => esc_html_x( 'Body', 'font' , 'simple-days'),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $normal_fonts,
    ));

    $wp_customize->add_setting( 'simple_days_font_headings',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_headings',array(
      'label'   => esc_html_x( 'Headings', 'font' , 'simple-days'),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $normal_fonts,
    ));

    $wp_customize->add_setting( 'simple_days_font_site_title',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_site_title',array(
      'label'   => esc_html_x( 'Site title', 'font' , 'simple-days'),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $normal_fonts,
    ));

    $wp_customize->add_setting( 'simple_days_font_post_title',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_post_title',array(
      'label'   => esc_html_x( 'Post title', 'font' , 'simple-days'),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $normal_fonts,
    ));

    $wp_customize->add_setting( 'simple_days_google_fonts_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_google_fonts_info', array(
      'section' => 'simple_days_font_setting',
      'label' => esc_html__( 'Google Fonts', 'simple-days' ),
      
      'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'),esc_html__( 'Web Safe Fonts', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));


    get_template_part( 'inc/googlefonts' );
    $googlefonts = simple_days_google_fonts_list();
    $wp_customize->add_setting( 'simple_days_font_body_google',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_body_google',array(
      'label'   => esc_html_x( 'Body', 'font' , 'simple-days'),
      
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Body font', 'simple-days').esc_html__( '(Web Safe Fonts)', 'simple-days')),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $googlefonts,
    ));


    $wp_customize->add_setting( 'simple_days_font_headings_google',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_headings_google',array(
      'label'   => esc_html_x( 'Headings', 'font' , 'simple-days'),
      
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Headings font', 'simple-days').esc_html__( '(Web Safe Fonts)', 'simple-days'), 'simple-days'),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $googlefonts,
    ));

    $wp_customize->add_setting( 'simple_days_font_site_title_google',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_site_title_google',array(
      'label'   => esc_html_x( 'Site title', 'font' , 'simple-days'),
      
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Site title font', 'simple-days').esc_html__( '(Web Safe Fonts)', 'simple-days'), 'simple-days'),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $googlefonts,
    ));



    $wp_customize->add_setting( 'simple_days_font_post_title_google',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_post_title_google',array(
      'label'   => esc_html_x( 'Post title', 'font' , 'simple-days'),
      
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Site title font', 'simple-days').esc_html__( '(Web Safe Fonts)', 'simple-days'), 'simple-days'),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $googlefonts,
    ));

    $wp_customize->add_setting( 'simple_days_font_site_title_google_effects_1',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_site_title_google_effects_1',array(
      'label'   => esc_html_x( 'Site title', 'font' , 'simple-days').esc_html__( '(Effect)', 'simple-days'),
      
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Body font', 'simple-days').esc_html__( '(Web Safe Fonts)', 'simple-days')),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $google_font_effects,
    ));
    $wp_customize->add_setting( 'simple_days_font_site_title_google_effects_2',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_font_site_title_google_effects_2',array(
      'label'   => esc_html_x( 'Post title', 'font' , 'simple-days').esc_html__( '(Effect)', 'simple-days'),
      
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Body font', 'simple-days').esc_html__( '(Web Safe Fonts)', 'simple-days')),
      'section' => 'simple_days_font_setting',
      'type' => 'select',
      'choices' => $google_font_effects,
    ));

    if( get_locale() == 'ja' ) {


      $wp_customize->add_setting( 'simple_days_local_fonts_japanese_info', array(
        'sanitize_callback' => 'sanitize_text_field',
      ));
      $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_local_fonts_japanese_info', array(
        'section' => 'simple_days_font_setting',
        'label' => esc_html__( 'Local Fonts Japanese', 'simple-days' ),
        
        'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Google Fonts', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
      )));

      $normal_jp_fonts = array(
        'none' => '',
        esc_html__('Verdana, "YuGothic", YuGothic, "Hiragino Kaku Gothic ProN W3", "Hiragino Kaku Gothic ProN", "Meiryo", Meiryo, sans-serif', 'simple-days') => esc_html__('Verdana, "YuGothic", YuGothic, "Hiragino Kaku Gothic ProN W3", "Hiragino Kaku Gothic ProN", "Meiryo", Meiryo, sans-serif', 'simple-days'),
        esc_html__('"Times New Roman", "YuMincho", YuMincho, "Hiragino Mincho ProN W3", "Hiragino Mincho ProN", "Meiryo", Meiryo, serif', 'simple-days') => esc_html__('"Times New Roman", "YuMincho", YuMincho, "Hiragino Mincho ProN W3", "Hiragino Mincho ProN", "Meiryo", Meiryo, serif', 'simple-days'),
        esc_html__('"Osaka", Osaka-mono, "MS Gothic", "MS Gothic", monospace', 'simple-days') => esc_html__('"Osaka", Osaka-mono, "MS Gothic", "MS Gothic", monospace', 'simple-days'),
        esc_html__('Verdana, Roboto, "Droid Sans", "YuGothic", YuGothic, "Hiragino Kaku Gothic ProN W3", "Hiragino Kaku Gothic ProN", "Meiryo", Meiryo, sans-serif', 'simple-days') => esc_html__('Verdana, Roboto, "Droid Sans", "YuGothic", YuGothic, "Hiragino Kaku Gothic ProN W3", "Hiragino Kaku Gothic ProN", "Meiryo", Meiryo, sans-serif', 'simple-days'),
      );

      $wp_customize->add_setting( 'simple_days_font_body_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_body_jp',array(
        'label'   => esc_html_x( 'Body', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Body font', 'simple-days').esc_html__( '(Google Fonts)', 'simple-days')),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $normal_jp_fonts,
      ));
      $wp_customize->add_setting( 'simple_days_font_headings_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_headings_jp',array(
        'label'   => esc_html_x( 'Headings', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Headings font', 'simple-days').esc_html__( '(Google Fonts)', 'simple-days'), 'simple-days'),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $normal_jp_fonts,
      ));
      $wp_customize->add_setting( 'simple_days_font_site_title_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_site_title_jp',array(
        'label'   => esc_html_x( 'Site title', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Site title font', 'simple-days').esc_html__( '(Google Fonts)', 'simple-days'), 'simple-days'),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $normal_jp_fonts,
      ));

      $wp_customize->add_setting( 'simple_days_font_post_title_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_post_title_jp',array(
        'label'   => esc_html_x( 'Post title', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Site title font', 'simple-days').esc_html__( '(Google Fonts)', 'simple-days'), 'simple-days'),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $normal_jp_fonts,
      ));

      $wp_customize->add_setting( 'simple_days_google_fonts_japanese_info', array(
        'sanitize_callback' => 'sanitize_text_field',
      ));
      $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_google_fonts_japanese_info', array(
        'section' => 'simple_days_font_setting',
        'label' => esc_html__( 'Google Fonts Japanese', 'simple-days' ),
        
        'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'),esc_html__( 'Local Fonts Japanese', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
      )));

      $google_jp_fonts = array(
        'none' => '',
        'M PLUS 1p' => esc_html('M PLUS 1p'),
        'M PLUS Rounded 1c' => esc_html('M PLUS Rounded 1c'),
        'Sawarabi Mincho' => esc_html__('Sawarabi Mincho', 'simple-days'),
        'Sawarabi Gothic' => esc_html__('Sawarabi Gothic', 'simple-days'),
        'Kosugi' => esc_html('Kosugi'),
        'Kosugi Maru' => esc_html('Kosugi Maru'),
        'Hannari' => esc_html__('Hannari', 'simple-days'),
        'Kokoro' => esc_html__('Kokoro', 'simple-days'),
        'Nikukyu' => esc_html__('Nikukyu', 'simple-days'),
        'Nico Moji' => esc_html__('Nico Moji', 'simple-days'),
        'Noto Sans Japanese' => esc_html('Noto Sans Japanese'),
        'Noto Sans JP' => esc_html('Noto Sans JP'),
      );

      $wp_customize->add_setting( 'simple_days_font_body_google_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_body_google_jp',array(
        'label'   => esc_html_x( 'Body', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Body font', 'simple-days').esc_html__( '(Local Fonts Japanese)', 'simple-days'), 'simple-days'),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $google_jp_fonts,
      ));

      $wp_customize->add_setting( 'simple_days_font_headings_google_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_headings_google_jp',array(
        'label'   => esc_html_x( 'Headings', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Headings font', 'simple-days').esc_html__( '(Local Fonts Japanese)', 'simple-days'), 'simple-days'),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $google_jp_fonts,
      ));
      $wp_customize->add_setting( 'simple_days_font_site_title_google_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_site_title_google_jp',array(
        'label'   => esc_html_x( 'Site title', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Site title font', 'simple-days').esc_html__( '(Local Fonts Japanese)', 'simple-days'), 'simple-days'),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $google_jp_fonts,
      ));



      $wp_customize->add_setting( 'simple_days_font_post_title_google_jp',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_post_title_google_jp',array(
        'label'   => esc_html_x( 'Post title', 'font' , 'simple-days'),
        
        //'description' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Site title font', 'simple-days').esc_html__( '(Local Fonts Japanese)', 'simple-days'), 'simple-days'),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $google_jp_fonts,
      ));

      $wp_customize->add_setting( 'simple_days_font_site_title_google_jp_effects_1',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_site_title_google_jp_effects_1',array(
        'label'   => esc_html_x( 'Site title', 'font' , 'simple-days').esc_html__( '(Effect)', 'simple-days'),
        
        //'description' => sprintf(esc_html__('This option does not apply to %s.', 'simple-days'), esc_html__('Hannari', 'simple-days').','.esc_html__('Kokoro', 'simple-days').','.esc_html__('Nikukyu', 'simple-days').','.esc_html__('Nico Moji', 'simple-days').','.esc_html('Noto Sans Japanese').','.esc_html('Noto Sans JP')),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $google_font_effects,
      ));
      $wp_customize->add_setting( 'simple_days_font_site_title_google_jp_effects_2',array(
        'default'    => 'none',
        'sanitize_callback' => 'wp_kses_post',
      ));
      $wp_customize->add_control( 'simple_days_font_site_title_google_jp_effects_2',array(
        'label'   => esc_html_x( 'Post title', 'font' , 'simple-days').esc_html__( '(Effect)', 'simple-days'),
        
        //'description' => sprintf(esc_html__('This option does not apply to %s.', 'simple-days'), esc_html__('Hannari', 'simple-days').','.esc_html__('Kokoro', 'simple-days').','.esc_html__('Nikukyu', 'simple-days').','.esc_html__('Nico Moji', 'simple-days').','.esc_html('Noto Sans Japanese').','.esc_html('Noto Sans JP')),
        'section' => 'simple_days_font_setting',
        'type' => 'select',
        'choices' => $google_font_effects,
      ));
    }// Japanese only












    function simple_days_sanitize_radio( $input, $setting ){
         //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
      $input = sanitize_key($input);
            //get the list of possible radio box options
      $choices = $setting->manager->get_control( $setting->id )->choices;
            //return input if valid or return default option
      return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    function simple_days_sanitize_select( $input, $setting ){
            //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
      $input = sanitize_key($input);
            //get the list of possible select options
      $choices = $setting->manager->get_control( $setting->id )->choices;
            //return input if valid or return default option
      return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    function simple_days_sanitize_image_file( $file, $setting ) {
            //allowed file types
      $mimes = array(
        'jpg|jpeg|jpe' => 'assets/images/jpeg',
        'gif'          => 'assets/images/gif',
        'png'          => 'assets/images/png'
      );
            //check file type from file name
      $file_ext = wp_check_filetype( $file, $mimes );
            //if file has a valid mime type return it, otherwise return default
      return ( $file_ext['ext'] ? $file : $setting->default );
    }

    //select sanitization function
    function simple_days_sns_name_sanitize($input){
          //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
      $input = sanitize_key($input);
          //get the list of possible select options
      $choices = array(
        'none'            => '-',
        'amazon'          => 'Amazon',
        'buffer'          => 'buffer',
        'codepen'         => 'CodePen',
        'digg'            => 'digg',
        'mail'            => 'Email',
        'evernote'        => 'Evernote',
        'facebook'        => 'Facebook',
        'feedly'          => 'Feedly',
        'flickr'          => 'Flickr',
        'github'          => 'Github',
        'googleplus'      => 'Google+',
        'hatenabookmark'  => 'Hatena Bookmark',
        'instagram'       => 'Instagram',
        'line'            => 'Line',
        'linkedin'        => 'LinkedIn',
        'meetup'          => 'Meetup',
        'messenger'       => 'Messenger',
        'pinterest'       => 'Pinterest',
        'pocket'          => 'Pocket',
        'reddit'          => 'Reddit',
        'rss'             => 'RSS',
        'soundcloud'      => 'SoundCloud',
        'tumblr'          => 'Tumblr',
        'twitter'         => 'Twitter',
        'whatsapp'        => 'WhatsApp',
        'vimeo'           => 'Vimeo',
        'youtube'         => 'Youtube',
      );
          //return input if valid or return default option
      return ( array_key_exists( $input, $choices ) ? $input : '' );
    }


    
    $wp_customize->add_section('simple_days_index_page_setting',array(
      'title' => esc_html__('Index Page', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));
    


    $wp_customize->add_setting( 'simple_days_index_layout_list', array(
      'default'           => 'list',
      'sanitize_callback' => 'sanitize_key'
    ) );
    $wp_customize->add_control( new Simple_Days_Image_Select_Control( $wp_customize, 'simple_days_index_layout_list', array(
      'label'       => esc_html__( 'Layout', 'simple-days' ),
      'description' => __( 'Choose a layout for the blog posts.', 'simple-days' ),
      'section'     => 'simple_days_index_page_setting',
      'choices'     => array(
        'list' => array(
          'label' => esc_html__( 'List layout', 'simple-days' ),
          'url'   => '%slayout_list.png'
        ),
        'grid2'    => array(
          'label' => esc_html__( 'Two grid layout', 'simple-days' ),
          'url'   => '%slayout_grid2.png'
        ),
        'grid3'    => array(
          'label' => esc_html__( 'Three grid layout', 'simple-days' ),
          'url'   => '%slayout_grid3.png'
        ),
      ),
    )));





    
    $wp_customize->add_setting('index_thumbnail',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('index_thumbnail',array(
      'section' => 'simple_days_index_page_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'index_thumbnail', array(
     'selector' => '.post_card_thum',
   ));
    $wp_customize->add_setting( 'simple_days_index_thumbnail', array(
      'default'           => 'left',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_index_thumbnail', array(
      'label'    => esc_html__( 'Thumbnail display position', 'simple-days' ),
    //'description' => esc_html__('Date and category disappears when you select hide.', 'simple-days'),
      'section'  => 'simple_days_index_page_setting',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ).esc_html__( '(Up)', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ).esc_html__( '(Down)', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));



    
    $wp_customize->add_setting('post_date_wrap',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('post_date_wrap',array(
      'section' => 'simple_days_index_page_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'post_date_wrap', array(
     'selector' => '.post_date_wrap',
   ));
    $wp_customize->add_setting( 'simple_days_top_date_format', array(
      'default'           => '1',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    )
  );
    $wp_customize->add_control( 'simple_days_top_date_format', array(
      'label'    => esc_html__( 'post date display format', 'simple-days' ),
      'section'  => 'simple_days_index_page_setting',
      'type'     => 'radio',
      'choices'  => array(
        '1' => esc_html__( 'day-month-year', 'simple-days' ),
        '2' => esc_html__( 'month-day-year', 'simple-days' ),
      ),
    ));
    $wp_customize->add_setting( 'simple_days_top_date_wrap', array(
      'default'           => '1',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    )
  );
    $wp_customize->add_control( 'simple_days_top_date_wrap', array(
      'label'    => esc_html__( 'post date display shape', 'simple-days' ),
      'description' => esc_html__('around of a line appear rounded or squared', 'simple-days'),
      'section'  => 'simple_days_index_page_setting',
      'type'     => 'radio',
      'choices'  => array(
        '1' => esc_html__( 'Circle', 'simple-days' ),
        '2' => esc_html__( 'Square', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_index_date_position', array(
      'default'           => 'left',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_index_date_position', array(
      'label'    => esc_html__( 'Post date display position', 'simple-days' ),
      'section'  => 'simple_days_index_page_setting',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));


    
    $wp_customize->add_setting('index_category',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('index_category',array(
      'section' => 'simple_days_index_page_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'index_category', array(
      'selector' => '.post_card_category',
    ));


    $wp_customize->add_setting( 'simple_days_index_category_position', array(
      'default'           => 'right',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_index_category_position', array(
      'label'    => esc_html__( 'Post category display position', 'simple-days' ),
      'section'  => 'simple_days_index_page_setting',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));


    
    $wp_customize->add_setting('excerpt_length',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('excerpt_length',array(
      'section' => 'simple_days_index_page_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'excerpt_length', array(
     'selector' => '.post_card .summary',
   ));
    $wp_customize->add_setting( 'simple_days_excerpt_length_customize', array(
      'default' => 150,
      'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control( 'simple_days_excerpt_length_customize', array(
      'label' => esc_html__( 'Excerpt length', 'simple-days' ),
      'description' => esc_html__('default&#58;', 'simple-days').esc_html('150'),
      'section' => 'simple_days_index_page_setting',
      'type' => 'number',
      'input_attrs' => array(
        'min' => '0', 'step' => '1', 'max' => '500',),
    ));

    $delimiter = '&hellip;';
    $wp_customize->add_setting( 'simple_days_excerpt_ellipsis',array(
      'default'    => $delimiter,
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_excerpt_ellipsis',array(
      'label'   => esc_html__( 'Ellipsis', 'simple-days'),
      'section' => 'simple_days_index_page_setting',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       '&hellip;' => esc_html('&hellip;'),
       '[&hellip;]' => esc_html('[&hellip;]'),
       '&#8229;' => esc_html('&#8229;'),
     ),
    ));







    
    $wp_customize->add_setting('more_read',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('more_read',array(
      'section' => 'simple_days_index_page_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'more_read', array(
      'selector' => '.more_read',
    ));
    $wp_customize->add_setting( 'simple_days_read_more_position', array(
      'default'           => 'right',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_read_more_position', array(
      'label'    => esc_html__( 'Read More display position', 'simple-days' ),
      'section'  => 'simple_days_index_page_setting',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'center' => esc_html__( 'Center', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_index_list_widget_position', array(
      'default'           => 'after',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_index_list_widget_position', array(
      'label'    => esc_html__( 'How to Insert Index list widget area', 'simple-days' ),
      'section'  => 'simple_days_index_page_setting',
      'type'     => 'radio',
      'choices'  => array(
        'after' => esc_html__( 'Just after post', 'simple-days' ),
        'every' => esc_html__( 'Every post', 'simple-days' ),
      ),
    ));


    $wp_customize->add_setting( 'simple_days_index_list_widget_number', array(
      'default' => 3,
      'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control( 'simple_days_index_list_widget_number', array(
      'label' => esc_html__( 'Count of post for above configuring', 'simple-days' ),
        //'description' => esc_html__( 'Count of post for above configuring', 'simple-days' ),
        'section' => 'simple_days_index_page_setting', // Add a default or your own section
        'type' => 'number',
        'input_attrs' => array(
          'min' => 1, 'step' => 1, 'max' => 10,
        ),
      ));






    
    $wp_customize->add_section('simple_days_posts',array(
      'title' => esc_html__('Posts','simple-days'),
      'panel' => 'simple_days_setting',
    ));


    
    $wp_customize->add_setting('posts_thumbnail',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('posts_thumbnail',array(
      'section' => 'simple_days_posts',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'posts_thumbnail', array(
     'selector' => '.posts_thum',
   ));

    $wp_customize->add_setting( 'simple_days_posts_thumbnail',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_posts_thumbnail',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Thumbnail', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_posts_title_over_thumbnail',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_posts_title_over_thumbnail',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Post title over the thumbnail.', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_posts_full_width_thumbnail',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_posts_full_width_thumbnail',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Full width thumbnail at under the header.', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting('author_position',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('author_position',array(
      'section' => 'simple_days_posts',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'author_position', array(
     'selector' => '.post_author',
   ));
    $wp_customize->add_setting( 'simple_days_posts_author_position', array(
      'default'           => 'right',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_posts_author_position', array(
      'label'    => esc_html__( 'Author display position', 'simple-days' ),
      'section'  => 'simple_days_posts',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_posts_author_icon',array(
      'default'    => 'fa-user',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_posts_author_icon',array(
      'label'   => esc_html__( 'Author icon', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-user' => '&#xf007; fa-user',
       'fa-user-o' => '&#xf2c0; fa-user-o',
       'fa-user-circle' => '&#xf2bd; fa-user-circle',
       'fa-user-circle-o' => '&#xf2be; fa-user-circle-o',
       'fa-users' => '&#xf0c0; fa-users',
       'fa-user-secret' => '&#xf21b; fa-user-secret',
       'fa-female' => '&#xf182; fa-female',
       'fa-male' => '&#xf183; fa-male',
       'fa-child' => '&#xf1ae; fa-child',
       'fa-id-badge' => '&#xf2c1; fa-id-badge',
       'fa-smile-o' => '&#xf118; fa-smile-o',
       'fa-star-o' => '&#xf006; fa-star-o',
       'fa-star' => '&#xf005; fa-star',
       'fa-heart' => '&#xf004; fa-heart',
       'fa-heart-o' => '&#xf08a; fa-heart-o',
     ),
    ));


    
    $wp_customize->add_setting('date_position',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('date_position',array(
      'section' => 'simple_days_posts',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'date_position', array(
     'selector' => '.post_date',
   ));
    $wp_customize->add_setting( 'simple_days_posts_date_position', array(
      'default'           => 'right',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_posts_date_position', array(
      'label'    => esc_html__( 'Post date display position', 'simple-days' ),
      'section'  => 'simple_days_posts',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_posts_date_display', array(
      'default'           => 'both',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_posts_date_display', array(
      'label'    => esc_html__( 'Display method Post date', 'simple-days' ),
      'section'  => 'simple_days_posts',
      'type'     => 'radio',
      'choices'  => array(
        'date' => esc_html__( 'Only Date', 'simple-days' ),
        'update' => esc_html__( 'Date hide when post have update.', 'simple-days' ),
        'both' => esc_html__( 'Both', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_posts_date_icon',array(
      'default'    => 'fa-calendar-check-o',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_posts_date_icon',array(
      'label'   => esc_html__( 'Date icon', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-calendar-check-o' => '&#xf274; fa-calendar-check-o',
       'fa-clock-o' => '&#xf017; fa-clock-o',
       'fa-calendar-o' => '&#xf133; fa-calendar-o',
       'fa-calendar' => '&#xf073; fa-calendar',
       'fa-history' => '&#xf1da; fa-history',
       'fa-refresh' => '&#xf021; fa-refresh',
     ),
    ));

    $wp_customize->add_setting( 'simple_days_posts_up_date_icon',array(
      'default'    => 'fa-history',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_posts_up_date_icon',array(
      'label'   => esc_html__( 'Update icon', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-history' => '&#xf1da; fa-history',
       'fa-refresh' => '&#xf021; fa-refresh',
       'fa-calendar-o' => '&#xf133; fa-calendar-o',
       'fa-calendar' => '&#xf073; fa-calendar',
       'fa-calendar-check-o' => '&#xf274; fa-calendar-check-o',
       'fa-clock-o' => '&#xf017; fa-clock-o',
     ),
    ));


    $wp_customize->add_setting('post_category_icon',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('post_category_icon',array(
      'section' => 'simple_days_posts',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'post_category_icon', array(
     'selector' => '.post_category',
   ));

    $wp_customize->add_setting( 'simple_days_posts_category_icon',array(
      'default'    => 'fa-folder-o',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_posts_category_icon',array(
      'label'   => esc_html__( 'Category icon', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-folder-o' => '&#xf114; fa-folder-o',
       'fa-folder-open-o' => '&#xf115; fa-folder-open-o',
       'fa-folder' => '&#xf07b; fa-folder',
       'fa-folder-open' => '&#xf07c; folder-open',
     ),
    ));

    $wp_customize->add_setting('post_tag_icon',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('post_tag_icon',array(
      'section' => 'simple_days_posts',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'post_tag_icon', array(
     'selector' => '.post_tag',
   ));
    $wp_customize->add_setting( 'simple_days_posts_tag_icon',array(
      'default'    => 'fa-tag',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_posts_tag_icon',array(
      'label'   => esc_html__( 'Tag icon', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-tag' => '&#xf02b; fa-tag',
       'fa-tags' => '&#xf02c; fa-tags',
     ),
    ));

    
    $wp_customize->add_setting('author_profile',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('author_profile',array(
      'section' => 'simple_days_posts',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'author_profile', array(
     'selector' => '.tabs',
   ));

    $wp_customize->add_setting( 'simple_days_posts_author_profile',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('simple_days_posts_author_profile',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('About the author(Author profile)', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'checkbox',
    ));


    
    $wp_customize->add_setting('related_post',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('related_post',array(
      'section' => 'simple_days_posts',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'related_post', array(
     'selector' => '#related_posts',
   ));

    $wp_customize->add_setting( 'simple_days_posts_related_post',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_posts_related_post',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Related Posts', 'simple-days'),
      'section' => 'simple_days_posts',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_posts_related_post_number', array(
      'default' => 9,
      'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control( 'simple_days_posts_related_post_number', array(
      'label' => esc_html__( 'Related Posts view count.', 'simple-days' ),
      'description' => esc_html__( '(min1 max18)', 'simple-days' ),
        'section' => 'simple_days_posts', // Add a default or your own section
        'type' => 'number',
        'input_attrs' => array(
          'min' => '1', 'step' => '1', 'max' => '18',
        ),
      ));

    $sort_order_list =array(
     'breadcrumbs','title','date','author','pv','thumbnail','content','widget','page_link','cta','share','author_profile','related','category','tag','pagenation','comment',
   );
    
    $wp_customize->add_setting( 'simple_days_posts_sortable',
     array(
      'default'   => $sort_order_list,
      'sanitize_callback' => 'wp_kses_post',
    )
   );
    $wp_customize->add_control( new Simple_Days_Posts_Sortable_Custom_Control( $wp_customize, 'simple_days_posts_sortable',
     array(
      'type' => 'simple_days_posts_sortable',
      'label' => esc_html__( 'Reorder Sections', 'simple-days' ),
      'description' => esc_html__( 'drag the columns to rearrange their order.', 'simple-days' ),
      'section' => 'simple_days_posts',

      'choices'  => get_theme_mod( 'simple_days_posts_sortable',$sort_order_list),
    )
   ) );






    
    $wp_customize->add_section('simple_days_page',array(
      'title' => esc_html_x('Page', 'customizer' ,'simple-days'),
      'panel' => 'simple_days_setting',
    ));
    
    $wp_customize->add_setting('page_thumbnail',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('page_thumbnail',array(
      'section' => 'simple_days_page',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'page_thumbnail', array(
     'selector' => '.page_thum',
   ));

    $wp_customize->add_setting( 'simple_days_page_thumbnail',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_page_thumbnail',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Thumbnail', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_page_title_over_thumbnail',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_page_title_over_thumbnail',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Page title over the thumbnail.', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_page_full_width_thumbnail',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_page_full_width_thumbnail',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Full width thumbnail at under the header.', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'checkbox',
    ));

    
    $wp_customize->add_setting('page_author_position',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('page_author_position',array(
      'section' => 'simple_days_page',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'page_author_position', array(
     'selector' => '.page_author',
   ));
    $wp_customize->add_setting( 'simple_days_page_author_position', array(
      'default'           => 'none',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_page_author_position', array(
      'label'    => esc_html__( 'Author display position', 'simple-days' ),
      'section'  => 'simple_days_page',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_page_author_icon',array(
      'default'    => 'fa-user',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_page_author_icon',array(
      'label'   => esc_html__( 'Author icon', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-user' => '&#xf007; fa-user',
       'fa-user-o' => '&#xf2c0; fa-user-o',
       'fa-user-circle' => '&#xf2bd; fa-user-circle',
       'fa-user-circle-o' => '&#xf2be; fa-user-circle-o',
       'fa-users' => '&#xf0c0; fa-users',
       'fa-user-secret' => '&#xf21b; fa-user-secret',
       'fa-female' => '&#xf182; fa-female',
       'fa-male' => '&#xf183; fa-male',
       'fa-child' => '&#xf1ae; fa-child',
       'fa-id-badge' => '&#xf2c1; fa-id-badge',
       'fa-smile-o' => '&#xf118; fa-smile-o',
       'fa-star-o' => '&#xf006; fa-star-o',
       'fa-star' => '&#xf005; fa-star',
       'fa-heart' => '&#xf004; fa-heart',
       'fa-heart-o' => '&#xf08a; fa-heart-o',
     ),
    ));


    
    $wp_customize->add_setting('page_date_position',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('page_date_position',array(
      'section' => 'simple_days_page',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'page_date_position', array(
     'selector' => '.page_date',
   ));
    $wp_customize->add_setting( 'simple_days_page_date_position', array(
      'default'           => 'none',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_page_date_position', array(
      'label'    => esc_html__( 'Post date display position', 'simple-days' ),
      'section'  => 'simple_days_page',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_page_date_display', array(
      'default'           => 'both',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_page_date_display', array(
      'label'    => esc_html__( 'Display method Post date', 'simple-days' ),
      'section'  => 'simple_days_page',
      'type'     => 'radio',
      'choices'  => array(
        'date' => esc_html__( 'Only Date', 'simple-days' ),
        'update' => esc_html__( 'Date hide when post have update.', 'simple-days' ),
        'both' => esc_html__( 'Both', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_page_date_icon',array(
      'default'    => 'fa-calendar-check-o',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_page_date_icon',array(
      'label'   => esc_html__( 'Date icon', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-calendar-check-o' => '&#xf274; fa-calendar-check-o',
       'fa-clock-o' => '&#xf017; fa-clock-o',
       'fa-calendar-o' => '&#xf133; fa-calendar-o',
       'fa-calendar' => '&#xf073; fa-calendar',
       'fa-history' => '&#xf1da; fa-history',
       'fa-refresh' => '&#xf021; fa-refresh',
     ),
    ));

    $wp_customize->add_setting( 'simple_days_page_up_date_icon',array(
      'default'    => 'fa-history',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_page_up_date_icon',array(
      'label'   => esc_html__( 'Update icon', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-history' => '&#xf1da; fa-history',
       'fa-refresh' => '&#xf021; fa-refresh',
       'fa-calendar-o' => '&#xf133; fa-calendar-o',
       'fa-calendar' => '&#xf073; fa-calendar',
       'fa-calendar-check-o' => '&#xf274; fa-calendar-check-o',
       'fa-clock-o' => '&#xf017; fa-clock-o',
     ),
    ));

    $wp_customize->add_setting('page_folder_icon',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('page_folder_icon',array(
      'section' => 'simple_days_page',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'page_folder_icon', array(
     'selector' => '.page_folder',
   ));
    $wp_customize->add_setting( 'simple_days_page_category_icon',array(
      'default'    => 'fa-folder-o',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_page_category_icon',array(
      'label'   => esc_html__( 'Category icon', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-folder-o' => '&#xf114; fa-folder-o',
       'fa-folder-open-o' => '&#xf115; fa-folder-open-o',
       'fa-folder' => '&#xf07b; fa-folder',
       'fa-folder-open' => '&#xf07c; folder-open',
     ),
    ));

    $wp_customize->add_setting('page_tag_icon',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('page_tag_icon',array(
      'section' => 'simple_days_page',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'page_tag_icon', array(
     'selector' => '.page_tag',
   ));
    $wp_customize->add_setting( 'simple_days_page_tag_icon',array(
      'default'    => 'fa-tag',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_page_tag_icon',array(
      'label'   => esc_html__( 'Tag icon', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-tag' => '&#xf02b; fa-tag',
       'fa-tags' => '&#xf02c; fa-tags',
     ),
    ));

    $wp_customize->add_setting( 'simple_days_page_social_share',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_page_social_share',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Social share', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_page_author_profile',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_page_author_profile',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('About the author(Author profile)', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_page_related_page',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_page_related_page',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Related Pages', 'simple-days').'<br />'.esc_html__('The plugin [Pages with category and tag] is needed', 'simple-days'),
      'section' => 'simple_days_page',
      'type' => 'checkbox',
    ));

    /*
    $wp_customize->add_setting( 'simple_days_page_install_pwcat', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_page_install_pwcat', array(
      'section' => 'simple_days_page',
    //'label' => esc_html__( 'Install Plugins', 'simple-days' ),
    'content' => '<a href="'. esc_url( admin_url( 'plugin-install.php?tab=search&type=author&s=yahman' ) ).'" class="button button-secondary">'.esc_html__( 'Install Plugins', 'simple-days' ).'</a>',
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));
    */

    $wp_customize->add_setting( 'simple_days_page_install_pwcat', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_plugin_install_Custom_Content( $wp_customize, 'simple_days_page_install_pwcat', array(
      'section' => 'simple_days_page',
      
      'label' => sprintf(esc_html__('Install Plugin [ %s ]', 'simple-days'), esc_html__( 'Pages with category and tag', 'simple-days')),
      'plugin' => array(
       'name' => esc_html__('Pages with category and tag', 'simple-days'),
       'dir' => 'pages-with-category-and-tag',
       'filename' => 'pages_with_category_and_tag.php',
     ),
    )));

    $wp_customize->add_setting( 'simple_days_page_related_post_number', array(
      'default' => 9,
      'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control( 'simple_days_page_related_post_number', array(
      'label' => esc_html__( 'Related Pages view count.', 'simple-days' ),
      'description' => esc_html__( 'multiples of 3 (min3 max18)', 'simple-days' ),
        'section' => 'simple_days_page', // Add a default or your own section
        'type' => 'number',
        'input_attrs' => array(
          'min' => '3', 'step' => '3', 'max' => '18',
        ),
      ));

    $wp_customize->add_setting( 'simple_days_page_sortable',
     array(
      'default'   => $sort_order_list,
      'sanitize_callback' => 'wp_kses_post',
    )
   );
    $wp_customize->add_control( new Simple_Days_Posts_Sortable_Custom_Control( $wp_customize, 'simple_days_page_sortable',
     array(
      'type' => 'simple_days_posts_sortable',
      'label' => esc_html__( 'Reorder Sections', 'simple-days' ),
      'description' => esc_html__( 'drag the columns to rearrange their order.', 'simple-days' ),
      'section' => 'simple_days_page',

      'choices'  => get_theme_mod( 'simple_days_page_sortable',$sort_order_list),
    )
   ) );


    $wp_customize->add_section('simple_days_menu_bar',array(
      'title' => esc_html__('Menu Icon','simple-days'),
      'panel' => 'simple_days_setting',
    ));
    get_template_part( 'inc/fontawsome', 'list' );
    $fontawesomelist = get_query_var('fontawesomelist');

    $wp_customize->add_setting( 'simple_days_menu_bar_fontawsome_icon_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_menu_bar_fontawsome_icon_info', array(
      'section' => 'simple_days_menu_bar',
    //'label' => esc_html__( 'Footer Menu Icon', 'simple-days' ),
      
      'content' => '<a href="'.esc_url('https://fontawesome.com/v4.7.0/icons/').'" target="_blank">'.__( 'FontAwesome 4 Icon List' , 'simple-days').'</a><br /><br />'.'<a href="'.esc_js('javascript:wp.customize.section(\"simple_days_script_css\").focus();' ).'">'.esc_html__( 'You need full icons?', 'simple-days' ).'</a>',
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));

    $wp_customize->add_setting( 'simple_days_menu_bar_h_icon_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_menu_bar_h_icon_info', array(
      'section' => 'simple_days_menu_bar',
      'label' => esc_html__( 'Header Menu Icon', 'simple-days' ),
      
    //'content' => '<a href="'.esc_url('https://fontawesome.com/v4.7.0/icons/').'" target="_blank">'.__( 'Icon List' , 'simple-days').'</a>',
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));


    $i = 1;
    while($i <= 10){
      $wp_customize->add_setting( 'simple_days_menu_bar_h_icon_'.$i,array(
        'default'       => 'none',
        'sanitize_callback' => 'wp_strip_all_tags',
      ));
      $wp_customize->add_control('simple_days_menu_bar_h_icon_'.$i,array(
        
        'label'   => sprintf(esc_html__( 'Icon #%s', 'simple-days'),$i),
        'section' => 'simple_days_menu_bar',
        'type'    => 'select',
        'choices' => $fontawesomelist,
      ));

      $wp_customize->add_setting( 'simple_days_menu_bar_h_icon_color_'.$i,array(
        'default'    => '',
        'sanitize_callback' => 'sanitize_text_field',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_menu_bar_h_icon_color_'.$i, array(
        
        'label'      => sprintf(esc_html__( 'Icon color #%s', 'simple-days'),$i),
        'section'    => 'simple_days_menu_bar',
      )));

      $wp_customize->add_setting( 'simple_days_menu_bar_h_icon_after_'.$i,array(
        'default'    => false,
        'sanitize_callback' => 'sanitize_text_field',
      ));
      $wp_customize->add_control( 'simple_days_menu_bar_h_icon_after_'.$i,array(
        'label'   => esc_html__( 'after icon', 'simple-days'),
        //'description' => esc_html__('Current name', 'simple-days'),
        'section' => 'simple_days_menu_bar',
        'type' => 'checkbox',
      ));

      $i++;
    }

    $wp_customize->add_setting( 'simple_days_menu_bar_f_icon_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_menu_bar_f_icon_info', array(
      'section' => 'simple_days_menu_bar',
      'label' => esc_html__( 'Footer Menu Icon', 'simple-days' ),
      
    //'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'),esc_html__( 'Local Fonts Japanese', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));

    $i = 1;
    while($i <= 10){
      $wp_customize->add_setting( 'simple_days_menu_bar_f_icon_'.$i,array(
        'default'       => 'none',
        'sanitize_callback' => 'wp_strip_all_tags',
      ));
      $wp_customize->add_control('simple_days_menu_bar_f_icon_'.$i,array(
        
        'label'   => sprintf(esc_html__( 'Icon #%s', 'simple-days'),$i),
        'section' => 'simple_days_menu_bar',
        'type'    => 'select',
        'choices' => $fontawesomelist,
      ));

      $wp_customize->add_setting( 'simple_days_menu_bar_f_icon_color_'.$i,array(
        'default'    => '',
        'sanitize_callback' => 'sanitize_text_field',
      ));
      $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_menu_bar_f_icon_color_'.$i, array(
        
        'label'      => sprintf(esc_html__( 'Icon color #%s', 'simple-days'),$i),
        'section'    => 'simple_days_menu_bar',
      )));

      $wp_customize->add_setting( 'simple_days_menu_bar_f_icon_after_'.$i,array(
        'default'    => false,
        'sanitize_callback' => 'sanitize_text_field',
      ));
      $wp_customize->add_control( 'simple_days_menu_bar_f_icon_after_'.$i,array(
        'label'   => esc_html__( 'after icon', 'simple-days'),
        //'description' => esc_html__('Current name', 'simple-days'),
        'section' => 'simple_days_menu_bar',
        'type' => 'checkbox',
      ));

      $i++;
    }

    
    $wp_customize->add_section('simple_days_alert_box_setting',array(
      'title' => esc_html__('Alert Box','simple-days'),
      'panel' => 'simple_days_setting',
    ));
    $wp_customize->add_setting( 'simple_days_alert_box',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_alert_box',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
        //'description' => esc_html__('Current name', 'simple-days'),
      'section' => 'simple_days_alert_box_setting',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_alert_box_text',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_alert_box_text',array(
      'label'   => esc_html__( 'Text', 'simple-days'),
        //'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
      'section' => 'simple_days_alert_box_setting',
      'type'    => 'text',
    ));

    $wp_customize->add_setting( 'simple_days_alert_box_text_position', array(
      'default'           => 'center',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_alert_box_text_position', array(
      'label'    => esc_html__( 'Text display position', 'simple-days' ),
      'section'  => 'simple_days_alert_box_setting',
      'type'     => 'select',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'center' => esc_html__( 'Center', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
      ),
    ));
    $wp_customize->add_setting( 'simple_days_alert_box_text_size', array(
      'default' => 16,
      'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control( 'simple_days_alert_box_text_size', array(
      'label' => esc_html__( 'Text Size', 'simple-days' ),
    //'description' => esc_html__('default&#58;', 'simple-days').esc_html('1'),
      'section' => 'simple_days_alert_box_setting',
      'type' => 'number',
      'input_attrs' => array(
        'min' => 1, 'step' => 1, 'max' => 64,),
    ));


    $alert_box_icon = array(
     '&nbsp;' => esc_html('&nbsp;'),
     'fa-info-circle' => '&#xf05a; info-circle',
     'fa-info' => '&#xf129; info',
     'fa-question-circle' => '&#xf059; question-circle',
     'fa-times-circle' => '&#xf057; times-circle',
     'fa-times-circle-o' => '&#xf05c; times-circle-o',
     'fa-warning' => '&#xf071; warning',
     'fa-exclamation-circle' => '&#xf06a; exclamation-circle',
     'fa-search' => '&#xf002; search',
     'fa-envelope-o' => '&#xf003; envelope-o',
     'fa-heart-o' => '&#xf08a; fa-heart-o',
     'fa-heart' => '&#xf004; fa-heart',
     'fa-star-o' => '&#xf006; fa-star-o',
     'fa-star' => '&#xf005; fa-star',
     'fa-user' => '&#xf007; fa-user',
     'fa-user-o' => '&#xf2c0; fa-user-o',
     'fa-user-circle' => '&#xf2bd; fa-user-circle',
     'fa-user-circle-o' => '&#xf2be; fa-user-circle-o',
     'fa-users' => '&#xf0c0; fa-users',
     'fa-user-secret' => '&#xf21b; fa-user-secret',
     'fa-female' => '&#xf182; fa-female',
     'fa-male' => '&#xf183; fa-male',
     'fa-child' => '&#xf1ae; fa-child',
     'fa-id-badge' => '&#xf2c1; fa-id-badge',
     'fa-smile-o' => '&#xf118; fa-smile-o',
     'fa-frown-o' => '&#xf119; fa-frown-o',
     'fa-meh-o' => '&#xf11a; fa-meh-o',
     'fa-check' => '&#xf00c; check',
     'fa-close' => '&#xf00d; close',
     'fa-signal' => '&#xf012; fa-signal',
     'fa-cog' => '&#xf013; cog',
     'fa-trash-o' => '&#xf014; trash-o',
     'fa-home' => '&#xf015; home',
     'fa-file-o' => '&#xf016; file-o',
     'fa-clock-o' => '&#xf017; clock-o',
     'fa-play-circle-o' => '&#xf01d; play-circle-o',
     'fa-repeat' => '&#xf01e; repeat',
     'fa-refresh' => '&#xf021; fa-refresh',
     'fa-lock' => '&#xf023; fa-lock',



     'fa-arrow-circle-o-up' => '&#xf01b; arrow-circle-o-up',
     'fa-arrow-circle-o-down' => '&#xf01a; arrow-circle-o-down',
     'fa-arrow-circle-o-right' => '&#xf18e; arrow-circle-o-right',
     'fa-arrow-circle-o-left' => '&#xf190; arrow-circle-o-left',
     'fa-arrow-up' => '&#xf062; arrow-up',
     'fa-arrow-down' => '&#xf063; arrow-down',
     'fa-arrow-right' => '&#xf061; arrow-right',
     'fa-arrow-left' => '&#xf060; arrow-left',
     'fa-chevron-up' => '&#xf077; chevron-up',
     'fa-chevron-down' => '&#xf078; chevron-down',
     'fa-chevron-right' => '&#xf054; chevron-right',
     'fa-chevron-left' => '&#xf053; chevron-left',
     'fa-arrow-circle-up' => '&#xf0aa; arrow-circle-up',
     'fa-arrow-circle-down' => '&#xf0ab; arrow-circle-down',
     'fa-arrow-circle-right' => '&#xf0a9; arrow-circle-right',
     'fa-arrow-circle-left' => '&#xf0a8; arrow-circle-left',
     'fa-angle-up' => '&#xf106; angle-up',
     'fa-angle-down' => '&#xf107; angle-down',
     'fa-angle-right' => '&#xf105; angle-right',
     'fa-angle-left' => '&#xf104; angle-left',
     'fa-angle-double-up' => '&#xf102; angle-double-up',
     'fa-angle-double-down' => '&#xf103; angle-double-down',
     'fa-angle-double-right' => '&#xf101; angle-double-right',
     'fa-angle-double-left' => '&#xf100; angle-double-left',



     'fa-area-chart' => '&#xf1fe; fa-area-chart',
     'fa-line-chart' => '&#xf201; fa-line-chart',


     'fa-history' => '&#xf1da; fa-history',


     'fa-bolt' => '&#xf0e7; fa-bolt',
     'fa-lightbulb-o' => '&#xf0eb; fa-lightbulb-o',

     'fa-rocket' => '&#xf135; fa-rocket',
     'fa-location-arrow' => '&#xf124; fa-location-arrow',

     'fa-paw' => '&#xf1b0; fa-paw',
     'fa-bomb' => '&#xf1e2; fa-bomb',
     'fa-birthday-cake' => '&#xf1fd; fa-birthday-cake',
     'fa-fort-awesome' => '&#xf286; fa-fort-awesome',
     'fa-gamepad' => '&#xf11b; fa-gamepad',
   );






    $wp_customize->add_setting( 'simple_days_alert_box_start_icon',array(
      'default'    => 'fa-info-circle',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_alert_box_start_icon',array(
      'label'   => esc_html__( 'Heading icon', 'simple-days'),
      'section' => 'simple_days_alert_box_setting',
      'type' => 'select',
      'choices' => $alert_box_icon,
    ));
    $wp_customize->add_setting( 'simple_days_alert_box_end_icon',array(
      'default'    => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_alert_box_end_icon',array(
      'label'   => esc_html__( 'Ending icon', 'simple-days'),
      'section' => 'simple_days_alert_box_setting',
      'type' => 'select',
      'choices' => $alert_box_icon,
    ));

    $wp_customize->add_setting( 'simple_days_alert_box_color',array(
      'default'    => define("simple_days_alert_box_color", ""),
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_alert_box_color', array(
      'label'      => esc_html__( 'Text Color', 'simple-days' ),
      'section'    => 'simple_days_alert_box_setting',
    )));

    $wp_customize->add_setting( 'simple_days_alert_box_bg_color',array(
      'default'    => define("simple_days_alert_box_bg_color", ""),
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_alert_box_bg_color', array(
      'label'      => esc_html__( 'Background Color', 'simple-days' ),
      'section'    => 'simple_days_alert_box_setting',
    )));



    $wp_customize->add_setting( 'simple_days_alert_box_border_type', array(
      'default'           => 'none',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_alert_box_border_type', array(
      'label'    => esc_html__( 'Border Type', 'simple-days' ),
      'section'  => 'simple_days_alert_box_setting',
      'type'     => 'select',
      'choices'  => array(
        'none' => esc_html__( 'none', 'simple-days' ),
        'solid' => esc_html__( 'Solid', 'simple-days' ),
        'double' => esc_html__( 'Double', 'simple-days' ),
        'groove' => esc_html__( 'Groove', 'simple-days' ),
        'ridge' => esc_html__( 'Ridge', 'simple-days' ),
        'inset' => esc_html__( 'Inset', 'simple-days' ),
        'outset' => esc_html__( 'Outset', 'simple-days' ),
        'dashed' => esc_html__( 'Dashed', 'simple-days' ),
        'dotted' => esc_html__( 'Dotted', 'simple-days' ),
      ),
    ));
    $wp_customize->add_setting( 'simple_days_alert_box_border_width', array(
      'default' => 1,
      'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control( 'simple_days_alert_box_border_width', array(
      'label' => esc_html__( 'Border width', 'simple-days' ),
    //'description' => esc_html__('default&#58;', 'simple-days').esc_html('1'),
      'section' => 'simple_days_alert_box_setting',
      'type' => 'number',
      'input_attrs' => array(
        'min' => 1, 'step' => 1, 'max' => 50,),
    ));

    $wp_customize->add_setting( 'simple_days_alert_box_border_color',array(
      'default'    => define("simple_days_alert_box_border_color", ""),
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_alert_box_border_color', array(
      'label'      => esc_html__( 'Border Color', 'simple-days' ),
      'section'    => 'simple_days_alert_box_setting',
    )));
    $wp_customize->add_setting( 'simple_days_alert_box_border_inside',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_alert_box_border_inside',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Border is inside', 'simple-days'),
      'section' => 'simple_days_alert_box_setting',
      'type' => 'checkbox',
    ));

    
    $wp_customize->add_setting('breadcrumbs',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('breadcrumbs',array(
      'section' => 'simple_days_breadcrumbs',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'breadcrumbs', array(
     'selector' => '#breadcrumb',
   ));

    $wp_customize->add_section('simple_days_breadcrumbs',array(
      'title' => esc_html__('Breadcrumbs','simple-days'),
      'panel' => 'simple_days_setting',
    ));

    $wp_customize->add_setting( 'simple_days_breadcrumbs_display', array(
      'default'           => 'left',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_breadcrumbs_display', array(
      'label'    => esc_html__( 'Breadcrumbs display position', 'simple-days' ),
      'section'  => 'simple_days_breadcrumbs',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
        'none' => esc_html__( 'Hide', 'simple-days' ),
      ),
    ));


    $wp_customize->add_setting( 'simple_days_breadcrumbs_current',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_breadcrumbs_current',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Current name', 'simple-days'),
      'section' => 'simple_days_breadcrumbs',
      'type' => 'checkbox',
    ));



    $delimiter = '&raquo;';
    $wp_customize->add_setting( 'simple_days_breadcrumbs_delimiter',array(
      'default'    => $delimiter,
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_breadcrumbs_delimiter',array(
      'label'   => esc_html__( 'Delimiter', 'simple-days'),
      'section' => 'simple_days_breadcrumbs',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       '&raquo;' => esc_html('&raquo;'),
       '&gt;' => esc_html('&gt;'),
       '&middot;' => esc_html('&middot;'),
       '&#45;' => esc_html('&#45;'),
       '&rarr;' => esc_html('&rarr;'),
       '&rArr;' => esc_html('&rArr;'),
       '&sim;' => esc_html('&sim;'),
       '&#124;' => esc_html('&#124;'),
       '&hellip;' => esc_html('&hellip;'),
     ),
    ));


    $wp_customize->add_setting( 'simple_days_breadcrumbs_homeicon',array(
      'default'    => 'fa-home',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_breadcrumbs_homeicon',array(
      'label'   => esc_html__( 'Home icon', 'simple-days'),
      'section' => 'simple_days_breadcrumbs',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-home' => '&#xf015; fa-home',
       'fa-star-o' => '&#xf006; fa-star-o',
       'fa-star' => '&#xf005; fa-star',
       'fa-cube' => '&#xf1b2; fa-cube',
       'fa-tree' => '&#xf1bb; fa-tree',
       'fa-map-pin' => '&#xf276; fa-map-pin',
       'fa-map-marker' => '&#xf041; fa-map-marker',
       'fa-fort-awesome' => '&#xf286; fa-fort-awesome',
       'fa-rocket' => '&#xf135; fa-rocket',
     ),
    ));


    $wp_customize->add_setting( 'simple_days_breadcrumbs_treeicon',array(
      'default'    => 'fa-folder-open-o',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_breadcrumbs_treeicon',array(
      'label'   => esc_html__( 'Tree icon', 'simple-days'),
      'section' => 'simple_days_breadcrumbs',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-folder-open-o' => '&#xf115; fa-folder-open-o',
       'fa-folder-o' => '&#xf114; fa-folder-o',
       'fa-folder-open' => '&#xf07c; fa-folder-open',
       'fa-folder' => '&#xf07b; fa-folder',
       'fa-files-o' => '&#xf0c5; fa-files-o',
       'fa-book' => '&#xf02d; fa-book',
       'fa-check' => '&#xf00c; fa-check',
       'fa-check-square' => '&#xf14a; fa-check-square',
       'fa-cubes' => '&#xf1b3; fa-cubes',
     ),
    ));


    $wp_customize->add_setting( 'simple_days_breadcrumbs_currenticon',array(
      'default'    => 'fa-file-text-o',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_breadcrumbs_currenticon',array(
      'label'   => esc_html__( 'Current icon', 'simple-days'),
      'section' => 'simple_days_breadcrumbs',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-file-text-o' => '&#xf0f6; fa-file-text-o',
       'fa-file-o' => '&#xf016; fa-file-o',
       'fa-file-text' => '&#xf15c; fa-file-text',
       'fa-newspaper-o' => '&#xf1ea; fa-newspaper-o',
       'fa-sticky-note' => '&#xf249; fa-sticky-note',
       'fa-sticky-note-o' => '&#xf24a; fa-sticky-note-o',
       'fa-pencil' => '&#xf040; fa-pencil',
       'fa-smile-o' => '&#xf118; fa-smile-o',
       'fa-check' => '&#xf00c; fa-check',
       'fa-check-square' => '&#xf14a; fa-check-square',
       'fa-cube' => '&#xf1b2; fa-cube',
       'fa-paw' => '&#xf1b0; fa-paw',
       'fa-gamepad' => '&#xf11b; fa-gamepad',
     ),
    ));


    
    $wp_customize->add_section('simple_days_layout_footer',array(
      'title' => esc_html__('Layout', 'simple-days').esc_html__('(Footer)', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));


    $wp_customize->add_setting( 'simple_days_footer_layout', array(
      'default'           => '2',
      'sanitize_callback' => 'sanitize_key'
    ) );
    $wp_customize->add_control( new Simple_Days_Image_Select_Control( $wp_customize, 'simple_days_footer_layout', array(
      'label'       => esc_html__( 'Footer Menu Layout', 'simple-days' ),
      'section'     => 'simple_days_layout_footer',
      'choices'     => array(
        '1' => array(
          'label' => esc_html__( 'First', 'simple-days' ),
          'url'   => '%sfooter_1.png'
        ),
        '2'    => array(
          'label' => esc_html__( 'Second', 'simple-days' ),
          'url'   => '%sfooter_2.png'
        ),
        '3'    => array(
          'label' => esc_html__( 'Third', 'simple-days' ),
          'url'   => '%sfooter_3.png'
        ),
      ),
    )));


    $wp_customize->add_setting('back_to_top_button',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('back_to_top_button',array(
      'section' => 'simple_days_layout_footer',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'back_to_top_button', array(
      'selector' => '.to_top',
    ));
    $wp_customize->add_setting( 'simple_days_back_to_top_button',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_back_to_top_button',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Back to top button', 'simple-days'),
      'section' => 'simple_days_layout_footer',
      'type' => 'checkbox',
    ));

    
    
    $wp_customize->add_setting('copyright',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('copyright',array(
      'section' => 'simple_days_layout_footer',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'copyright', array(
     'selector' => '.copyright',
   ));


    $copyright_year = 1998;
    $copyright_year_list = array();
    while($copyright_year <= date('Y')){
      $copyright_year_list[] = (string) $copyright_year;
      $copyright_year++;
    }

    $copyright_year_list = array_combine( $copyright_year_list, $copyright_year_list ) ;
    $copyright_year_list = $copyright_year_list + array('none' => '');
    $wp_customize->add_setting( 'simple_days_copyright_year',array(
      'default'    => 'none',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control( 'simple_days_copyright_year',array(
      'label'   => esc_html__( 'Year of Publication', 'simple-days'),
      'section' => 'simple_days_layout_footer',
      'type' => 'select',
      'choices' => $copyright_year_list,
    ));

    $wp_customize->add_setting('copyright_description',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('copyright_description',array(
      'section' => 'simple_days_layout_footer',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'copyright_description', array(
      'selector' => '.description',
    ));
    $wp_customize->add_setting( 'simple_days_copyright_description',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_copyright_description',array(
      'label'   => esc_html__( 'Hide', 'simple-days'),
      'description' => esc_html__('Description', 'simple-days'),
      'section' => 'simple_days_layout_footer',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting('copyright_wordpress',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('copyright_wordpress',array(
      'section' => 'simple_days_layout_footer',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'copyright_wordpress', array(
      'selector' => '.copyright_wordpress',
    ));
    $wp_customize->add_setting( 'simple_days_copyright_wordpress',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_copyright_wordpress',array(
      'label'   => esc_html__( 'Hide', 'simple-days'),
      'description' => esc_html__('Powered by WordPress', 'simple-days'),
      'section' => 'simple_days_layout_footer',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_copyright_simple_days',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_copyright_simple_days',array(
      'label'   => esc_html__( 'Hide', 'simple-days'),
      'description' => esc_html__('Theme by Simple Days', 'simple-days'),
      'section' => 'simple_days_layout_footer',
      'type' => 'checkbox',
    ));




    
    $wp_customize->add_section('simple_days_widget_setting',array(
      'title' => esc_html__('Simple Days Widget','simple-days'),
      'panel' => 'simple_days_setting',
    ));

    $wp_customize->add_setting( 'simple_days_social_link_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_link_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Add Social Links Widget', 'simple-days'),
      'section' => 'simple_days_widget_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_recent_posts_with_thumbnail_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_recent_posts_with_thumbnail_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Recent Posts with thumbnail widget', 'simple-days'),
      'section' => 'simple_days_widget_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_update_posts_with_thumbnail_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_update_posts_with_thumbnail_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Update Posts with thumbnail widget', 'simple-days'),
      'section' => 'simple_days_widget_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_recommend_posts_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_recommend_posts_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Recommended Posts with thumbnail widget', 'simple-days'),
      'section' => 'simple_days_widget_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_dd_archives_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_dd_archives_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Drop Down Archives widget without JavaScript', 'simple-days'),
      'section' => 'simple_days_widget_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_dd_categories_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_dd_categories_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Drop Down Categories widget without JavaScript', 'simple-days'),
      'section' => 'simple_days_widget_setting',
      'type' => 'checkbox',
    ));




    $social_account_description_before = esc_html__('e.g.&nbsp;', 'simple-days');
    $social_account_description_after = '<strong class="highlighter">&lowast;&lowast;&lowast;&lowast;&lowast;&lowast;</strong><br />'.esc_html__('type the &lowast; part of your url', 'simple-days');
    $social_account_description['amazon'] = esc_html__("add your amazon website's full URL", 'simple-days').'<br />'.esc_html__('e.g.&nbsp;', 'simple-days').esc_html__('Your wish list URL', 'simple-days');
    $social_account_description['facebook'] = $social_account_description_before.' facebook.com/'.$social_account_description_after;
    $social_account_description['twitter'] = $social_account_description_before.' twitter.com/'.$social_account_description_after;
    $social_account_description['linkedin'] = $social_account_description_before.' linkedin.com/in/'.$social_account_description_after;
    $social_account_description['instagram'] = $social_account_description_before.' instagram.com/'.$social_account_description_after;
    $social_account_description['googleplus'] = $social_account_description_before.'  plus.google.com/'.$social_account_description_after;
    $social_account_description['pinterest'] = $social_account_description_before.' pinterest.com/'.$social_account_description_after;
    $social_account_description['flickr'] = $social_account_description_before.' flickr.com/photos/'.$social_account_description_after;
    $social_account_description['github'] = $social_account_description_before.' github.com/'.$social_account_description_after;
    $social_account_description['codepen'] = $social_account_description_before.' codepen.io/'.$social_account_description_after;
    $social_account_description['youtube'] = $social_account_description_before.' youtube.com/'.$social_account_description_after;
    $social_account_description['vimeo'] = $social_account_description_before.' vimeo.com/'.$social_account_description_after;
    $social_account_description['soundcloud'] = $social_account_description_before.' soundcloud.com/'.$social_account_description_after;
    $social_account_description['meetup'] = $social_account_description_before.' meetup.com/'.$social_account_description_after;
    $social_account_description['hatenabookmark'] = $social_account_description_before.' b.hatena.ne.jp/'.$social_account_description_after;
    $social_account_description['line'] = $social_account_description_before.' line.naver.jp/ti/p/'.$social_account_description_after;
    $social_account_description['tumblr'] = esc_html__('e.g.&nbsp;', 'simple-days').' <strong class="highlighter">&lowast;&lowast;&lowast;&lowast;&lowast;&lowast;</strong>.tumblr.com<br />'.esc_html__('type the &lowast; part of your url', 'simple-days');

    $social_account_list = $social['name_list'];
    unset($social_account_list['none']);
    unset($social_account_list['feedly']);
    unset($social_account_list['rss']);

    
    $wp_customize->add_section('simple_days_social_account_setting',array(
      'title' => esc_html__('Social Account','simple-days'),
      'panel' => 'simple_days_setting',
    ));

    foreach ($social_account_list as $key => $value) {
      $wp_customize->add_setting( 'simple_days_social_account_'.$key,array(
        'default'           => '',
        'sanitize_callback' => 'wp_strip_all_tags',
      ));
      $wp_customize->add_control('simple_days_social_account_'.$key,array(
        'label'   => $value,
        'description' => $social_account_description[$key],
        'section' => 'simple_days_social_account_setting',
        'type'    => 'text',
      ));
    }

    
    $wp_customize->add_setting( 'simple_days_social_account_facebook_app_id',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_social_account_facebook_app_id',array(
      'label'   => esc_html__( 'Facebook App ID', 'simple-days'),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
      'section' => 'simple_days_social_account_setting',
      'type'    => 'text',
    ));
    
    $wp_customize->add_setting( 'simple_days_social_account_facebook_admins',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_social_account_facebook_admins',array(
      'label'   => esc_html__( 'Facebook fb:admins', 'simple-days'),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
      'section' => 'simple_days_social_account_setting',
      'type'    => 'text',
    ));


    
    $wp_customize->add_section('simple_days_social_share_setting',array(
      'title' => esc_html__('Social Share','simple-days'),
      'panel' => 'simple_days_setting',
    ));
    
    $wp_customize->add_setting('sns_share',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('sns_share',array(
      'section' => 'simple_days_social_share_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'sns_share', array(
     'selector' => '.social_share_list',
   ));

    $wp_customize->add_setting( 'simple_days_social_share',array(
      'default'    => 'false',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_share',array(
      'label'   => esc_html__( 'Display Style', 'simple-days'),
      'description' => esc_html__('Social share', 'simple-days'),
      'section' => 'simple_days_social_share_setting',
      'type'     => 'radio',
      'choices'  => array(
        'false' => esc_html__( 'Disable', 'simple-days' )
      ) + $social['shape_list'],
    ));

    $wp_customize->add_setting( 'simple_days_social_share_size',array(
      'default'    => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_share_size',array(
      'label'   => esc_html__( 'Icon Size', 'simple-days'),
      'section' => 'simple_days_social_share_setting',
      'type'     => 'radio',
      'choices'  => $social['size_list'],
    ));

    $wp_customize->add_setting( 'simple_days_social_share_icon_color',array(
      'default'    => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_social_share_icon_color', array(
      'label'      => esc_html__( 'Specifies the color of the icon.', 'simple-days' ),
      'section'    => 'simple_days_social_share_setting',
    )));

    $wp_customize->add_setting( 'simple_days_social_share_icon_hover_color',array(
      'default'    => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_social_share_icon_hover_color', array(
      'label'      => esc_html__( 'Specifies the color of hover.', 'simple-days' ),
      'section'    => 'simple_days_social_share_setting',
    )));

    $wp_customize->add_setting( 'simple_days_social_share_icon_tooltip',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_share_icon_tooltip',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Tool tip', 'simple-days'),
      'section' => 'simple_days_social_share_setting',
      'type' => 'checkbox',
    ));



    $wp_customize->add_setting( 'simple_days_social_share_title_icon',array(
      'default'    => 'fa-share-alt',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_social_share_title_icon',array(
      'label'   => esc_html__( 'Title icon', 'simple-days'),
      'section' => 'simple_days_social_share_setting',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-share-alt' => '&#xf1e0; fa-share-alt',
       'fa-share-alt-square' => '&#xf1e1; fa-share-alt-square',
       'fa-share-square-o' => '&#xf045; fa-share-square-o',
       'fa-share-square' => '&#xf14d; fa-share-square',
       'fa-share' => '&#xf064; fa-share',
       'fa-retweet' => '&#xf079; fa-retweet',
     ),
    ));


    $wp_customize->add_setting( 'simple_days_social_share_title',array(
      'default'           => esc_html__('Share this post', 'simple-days'),
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_social_share_title',array(
      'label'   => esc_html__( 'Title', 'simple-days'),
      'section' => 'simple_days_social_share_setting',
      'type'    => 'text',
    ));


    $sns_share_name = array(
      'none'               => '-',
      'buffer'             => esc_html__('buffer', 'simple-days'),
      'digg'               => esc_html__('digg', 'simple-days'),
      'mail'               => esc_html__('Email', 'simple-days'),
      'evernote'           => esc_html__('Evernote', 'simple-days'),
      'facebook'           => esc_html__('Facebook', 'simple-days'),
      'googleplus'         => esc_html__('Google+', 'simple-days'),
      'hatenabookmark'     => esc_html__('Hatena Bookmark', 'simple-days'),
      'line'               => esc_html__('Line', 'simple-days'),
      'linkedin'           => esc_html__('LinkedIn', 'simple-days'),
      'messenger'          => esc_html__('Messenger', 'simple-days'),
      'pinterest'          => esc_html__('Pinterest', 'simple-days'),
      'pocket'             => esc_html__('Pocket', 'simple-days'),
      'reddit'             => esc_html__('Reddit', 'simple-days'),
      'tumblr'             => esc_html__('Tumblr', 'simple-days'),
      'twitter'            => esc_html__('Twitter', 'simple-days'),
      'whatsapp'           => esc_html__('WhatsApp', 'simple-days'),
    );








    $i = 1;
    while($i <= 10){
      $wp_customize->add_setting( 'simple_days_sns_share_'.$i,array(
        'default'       => 'none',
        'sanitize_callback' => 'simple_days_sns_name_sanitize',
      ));
      $wp_customize->add_control('simple_days_sns_share_'.$i,array(
        
        'label'   => sprintf(esc_html__( 'Social share Icon #%s', 'simple-days'),$i),
        'section' => 'simple_days_social_share_setting',
        'type'    => 'select',
        'choices' => $sns_share_name,
        'priority'  => $i+100,
      ));
      $i++;
    }





    
    $wp_customize->add_section('simple_days_social_cta_setting',array(
      'title' => esc_html__('Social CTA','simple-days'),
      'panel' => 'simple_days_setting',
    ));

    $wp_customize->add_setting('sns_cta',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('sns_cta',array(
      'section' => 'simple_days_social_cta_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'sns_cta', array(
     'selector' => '.simple_days_cta_box ',
   ));

    $wp_customize->add_setting( 'simple_days_social_cta',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_cta',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('call-to-action under in the contents of the post', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_social_cta_page',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_cta_page',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('call-to-action under in the contents of the page', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_social_cta_heading_text',array(
      'default'           => esc_html__('Follow us', 'simple-days'),
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_social_cta_heading_text',array(
      'label'   => esc_html__( 'heading text', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_social_cta_end_text',array(
      'default'           => esc_html__('We will keep you updated', 'simple-days'),
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_social_cta_end_text',array(
      'label'   => esc_html__( 'end text', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_social_cta_facebook',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_cta_facebook',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Facebook', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_social_cta_facebook_script',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_cta_facebook_script',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('required Facebook script.', 'simple-days').'<br />'.esc_html__('be careful not to conflict', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_social_cta_twitter',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_cta_twitter',array(
      'label'   => esc_html__( 'Display', 'simple-days'),
      'description' => esc_html__('Twitter', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_social_cta_gradation',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_social_cta_gradation',array(
      'label'   => esc_html__( 'Gradation Color', 'simple-days'),
      'description' => esc_html__('Background color', 'simple-days'),
      'section' => 'simple_days_social_cta_setting',
      'type' => 'checkbox',
    ));




























    
    $wp_customize->add_setting('profile',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('profile',array(
      'section' => 'simple_days_profile_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'profile', array(
     'selector' => '.pf_box:not(.pf_another_box)',
   ));

    $wp_customize->add_section('simple_days_profile_setting',array(
      'title' => esc_html__('Profile Widget', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));
    $wp_customize->add_setting( 'simple_days_profile_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_profile_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Add Profile Widget', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_another_profile_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_another_profile_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Add Another Profile Widget', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_profile_title',array(
      'default'           => esc_html__( 'Profile', 'simple-days'),
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_profile_title',array(
      'label'   => esc_html__( 'Title', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_profile_name',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_profile_name',array(
      'label'   => esc_html__( 'Name', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_profile_image',array(
      'default'    => '',
      'sanitize_callback' => 'simple_days_sanitize_image_file',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simple_days_profile_image', array(
      'label' => esc_html__( 'Profile image', 'simple-days'),
      'description' => esc_html__( 'Profile use this image.', 'simple-days'),
      'section' => 'simple_days_profile_setting',
    )));
    $wp_customize->add_setting( 'simple_days_profile_image_wrap', array(
      'default'           => 'circle',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    )
  );
    $wp_customize->add_control( 'simple_days_profile_image_wrap', array(
      'label'    => esc_html__( 'Profile image display shape', 'simple-days' ),
      'section'  => 'simple_days_profile_setting',
      'type'     => 'radio',
      'choices'  => array(
        'circle' => esc_html__( 'Circle', 'simple-days' ),
        'square' => esc_html__( 'Square', 'simple-days' ),
      ),
    ));
    $wp_customize->add_setting( 'simple_days_profile_background_image',array(
      'default'    => '',
      'sanitize_callback' => 'simple_days_sanitize_image_file',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simple_days_profile_background_image', array(
      'label' => esc_html__( 'Background image', 'simple-days'),
      'description' => esc_html__( 'Background use this image.', 'simple-days'),
      'section' => 'simple_days_profile_setting',
    )));

    $wp_customize->add_setting( 'simple_days_profile_text',array(
      'default'           => '',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('simple_days_profile_text',array(
      'label'   => esc_html__( 'Profile text', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type'    => 'textarea',
    ));
    $wp_customize->add_setting( 'simple_days_profile_read_more_url',array(
      'default'           => '',
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('simple_days_profile_read_more_url',array(
      'label'   => esc_html__( 'Read more URL', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_profile_read_more_text',array(
      'default'           => esc_html__( 'Read More', 'simple-days' ),
      'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('simple_days_profile_read_more_text',array(
      'label'   => esc_html__( 'Read more text', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_profile_read_more_blank',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_profile_read_more_blank',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Read more link open new window.', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type' => 'checkbox',
    ));


    $wp_customize->add_setting( 'simple_days_profile_social_link_shape',array(
      'default'    => 'icon_square',
      'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'simple_days_profile_social_link_shape',array(
      'label'   => esc_html__( 'Social Links', 'simple-days'),
      'description' => esc_html__('Display Style', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type'     => 'radio',
      'choices'  => $social['shape_list'],
    ));

    $wp_customize->add_setting( 'simple_days_profile_social_link_size',array(
      'default'    => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_profile_social_link_size',array(
      'label'   => esc_html__( 'Icon Size', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type'     => 'radio',
      'choices'  => $social['size_list'],
    ));



    $wp_customize->add_setting( 'simple_days_profile_social_icon_color',array(
      'default'    => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_profile_social_icon_color', array(
      'label'      => esc_html__( 'Specifies the color of the icon.', 'simple-days' ),
      'section'    => 'simple_days_profile_setting',
    )));

    $wp_customize->add_setting( 'simple_days_profile_social_icon_hover_color',array(
      'default'    => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'simple_days_profile_social_icon_hover_color', array(
      'label'      => esc_html__( 'Specifies the color of hover.', 'simple-days' ),
      'section'    => 'simple_days_profile_setting',
    )));

    $wp_customize->add_setting( 'simple_days_profile_social_icon_tooltip',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_profile_social_icon_tooltip',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Tool tip', 'simple-days'),
      'section' => 'simple_days_profile_setting',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_profile_caution', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_profile_caution', array(
      'section' => 'simple_days_profile_setting',
      'label' => esc_html__( 'How to show social icon', 'simple-days' ),
      
      'content' => sprintf(esc_html__( 'You must register your %1$s before you can show social links.', 'simple-days' ),'<a href="'.esc_js('javascript:wp.customize.section(\"simple_days_social_account_setting\").focus();' ).'">'.esc_html__( 'Social Account', 'simple-days' ).'</a>'),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));


    $i = 1;
    while($i <= 5){
      $wp_customize->add_setting( 'simple_days_profile_social_icon_'.$i,array(
        'default'       => 'none',
        'sanitize_callback' => 'simple_days_sns_name_sanitize',
      ));
      $wp_customize->add_control('simple_days_profile_social_icon_'.$i,array(
        
        'label'   => sprintf(esc_html__( 'Social Icon #%s', 'simple-days'),$i),
        'section' => 'simple_days_profile_setting',
        'type'    => 'select',
        'choices' => $social['name_list'],
        'priority'  => $i+100,
      ));
      $i++;
    }

    
    $wp_customize->add_section('simple_days_popular_post_setting',array(
      'title' => esc_html__('Popular Post', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));
    $wp_customize->add_setting( 'simple_days_popular_post',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_popular_post',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Count Popular Post', 'simple-days'),
      'section' => 'simple_days_popular_post_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_popular_post_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_popular_post_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Popular Posts Widgets', 'simple-days'),
      'section' => 'simple_days_popular_post_setting',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting('popular_post_view',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('popular_post_view',array(
      'section' => 'simple_days_popular_post_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'popular_post_view', array(
     'selector' => '.page_view',
   ));


    $wp_customize->add_setting( 'simple_days_popular_post_view',array(
      'default'    => 'none',
      'sanitize_callback' => 'simple_days_sanitize_select',
    ));
    $wp_customize->add_control( 'simple_days_popular_post_view',array(
      'label'   => esc_html__( 'Display page view at the each post.', 'simple-days'),
      'section' => 'simple_days_popular_post_setting',
      'type' => 'select',
      'choices' => array(
       'none' =>  esc_html__( 'Hide', 'simple-days' ),
       'all' => esc_html__('Page View', 'simple-days'),
       'yearly' => esc_html__('Yearly Page View', 'simple-days'),
       'monthly' => esc_html__('Monthly Page View', 'simple-days'),
       'weekly' => esc_html__('Weekly Page View', 'simple-days'),
       'daily' => esc_html__('Daily Page View', 'simple-days'),
     ),
    ));

    $wp_customize->add_setting( 'simple_days_popular_post_view_icon',array(
      'default'    => 'fa-signal',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control( 'simple_days_popular_post_view_icon',array(
      'label'   => esc_html__( 'Page view icon', 'simple-days'),
      'section' => 'simple_days_popular_post_setting',
      'type' => 'select',
      'choices' => array(
       '&nbsp;' => esc_html('&nbsp;'),
       'fa-signal' => '&#xf012; fa-signal',
       'fa-area-chart' => '&#xf1fe; fa-area-chart',
       'fa-line-chart' => '&#xf201; fa-line-chart',
       'fa-heart-o' => '&#xf08a; fa-heart-o',
       'fa-heart' => '&#xf004; fa-heart',
       'fa-star-o' => '&#xf006; fa-star-o',
       'fa-star' => '&#xf005; fa-star',
       'fa-history' => '&#xf1da; fa-history',
       'fa-history' => '&#xf1da; fa-history',
       'fa-home' => '&#xf015; fa-home',
       'fa-bolt' => '&#xf0e7; fa-bolt',
       'fa-lightbulb-o' => '&#xf0eb; fa-lightbulb-o',
       'fa-smile-o' => '&#xf118; fa-smile-o',
       'fa-rocket' => '&#xf135; fa-rocket',
       'fa-location-arrow' => '&#xf124; fa-location-arrow',
       'fa-info-circle' => '&#xf05a; fa-info-circle',
       'fa-info' => '&#xf129; fa-info',
       'fa-paw' => '&#xf1b0; fa-paw',
       'fa-bomb' => '&#xf1e2; fa-bomb',
       'fa-birthday-cake' => '&#xf1fd; fa-birthday-cake',
       'fa-fort-awesome' => '&#xf286; fa-fort-awesome',
       'fa-gamepad' => '&#xf11b; fa-gamepad',
     ),
    ));

    $wp_customize->add_setting( 'simple_days_popular_post_view_position', array(
      'default'           => 'right',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    ));
    $wp_customize->add_control( 'simple_days_popular_post_view_position', array(
      'label'    => esc_html__( 'Post view display position', 'simple-days' ),
      'section'  => 'simple_days_popular_post_setting',
      'type'     => 'radio',
      'choices'  => array(
        'left' => esc_html__( 'Left', 'simple-days' ),
        'center' => esc_html__( 'Center', 'simple-days' ),
        'right' => esc_html__( 'Right', 'simple-days' ),
      ),
    ));





    $wp_customize->add_setting( 'simple_days_popular_post_view_logout',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_popular_post_view_logout',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Display page view to logout user.', 'simple-days'),
      'section' => 'simple_days_popular_post_setting',
      'type' => 'checkbox',
    ));



    
    $wp_customize->add_section('simple_days_toc_setting',array(
      'title' => esc_html__('Table of contents', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));

    $wp_customize->add_setting('toc_setting',array('sanitize_callback' => 'absint',));
    $wp_customize->add_control('toc_setting',array(
      'section' => 'simple_days_toc_setting',
      'type' => 'hidden'
    ));
    $wp_customize->selective_refresh->add_partial( 'toc_setting', array(
     'selector' => '.s_d_toc',
   ));


    $wp_customize->add_setting( 'simple_days_toc',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('insert table of contents', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_toc_title',array(
      'default'           => esc_html_x( 'Contents', 'toc' , 'simple-days' ),
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_toc_title',array(
      'label'   => esc_html_x( 'Toc Title', 'toc' , 'simple-days' ),
      'section' => 'simple_days_toc_setting',
      'type'    => 'text',
    ));

    $wp_customize->add_setting( 'simple_days_toc_hide',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc_hide',array(
      'label'   => esc_html__( 'Initially hide table of contents', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_toc_dc',array(
      'default'    => '3',
      'sanitize_callback' => 'simple_days_sanitize_select',
    ));
    $wp_customize->add_control( 'simple_days_toc_dc',array(
      'label'   => esc_html__( 'lower limit the heading which toc is displayed', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'select',
      'choices' => array(
       '2' => '2',
       '3' => '3',
       '4' => '4',
       '5' => '5',
       '6' => '6',
       '7' => '7',
       '8' => '8',
       '9' => '9',
       '10' => '10',
     ),
    ));
    $wp_customize->add_setting( 'simple_days_toc_post',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc_post',array(
      'label'   => esc_html__( 'Automatically display toc in post', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_toc_page',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc_page',array(
      'label'   => esc_html__( 'Automatically display toc in page', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_toc_dp',array(
      'default'    => '0',
      'sanitize_callback' => 'simple_days_sanitize_select',
    ));
    $wp_customize->add_control( 'simple_days_toc_dp',array(
      'label'   => esc_html__( 'display position', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'select',
      'choices' => array(
       '0' => esc_html__('Before the first heading', 'simple-days'),
       '1' => esc_html__('After the first heading', 'simple-days'),
       '2' => esc_html__('Top', 'simple-days'),
     ),
    ));
    $wp_customize->add_setting( 'simple_days_toc_hierarchical',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc_hierarchical',array(
      'label'   => esc_html__( 'hierarchical view', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_toc_numerical',array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc_numerical',array(
      'label'   => esc_html__( 'numerical display', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_toc_widget',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc_widget',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Add Widgets TOC', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_toc_widget_sticky',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_toc_widget_sticky',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Sticky TOC of SideBar Widgets', 'simple-days'),
      'section' => 'simple_days_toc_setting',
      'type' => 'checkbox',
    ));
    
    $wp_customize->add_section('simple_days_blog_card_setting',array(
      'title' => esc_html__('Blog Card', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));
    $wp_customize->add_setting( 'simple_days_blog_card_internal',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_blog_card_internal',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Blog card(internal site)', 'simple-days'),
      'section' => 'simple_days_blog_card_setting',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_blog_card_external',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_blog_card_external',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Blog card(external site)', 'simple-days'),
      'section' => 'simple_days_blog_card_setting',
      'type' => 'checkbox',
    ));





    
    $wp_customize->add_section('simple_days_google_analytics_setteing',array(
      'title' => esc_html__('Google Analytics', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));

    $wp_customize->add_setting( 'simple_days_ga_analytics', array(
      'default'           => 'false',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    )
  );
    $wp_customize->add_control( 'simple_days_ga_analytics', array(
      'label'    => esc_html__( 'Google Analytics', 'simple-days' ),
      'section'  => 'simple_days_google_analytics_setteing',
      'type'     => 'radio',
      'choices'  => array(
        'false' => esc_html__( 'Disable', 'simple-days' ),
        '1' => esc_html__( 'ga.js', 'simple-days' ),
        '2' => esc_html__( 'gtag.js', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_ga_analytics_id',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_ga_analytics_id',array(
      'label'   => esc_html__( 'Google Analytics account', 'simple-days'),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('UA-XXXXXX-Y'),
      'section' => 'simple_days_google_analytics_setteing',
      'type'    => 'text',
    ));

    $wp_customize->add_setting( 'simple_days_google_site_verification',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_site_verification',array(
      'label'   => esc_html__( 'Google Site Verification', 'simple-days'),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890AbCdeFghIjKLMnoPQrstuVWXYz'),
      'section' => 'simple_days_google_analytics_setteing',
      'type'    => 'text',
    ));










    
  // Add Settings and Controls for Google AD.
    $wp_customize->add_section('simple_days_google_ad_setteing',array(
      'title' => esc_html__('Google AdSense', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_publisher_id',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_ad_publisher_id',array(
      'label'   => esc_html__( 'Your publisher ID(data-ad-client):', 'simple-days'),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('ca-pub-1234567890'),
      'section' => 'simple_days_google_ad_setteing',
      'type'    => 'text',
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_labeling',array(
      'default'    => '0',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_google_ad_labeling',array(
      'label'   => esc_html__( 'Labeling ads', 'simple-days'),
      'section' => 'simple_days_google_ad_setteing',
      'type'     => 'radio',
      'choices'  => array(
        '0' => esc_html__( 'Hide', 'simple-days' ),
        '1' => esc_html__( 'Advertisements', 'simple-days' ),
        '2' => esc_html__( 'Sponsored Links', 'simple-days' ),
      ),
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_responsive_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_google_ad_responsive_info', array(
      'section' => 'simple_days_google_ad_setteing',
      
      'label' => sprintf(esc_html__('%s ad setting', 'simple-days'),esc_html_x('Responsive', 'google_ad', 'simple-days')),

    //'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'),esc_html__( 'Local Fonts Japanese', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));

    $wp_customize->add_setting( 'simple_days_google_ad',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_google_ad',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      
      'description' => sprintf(esc_html__('Add Widgets Google AdSense (%s)', 'simple-days'),esc_html_x('Responsive', 'google_ad', 'simple-days')),
      'section' => 'simple_days_google_ad_setteing',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_data_ad_slot',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_ad_data_ad_slot',array(
      
      'label'   => sprintf(esc_html__( 'Your %s ad unit\'s ID(data-ad-slot):', 'simple-days'),esc_html_x('Responsive', 'google_ad', 'simple-days')),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
      'section' => 'simple_days_google_ad_setteing',
      'type'    => 'text',
    ));


    $wp_customize->add_setting( 'simple_days_google_ad_infeed_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_google_ad_infeed_info', array(
      'section' => 'simple_days_google_ad_setteing',
      
      'label' => sprintf(esc_html__('%s ad setting', 'simple-days'),esc_html_x('In-feed', 'google_ad', 'simple-days')),

    //'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'),esc_html__( 'Local Fonts Japanese', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));

    $wp_customize->add_setting( 'simple_days_google_ad_infeed',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_google_ad_infeed',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      
      'description' => sprintf(esc_html__('Add Widgets Google AdSense (%s)', 'simple-days'),esc_html_x('In-feed', 'google_ad', 'simple-days')),
      'section' => 'simple_days_google_ad_setteing',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_data_ad_slot_infeed',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_ad_data_ad_slot_infeed',array(
      
      'label'   => sprintf(esc_html__( 'Your %s ad unit\'s ID(data-ad-slot):', 'simple-days'),esc_html_x('In-feed', 'google_ad', 'simple-days')),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
      'section' => 'simple_days_google_ad_setteing',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_google_ad_data_ad_layout_key_infeed',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_ad_data_ad_layout_key_infeed',array(
      
      'label'   => sprintf(esc_html__( 'Your %s ad unit\'s layout key(data-ad-layout-key):', 'simple-days'),esc_html_x('In-feed', 'google_ad', 'simple-days')),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('-a0+b1+2c-d3+4e'),
      'section' => 'simple_days_google_ad_setteing',
      'type'    => 'text',
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_data_ad_slot_infeed_mobile',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_ad_data_ad_slot_infeed_mobile',array(
      
      'label'   => esc_html_x('For Mobile', 'google_ad', 'simple-days').sprintf(esc_html__( 'Your %s ad unit\'s ID(data-ad-slot):', 'simple-days'),esc_html_x('In-feed', 'google_ad', 'simple-days')),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
      'section' => 'simple_days_google_ad_setteing',
      'type'    => 'text',
    ));
    $wp_customize->add_setting( 'simple_days_google_ad_data_ad_layout_key_infeed_mobile',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_ad_data_ad_layout_key_infeed_mobile',array(
      
      'label'   => esc_html_x('For Mobile', 'google_ad', 'simple-days').sprintf(esc_html__( 'Your %s ad unit\'s layout key(data-ad-layout-key):', 'simple-days'),esc_html_x('In-feed', 'google_ad', 'simple-days')),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('-a0+b1+2c-d3+4e'),
      'section' => 'simple_days_google_ad_setteing',
      'type'    => 'text',
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_inarticle_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_google_ad_inarticle_info', array(
      'section' => 'simple_days_google_ad_setteing',
      
      'label' => sprintf(esc_html__('%s ad setting', 'simple-days'),esc_html_x('In-article', 'google_ad', 'simple-days')),

    //'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'),esc_html__( 'Local Fonts Japanese', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));

    $wp_customize->add_setting( 'simple_days_google_ad_inarticle',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_google_ad_inarticle',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      
      'description' => sprintf(esc_html__('Add Widgets Google AdSense (%s)', 'simple-days'),esc_html_x('In-article', 'google_ad', 'simple-days')),
      'section' => 'simple_days_google_ad_setteing',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_google_ad_data_ad_slot_inarticle',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_google_ad_data_ad_slot_inarticle',array(
      
      'label'   => sprintf(esc_html__( 'Your %s ad unit\'s ID(data-ad-slot):', 'simple-days'),esc_html_x('In-article', 'google_ad', 'simple-days')),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
      'section' => 'simple_days_google_ad_setteing',
      'type'    => 'text',
    ));

    
    $wp_customize->add_section('simple_days_amp_setting',array(
      'title' => esc_html__('AMP(beta Ver.)', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));


    $wp_customize->add_setting( 'simple_days_amp',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_amp',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Accelerated Mobile Pages(AMP)', 'simple-days'),
      'section' => 'simple_days_amp_setting',
      'type' => 'checkbox',
    ));





    
    $wp_customize->add_setting( 'simple_days_amp_logo_img',array(
      'default'    => esc_url(get_template_directory_uri() .'/assets/images/amp-logo.png'),
      'sanitize_callback' => 'simple_days_sanitize_image_file',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simple_days_amp_logo_img', array(
      'label' => esc_html__( 'AMP Logo Image', 'simple-days'),
      'description' => __( 'AMP Logo use this image.', 'simple-days').'<br />'.__( 'For more information', 'simple-days').' <a href="'.esc_url('https://developers.google.com/search/docs/data-types/article#amp').'" target="_blank">'.__( 'click here' , 'simple-days').'</a>',
      'section' => 'simple_days_amp_setting',
    )));

    $wp_customize->add_setting( 'simple_days_amp_analytics',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_amp_analytics',array(
      'label'   => esc_html__( 'Google Analytics AMP account', 'simple-days'),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('UA-XXXXXX-Y'),
      'section' => 'simple_days_amp_setting',
      'type'    => 'text',
    ));



    
  // Add Settings and Controls for OGP.
    $wp_customize->add_section('simple_days_ogp_setteing',array(
      'title' => esc_html__('OGP', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));
    
    $wp_customize->add_setting( 'simple_days_ogp',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_ogp',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('add metadata for Open Graph protocol(OGP)', 'simple-days'),
      'section' => 'simple_days_ogp_setteing',
      'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting( 'simple_days_ogp_logo_img',array(
      'default'    => esc_url(get_template_directory_uri() .'/assets/images/ogp.jpg'),
      'sanitize_callback' => 'simple_days_sanitize_image_file',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simple_days_ogp_logo_img', array(
      'label' => esc_html__( 'OGP Image', 'simple-days'),
      'description' => esc_html__( 'If no thumbnail or home page then use this image.', 'simple-days'),
      'section' => 'simple_days_ogp_setteing',
    )));

    
    $wp_customize->add_setting( 'simple_days_twitter_card', array(
      'default'           => 'false',
      'sanitize_callback' => 'simple_days_sanitize_radio',
    )
  );
    $wp_customize->add_control( 'simple_days_twitter_card', array(
      'label'    => esc_html__( 'Twitter Card', 'simple-days' ),
      'section'  => 'simple_days_ogp_setteing',
      'type'     => 'radio',
      'choices'  => array(
        'false' => esc_html__( 'Disable', 'simple-days' ),
        'summary' => esc_html__( 'Summary Card', 'simple-days' ),
        'summary_large_image' => esc_html__( 'Summary Card with Large Image', 'simple-days' ),
      ),
    ));




    
  // Add Settings and Controls for Sitemap.
    $wp_customize->add_section('simple_days_sitemap_setteing',array(
      'title' => esc_html__('Site map', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));

    
    $wp_customize->add_setting( 'simple_days_sitemap_page',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_sitemap_page',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Display the site map at the page.', 'simple-days'),
      'section' => 'simple_days_sitemap_setteing',
      'type' => 'checkbox',
    ));
    $wp_customize->add_setting( 'simple_days_sitemap_page_post_name',array(
      'default'           => '',
      'sanitize_callback' => 'wp_strip_all_tags',
    ));
    $wp_customize->add_control('simple_days_sitemap_page_post_name',array(
      'label'   => esc_html__( 'Page slug to be display at the page.', 'simple-days'),
      'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('sitemap'),
      'section' => 'simple_days_sitemap_setteing',
      'type'    => 'text',
    ));



    $wp_customize->add_setting( 'simple_days_sitemap_footer',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_sitemap_footer',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('Display the site map link at footer area', 'simple-days'),
      'section' => 'simple_days_sitemap_setteing',
      'type' => 'checkbox',
    ));


    
  // Add Settings and Controls for Option.
    $wp_customize->add_section('simple_days_script_css',array(
      'title' => esc_html__('JavaScript and CSS', 'simple-days'),
      'panel' => 'simple_days_setting',
    ));


    $wp_customize->add_setting( 'simple_days_script_css_fontawesome_info', array(
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_script_css_fontawesome_info', array(
      'section' => 'simple_days_script_css',
      'label' => esc_html__( 'use CDN FontAwesome 4', 'simple-days' ),
      
      'content' => esc_html__('Simple Days\'s careful selection of FontAwesome icons to make it smoothly.', 'simple-days').'<br>'.esc_html__('Therefore, you can not use full icons.', 'simple-days').'<br>'.esc_html__('If you use CDN FontAwesome, you can use full icons.', 'simple-days').'<br>'.esc_html__('but to be slowly.', 'simple-days'),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));
    $wp_customize->add_setting( 'simple_days_fontawesome',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_fontawesome',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('use CDN FontAwesome 4', 'simple-days'),
      'section' => 'simple_days_script_css',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_lightbox',array(
      'default'    => 'false',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_lightbox',array(
      'label'   => esc_html__( 'Lightbox', 'simple-days'),
      'section' => 'simple_days_script_css',
      'type'     => 'radio',
      'choices'  => array(
        'false' => esc_html__( 'Disable', 'simple-days' ),
        'lity' => esc_html__( 'Lity', 'simple-days' ),
      ),
    ));



    $wp_customize->add_setting( 'simple_days_highlight',array(
      'default'    => false,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_highlight',array(
      'label'   => esc_html__( 'Enable', 'simple-days'),
      'description' => esc_html__('use highlight.js', 'simple-days'),
      'section' => 'simple_days_script_css',
      'type' => 'checkbox',
    ));

    $wp_customize->add_setting( 'simple_days_highlight_styles',array(
      'default'       => 'default',
      'sanitize_callback' => 'simple_days_sanitize_select',
    ));

    $highlight_styles = array(
      'default'                 => 'default',
      'agate'                   => 'agate',
      'androidstudio'                 => 'androidstudio',
      'arduino-light'                   => 'arduino-light',
      'arta'                 => 'arta',
      'ascetic'                   => 'ascetic',
      'atelier-cave-dark'                 => 'atelier-cave-dark',
      'atelier-cave-light'                   => 'atelier-cave-light',
      'atelier-dune-dark'                 => 'atelier-dune-dark',
      'atelier-dune-light'                   => 'atelier-dune-light',
      'atelier-estuary-dark'                 => 'atelier-estuary-dark',
      'atelier-estuary-light'                   => 'atelier-estuary-light',
      'atelier-forest-dark'                 => 'atelier-forest-dark',
      'atelier-forest-light'                   => 'atelier-forest-light',
      'atelier-heath-dark'                 => 'atelier-heath-dark',
      'atelier-heath-light'                   => 'atelier-heath-light',
      'atelier-lakeside-dark'                 => 'atelier-lakeside-dark',
      'atelier-lakeside-light'                   => 'atelier-lakeside-light',
      'atelier-plateau-dark'                 => 'atelier-plateau-dark',
      'atelier-plateau-light'                   => 'atelier-plateau-light',
      'atelier-savanna-dark'                 => 'atelier-savanna-dark',
      'atelier-savanna-light'                   => 'atelier-savanna-light',
      'atelier-seaside-dark'                 => 'atelier-seaside-dark',
      'atelier-seaside-light'                   => 'atelier-seaside-light',
      'atelier-sulphurpool-dark'                 => 'atelier-sulphurpool-dark',
      'atelier-sulphurpool-light'                   => 'atelier-sulphurpool-light',
      'atom-one-dark'                 => 'atom-one-dark',
      'atom-one-light'                   => 'atom-one-light',
      'brown-paper'                 => 'brown-paper',
      'codepen-embed'                   => 'codepen-embed',
      'color-brewer'                 => 'color-brewer',
      'darcula'                   => 'darcula',
      'dark'                 => 'dark',
      'darkula'                   => 'darkula',
      'docco'                 => 'docco',
      'dracula'                   => 'dracula',
      'far'                 => 'far',
      'foundation'                   => 'foundation',
      'github'                 => 'github',
      'github-gist'                   => 'github-gist',
      'googlecode'                 => 'googlecode',
      'grayscale'                   => 'grayscale',
      'gruvbox-dark'                 => 'gruvbox-dark',
      'gruvbox-light'                   => 'gruvbox-light',
      'hopscotch'                 => 'hopscotch',
      'hybrid'                   => 'hybrid',
      'idea'                 => 'idea',
      'ir-black'                   => 'ir-black',
      'kimbie.dark'                 => 'kimbie.dark',
      'kimbie.light'                   => 'kimbie.light',
      'magula'                   => 'magula',
      'mono-blue'                 => 'mono-blue',
      'monokai'                   => 'monokai',
      'monokai-sublime'                 => 'monokai-sublime',
      'obsidian'                   => 'obsidian',
      'ocean'                 => 'ocean',
      'paraiso-dark'                   => 'paraiso-dark',
      'paraiso-light'                 => 'paraiso-light',
      'pojoaque'                   => 'pojoaque',
      'purebasic'                   => 'purebasic',
      'qtcreator_dark'                 => 'qtcreator_dark',
      'qtcreator_light'                   => 'qtcreator_light',
      'railscasts'                 => 'railscasts',
      'rainbow'                   => 'rainbow',
      'routeros'                 => 'routeros',
      'school-book'                   => 'school-book',
      'solarized-dark'                 => 'solarized-dark',
      'solarized-light'                   => 'solarized-light',
      'sunburst'                   => 'sunburst',
      'tomorrow'                 => 'tomorrow',
      'tomorrow-night'                   => 'tomorrow-night',
      'tomorrow-night-blue'                 => 'tomorrow-night-blue',
      'tomorrow-night-bright'                   => 'tomorrow-night-bright',
      'tomorrow-night-eighties'                 => 'tomorrow-night-eighties',
      'vs'                   => 'vs',
      'vs2015'                 => 'vs2015',
      'xcode'                   => 'xcode',
      'xt256'                   => 'xt256',
      'zenburn'                 => 'zenburn',
    );

$wp_customize->add_control('simple_days_highlight_styles',array(
  'label'   => esc_html__( 'Style of highlight.js', 'simple-days'),
  'section' => 'simple_days_script_css',
  'type'    => 'select',
  'choices' => $highlight_styles,
));





  // Add Settings and Controls for Option.
$wp_customize->add_section('simple_days_word_balloon',array(
  'title' => esc_html__('Word Balloon', 'simple-days'),
  'panel' => 'simple_days_setting',
));

$wp_customize->add_setting( 'simple_days_page_word_balloon_amp',array(
  'default'    => false,
  'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control( 'simple_days_page_word_balloon_amp',array(
  'label'   => esc_html__( 'Enable', 'simple-days'),
  'description' => esc_html__('Use word balloon css when AMP', 'simple-days'),
  'section' => 'simple_days_word_balloon',
  'type' => 'checkbox',
));
/*
  $wp_customize->add_setting( 'simple_days_page_word_balloon_install', array(
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_page_word_balloon_install', array(
    'section' => 'simple_days_word_balloon',
    'label' => esc_html__( 'Install Word Balloon Plugins', 'simple-days' ),
    'content' => '<a href="'. esc_url( admin_url( 'plugin-install.php?tab=search&type=author&s=yahman' ) ).'" class="button button-secondary">'.esc_html__( 'Install Plugins', 'simple-days' ).'</a>',
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
  )));
*/

  $wp_customize->add_setting( 'simple_days_page_word_balloon_install', array(
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( new Simple_Days_plugin_install_Custom_Content( $wp_customize, 'simple_days_page_word_balloon_install', array(
    'section' => 'simple_days_word_balloon',
    
    'label' => sprintf(esc_html__('Install Plugin [ %s ]', 'simple-days'), esc_html__( 'Word Balloon', 'simple-days')),
    'plugin' => array(
     'name' => esc_html__('Word Balloon', 'simple-days'),
     'dir' => 'word-balloon',
     'filename' => 'word_balloon.php',
   ),
    
      
      
      
      
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
    )));



  
  // Add Settings and Controls for Option.
  $wp_customize->add_section('simple_days_gutenberg_setting',array(
    'title' => esc_html__('Gutenberg', 'simple-days'),
    'panel' => 'simple_days_setting',
  ));
  get_template_part( 'inc/gutenberg_block', 'list' );
  $gutenberg_block = get_query_var('gutenberg_block_list');

  $wp_customize->add_setting( 'simple_days_gutenberg_block_info', array(
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( new Simple_Days_html_text_Custom_Content( $wp_customize, 'simple_days_gutenberg_block_info', array(
    'section' => 'simple_days_gutenberg_setting',
    'label' => esc_html__( 'Select a block to be displayed', 'simple-days' ),
    
    //'content' => sprintf(esc_html__('This selection overrides %s.', 'simple-days'), esc_html__( 'Google Fonts', 'simple-days')),
    //'description' => esc_html__( 'Optional: Example Description.', 'simple-days' ),
  )));

  foreach ($gutenberg_block['core_list'] as $key => $value) {
    $wp_customize->add_setting( 'simple_days_gutenberg_block_'.$key,array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_gutenberg_block_'.$key,array(
      'label'   => esc_html($value),
    //'description' => esc_html__('Uploaded to this post is always enabled on the Add Media.', 'simple-days'),
      'section' => 'simple_days_gutenberg_setting',
      'type' => 'checkbox',
    ));
  }
  foreach ($gutenberg_block['embed_list'] as $key => $value) {
    $wp_customize->add_setting( 'simple_days_gutenberg_block_'.$key,array(
      'default'    => true,
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( 'simple_days_gutenberg_block_'.$key,array(
      'label'   => esc_html($value),
    //'description' => esc_html__('Uploaded to this post is always enabled on the Add Media.', 'simple-days'),
      'section' => 'simple_days_gutenberg_setting',
      'type' => 'checkbox',
    ));
  }




  
  // Add Settings and Controls for Option.
  $wp_customize->add_section('simple_days_option',array(
    'title' => esc_html__('Option', 'simple-days'),
    'panel' => 'simple_days_setting',
  ));

  
  $wp_customize->add_setting( 'simple_days_uploaded_to_this_post',array(
    'default'    => false,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( 'simple_days_uploaded_to_this_post',array(
    'label'   => esc_html__( 'Enable', 'simple-days'),
    'description' => esc_html__('Uploaded to this post is always enabled on the Add Media.', 'simple-days'),
    'section' => 'simple_days_option',
    'type' => 'checkbox',
  ));

  
  $wp_customize->add_setting( 'simple_days_no_robots',array(
    'default'    => true,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( 'simple_days_no_robots',array(
    'label'   => esc_html__( 'Enable', 'simple-days'),
    'description' => esc_html__('Robots do not search for 404 , search , tag , year , month , day page', 'simple-days'),
    'section' => 'simple_days_option',
    'type' => 'checkbox',
  ));

  
  $wp_customize->add_setting( 'simple_days_404_img',array(
    'default'    => esc_url(get_template_directory_uri() .'/assets/images/404.jpg'),
    'sanitize_callback' => 'simple_days_sanitize_image_file',
  ));
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simple_days_404_img', array(
    'label' => esc_html__( '404 Image', 'simple-days'),
    'description' => esc_html__( '404 page use this image.', 'simple-days'),
    'section' => 'simple_days_option',
  )));

  
  $wp_customize->add_setting( 'simple_days_no_img',array(
    'default'    => esc_url(get_template_directory_uri() .'/assets/images/no_image.png'),
    'sanitize_callback' => 'simple_days_sanitize_image_file',
  ));
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'simple_days_no_img', array(
    'label' => esc_html__( 'No Image', 'simple-days'),
    'description' => esc_html__( 'No thumbnail page use this image.', 'simple-days'),
    'section' => 'simple_days_option',
  )));




  $wp_customize->add_setting( 'simple_days_header_image_text',array(
    'default'           => '',
    'sanitize_callback' => 'wp_strip_all_tags',
  ));
  $wp_customize->add_control('simple_days_header_image_text',array(
    'label'   => esc_html__( 'Text on Header image', 'simple-days'),
        //'description' => esc_html__('e.g.&nbsp;', 'simple-days').esc_html('1234567890'),
    'section' => 'header_image',
    'priority'    => 0,
    'type'    => 'text',
  ));


  $wp_customize->add_setting( 'simple_days_skin_style',array(
    'default'    => 'none',
    'sanitize_callback' => 'simple_days_sanitize_select',
  ));
  $wp_customize->add_control( 'simple_days_skin_style',array(
    'label'   => esc_html__( 'Skins', 'simple-days'),
    'description' => esc_html__('You can easily change color', 'simple-days'),
    'section' => 'colors',
    'type' => 'select',
    'choices' => array(
     'none' => 'none',
     'red_orange' => esc_html__('Red Orange', 'simple-days'),
     'orange' => esc_html__('Orange', 'simple-days'),
     'rose_peche' => esc_html__('Rose Peche', 'simple-days'),
     'grape_juice' => esc_html__('Grape Juice', 'simple-days'),
     'blue_yellow' => esc_html__('Blue Yellow', 'simple-days'),
     'blue_ocean' => esc_html__('Blue Ocean', 'simple-days'),
     'petrole' => esc_html__('Petrole', 'simple-days'),
     'apple_green' => esc_html__('Apple Green', 'simple-days'),
     'moss_green' => esc_html__('Moss Green', 'simple-days'),
     'yellow_mustard' => esc_html__('Yellow Mustard', 'simple-days'),
     'cinnamon' => esc_html__('Cinnamon', 'simple-days'),
     'brown_bread' => esc_html__('Brown Bread', 'simple-days'),
     'gray_horse' => esc_html__('Gray Horse', 'simple-days'),
     'black_coffee' => esc_html__('Black Coffee', 'simple-days'),
   ),
  ));
  $wp_customize->add_setting( 'simple_days_skin_style_random',array(
    'default'    => false,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control( 'simple_days_skin_style_random',array(
    'label'   => esc_html__( 'Enable', 'simple-days'),
    'description' => esc_html__('Selects skins randomly at access.', 'simple-days'),
    'section' => 'colors',
    'type' => 'checkbox',
  ));

      //background Color
  $wp_customize->add_setting( 'simple_days_background_color',array(
    'default'           => define("simple_days_background_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,
   'simple_days_background_color',array(
    'label'      => esc_html__( 'Background Color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;fafafa'),
  )));
      //Link Color
  $wp_customize->add_setting( 'link_textcolor',array(
    'default'           => define("link_textcolor", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,
   'link_textcolor',array(
    'label'      => esc_html__( 'Link Color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;07a'),
  )));
      //Link Hover Color
  $wp_customize->add_setting( 'link_hover_color',array(
    'default'           => define("link_hover_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,'link_hover_color',array(
    'label'      => esc_html__( 'Link Hover Color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;222'),
  )));
      //Blog Title Color
  $wp_customize->add_setting( 'blog_name',array(
    'default'           => define("blog_name", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,'blog_name',array(
    'label'      => esc_html__( 'Site Title', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;07a'),
  )));

      //Blog Header Color
  $wp_customize->add_setting( 'header_color',array(
    'default'           => define("header_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,'header_color',array(
    'label'      => esc_html__( 'Header background color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;fff'),
  )));

      //Blog Header Menu BG Color
  $wp_customize->add_setting( 'header_nav_h2_bg_color',array(
    'default'           => define("header_nav_h2_bg_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,'header_nav_h2_bg_color',array(
    'label'      => esc_html__( 'Header Menu background color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;f1f1f1'),
  )));

      //Blog Footer Widget Color
  $wp_customize->add_setting( 'footer_widget_color',array(
    'default'           => define("footer_widget_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,'footer_widget_color',array(
    'label'      => esc_html__( 'Footer Widget background area color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;474747'),
  )));
      //Footer Widget text color
  $wp_customize->add_setting( 'footer_widget_textcolor',array(
    'default'           => define("footer_widget_textcolor", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,
   'footer_widget_textcolor',array(
    'label'      => esc_html__( 'Footer Widget text color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;d4d4d4'),
  )));
      //Footer Widget text color
  $wp_customize->add_setting( 'footer_widget_linkcolor',array(
    'default'           => define("footer_widget_linkcolor", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,
   'footer_widget_linkcolor',array(
    'label'      => esc_html__( 'Footer Widget link color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;fff'),
  )));

      //Footer Widget text color
  $wp_customize->add_setting( 'f_menu_wrap_bg_color',array(
    'default'           => define("f_menu_wrap_bg_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,
   'f_menu_wrap_bg_color',array(
    'label'      => esc_html__( 'Footer Menu background color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;f1f1f1'),
  )));

      //Blog Footer Color
  $wp_customize->add_setting( 'footer_color',array(
    'default'           => define("footer_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,'footer_color',array(
    'label'      => esc_html__( 'Footer color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;33363b'),
  )));

      //Blog Footer Color
  $wp_customize->add_setting( 'oh_wrap_bg_color',array(
    'default'           => define("oh_wrap_bg_color", ""),
    'sanitize_callback' => 'sanitize_hex_color',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,'oh_wrap_bg_color',array(
    'label'      => esc_html__( 'Over Header background color', 'simple-days' ),
    'section'    => 'colors',
    'description' => esc_html__('default&#58;', 'simple-days').esc_html('&#35;33363b'),
  )));
  
      /*if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector' => '.site_title a',
        // PHP 5.2 or earlier 'render_callback' => function() { bloginfo( 'name' ); },
        'render_callback' => 'simple_days_customize_partial_blogname',
        ) );
      }*/


      
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

      $wp_customize->get_setting( 'simple_days_background_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'link_textcolor' )->transport = 'postMessage';
      $wp_customize->get_setting( 'link_hover_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blog_name' )->transport = 'postMessage';
      $wp_customize->get_setting( 'header_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'footer_widget_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'footer_widget_textcolor' )->transport = 'postMessage';
      $wp_customize->get_setting( 'footer_widget_linkcolor' )->transport = 'postMessage';
      $wp_customize->get_setting( 'footer_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'header_nav_h2_bg_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'f_menu_wrap_bg_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'oh_wrap_bg_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_bg_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_text_position' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_border_type' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_border_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_border_width' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_text_size' )->transport = 'postMessage';
      $wp_customize->get_setting( 'simple_days_alert_box_border_inside' )->transport = 'postMessage';

      if(get_theme_mod( 'simple_days_sidebar_layout','3') != '0'){
        $wp_customize->get_setting( 'simple_days_sidebar_layout' )->transport = 'postMessage';
      }



    }

    function simple_days_customize_partial_blogname() {
     bloginfo( 'name' );
   }

   public static function live_preview() {
     wp_enqueue_script(
              'simple_days_customizer_script', // Give the script a unique ID
              get_template_directory_uri() . '/assets/js/customizer/customizer.min.js', // Define the path to the JS file
              array( 'jquery', 'customize-preview' ), // Define dependencies
              null, // Define a version (optional)
              true // Specify whether to put in footer (leave this true)
            );
   }

   public static function header_output() {

    if ( !is_amp() ){ ?>
      <!--Customizer CSS-->
      <style type="text/css">
      <?php self::generate_css('body', 'background', 'simple_days_background_color'); ?>
      <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
      <?php self::generate_css('a:hover:not(.non_hover)', 'color', 'link_hover_color'); ?>
      <?php self::generate_css('.site_title a', 'color', 'blog_name'); ?>
      <?php self::generate_css('#site_h', 'background', 'header_color'); ?>
      <?php self::generate_css('.f_widget_wrap', 'background', 'footer_widget_color'); ?>
      <?php self::generate_css('.f_widget_wrap', 'color', 'footer_widget_textcolor'); ?>
      <?php self::generate_css('.f_widget_wrap a:not(.icon_base):not(.to_top)', 'color', 'footer_widget_linkcolor'); ?>
      <?php self::generate_css('.credit_wrap', 'background', 'footer_color'); ?>
      <?php self::generate_css('.nav_h2', 'background', 'header_nav_h2_bg_color'); ?>
      <?php self::generate_css('.f_menu_wrap', 'background', 'f_menu_wrap_bg_color'); ?>
      <?php self::generate_css('#oh_wrap', 'background', 'oh_wrap_bg_color'); ?>


      <?php

      $font_body = $font_headings = $font_site_title = $font_post_title = '';

      $google_font_body_jp = get_theme_mod( 'simple_days_font_body_google_jp','none');
      $font_body_jp = get_theme_mod( 'simple_days_font_body_jp','none');
      $google_font_body = get_theme_mod( 'simple_days_font_body_google','none');
      if( $google_font_body_jp != 'none'){
       $font_body = '"'.$google_font_body_jp.'"';
     }else if($font_body_jp != 'none'){
       $font_body = $font_body_jp;
     }else if($google_font_body != 'none'){
       $font_body = $google_font_body;
     }else if(get_theme_mod( 'simple_days_font_body','none') != 'none'){
       $font_body = get_theme_mod( 'simple_days_font_body');
     }

     $google_font_headings_jp = get_theme_mod( 'simple_days_font_headings_google_jp','none');
     $font_headings_jp = get_theme_mod( 'simple_days_font_headings_jp','none');
     $google_font_headings = get_theme_mod( 'simple_days_font_headings_google','none');
     if( $google_font_headings_jp != 'none'){
       $font_headings = '"'.$google_font_headings_jp.'"';
     }else if($font_headings_jp != 'none'){
       $font_headings = $font_headings_jp;
     }else if($google_font_headings != 'none'){
       $font_headings = $google_font_headings;
     }else if(get_theme_mod( 'simple_days_font_headings','none') != 'none'){
       $font_headings = get_theme_mod( 'simple_days_font_headings');
     }

     $google_font_site_title_jp = get_theme_mod( 'simple_days_font_site_title_google_jp','none');
     $font_site_title_jp = get_theme_mod( 'simple_days_font_site_title_jp','none');
     $google_font_site_title = get_theme_mod( 'simple_days_font_site_title_google','none');
     if( $google_font_site_title_jp != 'none'){
       $font_site_title = '"'.$google_font_site_title_jp.'"';
     }else if($font_site_title_jp != 'none'){
       $font_site_title = $font_site_title_jp;
     }else if($google_font_site_title != 'none'){
       $font_site_title = $google_font_site_title;
     }else if(get_theme_mod( 'simple_days_font_site_title','none') != 'none'){
       $font_site_title = get_theme_mod( 'simple_days_font_site_title');
     }

     $google_font_post_title_jp = get_theme_mod( 'simple_days_font_post_title_google_jp','none');
     $font_post_title_jp = get_theme_mod( 'simple_days_font_post_title_jp','none');
     $google_font_post_title = get_theme_mod( 'simple_days_font_post_title_google','none');
     if( $google_font_post_title_jp != 'none'){
       $font_post_title = '"'.$google_font_post_title_jp.'"';
     }else if($font_post_title_jp != 'none'){
       $font_post_title = $font_post_title_jp;
     }else if($google_font_post_title != 'none'){
       $font_post_title = $google_font_post_title;
     }else if(get_theme_mod( 'simple_days_font_post_title','none') != 'none'){
       $font_post_title = get_theme_mod( 'simple_days_font_post_title');
     }

     if($font_body != ''){
      echo 'body{font-family:'.$font_body.';}';
    }
    if($font_headings != ''){
      echo 'h1,h2,h3,h4,h5,h6{font-family:'.$font_headings.';}';
    }
    if($font_site_title != ''){
      echo '.site_title a{font-family:'.$font_site_title.';}';
    }

    if($font_post_title != ''){
      echo '.post_title{font-family:'.$font_post_title.';}';
    }

    if(get_theme_mod( 'simple_days_box_style','flat') == 'shadow'){
      echo ' .simple_days_box_shadow{-webkit-box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);-webkit-border-radius:2px;border-radius:2px}.to_top{box-shadow: 0px 4px 16px rgba(0, 0, 0, 1)}';
    }elseif (get_theme_mod( 'simple_days_header_shadow',true)) {
      echo ' #h_wrap{-webkit-box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);-webkit-border-radius:2px;border-radius:2px}.to_top{box-shadow: 0px 4px 16px rgba(0, 0, 0, 1)}';
    }
    ?>
    <?php $read_more_position = get_theme_mod( 'simple_days_read_more_position','right');
    if( $read_more_position != 'right' && $read_more_position != 'none'){
     echo '.more_read_box{text-align:'.($read_more_position == 'center' ? 'center' : 'left').'}';
   }
   if(get_theme_mod( 'simple_days_index_thumbnail','left') == 'right'){
     echo '.post_card_thum{-webkit-box-ordinal-group:3;-ms-flex-order:3;-webkit-order:3;order:3;}';
   }
   if(get_theme_mod( 'simple_days_index_date_position','left') == 'right'){
     echo '.post_card_date{left:auto;right:0;}';
   }
   if(get_theme_mod( 'simple_days_index_category_position','right') == 'left'){
     echo '.post_card_category{right:auto;left:0;}';
   }
   if(get_theme_mod( 'simple_days_posts_author_position','right') == 'left'){
     echo '.post_author{text-align:left}';
   }
   if(get_theme_mod( 'simple_days_posts_date_position','right') == 'left'){
     echo '.post_date{text-align:left}';
   }
   if(get_theme_mod( 'simple_days_page_author_position','none') == 'left'){
     echo '.page_author{text-align:left}';
   }
   if(get_theme_mod( 'simple_days_page_date_position','none') == 'left'){
     echo '.page_date{text-align:left}';
   }
   if(get_theme_mod( 'simple_days_breadcrumbs_display','left') == 'right'){
     echo '.breadcrumb{text-align:right}';
   }
   if(get_theme_mod( 'simple_days_popular_post_view_position','right') != 'right'){
     echo '.page_view{text-align:'.get_theme_mod( 'simple_days_popular_post_view_position','right').'}';
   }

   $i = 1;
   $awsome_b = $awsome_a = '';
   $icon_color = '';
   $icon_before_after = 'before';
   while($i <= 10){
     if(get_theme_mod( 'simple_days_menu_bar_h_icon_'.$i,'none') != 'none'){
       if(get_theme_mod( 'simple_days_menu_bar_h_icon_color_'.$i,'') != '')$icon_color = 'color:'.get_theme_mod( 'simple_days_menu_bar_h_icon_color_'.$i,'').';';
       
       if(get_theme_mod( 'simple_days_menu_bar_h_icon_after_'.$i,false))$icon_before_after = 'after';$awsome_a = '1';
       
       if(!is_customize_preview()){
         echo '#menu_h > .menu-item:nth-child('.$i.') > a:'.$icon_before_after.'{'.$icon_color.'content:"\\'.get_theme_mod( 'simple_days_menu_bar_h_icon_'.$i).'"'.'}';
       }else{
         echo '#menu_h > .menu-item:nth-child('.($i+1).') > a:'.$icon_before_after.'{'.$icon_color.'content:"\\'.get_theme_mod( 'simple_days_menu_bar_h_icon_'.$i).'"'.'}';
       }
       $awsome_b = '1';
     }
     $icon_color = '';
     $icon_before_after = 'before';
     $i++;
   }

   $i = 1;
   $icon_color = '';
   while($i <= 10){
     if(get_theme_mod( 'simple_days_menu_bar_f_icon_'.$i,'none') != 'none'){
       if(get_theme_mod( 'simple_days_menu_bar_f_icon_color_'.$i,'') != '')$icon_color = 'color:'.get_theme_mod( 'simple_days_menu_bar_f_icon_color_'.$i,'').';';
       
       if(get_theme_mod( 'simple_days_menu_bar_f_icon_after_'.$i,false))$icon_before_after = 'after';$awsome_a = '1';
       
       if(!is_customize_preview()){
         echo '#menu_f > .menu-item:nth-child('.$i.') > a:'.$icon_before_after.'{'.$icon_color.'content:"\\'.get_theme_mod( 'simple_days_menu_bar_f_icon_'.$i).'"'.'}';
       }else{
         echo '#menu_f > .menu-item:nth-child('.($i+1).') > a:'.$icon_before_after.'{'.$icon_color.'content:"\\'.get_theme_mod( 'simple_days_menu_bar_f_icon_'.$i).'"'.'}';
       }
       $awsome_b = '1';
     }
     $icon_color = '';
     $icon_before_after = 'before';
     $i++;
   }

   if($awsome_b == '1'){
     echo '.menu-item > a:before {font:16px/1 FontAwesome;display:inline-block;margin-right:4px;}';
   }
   if($awsome_a == '1'){
     echo '.menu-item > a:after {font:16px/1 FontAwesome;display:inline-block;margin-left:4px;}';
   }

   if( get_theme_mod( 'simple_days_alert_box',false)){
    echo '#h_alert{';
    if( get_theme_mod( 'simple_days_alert_box_bg_color','')){
     echo 'background:'.get_theme_mod( 'simple_days_alert_box_bg_color','').';';
   }
   if( get_theme_mod( 'simple_days_alert_box_color','')){
     echo 'color:'.get_theme_mod( 'simple_days_alert_box_color','').';';
   }
   if( get_theme_mod( 'simple_days_alert_box_text_position','center') != 'left'){
     echo 'text-align:'.get_theme_mod( 'simple_days_alert_box_text_position','center').';';
   }
   if( get_theme_mod( 'simple_days_alert_box_text_size',16) != 16){
     echo 'font-size:'.get_theme_mod( 'simple_days_alert_box_text_size',16).'px;';
   }
   $alert_box_border['type'] = get_theme_mod( 'simple_days_alert_box_border_type','none');
   if( $alert_box_border['type'] != 'none' && !get_theme_mod( 'simple_days_alert_box_border_inside',false)){
     $alert_box_border['width'] = get_theme_mod( 'simple_days_alert_box_border_width',1);
     echo 'border:'.$alert_box_border['type'].' '.$alert_box_border['width'].'px '.get_theme_mod( 'simple_days_alert_box_border_color','');
   }
   echo '}';
   if( $alert_box_border['type'] != 'none' && get_theme_mod( 'simple_days_alert_box_border_inside',false)){
     $alert_box_border['width'] = get_theme_mod( 'simple_days_alert_box_border_width',1);
     echo '#h_alert_box{display:inline-block;border:'.$alert_box_border['type'].' '.$alert_box_border['width'].'px '.get_theme_mod( 'simple_days_alert_box_border_color','').'}';
   }
 }




 $mod = get_theme_mod( 'simple_days_menu_layout','1');
 $mod2 = get_theme_mod( 'simple_days_menu_layout_title_position','center');
 $mod3 = get_theme_mod( 'simple_days_menu_layout_menu_position','left');

 echo '@media screen and (min-width: 980px) {';

 if(get_theme_mod( 'simple_days_sidebar_layout','3') == '1'){
        echo '.sidebar{-webkit-box-ordinal-group:1;-ms-flex-order:1;-webkit-order:1;order:1;margin:20px 30px 0 0}';
 }


 if($mod == '1' || $mod == '2'){
   echo '.a_w{flex:1 1 auto}.h_widget{flex:0 0 auto}';
 }
 if($mod == '1'){
   echo '.title_wrap{margin-right:20px}.menu_base{justify-content:flex-end}';
 }
 if($mod == '2'){
   echo '.a_w,.title_wrap{-webkit-box-ordinal-group:2;-ms-flex-order:2;-webkit-order:2;order:2}.title_wrap{padding-left:20px;margin-left:auto}';
 }
 if($mod == '3' || $mod == '4'){
   echo '#site_h .container{-webkit-flex-direction:column;flex-direction:column;}';
   if($mod2 == 'left'){
     echo '.title_wrap{margin-right:auto}';
   }
   if($mod2 == 'center'){
     echo '.title_wrap{margin:0 auto}.header_logo{position:absolute;left:0;right:0;margin:0 auto}';
     if( is_active_sidebar( 'header_widget' )){
       echo '.h_no_logo{position:absolute;left:50%;transform:translate(-50%,0%)}.site_title{height:40px}';
     }else{
       echo '.site_title{height:40px;margin:0 auto}';
     }
   }
   if($mod2 == 'right'){
     echo '.title_wrap{-webkit-box-ordinal-group:2;-ms-flex-order:2;-webkit-order:2;order:2;margin-left:auto}';
   }
   if($mod3 == 'center'){
     echo '#menu_h{margin:0 auto}';
   }
   if($mod3 == 'right'){
     echo '#menu_h{margin-left:auto;justify-content:flex-end}';
   }
 }
 if($mod == '4'){
   echo '#site_h{-webkit-box-ordinal-group:2;-ms-flex-order:2;-webkit-order:2;order:2;}';
 }
 echo '}';



 if ( !is_active_sidebar( 'footer-1' ) && !is_active_sidebar( 'footer-2' ) && !is_active_sidebar( 'footer-3' )){
   echo '.f_widget_wrap{background:transparent}';
 }
 ?>
</style>
<!--/Customizer CSS-->
<?php }
}

    /**
     * <head> 内に出力する CSS を作成します。
     * $mod_name 設定が未定義の場合は、何も出力しません。
     *
     * @uses get_theme_mod()
     * @param string $selector CSSセレクタ。
     * @param string $style 変更する CSS *プロパティ* 名。
     * @param string $mod_name 'theme_mod' 設定の名前。
     * @param string $prefix （任意）CSS プロパティの前に出力する内容。
     * @param string $postfix （任意）CSS プロパティの後に出力する内容。
     * @param bool $echo （任意）出力するか否か (デフォルト：true)。
     * @return string セレクタとプロパティからなる1行の CSS を返します。
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
       $return = sprintf('%s { %s:%s; }',
        $selector,
        $style,
        $prefix.$mod.$postfix
      );
       if ( $echo ) {
        echo esc_attr($return);
      }
    }
    return $return;
  }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Simple_Days_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'Simple_Days_Customize' , 'header_output' ) );

// 即時反映用の JavaScript をエンキューします。
add_action( 'customize_preview_init' , array( 'Simple_Days_Customize' , 'live_preview' ) );

if ( class_exists( 'WP_Customize_Control' ) ) {

  class Simple_Days_Posts_Sortable_Custom_Control extends WP_Customize_Control {
    
    public $type = 'simple_days_posts_sortable';
    
    public function enqueue() {
      wp_register_script(
        'simple_days_sortable',
        get_template_directory_uri() . '/assets/js/customizer/sortable.min.js',
        array( 'jquery', 'customize-base', 'jquery-ui-core', 'jquery-ui-sortable' ),
        '',
        true
      );
      wp_enqueue_script( 'simple_days_sortable' );
    }

    
    public function render_content() {
      $sort_order_list =array(
       'breadcrumbs','title','date','author','pv','thumbnail','content','widget','page_link','cta','share','author_profile','related','category','tag','pagenation','comment'
     );

      $sortable = $this->choices;
      if(count($sort_order_list) != count($this->choices)){
        $sortable = $sortable + array_diff($sort_order_list,$this->choices);
      }

      echo '<span class="customize-control-title">'.esc_html($this->label).'</span>';
      echo '<span class="description customize-control-description">'.esc_html($this->description).'</span>';
      echo '<ul class="simple_days_posts_sortable_ul">';
      foreach ($sortable as $key => $value) {
        switch ($value){
          case 'breadcrumbs':
          $value_item = esc_html_x( 'Breadcrumbs' , 'post_sortable' ,'simple-days' );
          break;
          case 'title':
          $value_item = esc_html_x( 'Title' , 'post_sortable' ,'simple-days' );
          break;
          case 'date':
          $value_item = esc_html_x( 'Date' , 'post_sortable' ,'simple-days' );
          break;
          case 'author':
          $value_item = esc_html_x( 'Author' , 'post_sortable' ,'simple-days' );
          break;
          case 'pv':
          $value_item = esc_html_x( 'Page views' , 'post_sortable' ,'simple-days' );
          break;
          case 'thumbnail':
          $value_item = esc_html_x( 'Thumbnail' , 'post_sortable' ,'simple-days' );
          break;
          case 'content':
          $value_item = esc_html_x( 'Content' , 'post_sortable' ,'simple-days' );
          break;
          case 'widget':
          $value_item = esc_html_x( 'Widget' , 'post_sortable' ,'simple-days' );
          break;
          case 'page_link':
          $value_item = esc_html_x( 'Page Link' , 'post_sortable' ,'simple-days' );
          break;
          case 'cta':
          $value_item = esc_html_x( 'CTA' , 'post_sortable' ,'simple-days' );
          break;
          case 'share':
          $value_item = esc_html_x( 'Share' , 'post_sortable' ,'simple-days' );
          break;
          case 'author_profile':
          $value_item = esc_html_x( 'About the author' , 'post_sortable' ,'simple-days' );
          break;
          case 'related':
          $value_item = esc_html_x( 'Related' , 'post_sortable' ,'simple-days' );
          break;
          case 'category':
          $value_item = esc_html_x( 'Category' , 'post_sortable' ,'simple-days' );
          break;
          case 'tag':
          $value_item = esc_html_x( 'Tag' , 'post_sortable' ,'simple-days' );
          break;
          case 'pagenation':
          $value_item = esc_html_x( 'Pagenation' , 'post_sortable' ,'simple-days' );
          break;
          case 'comment':
          $value_item = esc_html_x( 'Comment' , 'post_sortable' ,'simple-days' );
          break;
          default:
          $value_item = '';
        }
        echo '<li class="" data-value="'.esc_attr($value).'"><i class="dashicons dashicons-menu"></i>'.esc_html($value_item).'</li>';
      }
      echo '</ul>';
    }
  }//end Simple_Days_Posts_Sortable_Custom_Control






  class Simple_Days_html_text_Custom_Content extends WP_Customize_Control {
    public $content = '';
    public function render_content() {

      if ( isset( $this->label ) ) {
        echo '<span class="customize-control-title">' . esc_html($this->label) . '</span>';
      }
      if ( isset( $this->content ) ) {
        echo $this->content;
      }
      if ( isset( $this->description ) ) {
        echo '<span class="description customize-control-description">' . esc_html($this->description) . '</span>';
      }
    }
  }

  class Simple_Days_plugin_install_Custom_Content extends WP_Customize_Control {
    public $plugin = '';

    public function enqueue() {
      wp_enqueue_style( 'plugin-install' );
      wp_enqueue_script( 'plugin-install' );
      wp_enqueue_script( 'updates' );
      wp_register_script(
        'simple_days_plugin_install',
        get_template_directory_uri() . '/assets/js/customizer/plugin_install.min.js',
        array( 'jquery', 'customize-base', 'jquery-ui-core', 'jquery-ui-sortable','plugin-install','updates' ),
        '',
        true
      );
      wp_enqueue_script( 'simple_days_plugin_install' );
    }

    public function render_content() {


      if ( isset( $this->plugin ) ) {
        $plugin_setting = array();

        $plugin_setting['name'] = $this->plugin['name'];
        $plugin_setting['dir'] = $this->plugin['dir'];
        $plugin_setting['filename'] = $this->plugin['filename'];
        $plugin_setting['pass'] = $plugin_setting['dir'].'/'.$plugin_setting['filename'];

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $plugins = get_plugins();
        $action = $url = $classes = $disabled = $activate_url = '';
        $classic_action = $classic_url = $classic_classes = '';
        if ( current_user_can( 'install_plugins' ) ) {
          if ( empty( $plugins[$plugin_setting['pass']] ) ) {
            if ( get_filesystem_method( array(), WP_PLUGIN_DIR ) === 'direct' ) {
              
              $action =  sprintf(esc_html__('Install %s', 'simple-days'), $plugin_setting['name']);
              $url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='.$plugin_setting['dir'] ), 'install-plugin_'.$plugin_setting['dir'] );
              $activate_url = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin='.$plugin_setting['pass'] ), 'activate-plugin_'.$plugin_setting['pass'] );
              $classes = ' install-now';
            }
          } else if ( is_plugin_inactive( $plugin_setting['pass'] ) ) {
            
            $action = sprintf(esc_html__('Activate %s', 'simple-days'), $plugin_setting['name']);
            $activate_url = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin='.$plugin_setting['pass'] ), 'activate-plugin_'.$plugin_setting['pass'] );
            $classes = ' activate-now';
          }
        }

        if ( current_user_can( 'edit_posts' ) && is_plugin_active( $plugin_setting['pass'] ) ) {
          $action = esc_html__( 'Already activated' , 'simple-days' );
          $classes = ' button-disabled';
          $disabled = ' disabled="disabled"';
            //$url = admin_url( 'admin.php?page='.$plugin_setting['dir'] );
        }

        if ( $action ) {

          if ( isset( $this->label ) ) {
            echo '<span class="customize-control-title">' . esc_html($this->label) . '</span>';
          }


          echo '<p><a class="button '. esc_attr( $classes ).' simple-days-install-plugin"'.$disabled.' data-install-url="'. esc_url( $url ) .'" data-activate-url="'. esc_url( $activate_url ) .'" data-name="' .esc_attr( $plugin_setting['name'] ).'" data-slug="'.esc_attr( $plugin_setting['dir'] ).'" data-activating="'.esc_attr__( 'Activating&hellip;' , 'simple-days' ).'" data-activated="'.esc_attr__( 'Activated' , 'simple-days' ).'">'. esc_html( $action ) .'</a></p>';

          if ( isset( $this->description ) ) {
            echo '<span class="description customize-control-description">' . esc_html($this->description) . '</span>';
          }
        // data-redirect="'. esc_url( admin_url( 'customize.php' ) ).'"
        //echo $this->plugin;
        }

      }// end isset( $this->plugin

    }// end render_content
  }// end Simple_Days_plugin_install_Custom_Content



  class Simple_Days_Image_Select_Control extends WP_Customize_Control {

  /**
   * The type of customize control being rendered.
   *
   * @access public
   * @since  1.1
   * @var    string
   */
  public $type = 'radio-image';

  /**
   * Add our JavaScript and CSS to the Customizer.
   *
   * @access public
   * @since  1.1
   * @return void
   */
  public function enqueue() {
    wp_register_script(
      'simple_days_control_image_select',
      get_template_directory_uri() . '/assets/js/customizer/control-image-select.js',
      array( 'jquery'),
      '',
      true
    );
    wp_enqueue_script( 'simple_days_control_image_select');
    //wp_enqueue_style( 'simple-days-image-select', get_template_directory_uri() . '/assets/css/customizer-image-select.css' );
  }

  /**
   * Add custom JSON parameters to use in the JS template.
   *
   * @access public
   * @since  1.1
   * @return void
   */
  public function to_json() {
    parent::to_json();

    // Create the image URL. Replaces the %s placeholder with the URL to the customizer /images/ directory.
    foreach ( $this->choices as $value => $args ) {
      $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri() . '/assets/images/customizer/' ) );
    }

    $this->json['choices'] = $this->choices;
    $this->json['link']    = $this->get_link();
    $this->json['value']   = $this->value();
    $this->json['id']      = $this->id;
  }

  /**
   * An Underscore (JS) template for this control's content.
   *
   * Class variables for this control class are available in the `data` JS object;
   * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
   *
   * @see    WP_Customize_Control::print_template()
   *
   * @access protected
   * @since  1.1
   * @return void
   */
  protected function content_template() {
    ?>
    <# if ( ! data.choices ) {
    return;
  } #>

  <# if ( data.label ) { #>
  <span class="customize-control-title">{{ data.label }}</span>
  <# } #>

  <# if ( data.description ) { #>
  <span class="description customize-control-description">{{{ data.description }}}</span>
  <# } #>

  <# for ( key in data.choices ) { #>

  <label for="{{ data.id }}-{{ key }}">
    <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
    <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> />
    <img src="{{ data.choices[ key ]['url'] }}" alt="{{ data.choices[ key ]['label'] }}" class="s_d_input_image_layout"/>
  </label>
  <# } #>
  <?php
}

}











}//end WP_Customize_Control
