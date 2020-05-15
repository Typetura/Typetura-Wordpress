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

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	
	<form method="post" name="typetura_settings" action="options.php">

	<?php
		// Grab all options
		$options = get_option($this->plugin_name);
		
		// Typetura Settings
		$typetura_package = $options['typetura_package'];
		$typetura_api_key = $options['typetura_api_key'];
		$typetura_base_size = $options['typetura_base_size'];
		$typetura_auto_typesetting = $options['typetura_auto_typesetting'];

		$postdata = http_build_query(
			array(
			)
		);
		
		$response = file_get_contents ( 'https://cdn.typetura.com/get-packages' );
		$packages = json_decode($response, true)['packages'];
	?>


	<?php
		settings_fields( $this->plugin_name );
		do_settings_sections( $this->plugin_name );
	?>

	<table class="form-table" role="presentation">
		<tr>
			<th scope="row">
				<label>Getting started</label>
			</th>
			<td>
				<p style="max-width: 70ch" class="description">
					Thanks for using Typetura! Intrinsic typography for your website. To get started, you will need a paid Typetura account with an API key. If you need any assistance please see <a href="https://docs.typetura.com/using-typetura/configuration-with-packages">our documentation</a> or <a href="https://typetura.com">reach out to us</a>.
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="<?php echo $this->plugin_name;?>-typetura_api_key">API Key</label>
			</th>
			<td>
				<input
				type="text"
				class="regular-text"
				id="<?php echo $this->plugin_name;?>-typetura_api_key"
				name="<?php echo $this->plugin_name;?>[typetura_api_key]"
				value="<?php if(!empty($typetura_api_key)) echo $typetura_api_key;?>"
			/>
				<p class="description">
					<?php _e('You can find your API key in your <a href="https://typetura.com/account-settings">Typetura account settings</a>,', $this->plugin_name);?>
					<?php _e('Or <a href="https://typetura.com/auth/create-account">Create a Typetura account</a>.', $this->plugin_name);?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="<?php echo $this->plugin_name;?>-typetura_package">Typetura Package</label>
			</th>
			<td>
				<select
					id="<?php echo $this->plugin_name;?>-typetura_package"
					name="<?php echo $this->plugin_name;?>[typetura_package]"
				>
					<?php foreach ($packages as $key => $package) { ?>
						<?php $selected = ($typetura_package === $package['name']) ? 'selected' : '' ; ?>
						<option 
							value=<?php echo $package['name'] ?> 
							<?php echo $selected; ?>
						>
							<?php echo $package['title'] ?>
						</option>
					<?php } ?>
				</select>
				<img 
					id="package-preview" 
					src="https://s3.amazonaws.com/typetura.com/production/<?php echo $typetura_package ?>/preview.png" 
					alt="Package Preview" 
					class="package_image"
					style="display: block; background: #ddd; border-radius: 6px; width: 320px; height: 160px; margin: 1rem 0; box-shadow: 0 3px 8px #aaa"
				>
				<p class="description">
					<?php _e('You can <a href="https://typetura.com/typography-packages">browse the packages at Typetura.com.</a>', $this->plugin_name);?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="base-size">Base size</label>
			</th>
			<td>
				<label>
					<style>
						#<?php echo $this->plugin_name;?>-typetura_base_size:invalid {
							box-shadow: 0 0 0 4px #e1340c52 !important;
							border-color: #e1340c !important;
						}
						#<?php echo $this->plugin_name;?>-typetura_base_size:valid ~ .<?php echo $this->plugin_name;?>-typetura_base_size--invalid {
							display: none;
						}
					</style>
					<input
						type="number"
						step="1"
						min="12"
						max="34"
						size="2"
						placeholder="20"
						value="<?php if(!empty($typetura_base_size)) echo $typetura_base_size;?>"
						id="<?php echo $this->plugin_name;?>-typetura_base_size"
						name="<?php echo $this->plugin_name;?>[typetura_base_size]"
					/>
					<span
						class="<?php echo $this->plugin_name;?>-typetura_base_size--invalid"
						style="color: #e1340c; font-weight: 700; margin-left: .25em;"
					>
						This must be a unitless value between 12 and 34.
					</span>
				</label>
				<p style="max-width: 70ch" class="description"><?php _e('If you find the font size too big or small, you can adjust it here. The default value is <code>20</code> and values of <code>12</code> through <code>34</code> are accepted. These values will map to pixel values for most people, but there will be variation based on screen size and user preferences.', $this->plugin_name);?></p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="auto-typesetting">Auto typesetting</label>
			</th>
			<td>
				<label>
					<input
						type="checkbox"
						id="<?php echo $this->plugin_name;?>-typetura_auto_typesetting"
						name="<?php echo $this->plugin_name;?>[typetura_auto_typesetting]"
						<?php checked( $typetura_auto_typesetting ); ?>
					/>
					Toggle auto typesetting
				</label>
				<p style="max-width: 70ch" class="description"><?php _e('Auto typesetting ensures the Typetura package applies to all of your headlines regardless of the class names used. If you wish to explicitly use the class names defined by the Typetura package, turn this off. If you’re unsure, leave this checked.', $this->plugin_name);?></p>
			</td>
		</tr>
	</table>

	<?php submit_button(__('Save changes', $this->plugin_name), 'primary','submit', TRUE); ?>

  </form>

	<script>
		document.getElementById('typetura-typetura_package').addEventListener('change', function(e) {
			var packageName = e.target.value;

			document.getElementById('package-preview').src = "https://s3.amazonaws.com/typetura.com/production/" + packageName + '/preview.png';
		});
	</script>
</div>
