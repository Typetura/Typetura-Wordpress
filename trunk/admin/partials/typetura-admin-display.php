<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://typetura.com
 * @since      1.0.4
 *
 * @package    Typetura
 * @subpackage Typetura/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	
	<form method="post" name="typetura_settings" action="options.php">

	<?php
 // Grab all options
 $defaults = [
   "typetura_package" => "armonk",
   "typetura_api_key" => "XXXXXXX-XXXXXXX-XXXXXXX-XXXXXXX",
   "typetura_base_size" => "20",
   "typetura_scale" => "1",
   "typetura_disabled_auto_typesetting" => false,
 ];
 $options = get_option($this->plugin_name, $defaults);

 // Typetura Settings
 $typetura_package = $options["typetura_package"];
 $typetura_api_key = $options["typetura_api_key"];
 $typetura_base_size = $options["typetura_base_size"];
 $typetura_scale = $options["typetura_scale"];
 $typetura_disabled_auto_typesetting =
   $options["typetura_disabled_auto_typesetting"];
 $hostname = $_SERVER["SERVER_NAME"];

 $postdata = http_build_query([]);

 $response = wp_remote_get("https://cdn-staging.typetura.com/get-packages");
 $packages = json_decode(wp_remote_retrieve_body($response), true)["packages"];
 ?>


	<?php
 settings_fields($this->plugin_name);
 do_settings_sections($this->plugin_name);

 if ($hostname === "localhost") { ?>

	<div class="dops-notice is-info">
		<span class="dops-notice__icon-wrapper">
			<svg class="gridicon gridicons-info dops-notice__icon" height="24" width="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<g>
					<path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path>
				</g>
			</svg>
		</span>
		<span class="dops-notice__content">
			<h3>Development mode</h3>
			<p class="dops-notice__text">
				You do not need a paid Typetura account or valid API key while working on localhost. You can use the API key <code>XXXXXXX-XXXXXXX-XXXXXXX-XXXXXXX</code> to in this mode.
			</p>
		</span>
		</a>
	</div>

	<?php }
 ?>

	<style>
		.dops-notice {
		  background: #fff;
		  border: 1px solid #ccc;
		  box-shadow: 0 3px 8px #ddd;
		  border-radius: 6px;
		  padding: 1rem 1rem 1rem 1.5rem;
		  margin: 2rem 2rem 1rem;
		  max-width: 800px;
		  position: relative;
		}
		.dops-notice__icon-wrapper svg {
		  fill: #0073aa;
		  position: absolute;
		  left: 0;
		  top: 50%;
		  transform: translateY(-50%) translateX(-50%);
		  background: #fff;
		  border-radius: 50%;
		}
		.dops-notice__content h3 {
			margin-top: 0;
		}
		.dops-notice__text {
			margin: 0.5rem 0;
			font-size: 1.2em;
		}
	</style>

	<table class="form-table" role="presentation">
		<tr>
			<th scope="row">
				<label>Getting started</label>
			</th>
			<td>
				<p style="max-width: 70ch" class="description">
					Thanks for using Typetura! Typetura transforms the typography on your WordPress website. Just select a typographic package and see all the text on your website transform. Your website can have big, bold, and responsive type, regardless of the layout or theme you use. To get started, you will need a paid Typetura account with an API key.
				</p>
				<div style="display: flex; margin: 1rem 0;">
					<a style="margin-right: 0.3rem" class="button button-primary" href="https://typetura.com/auth/create-account" target="_blank">Purchase a subscription</a>
					<a style="margin-right: 0.3rem" class="button button-primary" href="https://typetura.com/account-settings" target="_blank">Find your API key</a>
					<a class="button button-primary" href="https://docs.typetura.com/using-typetura/configuration-with-packages" target="_blank">Documentation</a>
				</div>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="<?php echo $this->plugin_name; ?>-typetura_api_key">API Key</label>
			</th>
			<td>
				<input
				type="text"
				class="regular-text"
				id="<?php echo $this->plugin_name; ?>-typetura_api_key"
				name="<?php echo $this->plugin_name; ?>[typetura_api_key]"
				value="<?php if (!empty($typetura_api_key)) {
      echo $typetura_api_key;
    } ?>"
			/>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="<?php echo $this->plugin_name; ?>-typetura_package">Typetura Package</label>
			</th>
			<td>
				<select
					id="<?php echo $this->plugin_name; ?>-typetura_package"
					name="<?php echo $this->plugin_name; ?>[typetura_package]"
				>
					<?php foreach ($packages as $key => $package) { ?>
						<?php $selected = $typetura_package === $package["name"] ? "selected" : ""; ?>
						<option 
							value=<?php echo $package["name"]; ?> 
							<?php echo $selected; ?>
						>
							<?php echo $package["title"]; ?>
						</option>
					<?php } ?>
				</select>
				<img 
					id="package-preview" 
					src="https://s3.amazonaws.com/typetura.com/production/<?php echo $typetura_package; ?>/preview.png" 
					alt="Package Preview" 
					class="package_image"
					style="display: block; background: #ddd; border-radius: 6px; width: 320px; height: 160px; margin: 1rem 0; border: 1px solid #ccc; box-shadow: 0 3px 8px #ddd;"
				>
				<p class="description">
					<?php _e(
       'You can <a href="https://typetura.com/typography-packages">browse the packages at Typetura.com.</a>',
       $this->plugin_name
     ); ?>
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
				#<?php echo $this->plugin_name; ?>-typetura_base_size:invalid {
					box-shadow: 0 0 0 4px #e1340c52 !important;
					border-color: #e1340c !important;
				}
				#<?php echo $this->plugin_name; ?>-typetura_base_size:valid ~ .<?php echo $this->plugin_name; ?>-typetura_base_size--invalid {
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
				value="<?php if (!empty($typetura_base_size)) {
      echo $typetura_base_size;
    } ?>"
				id="<?php echo $this->plugin_name; ?>-typetura_base_size"
				name="<?php echo $this->plugin_name; ?>[typetura_base_size]"
			/>
			<span
				class="<?php echo $this->plugin_name; ?>-typetura_base_size--invalid"
				style="color: #e1340c; font-weight: 700; margin-left: .25em;"
			>
				This must be a unitless value between 12 and 34.
			</span>
		</label>
		<p style="max-width: 70ch" class="description"><?php _e(
    "If you find the font size too big or small, you can adjust it here. The default value is <code>20</code> and values of <code>12</code> through <code>34</code> are accepted. These values will map to pixel values for most people, but there will be variation based on screen size and user preferences.",
    $this->plugin_name
  ); ?></p>
	</td>
