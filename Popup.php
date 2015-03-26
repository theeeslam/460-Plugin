<!DOCTYPE html>
<html>
<body>
<?php
ob_start();
/*
 * Plugin Name: The Popup
 * Description: This is a plugin that displays a popup.
 * Author: Elyse M, Tom S, Paige R.
 */

// This is the function that initiates the menu and adds all the options to it. Things such as title and icon of the menu are here.
function popup_add_admin_menu(  ) { 

	add_menu_page( 'The Popup', 'The Popup', 'manage_options', 'popup_plugin', 'popup_options_page', 'dashicons-align-right', 66 );

}


function popup_settings_init(  ) { 
// This command registers the settings fields and makes them possible
	register_setting( 'plugin_page', 'popup_settings' );
	
	add_settings_section(
		'popup_page_section', 
		__( 'Here you can enter in the width and height for the popup that will come up. You can also enter in the text that the popup will display.', 'popup' ), 
		'popup_settings_section_callback', 
		'plugin_page'
	);
// This is the first settings field: Height of the popup in pixels
	add_settings_field( 
		'popup_text_field_0', 
		__( 'Enter Height in pixels:', 'popup' ), 
		'popup_text_field_0_render', 
		'plugin_page', 
		'popup_page_section' 
	);
// This is the second settings field: Width of the popup in pixels	
	add_settings_field( 
		'popup_text_field_1', 
		__( 'Enter Width in pixels:', 'popup' ), 
		'popup_text_field_1_render', 
		'plugin_page', 
		'popup_page_section' 
	);


// This is the final settings field: This contains a paragraph that will be used in the html file to fill it with content
	add_settings_field( 
		'popup_textarea_field_3', 
		__( 'Enter the content for the popup:', 'popup' ), 
		'popup_textarea_field_3_render', 
		'plugin_page', 
		'popup_page_section' 
	);

}

// These functions render the settings fields onto the page to make them visible and intractable. 
function popup_text_field_0_render() { 
	$options = get_option( 'popup_settings' );
	?>
	<input type="text" name="popup_settings[popup_text_field_0]" value="<?php if (isset($options['popup_text_field_0'])) echo $options['popup_text_field_0']; ?>">
	<?php
}

function popup_text_field_1_render() { 
	$options = get_option( 'popup_settings' );
	?>
	<input type="text" name="popup_settings[popup_text_field_1]" value="<?php if (isset($options['popup_text_field_1'])) echo $options['popup_text_field_1']; ?>">
	<?php
}

function popup_textarea_field_3_render() { 
	$options = get_option( 'popup_settings' );
	?>
	<textarea cols="40" rows="5" name="popup_settings[popup_textarea_field_3]"> 
		<?php if (isset($options['popup_textarea_field_3'])) echo $options['popup_textarea_field_3']; ?>
 	</textarea>
	<?php
}

// Variables for the text boxes. These are going to be imputed into the window.html file and will be read to produce a popup.

$Height = 'popup_text_field_0';
$Width = 'popup_text_field_0';
$Content = 'popup_textarea_field_3';
	

// These functions make the fields where information can be written have details. This is the callback.
function popup_settings_section_callback() { 
	echo __( 'Enter in text in the fields blow:', 'popup' );
}
		
function popup_options_page() { 
	?>
	<form action="options.php" method="post">
		
		<h2>Welcome to "The Plugin"</h2>
	
		<?php
		settings_fields( 'plugin_page' );
		do_settings_sections( 'plugin_page' );
		submit_button();
		?>

	<button onclick = "openWin()"> Create the Window </button>
	</form>
<!-- This script opens up the popup window. -->	
<script>
var Window

function openWin() {
	Window = window.open("/home/ccit2656/public_html/wp-content/plugins/WilltheRealPopupPleaseStandUp/window.php","Window","width = $Width, height = $Height");
}
</script>
	<?php
	
}

add_action( 'admin_menu', 'popup_add_admin_menu' );
add_action( 'admin_init', 'popup_settings_init' );	



function popup_callit(){
	$options = get_option( 'popup_settings' );
	echo '<img src="' . $options['popup_text_field_0'] . '" />';
	echo '<p>Textarea: ' . $options['popup_textarea_field_0'] . '</p>';
	echo '<p>Textarea: ' . $options['popup_textarea_field_1'] . '</p>';
	echo '<p>Textarea: ' . $options['popup_textarea_field_3'] . '</p>';

}	
function shortcode_welp($atts, $content = null) {
	extract(shortcode_atts(array(
		'class' => ''
	), $atts));

	return '<div class="welp">' . do_shortcode($content) . '</div>';
}

function shortcode_welp_register() {
add_shortcode('welp', 'shortcode_welp');
}

add_action('init', 'shortcode_welp_register');
add_filter('the_content', 'popup_callit');	


?>
</body>
</html>