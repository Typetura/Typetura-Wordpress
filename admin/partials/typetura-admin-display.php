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

	<h2 style="padding-bottom: 10px; margin-bottom: 20px;" class="nav-tab-wrapper"><?php echo esc_html( get_admin_page_title() ); ?></h2>

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

	<fieldset style="font-size: 16px;">
		<div>
			<?php _e('Enter your Typetura API key. You can Find it in your <a href="https://typetura.com/account-settings">Typetura account settings</a>', $this->plugin_name);?>
		</div>
		<div>
			<?php _e('Don\'t have an account? <a href="https://typetura.com/auth/create-account">Create a Typetura account here.</a>', $this->plugin_name);?>
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

	<div style="padding: 10px 0;"></div>

	<fieldset style="font-size: 16px;">
		<legend class="screen-reader-text"><span><?php _e('Select Typetura Package', $this->plugin_name);?></span></legend>
		<div><?php _e('Select a Typetura Package. You can <a href="https://typetura.com/typography-packages">browse the packages here.</a>', $this->plugin_name);?></div>

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

		<div>
			<img id="package-preview" src="https://s3.amazonaws.com/typetura.com/production/<?php echo $typetura_package ?>/preview.png" width="600" height="300" alt=" " class="package_image">
		</div>
	</fieldset>

	<?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

  </form>

	<script>
		document.getElementById('typetura-typetura_package').addEventListener('change', function(e) {
			var packageName = e.target.value;

			document.getElementById('package-preview').src = "https://s3.amazonaws.com/typetura.com/production/" + packageName + '/preview.png';
		});
	</script>
</div>
