<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Title_Icon
 * @subpackage Title_Icon/public
 * @author     Your Name <email@example.com>
 */
class Title_Icon_Public {

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
		$this->title_icon_options = get_option($this->title_icon);
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->title_icon, plugin_dir_url( __FILE__ ) . 'css/title-icon-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->title_icon, plugin_dir_url( __FILE__ ) . 'js/title-icon-public.js', array( 'jquery' ), $this->version, false );

	}
	
		
	public function add_text_to_page_title( $title ) {
		
		global $post;
		$postslist = $this->title_icon_options['postslist'];
		
		foreach ($postslist as $postlist) {
			
			if( $post->ID == $postlist and in_the_loop() ) {
				
				if ($this->title_icon_options['position'] == "left" ) {
					$title = '<span class="dashicons ' . $this->title_icon_options['postsicon'] . '"></span> ' . $title;
				}
				
				if ($this->title_icon_options['position'] == "right") {
					$title = $title . '<span class="dashicons ' . $this->title_icon_options['postsicon'] . '"></span> ';
				}
				
			}
		
		}
	
		return $title;
	}

}
