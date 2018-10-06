<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Bloge_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once get_template_directory() . '/inc/customizer-pro/section-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Bloge_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Bloge_Customize_Section_Pro(
				$manager,
				'bloge',
				array(
					'title'    => esc_html__( 'Premium Verison', 'bloge' ),
					'pro_text' => esc_html__( 'Upgrade To Pro',  'bloge' ),
					'pro_url'  => 'https://www.templatesell.com/item/bloge-pro/',
					'priority' => 0
				)
			)
		);
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		require_once get_template_directory() . '/inc/customizer-pro/section-pro.php';


		wp_enqueue_script( 'bloge-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/customizer-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'bloge-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/customizer-pro/customize-controls.css' );
	}
}

// Doing this customizer thang!
Bloge_Customize::get_instance();


if ( ! class_exists( 'Bloge_Customize_Static_Text_Control' ) ){
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
class Bloge_Customize_Static_Text_Control extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'static-text';

	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	protected function render_content() {
			?>
		<div class="description customize-control-description">
			
			<h2><?php esc_html_e('About Bloge', 'bloge')?></h2>
			<p><?php esc_html_e('Bloge is simple, clean and elegant WordPress Theme for your blog site.', 'bloge')?> </p>
			<p>
				<a href="<?php echo esc_url('http://demo.canyonthemes.com/bloge'); ?>" target="_blank"><?php esc_html_e( 'Bloge Demo', 'bloge' ); ?></a>
			</p>
			<h3><?php esc_html_e('Documentation', 'bloge')?></h3>
			<p><?php esc_html_e('Read documentation to learn more about theme.', 'bloge')?> </p>
			<p>
				<a href="<?php echo esc_url('http://doc.canyonthemes.com/bloge/'); ?>" target="_blank"><?php esc_html_e( 'Bloge Documentation', 'bloge' ); ?></a>
			</p>
			
			<h3><?php esc_html_e('Support', 'bloge')?></h3>
			<p><?php esc_html_e('For support, Kindly contact us and we would be happy to assist!', 'bloge')?> </p>
			
			<p>
				<a href="<?php echo esc_url('https://canyonthemes.com/supports/'); ?>" target="_blank"><?php esc_html_e( 'Bloge Support', 'bloge' ); ?></a>
			</p>
			<h3><?php esc_html_e( 'Rate This Theme', 'bloge' ); ?></h3>
			<p><?php esc_html_e('If you like Bloge Kindly Rate this Theme', 'bloge')?> </p>
			<p>
				<a href="<?php echo esc_url('https://wordpress.org/support/theme/bloge/reviews/#new-post'); ?>" target="_blank"><?php esc_html_e( 'Add Your Review', 'bloge' ); ?></a>
			</p>
			</div>
			
		<?php
	}

}
}
