<?php
session_start();
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
// This is the first settings field: This edits one of the properties in the window in pixels
	add_settings_field( 
		'popup_text_field_0', 
		__( 'Enter Height in pixels:', 'popup' ), 
		'popup_text_field_0_render', 
		'plugin_page', 
		'popup_page_section' 
	);
// This is the second settings field: This edits one of the properties in the window in pixels
	add_settings_field( 
		'popup_text_field_1', 
		__( 'Enter Width in pixels:', 'popup' ), 
		'popup_text_field_1_render', 
		'plugin_page', 
		'popup_page_section' 
	);

}

// These functions render the settings fields onto the page to make them visible and intractable. 
function popup_text_field_0_render() { 
	$options = get_option( 'popup_settings' );
	?>
	<input type="text" id="height" class="height" name="popup_settings[popup_text_field_0]" value="<?php if (isset($options['popup_text_field_0'])) echo $options['popup_text_field_0']; ?>">
	<?php
}

function popup_text_field_1_render() { 
	$options = get_option( 'popup_settings' );
	?>
	<input type="text" id="width" class="width" name="popup_settings[popup_text_field_1]" value="<?php if (isset($options['popup_text_field_1'])) echo $options['popup_text_field_1']; ?>">
	<?php
}

// These functions make the fields where information can be written and puts them in a form
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
<!-- This part of the code allows for the input to be recognized in the back end. The javascript function opens up the window in the back end for the preview window.
<?php
echo '
<script>
var Window;
var outWidth =  document.getElementsByClassName("height");
var inWidth = document.getElementsByClassName("width");
function openWin() {
	Window = window.open("/~ccit2656/wp-content/plugins/Popup_Plugin/window.php","Window", "width=" + String(' . $width . ') + ", height=" + String(inWidth) );
	window.alert($_POST["popup_settings[popup_text_field_1]"]);
	window.alert("aa");
	}
</script>';
?>
	

<!-- This part of the code creates the font end of the plugin where the popup can be created This function also helps to create the width and height in the plugin by echoing them to the php.-->
<?php
}

add_action( 'admin_menu', 'popup_add_admin_menu' );
add_action( 'admin_init', 'popup_settings_init' );	




function popup_callit(){
	$options = get_option( 'popup_settings' );
	
	$width = $options['popup_text_field_0'];
	$height = $options['popup_text_field_1'];
	
	echo '<p>Text field 0: ' . $width . '</p>';
	echo '<p>Text field 1: ' . $height . '</p>';


// This following process turns the javascript code for opening a window into a php echo that we use to open the window. We call on the function later on to open the window.	
	echo '
<script>
var Window;
var outWidth =  document.getElementsByClassName("height");
var inWidth = document.getElementsByClassName("width");
function openWin() {
	Window = window.open("http://phoenix.sheridanc.on.ca/~ccit2656/wp-content/plugins/Popup_Plugin/window.php","Window", "width=" + String(' . $width . ') + ", height=" + String(' . $height . ') );
	window.alert($_POST["popup_settings[popup_text_field_1]"]);
	window.alert("aa");
	}
</script>';
echo '<form>';
echo '<button onclick = "openWin()"> Create the Window </button>';
echo '</form>';
	


}	
?>
<?php
// This is the short code function. The user can call on it for ease of access by typing in the shortcode and then the function echoes out a set ammount of content

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