<?php
/**
 * Plugin Name: WooCommerce Reset Currency and Country
 */

class WooCommerce_Reset {
	private static $instance;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __clone() {
	}

	private function __wakeup() {
	}

	protected function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_submenu_page(
			'tools.php',
			__( 'Reset WooCommerce', 'wcrcc' ),
			__( 'Reset WooCommerce', 'wcrcc' ),
			'manage_options',
			'woocommerce-reset-page',
			array( $this, 'page' )
		);
	}

	public function page() {
		global $title;

		$options_to_delete = array(
			'woocommerce_store_address',
			'woocommerce_store_address_2',
			'woocommerce_store_city',
			'woocommerce_store_postcode',
			'woocommerce_price_decimal_sep',
			'woocommerce_price_num_decimals',
			'woocommerce_price_thousand_sep',
			'woocommerce_dimension_unit',
			'woocommerce_default_country',
			'woocommerce_currency_pos',
			'woocommerce_currency',
		);

		?>
			<h2>
				<?php echo esc_html( $title ); ?>
			</h2>
			<p>
				<?php esc_html_e( 'By visiting this page, the following options have been deleted', 'wcrcc' ); ?>
				<ul>
					<?php
					foreach ( (array) $options_to_delete as $option_to_delete ) {
						echo '<li>';
						echo esc_html( $option_to_delete );
						echo '</li>';
						delete_option( $option_to_delete );
					}
					?>
				</ul>
			</p>
		<?php
	}
}

WooCommerce_Reset::get_instance();
