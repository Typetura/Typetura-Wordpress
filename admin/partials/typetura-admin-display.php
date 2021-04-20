<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://typetura.com
 * @since      1.0.5
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

 $response = wp_remote_get("https://cdn.typetura.com/get-packages");
 $packages = json_decode(wp_remote_retrieve_body($response), true)["packages"];
 ?>


	<?php
 settings_fields($this->plugin_name);
 do_settings_sections($this->plugin_name);

 $js_link = "https://cdn.typetura.com/typetura.js?apiKey=$typetura_api_key";
 $css_link_admin = "https://cdn.typetura.com/$typetura_package/typetura-admin.css?apiKey=$typetura_api_key";

 wp_enqueue_style($this->plugin_name, $css_link_admin);
 wp_enqueue_script($this->plugin_name, $js_link);

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
		  padding: 16px 16px 16px 24px;
		  margin: 32px 32px 16px;
		  max-width: 800px;
		  position: relative;
			font-size: 16px;
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
			margin: 8px 0;
			font-size: 1.2em;
		}
		.dops-notice__content * {
			margin: 6px 0;
			line-height: 1.3;
		}

		input[type=range] {
			-webkit-appearance: none;
			appearance: none;
			margin: 0;
			width: 100%;
			max-width: 300px;
			background: none;
			display: inline-block;
			vertical-align: baseline;
		}
		input[type=range]:focus {
			outline: none;
		}
		input[type=range]::-webkit-slider-runnable-track {
			width: 100%;
			height: 2px;
			cursor: pointer;
			background: #2271b1;
			border-radius: 4px;
		}
		input[type=range]::-webkit-slider-thumb {
			height: 16px;
			width: 16px;
			border-radius: 50%;
			background: #fff;
			border: 1px solid #2271b1;
			cursor: pointer;
			-webkit-appearance: none;
			margin-top: calc(112px);
			box-sizing: border-box;
			transition: all 0.2s ease-in-out;
		}
		input[type=range]:focus::-webkit-slider-thumb {
			box-shadow: 0 0 0 1px #2271b1, 0 0 0 5px #f0f0f1;
		}
		input[type=range]:hover::-webkit-slider-thumb {
			box-shadow: 0 0 0 1px #2271b1, 0 0 0 5px #f0f0f1;
		}
		input[type=range]::-moz-range-track {
			width: 100%;
			height: 2px;
			cursor: pointer;
			background: #2271b1;
			border-radius: 4px;
		}
		input[type=range]::-moz-range-thumb {
			height: 16px;
			width: 16px;
			border-radius: 50%;
			background: #fff;
			border: 1px solid #2271b1;
			cursor: pointer;
			-webkit-appearance: none;
			margin-top: calc(-7px);
			box-sizing: border-box;
			transition: all 0.2s ease-in-out;
		}
		input[type=range]:focus::-moz-range-thumb {
			box-shadow: 0 0 0 1px #2271b1, 0 0 0 5px #f0f0f1;
		}
		input[type=range]:hover::-moz-range-thumb {
			box-shadow: 0 0 0 1px #2271b1, 0 0 0 5px #f0f0f1;
		}
		#collapse-button {
			font-size: 13px;
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
				<div style="display: flex; margin: 16px 0;">
					<a style="margin-right: 5px" class="button button-primary" href="https://typetura.com/auth/create-account" target="_blank">Purchase a subscription</a>
					<a style="margin-right: 5px" class="button button-primary" href="https://typetura.com/account-settings" target="_blank">Find your API key</a>
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
					oninput="changePack(this.value)"
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
		<label for="base-size">Base size <output id="base-size-output"><?php if (
    !empty($typetura_base_size)
  ) {
    echo $typetura_base_size;
  } else {
    echo 20;
  } ?>px</output></label>
	</th>
	<td>
		<label>
			<input
				type="range"
				step="1"
				min="12"
				max="34"
				value="<?php if (!empty($typetura_base_size)) {
      echo $typetura_base_size;
    } else {
      echo 20;
    } ?>"
				id="<?php echo $this->plugin_name; ?>-typetura_base_size"
				name="<?php echo $this->plugin_name; ?>[typetura_base_size]"
				oninput="changeBase(this.value)"
			/>
		</label>
		<p style="max-width: 70ch" class="description"><?php _e(
    "If you find the font size too big or small, you can adjust it here. The default value is <code>20</code>. The rendered value may vary based on screen size and user preferences.",
    $this->plugin_name
  ); ?></p>
	</td>
