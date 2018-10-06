<?php
/**
 * Dynamic css
 *
 * @since Bloge 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('bloge_dynamic_css')) :
 function bloge_dynamic_css()
    {
   global $bloge_theme_options;
        $bloge_font_family = esc_attr( $bloge_theme_options['bloge-font-family-name'] );

        $h1_h6_font_family = esc_attr( $bloge_theme_options['bloge-font-family-name'] );    
       
        $custom_css = '';
        /* Typography Section */

        if (!empty($bloge_font_family)) {
            
            $custom_css .= "body { font-family: {$bloge_font_family}; }";
        }

         if (!empty($h1_h6_font_family)) {
            
            $custom_css .= "h1,h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h5 a, h6, h6 a,#main-slider .feature-description figcaption h2, .promo-area a h4, .widget .widget-title, .entry-header h2.entry-title a, .site-title a { font-family: {$h1_h6_font_family}; }";
        }


        wp_add_inline_style('bloge-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'bloge_dynamic_css', 99);