<?php

class Typetura_Admin
{
  private $plugin_name;
  private $version;

  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /*
   *   public function typetura_cdn_package()
   *   {
   *     $typetura_package = $this->typetura_options["typetura_package"];
   *     $typetura_api_key = $this->typetura_options["typetura_api_key"];
   *     $typetura_base_size = $this->typetura_options["typetura_base_size"];
   *     $typetura_scale = $this->typetura_options["typetura_scale"];
   *     $typetura_disabled_auto_typesetting =
   *       $this->typetura_options["typetura_disabled_auto_typesetting"];
   *     $custom_js_link = plugin_dir_url(__FILE__) . "js/typetura-admin.js";
   *
   *     if (!empty($typetura_package) && !empty($typetura_api_key)) {
   *       $js_link = "https://cdn.typetura.com/typetura.js?apiKey=$typetura_api_key";
   *       $css_link_admin = "https://cdn.typetura.com/$typetura_package/typetura-admin.css?apiKey=$typetura_api_key";
   *
   *       if (!$typetura_disabled_auto_typesetting) {
   *         wp_enqueue_script("typetura_js_custom", $custom_js_link);
   *       }
   *       wp_enqueue_style($this->plugin_name, $css_link_admin);
   *       wp_enqueue_script($this->plugin_name, $js_link);
   *
   *       if ($typetura_base_size || $typetura_scale) { ?>
   * 			 <style type="text/css">
   * 				 :root {
   * 					 --tt-base: <?php echo $typetura_base_size; ?>;
   * 					 --tt-scale: <?php echo $typetura_scale; ?>;
   * 				 }
   * 			 </style>
   * 		 <?php }
   *     }
   *   }
   */

  public function add_plugin_admin_menu()
  {
    /*
     * Add a settings page for this plugin to the Settings menu.
     *
     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
     *
     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
     *
     */
    add_options_page(
      "Typetura Settings",
      "Typetura Settings",
      "manage_options",
      $this->plugin_name,
      [$this, "display_plugin_setup_page"]
    );
  }

  public function add_action_links($links)
  {
    /*
     *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
     */
    $settings_link = [
      '<a href="' .
      admin_url("options-general.php?page=" . $this->plugin_name) .
      '">' .
      __("Settings", $this->plugin_name) .
      "</a>",
    ];
    return array_merge($settings_link, $links);
  }

  public function display_plugin_setup_page()
  {
    include_once "partials/typetura-admin-display.php";
  }

  public function options_update()
  {
    register_setting($this->plugin_name, $this->plugin_name, [
      $this,
      "validate",
    ]);
  }

  public function validate($input)
  {
    // All inputs
    $valid = [];

    $valid["typetura_package"] = $input["typetura_package"];
    $valid["typetura_api_key"] = $input["typetura_api_key"];
    $valid["typetura_base_size"] = $input["typetura_base_size"];
    $valid["typetura_scale"] = $input["typetura_scale"];
    $valid["typetura_disabled_auto_typesetting"] =
      $input["typetura_disabled_auto_typesetting"] == "on" ? true : false;

    return $valid;
  }
}
