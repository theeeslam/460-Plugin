<?php
/*
 * Plugin Name: The Popup
 * Description: A plugin that loads a pop up on page load
 * Author: Paige R, Tom S, Elyse M
 * Version: 1.0
 */


function cd_popup_add_admin_menu(  ) { 

	add_menu_page( 'The Popup', 'The Popup', 'manage_options', 'popup_plugin', 'popup_options_page', 'dashicons-hammer', 66 );

}


function cd_popup_settings_init(  ) { 

	register_setting( 'plugin_page', 'cd_popup_settings' );
	
	add_settings_section(
		'cd_popup_page_section', 
		__( 'Description for the section', 'popup' ), 
		'cd_popup_settings_section_callback', 
		'plugin_page'
	);

	add_settings_field( 
		'cd_popup_text_field_0', 
		__( 'Enter content into the text box', 'popup' ), 
		'cd_popup_text_field_0_render', 
		'plugin_page', 
		'cd_popup_plugin_page_section' 
	);

	add_settings_field( 
		'cd_popup_checkbox_field_1', 
		__( 'Check your preference', 'popup' ), 
		'cd_popup_checkbox_field_1_render', 
		'plugin_page', 
		'cd_popup_plugin_page_section' 
	);

	add_settings_field( 
		'cd_popup_radio_field_2', 
		__( 'Choose an option', 'popup' ), 
		'cd_popup_radio_field_2_render', 
		'plugin_page', 
		'cd_popup_plugin_page_section' 
	);

	add_settings_field( 
		'cd_popup_textarea_field_3', 
		__( 'Enter content into the text area', 'popup' ), 
		'cd_popup_textarea_field_3_render', 
		'plugin_page', 
		'cd_popup_plugin_page_section' 
	);

	add_settings_field( 
		'cd_popup_select_field_4', 
		__( 'Choose from the dropdown', 'popup' ), 
		'cd_popup_select_field_4_render', 
		'plugin_page', 
		'cd_popup_plugin_page_section' 
	);


}

function cd_popup_text_field_0_render() { 
	$options = get_option( 'cd_popup_settings' );
	?>
	<input type="text" name="cd_popup_settings[cd_popup_text_field_0]" value="<?php if (isset($options['cd_popup_text_field_0'])) echo $options['cd_popup_text_field_0']; ?>">
	<?php
}


function cd_popup_checkbox_field_1_render() { 
	$options = get_option( 'cd_popup_settings' );
	?>
	<input type="checkbox" name="cd_popup_settings[cd_popup_checkbox_field_1]" <?php if (isset($options['cd_popup_checkbox_field_1'])) checked( $options['cd_popup_checkbox_field_1'], 1 ); ?> value="1">
	<?php
}


function cd_popup_radio_field_2_render() { 
	$options = get_option( 'cd_popup_settings' );
	?>
	<input type="radio" name="cd_popup_settings[cd_popup_radio_field_2]" <?php if (isset($options['cd_popup_radio_field_2'])) checked( $options['cd_popup_radio_field_2'], 1 ); ?> value="1">
	<?php
}


function cd_popup_textarea_field_3_render() { 
	$options = get_option( 'cd_popup_settings' );
	?>
	<textarea cols="40" rows="5" name="cd_popup_settings[cd_popup_textarea_field_3]"> 
		<?php if (isset($options['cd_popup_textarea_field_3'])) echo $options['cd_popup_textarea_field_3']; ?>
 	</textarea>
	<?php
}


function cd_popup_select_field_4_render() { 
	$options = get_option( 'cd_popup_settings' );
	?>
	<select name="cd_popup_settings[cd_popup_select_field_4]">
		<option value="1" <?php if (isset($options['cd_popup_select_field_4'])) selected( $options['cd_popup_select_field_4'], 1 ); ?>>Option 1</option>
		<option value="2" <?php if (isset($options['cd_popup_select_field_4'])) selected( $options['cd_popup_select_field_4'], 2 ); ?>>Option 2</option>
	</select>
<?php
}


function cd_popup_settings_section_callback() { 
	echo __( 'More of a description and detail about the section.', 'popup' );
}


function popup_options_page() { 
	?>
	<form action="options.php" method="post">
		
		<h2>The Popup</h2>
		
		<?php
		settings_fields( 'plugin_page' );
		do_settings_sections( 'plugin_page' );
		submit_button();
		?>
		
	</form>
	<?php

}

add_action( 'admin_menu', 'cd_popup_add_admin_menu' );
add_action( 'admin_init', 'cd_popup_settings_init' );	



function popup_plugin_callit(){
	$options = get_option( 'cd_popup_settings' );
	echo '<img src="' . $options['cd_popup_text_field_0'] . '" />';
	echo '<p>Checkbox: ' . $options['cd_[popup_checkbox_field_1'] . '</p>';
	echo '<p>Radio: ' . $options['cd_popup_radio_field_2'] . '</p>';
	echo '<p>Textarea: ' . $options['cd_popup_textarea_field_3'] . '</p>';
	echo '<p>Select: ' . $options['cd_popup_select_field_4'] . '</p>';
}	

add_filter('the_content', 'popup_plugin_callit');	


?>