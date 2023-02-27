<?phpclass MAX_PLUGIN_LICENSOR{	/**	 * This is a unique identifier of plugin.	 */	protected $plugin_name;	protected $version;	/**	 * The core functionality of the plugin.	 *	 */	public function __construct() {		if ( defined( 'MAX_PLUGIN_LICENSOR_VERSION' ) ) {			$this->version = MAX_PLUGIN_LICENSOR_VERSION;		} else {			$this->version = '1.0';		}		$this->plugin_name = 'max-plugin-licensor';		$this->load_dependencies();        $this->define_admin_hooks();	}	/**	 * Load the required dependencies.	 *	 * Include the required files:	 *	 */	private function load_dependencies() {        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-max-plugin-licensor-admin.php';        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-max-plugin-licensor-setting.php';        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/fields-html.php';        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-max-plugin-licensor-loader.php';		$this->loader = new MAX_PLUGIN_LICENSOR_Loader();			}	/**	 * Register admin hooks	 * of the plugin.	 *	 */	private function define_admin_hooks() {		$plugin_admin = new MAX_PLUGIN_LICENSOR_Admin( $this->get_plugin_name(), $this->get_version() );        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );        $this->loader->add_action( 'init', $plugin_admin, 'max_edit_user_role_capacities' );        $this->loader->add_action( 'admin_post_nopriv_max_add_new_plugin', $plugin_admin, 'max_add_new_plugin' );        $this->loader->add_action( 'admin_post_max_add_new_plugin', $plugin_admin, 'max_add_new_plugin' );        $this->loader->add_action( 'admin_post_nopriv_max_add_new_license', $plugin_admin, 'max_add_new_license' );        $this->loader->add_action( 'admin_post_max_add_new_license', $plugin_admin, 'max_add_new_license' );        $this->loader->add_action( 'wp_ajax_nopriv_max_show_plugin_details_modal', $plugin_admin, 'max_show_plugin_details_modal' );        $this->loader->add_action( 'wp_ajax_max_show_plugin_details_modal', $plugin_admin, 'max_show_plugin_details_modal' );        $this->loader->add_action( 'wp_ajax_nopriv_max_show_license_details_modal', $plugin_admin, 'max_show_license_details_modal' );        $this->loader->add_action( 'wp_ajax_max_show_license_details_modal', $plugin_admin, 'max_show_license_details_modal' );        $this->loader->add_action( 'wp_ajax_nopriv_max_delete_plugin_zips', $plugin_admin, 'max_delete_plugin_zips' );        $this->loader->add_action( 'wp_ajax_max_delete_plugin_zips', $plugin_admin, 'max_delete_plugin_zips' );        $this->loader->add_action( 'wp_ajax_nopriv_max_delete_plugin_licenses', $plugin_admin, 'max_delete_plugin_licenses' );        $this->loader->add_action( 'wp_ajax_max_delete_plugin_licenses', $plugin_admin, 'max_delete_plugin_licenses' );        $this->loader->add_action( 'wp_ajax_nopriv_max_remove_notice_from_options', $plugin_admin, 'max_remove_notice_from_options' );        $this->loader->add_action( 'wp_ajax_max_remove_notice_from_options', $plugin_admin, 'max_remove_notice_from_options' );        $this->loader->add_action('admin_head', $plugin_admin, 'max_manager_menu_with_user_role');        $this->loader->add_action('pre_get_users', $plugin_admin, 'max_hide_users_with_roles' , 99);//        $this->loader->add_action( 'rest_api_init', 'max_custom_wc_rest_api_function');    }    /**     * Run the loader.     *     */    public function max_run() {        $this->loader->max_run();    }	/**	 * The name of the plugin	 *	 */	public function get_plugin_name() {		return $this->plugin_name;	}	/**	 * The version number of the plugin.	 */	public function get_version() {		return $this->version;	}}