</tr>
<tr>
	<th scope="row">
		<label for="scale">Scale factor <output id="scale-output"><?php if (
    !empty($typetura_scale)
  ) {
    echo $typetura_scale;
  } else {
    echo 1;
  } ?>x</output></label>
	</th>
	<td>
		<label>
			<input
				type="range"
				step="0.1"
				min="0.1"
				max="3"
				value="<?php if (!empty($typetura_scale)) {
      echo $typetura_scale;
    } else {
      echo 1;
    } ?>"
				id="<?php echo $this->plugin_name; ?>-typetura_scale"
				name="<?php echo $this->plugin_name; ?>[typetura_scale]"
				oninput="changeScale(this.value)"
			/>
		</label>
		<p style="max-width: 70ch" class="description"><?php _e(
    "Sometimes you might find your headlines to be a little too big or small relative to your text. Adjusting the scale factor will change how big or small your headlines will go. The default scale factor is <code>1</code>.",
    $this->plugin_name
  ); ?></p>
	</td>
</tr>
<tr>
	<th scope="row">
		<label for="scale">Preview</label>
	</th>
	<td>
		<div class="typetura-preview edit-post-visual-editor">
			<section>
				<h1 class="primary-headline">The perfect staycation</h1>
				<h2 class="primary-subheadline">How to Get Away While You’re at Home</h2>
				<p> When you’re commuting to a 9-to-5, you long for the weekends, the beach and the get-things-done, life-organizing staycation. Our current environment has turned life on its head, and now more than ever we dream of being anywhere but at home. Until a quick trip to a new locale is an option, we’ve got everything you need to get away at home.</p>
			</section>
			<section>
				<h1 class="section-headline">A Day of Food and Customs to Transport You to the South of France</h1>
				<p> Lauren Paul and her husband spent all of last week cancelling their honeymoon. “We were devastated until we realized how dangerous not cancelling would have been for all of the hospitality workers we would have depended on.” Lauren reported. Not one to dwell on life’s curve balls, Lauren and Jose decided to bring a little Provence into their home. “We had already done so much research on the food, the farming culture, the way people care for the land in Provence. We thought, why not spend a day pretending we’re there.” </p>
			</section>
			<section>
				<h1 class="section-headline">Why Learning a Language is More Important Than Ever</h1>
				<p> My mother spoke Spanish with us at home from birth, through our disdainful teenage years, and on every phone call until the day she passed. When I was a youngster without the perspective that comes with experience, I asked her why she was so dedicated to us being bilingual. The simple answer, “If you and your sister do not know Spanish, you cannot teach it to your children.” </p>
			</section>
		  <style>
				.typetura-preview {
					display: grid;
					grid-template-rows: auto auto;
					grid-template-columns: 3fr 2fr;
					background: #fff;
					border-radius: 6px;
					margin: 16px 0;
					border: 1px solid #ccc;
					box-shadow: 0 3px 8px #ddd;
					padding: 0 1rem 1rem;
					gap: 1rem;
					max-width: 800px;
				}
				.typetura-preview section:first-child {
					grid-column-end: span 2;
				}
			</style>
		</div>
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
		
		const resizeObserver = new ResizeObserver((entries) => {
			for (let entry of entries) {
				if (entry.contentBoxSize) {
					entry.target.style.setProperty("--tt-bind", entry.contentRect.width);
				}
			}
		});
		
		document.documentElement.style.setProperty('--tt-base', <?php if (
    !empty($typetura_base_size)
  ) {
    echo $typetura_base_size;
  } else {
    echo 20;
  } ?>);
		document.documentElement.style.setProperty('--tt-scale', <?php if (
    !empty($typetura_scale)
  ) {
    echo $typetura_scale;
  } else {
    echo 1;
  } ?>);

		const previewSections = document.querySelectorAll('.edit-post-visual-editor section');
		
		previewSections.forEach(e => {
			resizeObserver.observe(e)
		});
	
		
		function changeBase(v) {
			document.getElementById('base-size-output').value = v + 'px';
			document.documentElement.style.setProperty('--tt-base', v);
		}
		function changeScale(v) {
			document.getElementById('scale-output').value = v + 'x';
			document.documentElement.style.setProperty('--tt-scale', v);
		}
		function changePack(v) {
			document.getElementById('typetura-css').setAttribute('href',`https://cdn.typetura.com/${v}/typetura-admin.css?apiKey=<?php echo $typetura_api_key; ?>`);
		}
	</script>
</div>
