<?php 

if ( ! class_exists( 'BBD_Basic_Share_Buttons_Admin' ) ) :

  class BBD_Basic_Share_Buttons_Admin extends BBD_Basic_Share_Buttons {
    public function __construct() {
      parent::__construct();

      add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_script'] );

      include_once BSB_PLUGIN_DIR . '/classes/bsb-settings.php';

    }

    public function enqueue_admin_script( $hook ) {
      if ( 'options-reading.php' != $hook ) {
          return;
      }

      wp_enqueue_style( 'basic-share-buttons-admin', BSB_PLUGIN_URL . '/css/basic-share-buttons-admin.css', false, 1 );
      wp_enqueue_script( 'basic-share-buttons-admin', BSB_PLUGIN_URL . '/js/basic-share-buttons-admin.js', array('jquery'), '1.0' );
      wp_enqueue_script( 'basic-share-buttons-sortable', BSB_PLUGIN_URL . '/js/sortable/sortable.min.js', array('basic-share-buttons-admin'), '1.0' );

      // load for button styles
      wp_enqueue_style( 'ssb-front-css', BSB_PLUGIN_URL . '/css/basic-share-buttons.css', false, 1 );
    }
  }
  
endif;
