<?php
/**
 * Widget Google AdSense responsive
 *
 * @package Simple Days
 */


class simple_days_google_ad_responsive_widget extends WP_Widget {

	
	function __construct() {
		parent::__construct(
			's_d_go_res', // Base ID
			esc_html__( '[Simple Days] Google AdSense Responsive', 'simple-days' ), // Name
			array( 'description' => esc_html__( 'Support a responsive ad unit for Google AdSense.Enable AMP when switching AMP ad.', 'simple-days' ), ) // Args
		);
	}

	 
	 
	 
	 

	public function widget( $args, $instance ) {



		$data_ad_client = get_theme_mod( 'simple_days_google_ad_publisher_id' , '');
		$data_ad_slot = get_theme_mod( 'simple_days_google_ad_data_ad_slot' , '');

		if ( $data_ad_client != '' && ($data_ad_slot != '' || !empty( $instance['data_ad_slot'] ))){
		    echo $args['before_widget'];
		    $ad_labeling = get_theme_mod( 'simple_days_google_ad_labeling' , '0');
		    if ($ad_labeling == '1'){
              $ad_labeling = esc_html__( 'Advertisements', 'simple-days' );
		    }else if ($ad_labeling == '2'){
              $ad_labeling = esc_html__( 'Sponsored Links', 'simple-days' );
		    }else{
		      $ad_labeling = '';
		    }

            if(!empty( $instance['data_ad_slot'] ))$data_ad_slot = $instance['data_ad_slot'];


			if ( $ad_labeling != '' ) {
              echo '<div class="ad_labeling">' . esc_html($ad_labeling) . '</div>';
            }
			echo '<div class="ad_wrap clearfix">';






            if(is_amp()){
			echo apply_filters( 'widget_text',
				'<amp-ad width="100vw" height=320
				  type="adsense"
				  data-ad-client="'.$data_ad_client.'"
				  data-ad-slot="'.$data_ad_slot.'"
				  data-auto-format="rspv"
				  data-full-width>
				    <div overflow></div>
				</amp-ad>' );
			}else{
				//"rectangle"（レクタングル）、"vertical"（縦長）、"horizontal"（横長）に変更したり、これらをカンマで区切って組み合わせた値（"rectangle, horizontal" など）に変更したりします。
			$ad_format = !empty( $instance['data_ad_format'] ) ? $instance['data_ad_format'] : 'auto';
            $width_responsive = "true";
            if(!wp_is_mobile())$width_responsive = "false";
            //if($args['id'] == 'on_pagination' && !wp_is_mobile())$ad_format = "vertical";
            //if($args['id'] == 'before_h2_no1' && !wp_is_mobile())$ad_format = "rectangle,vertical";
            //if($args['id'] == 'before_h2_no2' && !wp_is_mobile())$ad_format = "horizontal";
            //if($args['id'] == 'before_h2_no3' && !wp_is_mobile())$ad_format = "horizontal";
            //if($args['id'] == 'sidebar-1' && !wp_is_mobile())$ad_format = "vertical";
			echo apply_filters( 'widget_text',
				'<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="'.$data_ad_client.'"
				     data-ad-slot="'.$data_ad_slot.'"
				     data-ad-format="'.$ad_format.'"
				     data-full-width-responsive="'.$width_responsive.'">
				     </ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>'
				 );
			}
			echo '</div>';
		echo $args['after_widget'];
		}
	}


	 
	 
	 

	public function form( $instance ) {
		$settings['data_ad_slot'] = ! empty( $instance['data_ad_slot'] ) ? $instance['data_ad_slot'] : '';
		$settings['data_ad_format'] = ! empty( $instance['data_ad_format'] ) ? $instance['data_ad_format'] : 'auto';

		//https://support.google.com/adsense/answer/7183212
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'data_ad_slot' ) ); ?>"><?php esc_html_e( 'Your ad unit\'s ID(data-ad-slot):', 'simple-days' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'data_ad_slot' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'data_ad_slot' ) ); ?>" type="text" value="<?php echo esc_attr( $settings['data_ad_slot'] ); ?>">
		<label for="<?php echo esc_attr( $this->get_field_id( 'data_ad_slot' ) ); ?>"><?php esc_html_e( 'If empty this slot, then take precedence from customizer setting.', 'simple-days' ); ?></label>
		</p>

        <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'data_ad_format' ) ); ?>">
          <?php esc_html_e( 'Format', 'simple-days' ); ?></label><br />
          <select id="<?php echo esc_attr( $this->get_field_id( 'data_ad_format' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'data_ad_format' )); ?>">
            <option <?php echo selected( $settings['data_ad_format'], 'auto' ); ?> value="auto" ><?php echo esc_html_x( 'Auto', 'google_ad','simple-days' ); ?></option>
            <option <?php echo selected( $settings['data_ad_format'], 'rectangle' ); ?> value="rectangle" ><?php echo esc_html_x( 'rectangle', 'google_ad','simple-days' ); ?></option>
            <option <?php echo selected( $settings['data_ad_format'], 'horizontal' ); ?> value="horizontal" ><?php echo esc_html_x( 'horizontal', 'google_ad','simple-days' ); ?></option>
            <option <?php echo selected( $settings['data_ad_format'], 'vertical' ); ?> value="vertical" ><?php echo esc_html_x( 'vertical', 'google_ad','simple-days' ); ?></option>
          </select>
        </p>
		<?php
	}


	 

	 

	 
	 

	 

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['data_ad_slot'] =  ! empty( $new_instance['data_ad_slot'] ) ? sanitize_text_field( $new_instance['data_ad_slot'] ) : '';
		$instance['data_ad_format'] = ! empty( $new_instance['data_ad_format'] )  ? esc_attr($new_instance['data_ad_format']) : 'auto';
		return $instance;
	}

} // class simple_days_ad_link_widget
