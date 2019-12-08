<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://typetura.com
 * @since      1.0.0
 *
 * @package    Typetura
 * @subpackage Typetura/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

	<h2 style="margin-bottom: 10px;" class="nav-tab-wrapper"><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<form method="post" name="typetura_settings" action="options.php">

	<?php
		// Grab all options

		$options = get_option($this->plugin_name);

		// Typetura Settings
		$typetura_package = $options['typetura_package'];
		$typetura_api_key = $options['typetura_api_key'];
	?>


	<?php
		settings_fields( $this->plugin_name );
		do_settings_sections( $this->plugin_name );
	?>

	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Select Typetura Package', $this->plugin_name);?></span></legend>
		<div><?php _e('Select Typetura Package', $this->plugin_name);?></div>

		<label for="<?php echo $this->plugin_name;?>-typetura_package">
			<select
				id="<?php echo $this->plugin_name;?>-typetura_package"
				name="<?php echo $this->plugin_name;?>[typetura_package]"
			>
				<?php $selected = ($typetura_package === 'nova') ? 'selected' : '' ; ?>
				<option value="nova" <?php echo $selected; ?>>Nova</option>
				<?php $selected = ($typetura_package === 'bullseye') ? 'selected' : '' ; ?>
				<option value="bullseye" <?php echo $selected; ?>>Bullseye</option>
				<?php $selected = ($typetura_package === 'magazine-moderne') ? 'selected' : '' ; ?>
				<option value="magazine-moderne" <?php echo $selected; ?>>Magazine Moderne</option>
				<?php $selected = ($typetura_package === 'rustic') ? 'selected' : '' ; ?>
				<option value="rustic" <?php echo $selected; ?>>Rustic</option>
				<?php $selected = ($typetura_package === 'squared-off') ? 'selected' : '' ; ?>
				<option value="squared-off" <?php echo $selected; ?>>Squared Off</option>
				<?php $selected = ($typetura_package === 'zine') ? 'selected' : '' ; ?>
				<option value="zine" <?php echo $selected; ?>>Zine</option>
			</select>
		</label>
	</fieldset>

	<fieldset>
		<div>
			<?php _e('Typetura API Key', $this->plugin_name);?>
		</div>
		<legend class="screen-reader-text">
			<span>
				<?php _e('Type in your typetura API key', $this->plugin_name);?>
			</span>
		</legend>
		<input
			type="text"
			class="regular-text"
			id="<?php echo $this->plugin_name;?>-typetura_api_key"
			name="<?php echo $this->plugin_name;?>[typetura_api_key]"
			value="<?php if(!empty($typetura_api_key)) echo $typetura_api_key;?>"
		/>
	</fieldset>

	<?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

  </form>

</div>
