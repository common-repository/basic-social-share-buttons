<?php
/*
	Plugin Name: Basic Social Share Buttons
	Plugin URI: https://basicby.design/basic-social-share-buttons
	Description: Adds social share buttons to your post without any javascript tracking libraries
	Version: 1.0.2
	Author: Basic by Design
	Author URI: https://basicby.design
	License: MIT
	License URI: https://opensource.org/licenses/MIT
*/

class BBD_Basic_Share_Buttons {
  public function __construct() {
    $this->constants();

    include_once dirname( __FILE__ ) . '/classes/bsb-buttons.php';
    add_shortcode( "basic-share-buttons", [$this, "shortcode_content"] );
    add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue_scripts' ) );
  }
    
  public function shortcode_content($params) {
    $shares = new BBD_Basic_Share_Buttons_Buttons();
    $url = ($params['url'] ?? false) ? $params['url'] : get_the_permalink();
    $title = ($params['title'] ?? false) ? $params['title'] : get_the_title();
    $shares->links(
        $url, 
        $title,
        explode(" ", get_option("basic-share-buttons__sites"))
      );

  }

  public function front_enqueue_scripts() {
    if (get_option("basic-share-buttons__style", "yes") == "yes") {
      wp_enqueue_style( 'ssb-front-css', plugins_url( 'css/basic-share-buttons.css', __FILE__ ), false, 1 );
    }

  }

  public function constants() {
    if ( ! defined( 'BSB_PLUGIN_DIR' ) ) {
      define( 'BSB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    }
    if ( ! defined( 'BSB_PLUGIN_URL' ) ) {
      define( 'BSB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }
  }

}


global $_ssb_pr;
if ( is_admin() ) {
  include_once dirname( __FILE__ ) . '/classes/bsb-admin.php';
  new BBD_Basic_Share_Buttons_Admin();
} else {

  new BBD_Basic_Share_Buttons();
}
