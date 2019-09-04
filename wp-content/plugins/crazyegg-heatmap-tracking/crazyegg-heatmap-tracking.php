<?php
/*
Plugin Name: Crazy Egg
Plugin URI: http://www.crazyegg.com
Description: The easiest way to add the Crazy Egg tracking script to your WordPress blog!
Version: 2.2
Author: Crazy Egg
Author URI: http://www.crazyegg.com
License: GPL
*/

class CrazyEgg {
  var $longName = 'Crazy Egg for WordPress Options';
  var $shortName = 'Crazy Egg';
  var $uniqueID = 'crazyegg-heatmap-tracking';

  function __construct() {
    register_deactivation_hook(__FILE__, array( $this, 'delete_option' ) );
    add_action( 'wp_head', array( $this, 'add_script' ) );
    if ( is_admin() ) {
      add_action( 'admin_menu', array( $this, 'admin_menu_page' ) );
      add_action( 'admin_init', array( $this, 'register_settings' ) );
      add_filter( 'plugin_action_links_'.plugin_basename( __FILE__ ), array( $this, 'add_settings_link' ) );
      add_action( 'wp_loaded', array( $this, 'migration_check' ) );
    }
  }

  public function delete_option() {
    delete_option('crazy_egg_tracking_script');
  }

  public function add_script() {
    echo get_option('crazy_egg_tracking_script');
  }

  public function admin_menu_page() {
    add_menu_page(
      $this->longName,
      $this->shortName,
      'administrator',
      $this->uniqueID,
      array( $this, 'admin_options'),
      plugins_url('images/icon.png', __FILE__)
    );
  }

  public function register_settings() {
    register_setting( 'crazy-egg-options', 'crazy_egg_tracking_script' );
  }

  public function admin_options() {
    include 'views/options.php';
  }

  public function add_settings_link( $links ) {
    $settings_link = array( '<a href="admin.php?page=crazyegg-heatmap-tracking">Settings'.'</a>' );
    return array_merge( $links, $settings_link );
  }

  public function migration_check() {
    $accountNumber = get_option("cht_account_number");

    if ($accountNumber) {
      $accountPath = str_pad($accountNumber, 8, "0", STR_PAD_LEFT);
      $accountPath = substr($accountPath,0,4).'/'.substr($accountPath,4,8);
      $accountPath = "pages/scripts/".$accountPath.".js";
      $scriptHost = "script.crazyegg.com";

      $migrationScript = '<script type="text/javascript">
        setTimeout(function(){var a=document.createElement("script");
        var b=document.getElementsByTagName(\'script\')[0];
        a.src=document.location.protocol+"//'.$scriptHost.'/'.$accountPath.'";
        a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
        </script>
      ';

        update_option('crazy_egg_tracking_script', $migrationScript);
        delete_option('cht_account_number');
      }
    }
  }

add_action( 'init', 'CrazyEggForWordPress' );
function CrazyEggForWordPress() {
  global $CrazyEggForWordPress;

  $CrazyEggForWordPress = new CrazyEgg();
}
?>
