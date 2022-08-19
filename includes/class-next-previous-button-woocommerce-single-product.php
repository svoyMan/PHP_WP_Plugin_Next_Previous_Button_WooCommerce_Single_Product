<?php
class Next_Previous_Button_Woocommerce_Single_Product{
	public $plugin_version = '1.0';
	protected $plugin_path;
	protected $plugin_url;

	public function __construct( $plugin_main_file )
	{
		$this->plugin_path = plugin_dir_path( $plugin_main_file );
		$this->plugin_url = plugin_dir_url( $plugin_main_file );
	}

	public function run()
	{
		if ( $this->is_woocommerce_plugin_not_active() ) {
			add_action(
				'admin_notices',
				array( $this, 'on_display_info_about_disabled_woocommerce_action' )
			);

			return false;
		}

		add_action(
			'wp_enqueue_scripts',
			array( $this, 'enqueue_styles' )
		);

		add_action(
			'woocommerce_before_single_product',
			array( $this, 'on_display_next_previous_button' )
		);
	}

	public function is_woocommerce_plugin_not_active(): bool
	{
		return ! in_array(
			'woocommerce/woocommerce.php',
			apply_filters( 'active_plugins', get_option( 'active_plugins' ) )
		);
	}

	public function on_display_info_about_disabled_woocommerce_action()
	{
		include $this->plugin_path . 'templates/admin/display-info-about-disabled-woocommerce.php';
	}

	public function on_display_next_previous_button()
	{
		include $this->plugin_path . 'templates/public/display-next-previous-button.php';
	}

	public function enqueue_styles(): void
	{
		wp_enqueue_style( 'sptul_style', $this->plugin_url . 'assets/css/style.css', array(), $this->plugin_version );
	}
}
