<?php
add_action( 'wp_enqueue_scripts', 'arzine_theme_css',999);
function arzine_theme_css() {
    wp_enqueue_style( 'arzine-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'arzine-child-style', get_stylesheet_uri(), array( 'arzine-parent-style' ) );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'default-style-css', get_stylesheet_directory_uri()."/css/default.css" );
	wp_dequeue_style( 'default-css', get_template_directory_uri() .'/css/default.css');
	wp_enqueue_style( 'custom-style-css', get_stylesheet_directory_uri()."/css/custom.css" );
	wp_dequeue_style( 'custom-css', get_template_directory_uri() .'/css/custom.css');
	wp_enqueue_script('arzine-mp-masonry-js', get_stylesheet_directory_uri() . '/js/masonry/mp.mansory.js');
}

//Load text domain for translation-ready
load_theme_textdomain( 'arzine', get_stylesheet_directory() . '/languages' );

// footer custom script
function arzine_footer_custom_script()
{
wp_reset_query();
$col =4;

if(is_front_page() && is_active_sidebar('sidebar-primary') )
{
	$col =6;
}
elseif(is_front_page() )
{
	$col =4;
}

elseif ( is_active_sidebar('sidebar-primary') ) {
$col =6;
}
else
{
$col =4;
}
?>
<script>
jQuery(document).ready(function ( jQuery ) {
	jQuery("#blog-masonry").mpmansory(
		{
			childrenClass: 'item', // default is a div
			columnClasses: 'padding', //add classes to items
			breakpoints:{
				lg: <?php echo $col; ?>, //Change masonry column here like 2, 3, 4 column
				md: 6, 
				sm: 6,
				xs: 12
			},
			distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
			onload: function (items) {
				//make somthing with items
			} 
		}
	);
});
</script>
<?php
}
add_action('wp_footer','arzine_footer_custom_script');
?>