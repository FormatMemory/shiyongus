<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function seoboost_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Cabin:400,500&subset=latin,latin-ext|Montserrat:300,400,500&subset=latin,latin-ext');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return esc_url_raw($fonts_url);
}
function seoboost_scripts_styles() {
    wp_enqueue_style( 'google-fonts', seoboost_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'seoboost_scripts_styles' );
?>