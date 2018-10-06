<!DOCTYPE html>
<html <?php if ( is_amp()) echo '⚡ '; language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width,<?php if ( is_amp()): ?>minimum-scale=1,<?php endif; ?>initial-scale=1">
  <?php if ( is_amp()): get_template_part( 'inc/amp','head' ); endif;
  if ( !is_amp() && get_theme_mod( 'simple_days_amp',false) ): ?>
    <link rel="amphtml" href="<?php global $wp; echo esc_url(home_url( add_query_arg( array(), $wp->request ) )); ?>?amp=1" />
<?php endif;
if ( get_option('blog_public') != '0' && !is_amp() && get_theme_mod( 'simple_days_no_robots', true ) && (is_404() || is_tag() ||  is_day() || is_year() || is_month() || is_search()))echo '<meta name="robots" content="noindex,follow" />';
wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php
  $ga_acount = (get_theme_mod( 'simple_days_amp_analytics','') != '') ? get_theme_mod( 'simple_days_amp_analytics','') : get_theme_mod( 'simple_days_ga_analytics_id','');
  if(is_amp() && $ga_acount != ''){ ?>
    <amp-analytics type="googleanalytics">
      <script type="application/json">
        {
          "vars": {
          "account": "<?php echo esc_attr($ga_acount) ?>"
          },
          "triggers": {
              "trackPageview": {
              "on": "visible",
              "request": "pageview"
            }
          }
        }
    </script>
    </amp-analytics>
  <?php
  } ?>


<div id="h_wrap" class="simple_days_box_shadow<?php echo (get_theme_mod( 'simple_days_sticky_header', false ) ? ' h_sticky' : ''); ?>">
  <input id="t_menu" class="dn" type="checkbox" />
  <?php
  //over header widget
  if( is_active_sidebar( 'over_header_left' ) || is_active_sidebar( 'over_header_right' ))  get_template_part( 'template-parts/header','over' );
  ?>

  <header id="site_h" role="banner">
    <div class="container">
      <div class="a_w">
        <div class="title_wrap">
          <div class="t_menu_d"><label for="t_menu" class="humberger"></label></div>
          <?php if ( has_custom_logo() ) : ?>
            <div class="logo_box"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <?php $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
              if ( is_amp() ):
                if (get_theme_mod( 'simple_days_amp_logo_img',esc_url(get_template_directory_uri() .'/assets/images/amp-logo.png')) != esc_url(get_template_directory_uri() .'/assets/images/amp-logo.png')){
                  $amp_logo_id = attachment_url_to_postid( get_theme_mod( 'simple_days_amp_logo_img') );
                  $image = wp_get_attachment_image_src( $amp_logo_id, 'full' );
                }
              endif; ?>
              <<?php echo ( is_amp() ? 'amp-img layout="responsive"':'img'); ?> src="<?php echo esc_url( $image[0] ); ?>" class="header_logo" width="<?php echo absint( $image[1] ); ?>" height="<?php echo absint( $image[2] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a></div>
            <?php else:
             $site_title_effects = '';
             if((get_theme_mod( 'simple_days_font_site_title_google_jp', 'none' ) != 'none' || get_theme_mod( 'simple_days_font_body_google_jp', 'none' ) != 'none' || get_theme_mod( 'simple_days_font_headings_google_jp', 'none' ) != 'none') && get_theme_mod( 'simple_days_font_site_title_google_jp_effects_1', 'none' ) != 'none'){
              $site_title_effects = ' class="font-effect-'.get_theme_mod( 'simple_days_font_site_title_google_jp_effects_1').'"';
            }elseif((get_theme_mod( 'simple_days_font_site_title_google', 'none' ) != 'none' || get_theme_mod( 'simple_days_font_body_google', 'none' ) != 'none' || get_theme_mod( 'simple_days_font_headings_google', 'none' ) != 'none') && get_theme_mod( 'simple_days_font_site_title_google_effects_1', 'none' ) != 'none'){
              $site_title_effects = ' class="font-effect-'.get_theme_mod( 'simple_days_font_site_title_google_effects_1').'"';
            }
            ?>
            <?php if ( is_front_page() && is_home() ) : ?>
            <h1 class="site_title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo $site_title_effects ; ?> rel="home" class="h_no_logo"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
             <p class="site_title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo $site_title_effects ; ?> rel="home" class="h_no_logo"><?php bloginfo( 'name' ); ?></a></p>
           <?php endif; ?>
         <?php endif;
         if (get_theme_mod( 'simple_days_mobile_header_search',true)){ ?>
          <label for="t_search" class="search_m"><i class="fa fa-search serch_icon" aria-hidden="true"></i></label>
        <?php } ?>
      </div>

      <?php
    if(is_amp() && !is_ssl()){}else{
      ?>
      <input id="t_search" class="dn" type="checkbox" />
      <div id="h_search">
        <form role="search" method="get" class="search_form" action="<?php echo esc_url( home_url( '/' ) ); ?>" <?php if ( is_amp() ){ ?>target="_top"<?php } ?>>
          <input type="search" id="search-form-header" class="search_field" placeholder="<?php esc_attr_e( 'Search', 'simple-days' ) ?>" value="<?php echo get_search_query(); ?>" name="s" />
          <button type="submit" class="search_submit opa7"><i class="fa fa-search serch_icon" aria-hidden="true"></i></button>
        </form>
      </div>
    <?php } $mod = get_theme_mod( 'simple_days_menu_layout','1');

    if( is_active_sidebar( 'header_widget' )){
      if($mod == "2")echo '<div></div>';
      ?>
      <div class="h_widget">
       <?php dynamic_sidebar( 'header_widget' ); ?>
     </div>
     <?php
     if($mod == "1")echo '<div></div>';
   } ?>


 </div>
 <?php
 if($mod == "1" || $mod == "2"){  ?>

  <nav id="nav_h" class="nav_base">
    <?php wp_nav_menu( array(
     'theme_location'  => 'primary',
     'menu_class'      => 'menu_base',
     'menu_id'         => 'menu_h',
     'container'       => 'ul',
     
   ));
   ?>
 </nav>
<?php } ?>
</div>

</header>
<?php
if($mod == "3" || $mod == "4"){  ?>
  <nav id="nav_h" class="nav_base nav_h2">
    <div class="container">
      <?php wp_nav_menu( array(
       'theme_location'  => 'primary',
       'menu_class'      => 'menu_base',
       'menu_id'         => 'menu_h',
       'container'       => 'ul',
       
     ));
     ?>
   </div>
 </nav>
 <?php
}
?>
</div>

<?php

//alert box
if( get_theme_mod( 'simple_days_alert_box',false) ) get_template_part( 'template-parts/header','alertbox' );
//Header image
if( is_home() && get_header_image() ) get_template_part( 'template-parts/header','image' );

?>
