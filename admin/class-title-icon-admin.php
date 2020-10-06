<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Title_Icon
 * @subpackage Title_Icon/admin
 * @author     Your Name <email@example.com>
 */
class Title_Icon_Admin {

	/**
	 * The ID of this plugin.
	 */
	private $title_icon;
	
	/**
	 * The version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $title_icon, $version ) {

		$this->title_icon = $title_icon;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->title_icon, plugin_dir_url( __FILE__ ) . 'css/title-icon-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->title_icon, plugin_dir_url( __FILE__ ) . 'js/title-icon-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	
	/**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     */

    public function add_plugin_admin_menu() {

        add_options_page( 'Post icon settings', 'Post icon', 'manage_options', $this->title_icon, array($this, 'display_plugin_setup_page') );
    
	}

     /**
     * Add settings action link to the plugins page.
     */
    public function add_action_links( $links ) {
        
       $settings_link = array(
        '<a href="' . admin_url( 'options-general.php?page=' . $this->title_icon ) . '">' . __('Settings', $this->title_icon) . '</a>',
       );
       return array_merge(  $settings_link, $links );

    }

    /**
     * Render the settings page for this plugin.
     */
    public function display_plugin_setup_page() {
        
        include_once( 'partials/title-icon-admin-display.php' );
        
    } 
	
   /**
   * Validate options
   */
    public function validate($input) {
		$valid = array();
		$valid['footer_text'] = (isset($input['footer_text']) && !empty($input['footer_text'])) ? $input['footer_text'] : '';
		$valid['postslist'] = (isset($input['postslist']) && !empty($input['postslist'])) ? $input['postslist'] : '';
		$valid['postsicon'] = (isset($input['postsicon']) && !empty($input['postsicon'])) ? $input['postsicon'] : '';
		$valid['position'] = (isset($input['position']) && !empty($input['position'])) ? $input['position'] : '';
		return $valid;
    }
   
    /**
     * Update all options
     */
    public function options_update() {
        register_setting($this->title_icon, $this->title_icon, array($this, 'validate'));
    }

}