</tr>
<tr>
	<th scope="row">
		<label for="scale">Scale factor</label>
	</th>
	<td>
		<label>
			<style>
				#<?php echo $this->plugin_name; ?>-typetura_scale:invalid {
					box-shadow: 0 0 0 4px #e1340c52 !important;
					border-color: #e1340c !important;
				}
				#<?php echo $this->plugin_name; ?>-typetura_scale:valid ~ .<?php echo $this->plugin_name; ?>-typetura_scale--invalid {
					display: none;
				}
			</style>
			<input
				type="number"
				step="0.1"
				min="0.1"
				max="3"
				size="2"
				placeholder="1"
				value="<?php if (!empty($typetura_scale)) {
      echo $typetura_scale;
    } ?>"
				id="<?php echo $this->plugin_name; ?>-typetura_scale"
				name="<?php echo $this->plugin_name; ?>[typetura_scale]"
			/>
			<span
				class="<?php echo $this->plugin_name; ?>-typetura_scale--invalid"
				style="color: #e1340c; font-weight: 700; margin-left: .25em;"
			>
				This must be a unitless value between 0.1 and 3.
			</span>
		</label>
		<p style="max-width: 70ch" class="description"><?php _e(
    "Sometimes you might find your headlines to be a little too big or small relative to your text. Adjusting the scale factor will change how big or small your headlines will go. The default scale factor is <code>1</code>.",
    $this->plugin_name
  ); ?></p>
	</td>
</tr>
		<tr>
			<th scope="row">
				<label for="auto-typesetting">Disable auto typesetting</label>
			</th>
			<td>
				<label>
					<input
						type="checkbox"
						id="<?php echo $this->plugin_name; ?>-typetura_disabled_auto_typesetting"
						name="<?php echo $this->plugin_name; ?>[typetura_disabled_auto_typesetting]"
						<?php checked($typetura_disabled_auto_typesetting); ?>
					/>
					Disable auto typesetting
				</label>
				<p style="max-width: 70ch" class="description"><?php _e(
      "Auto typesetting ensures the Typetura package applies to your text, regardless of the theme you use. If you wish to have manual control over how Typetura interacts with your theme, disable auto typesetting.",
      $this->plugin_name
    ); ?></p>
			</td>
		</tr>
	</table>

	<?php submit_button(
   __("Save changes", $this->plugin_name),
   "primary",
   "submit",
   true
 ); ?>

  </form>

	<script>
		document.getElementById('typetura-typetura_package').addEventListener('change', function(e) {
			var packageName = e.target.value;

			document.getElementById('package-preview').src = "https://s3.amazonaws.com/typetura.com/production/" + packageName + '/preview.png';
		});
	</script>
</div>
