<?php
class Next_Previous_Button_Woocommerce_Single_Product_Settings{
	private $plugin_url;
	private $plugin_path;
	private $options_menu_page = array(
		'page_title' => '',
		'menu_title' => '',
		'capability' => '',
		'menu_slug' => '',
		'function' => '',
		'icon_url' => '/assets/images/icon-menu-page.svg',
		'position' => null
	);
	private static ?Next_Previous_Button_Woocommerce_Single_Product_Settings $instance = null;
	private $settings = array();

	public static function getInstance(): self
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function run()
	{
		add_action(
			'admin_menu',
			array( $this, 'add_menu_page' )
		);

		add_action(
			'admin_menu',
			array( $this, 'plugin_settings' )
		);
	}

	public function add_menu_page()
	{
		$options = $this->get_options_menu_page();
		add_menu_page(
			$options['page_title'],
			$options['menu_title'],
			$options['capability'],
			$options['menu_slug'],
			array( $this, 'display_menu_page' ),
			$this->get_plugin_url() . $options['icon_url'],
			$options['position']
		);
	}

	public function display_menu_page(){
		include $this->get_plugin_path() . 'templates/admin/display-menu-page.php';
	}

	public function set_options_menu_page( $options )
	{
		$this->options_menu_page = array_merge( $this->options_menu_page, $options );
	}

	public function get_options_menu_page()
	{
		return $this->options_menu_page;
	}

	public function set_plugin_url( $plugin_main_file )
	{
		$this->plugin_url = plugin_dir_url( $plugin_main_file );
	}

	public function get_plugin_url()
	{
		return $this->plugin_url;
	}

	public function set_plugin_path( $plugin_main_file )
	{
		$this->plugin_path = plugin_dir_path( $plugin_main_file );
	}

	public function get_plugin_path()
	{
		return $this->plugin_path;
	}

	protected function __construct()
	{

	}

	protected function __clone()
	{

	}

	public function __wakeup()
	{
		throw new \Exception("Cannot unserialize a singleton.");
	}



	public function plugin_settings(){
		// параметры: $option_group, $option_name, $sanitize_callback
		register_setting( 'option_group', 'option_name', array( $this, 'sanitize_callback' ) );

		// параметры: $id, $title, $callback, $page
		add_settings_section( 'section_id', 'Основные настройки', '', 'npbwsp' );

		// параметры: $id, $title, $callback, $page, $section, $args
		add_settings_field('primer_field1', 'Название опции', array( $this, 'fill_primer_field1' ), 'npbwsp', 'section_id' );
		add_settings_field('primer_field2', 'Другая опция', array( $this, 'fill_primer_field2' ), 'npbwsp', 'section_id' );
	}

	public function sanitize_callback( $options ){
		// очищаем
		foreach( $options as $name => & $val ){
			if( $name == 'input' )
				$val = strip_tags( $val );

			if( $name == 'checkbox' )
				$val = intval( $val );
		}

		//die(print_r( $options )); // Array ( [input] => aaaa [checkbox] => 1 )

		return $options;
	}

	## Заполняем опцию 1
	public function fill_primer_field1(){
		$val = get_option('option_name');
		$val = $val ? $val['input'] : null;
		?>
		<input type="text" name="option_name[input]" value="<?php echo esc_attr( $val ) ?>" />
		<?php
	}

	## Заполняем опцию 2
	public function fill_primer_field2(){
		$val = get_option('option_name');
		$val = $val ? $val['checkbox'] : null;
		?>
		<label><input type="checkbox" name="option_name[checkbox]" value="1" <?php checked( 1, $val ) ?> /> отметить</label>
		<?php
	}
}
