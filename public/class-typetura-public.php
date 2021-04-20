<?php

class Typetura_Public
{
  private $plugin_name;
  private $version;

  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
    $defaults = [
      "typetura_package" => "armonk",
      "typetura_api_key" => "XXXXXXX-XXXXXXX-XXXXXXX-XXXXXXX",
      "typetura_base_size" => "20",
      "typetura_scale" => "1",
      "typetura_disabled_auto_typesetting" => false,
    ];
    $this->typetura_options = get_option($this->plugin_name, $defaults);
  }

  // Load Typetura Package
  public function typetura_cdn_package()
  {
    $typetura_package = $this->typetura_options["typetura_package"];
    $typetura_api_key = $this->typetura_options["typetura_api_key"];
    $typetura_base_size = $this->typetura_options["typetura_base_size"];
    $typetura_scale = $this->typetura_options["typetura_scale"];
    $typetura_disabled_auto_typesetting =
      $this->typetura_options["typetura_disabled_auto_typesetting"];

    if (!empty($typetura_package) && !empty($typetura_api_key)) {
      $js_link = "https://cdn.typetura.com/typetura.js?apiKey=$typetura_api_key";
      $css_link = "https://cdn.typetura.com/$typetura_package/typetura.css?apiKey=$typetura_api_key";
      $css_hs_link = "https://cdn.typetura.com/$typetura_package/typetura-hs.css?apiKey=$typetura_api_key";
      $custom_js_link = plugin_dir_url(__FILE__) . "js/typetura-public.js";

      if ($typetura_disabled_auto_typesetting) {
        wp_enqueue_style($this->plugin_name, $css_link);
        wp_enqueue_script($this->plugin_name, $js_link);
      } else {
        wp_enqueue_script("typetura_js_custom", $custom_js_link);
        wp_enqueue_style($this->plugin_name, $css_hs_link);
        wp_enqueue_script("typetura_js_link", $js_link);
      }

      if ($typetura_base_size || $typetura_scale) { ?>
				<style type="text/css">
					:root {
						--tt-base: <?php echo $typetura_base_size; ?>;
						--tt-scale: <?php echo $typetura_scale; ?>;
					}
				</style>
			<?php }
    }
  }
}
