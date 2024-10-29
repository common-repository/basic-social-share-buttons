<?php 

class BBD_Basic_Share_Buttons_Settings {
  public function __construct() {
    add_action( 'admin_menu', array( $this, 'admin_menu' ) );

  }

  public function admin_menu() {
    // if ( current_user_can( 'activate_plugins' ) ) {
    register_setting("reading", "basic-share-buttons__sites", [
      "default" => ""
    ]);
    register_setting("reading", "basic-share-buttons__size", [
      "default" => "large"
    ]);
    register_setting("reading", "basic-share-buttons__style", [
      "default" => "yes"
    ]);
    add_settings_field("basic-share-buttons__sites", "Share Buttons <span class='basic-share-buttons__sites-shortcode'>[basic-share-buttons]</span>", [$this, "form_inputs"], "reading");
    // }
  }

  private function form_size_radio($label, $checked) {
    $state = ($label == $checked) ? "checked" : "";
    return "
    <label>
      <input type='radio' name='basic-share-buttons__size' {$state} value='{$label}'/>
      {$label}
    </label>";
  }

  private function form_style_radio($label, $checked) {
    $state = ($label == $checked) ? "checked" : "";
    return "
    <label>
      <input type='radio' name='basic-share-buttons__style' {$state} value='{$label}'/>
      {$label}
    </label>";
  }

  public function form_inputs( $args ) {
    echo "<div class='basic-share-buttons__options-container'>";

      // sites sortable
      echo "<div class='basic-share-buttons__sites-container'>
        <input type='hidden' id='basic-share-buttons__sites' name='basic-share-buttons__sites' value='".get_option("basic-share-buttons__sites")."'>

        <label class='basic-share-buttons__label'>Selected</label>
        <div class='basic-share-buttons__sortable-section'>
          <div class='basic-share-buttons__sortable basic-share-buttons__selected'></div>
        </div>
        <label class='basic-share-buttons__label'>Available</label>
        <div class='basic-share-buttons__sortable-section'>
          <div class='basic-share-buttons__sortable basic-share-buttons__available'>";
      $shares = new BBD_Basic_Share_Buttons_Buttons();
      $shares->spans([ "Facebook", "WhatsApp", "Twitter", "Email", "LinkedIn", "Reddit", "Pinterest", "Tumblr", "Telegram"]);
      echo "</div></div></div>";


      echo "<div class='basic-share-buttons__radio-coloumn'>";
        // size radio options
        echo "<div class='basic-share-buttons__size-container'>
          <label class='basic-share-buttons__label'>Button Size</label>
          <div class='basic-share-buttons__size-section'> ";
          $size_selected = get_option("basic-share-buttons__size");
          foreach(["large", "medium", "small"] as $size) {
            echo $this->form_size_radio($size, $size_selected);
          }

        echo "</div></div>";

        // style radio options
        echo "<div class='basic-share-buttons__style-container'>
          <label class='basic-share-buttons__label'>Include .css?</label>
          <div class='basic-share-buttons__style-section'> ";
          $style_selected = get_option("basic-share-buttons__style");
          foreach(["yes", "no"] as $style) {
            echo $this->form_style_radio($style, $style_selected);
          }

        echo "<p class='basic-share-buttons__para'>Merge css into your stylesheet to reduce http requests</p>
        </div></div>";
      echo "</div>";
    
    echo "</div>";

    // css copy paste
    $css_style = (get_option("basic-share-buttons__style") == "no") ? "" : "style='display: none;'";

    echo "<div class='basic-share-buttons__css' {$css_style}>";
    echo "<textarea></textarea>";
    echo "</div>";
    

    echo "<script>
    window.BSBCSS = { sites: {} }
    window.BSBCSS.base = `.basic-share-button__link,
.basic-share-button__icon {
  display: inline-block
}

.basic-share-button__link {
  text-decoration: none;
  color: #fff;
  margin: 0.5em
}

.basic-share-button {
  border-radius: 1px;
  -webkit-transition: 25ms ease-out;
  -o-transition: 25ms ease-out;
  transition: 25ms ease-out;
  padding: 0.5em 0.75em;
  font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
}

.basic-share-button__icon {
  display: -webkit-inline-box;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center; 
}

.basic-share-button__icon svg {
  width: 1em;
  height: 1em;
  margin-right: 0.4em;
  vertical-align: top
}

.basic-share-button--small svg {
  margin: 0;
  vertical-align: middle
}

.basic-share-button--small .basic-share-button__noun,
.basic-share-button--small .basic-share-button__verb {
  display: none;
}

.basic-share-button--medium .basic-share-button__verb {
  display: none;
}

.basic-share-button__icon {
  fill: #fff;
  stroke: none
}`

  window.BSBCSS.sites.twitter = `.basic-share-button--twitter {
  background-color: #55acee;
  border-color: #55acee;
}

.basic-share-button--twitter:hover,
.basic-share-button--twitter:active {
  background-color: #2795e9;
  border-color: #2795e9;
}`
  window.BSBCSS.sites.whatsapp = `.basic-share-button--whatsapp {
  background-color: #25D366;
  border-color: #25D366;
}

.basic-share-button--whatsapp:hover,
.basic-share-button--whatsapp:active {
  background-color: #1DA851;
  border-color: #1DA851;
}`
  window.BSBCSS.sites.facebook = `.basic-share-button--facebook {
  background-color: #3b5998;
  border-color: #3b5998;
}

.basic-share-button--facebook:hover,
.basic-share-button--facebook:active {
  background-color: #2d4373;
  border-color: #2d4373;
}`
  window.BSBCSS.sites.tumblr = `.basic-share-button--tumblr {
  background-color: #35465C;
  border-color: #35465C;
}

.basic-share-button--tumblr:hover,
.basic-share-button--tumblr:active {
  background-color: #222d3c;
  border-color: #222d3c;
}`
  window.BSBCSS.sites.email = `.basic-share-button--email {
  background-color: #777777;
  border-color: #777777;
}

.basic-share-button--email:hover,
.basic-share-button--email:active {
  background-color: #5e5e5e;
  border-color: #5e5e5e;
}`
  window.BSBCSS.sites.pinterest = `.basic-share-button--pinterest {
  background-color: #bd081c;
  border-color: #bd081c;
}

.basic-share-button--pinterest:hover,
.basic-share-button--pinterest:active {
  background-color: #8c0615;
  border-color: #8c0615;
}`
  window.BSBCSS.sites.linkedin = `.basic-share-button--linkedin {
  background-color: #0077b5;
  border-color: #0077b5;
}

.basic-share-button--linkedin:hover,
.basic-share-button--linkedin:active {
  background-color: #046293;
  border-color: #046293;
}`
  window.BSBCSS.sites.reddit = `.basic-share-button--reddit {
  background-color: #5f99cf;
  border-color: #5f99cf;
}

.basic-share-button--reddit:hover,
.basic-share-button--reddit:active {
  background-color: #3a80c1;
  border-color: #3a80c1;
}`
  window.BSBCSS.sites.telegram = `.basic-share-button--telegram {
  background-color: #54A9EB;
}

.basic-share-button--telegram:hover {
  background-color: #4B97D1;}`

    </script>";

  }
}

new BBD_Basic_Share_Buttons_Settings();
