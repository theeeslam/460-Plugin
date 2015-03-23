<?php
/*
 * Plugin Name: Plugin
 * Plugin URI: http://www.animalfactguide.com/wp-content/uploads/2013/10/ostrich2-585x585.jpg
 * Description: Our Plugin
 * Author: Paige, Tom, Elyse
 * Version: 1.0
 * Author URI: www.google.com
 */
 
/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}
?>
 
 
 
 
 
 
 
 
 ?>