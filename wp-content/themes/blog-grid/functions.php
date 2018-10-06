<?php
/**
 *Recommended way to include parent theme styles.
 *(Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 */  
add_action( 'wp_enqueue_scripts', 'blog_grid_child_style' );
  function blog_grid_child_style() {
	wp_enqueue_style( 'bloge-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css',array('bloge-style'));
}
/**
 *  Default Theme options
 *
 * @since bloge 1.0.0
 *
 * @param null
 * @return array $bloge_theme_layout
 *
 */
if ( !function_exists('bloge_default_theme_options') ) :
    function bloge_default_theme_options() {

        $default_theme_options = array(
            'site_layout'                        => 'full-width-wrapper',
            'bloge-feature-cat'                  => 0,
            'bloge-promo-cat'                    => 0,
            'bloge-footer-copyright'             => esc_html__('&copy; All Right Reserved','bloge'),
            'bloge-layout'                       => 'right-sidebar',
            'bloge-font-family-url'              => esc_url('//fonts.googleapis.com/css?family=Open+Sans:300,400', 'bloge'),
            'bloge-font-family-name'             => esc_html__('Open Sans, sans-serif','bloge'),

            'bloge-heading-font-family-url'      => esc_url('//fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i', 'bloge'),
            'bloge-heading-font-family-name'     => esc_html__('Merriweather, serif','bloge'),
            
            'bloge-footer-totop'                 => 1,
            'bloge-read-more-text'               => esc_html__('Read More','bloge'),
            'bloge-header-social'                => 0,
            'bloge-header-search'                => 0,
            'bloge-header-top-enable'            => 0,
            'bloge-header-date'                  => 0,
            'bloge-sticky-sidebar-option'        => 1,
            'bloge-slider-read-more'             => esc_html__('Read More','bloge'),
            'bloge-exclude-slider-category'      => '',
            'bloge-blog-pagination-type-options' => 'numeric',
);
        return apply_filters( 'bloge_default_theme_options', $default_theme_options );
    }
endif;
/*
* Excerpt Length
*/
function blog_gird_excerpt_lenght( $length ) {
	if(!is_admin()){
		return 15;
	 }
}
add_filter( 'excerpt_length', 'blog_gird_excerpt_lenght', 999 );
