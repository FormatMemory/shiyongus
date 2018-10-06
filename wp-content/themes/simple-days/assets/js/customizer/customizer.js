/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */



( function( $ ) {
  var alert_box_border_inside;
  var alert_box_border_inside_class;
  jQuery(document).ready(function($){
    alert_box_border_inside = wp.customize.settings.values.simple_days_alert_box_border_inside;
    if(alert_box_border_inside == true){
      alert_box_border_inside_class = '#h_alert_box';
    }else{
      alert_box_border_inside_class = '#h_alert';
    }
    //console.log(alert_box_border_inside);
  });
  
  wp.customize( 'simple_days_alert_box_border_inside', function( value ) {
    value.bind( function( newval ) {
      if(newval == true){
        $('#h_alert_box').css('border', $('#h_alert').css('border') ) ;
        $('#h_alert_box').css('display', 'inline-block' ) ;
        $('#h_alert').css('border', 'none' );
        alert_box_border_inside_class = '#h_alert_box';
      }else{
        $('#h_alert').css('border', $('#h_alert_box').css('border') ) ;
        $('#h_alert_box').css('border', 'none' );
        alert_box_border_inside_class = '#h_alert';
      }
      //console.log(newval);
      //console.log(alert_box_border_inside_class);
    } );
  } );


  // Site title and description.
  wp.customize( 'blogname', function( value ) {
    value.bind( function( newval ) {
      $( '.site_title a' ).html( newval );
    } );
  } );
  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( newval ) {
      $( '.description' ).html( newval );
    } );
  } );
  
  wp.customize( 'simple_days_background_color', function( value ) {
    value.bind( function( newval ) {
      if(newval != ''){
        $('body').css('background', newval );
      }else{
        $('body').css('background', '' );
        console.log('background');
      }
      console.log(newval);
    } );
  } );
  
  wp.customize( 'link_textcolor', function( value ) {
    value.bind( function( newval ) {
      $('a').css('color', newval );
    } );
  } );
  
  wp.customize( 'link_hover_color', function( value ) {
    value.bind( function( newval ) {
      $('a:hover:not(.non_hover)').css('color', newval );
    } );
  } );

  
  wp.customize( 'blog_name', function( value ) {
    value.bind( function( newval ) {
      $('.site_title a').css('color', newval );
    } );
  } );

  
  wp.customize( 'header_color', function( value ) {
    value.bind( function( newval ) {
      $('#site_h').css('background', newval );
    } );
  } );

  
  wp.customize( 'footer_widget_color', function( value ) {
    value.bind( function( newval ) {
      $('.f_widget_wrap').css('background', newval );
    } );
  } );

  
  wp.customize( 'footer_color', function( value ) {
    value.bind( function( newval ) {
      $('.credit_wrap').css('background', newval );
    } );
  } );

  
  wp.customize( 'footer_widget_textcolor', function( value ) {
    value.bind( function( newval ) {
      $('.f_widget_wrap').css('color', newval );
    } );
  } );

  
  wp.customize( 'footer_widget_linkcolor', function( value ) {
    value.bind( function( newval ) {
      $('.f_widget_wrap a:not(.icon_base):not(.to_top)').css('color', newval );
    } );
  } );

  
  wp.customize( 'header_nav_h2_bg_color', function( value ) {
    value.bind( function( newval ) {
      $('.nav_h2').css('background', newval );
    } );
  } );

  
  wp.customize( 'f_menu_wrap_bg_color', function( value ) {
    value.bind( function( newval ) {
      $('.f_menu_wrap').css('background', newval );
    } );
  } );

  
  wp.customize( 'oh_wrap_bg_color', function( value ) {
    value.bind( function( newval ) {
      $('#oh_wrap').css('background', newval );
    } );
  } );

  
  wp.customize( 'simple_days_alert_box_color', function( value ) {
    value.bind( function( newval ) {
      $('#h_alert').css('color', newval );
    } );
  } );
  
  wp.customize( 'simple_days_alert_box_bg_color', function( value ) {
    value.bind( function( newval ) {
      $('#h_alert').css('background', newval );
    } );
  } );
  
  wp.customize( 'simple_days_alert_box_text_position', function( value ) {
    value.bind( function( newval ) {
      $('#h_alert').css('text-align', newval );
    } );
  } );





  wp.customize( 'simple_days_alert_box_border_type', function( value ) {
    value.bind( function( newval ) {
      $(alert_box_border_inside_class).css('border-style', newval );
    } );
  } );
  wp.customize( 'simple_days_alert_box_border_color', function( value ) {
    value.bind( function( newval ) {
      $(alert_box_border_inside_class).css('border-color', newval );
    } );
  } );
  wp.customize( 'simple_days_alert_box_border_width', function( value ) {
    value.bind( function( newval ) {
            console.log(alert_box_border_inside_class);
      $(alert_box_border_inside_class).css('border-width', newval );
    } );
  } );
  wp.customize( 'simple_days_alert_box_text_size', function( value ) {
    value.bind( function( newval ) {
      $('#h_alert').css('font-size', newval + 'px' );
    } );
  } );






  
  wp.customize( 'simple_days_sidebar_layout', function( value ) {
    value.bind( function( newval ) {
      console.log(newval);
      if(newval == '1'){
        $('.sidebar').css({
          'display':'-webkit-flex',
          'display':'flex',
          '-webkit-box-ordinal-group':'1',
          '-ms-flex-order':'1',
          '-webkit-order':'1',
          order:'1',
          margin:'20px 30px 0 0'
        });
      }
      if(newval == '3'){
        $('.sidebar').css({
          'display':'-webkit-flex',
          'display':'flex',
          '-webkit-box-ordinal-group':'3',
          '-ms-flex-order':'3',
          '-webkit-order':'3',
          order:'3',
          margin:'20px 0 0 30px'
        });
      }
      if(newval == '0'){
        $('.sidebar').css({
          'display':'none',
        });
      }
    } );
  } );

} )( jQuery );