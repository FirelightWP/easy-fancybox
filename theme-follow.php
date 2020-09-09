<?php

  // Exit if accessed directly.
if (!defined('ABSPATH')) exit;

  /**
   * Default settings
   */
$theme_subscription_widget_defaults = array(
  'dis_cont' => 'false',
  'title' => 'Get new posts by email!',
  'submit' => 'Subscribe me!',
  'placeholder' => 'Enter your email',
  'provider' => 'https://theme.follow.it',
  'widget_class' => 'false'
);

  /**
   * If you wish to edit structure of the widget this is correct function!
   * Prints structure of the widget with default options
   *
   * @param array $opts Custom options for that instance instead of default
   * @return void Echoes it's output
   **/
if (!function_exists('theme_subscription_widget_content')) {

  // Mentioned function
  function theme_subscription_widget_content($opts = array(), $globals = false, $isw = false) {

    // Default values
    global $theme_subscription_widget_defaults;
    $defaults = $theme_subscription_widget_defaults;
    $wc = $defaults['widget_class'];
    $display_container = $defaults['dis_cont'];
    $container_title = $defaults['title'];
    $placeholder_email = $defaults['placeholder'];
    $submit_text = $defaults['submit'];
    $provider = $defaults['provider'];

    // Sanitize opts
    if (!empty($opts)) {
      if (!empty($opts['dis_cont'])) $display_container = sanitize_text_field($opts['dis_cont']);
      if (!empty($opts['title'])) $container_title = sanitize_text_field($opts['title']);
      else $container_title = 'Get new posts by email!';
      if (!empty($opts['submit'])) $submit_text = sanitize_text_field($opts['submit']);
      else $submit_text = 'Subscribe me!';
      if (!empty($opts['placeholder'])) $placeholder_email = sanitize_text_field($opts['placeholder']);
      else $placeholder_email = 'Enter your email';
      if (!empty($opts['provider'])) $provider = sanitize_text_field($opts['provider']);
      $wc = 'true';
    }

    // If user wish to use it as pseudo widget
    $widgeted = (($wc === 'true')?'widgeted ':'');

    // Prepare HTML
    $html = '';

    // If it's widget add additional class
    if ($isw == true) $isw = ' _tsw ';
    else $isw = '';

    // If $opts are empty use container
    if (empty($opts) && $display_container === 'true') {
      $html .= '<div id="theme--sub-form-sc" class="' . substr($widgeted, 0, -3) . 'theme_subscribe_widget-sc">';
      $html .= '  <h1 class="widget-title">' . $container_title . '</h1>';
    }

    // Print content of the widget (form)
    $html .= '<form action="' . $provider . '" target="_blank" method="post" class="theme_subscription_form_' . $isw . '">';
    $html .= '  <div class="' . $widgeted . $isw . 'sub-form">';
    $html .= '    <input class="' . $widgeted . $isw . 'form-control subscribe-input" type="email" name="email" placeholder="' . $placeholder_email . '" required>';
    $html .= '    <span class="theme_color_wrapper">';
    $html .= '      <input class="' . $widgeted . $isw . 'btn subscribe-submit" type="submit" name="subscribe" value="' . $submit_text . '" />';
    $html .= '    </span>';
    $html .= '  </div>';
    $html .= '</form>';

    // If $opts are empty close container
    if (empty($opts) && $display_container === 'true') $html .= '</div>';

    // Return structure
    return $html;

  }

}

  /**
   * Subscription Widget
   */
if (!class_exists('Theme_Subscription_Widget')) {

    /**
     * Subscription Widget - Main Class
     */
  class Theme_Subscription_Widget extends WP_Widget {

      /**
       * Constructor
       *
       * @return void
       **/
    function __construct() {

      // Get default settings
      global $theme_subscription_widget_defaults;

      // Widget Options
        $widget_ops = array(

          // Classname for those widgets
            'classname' => 'theme_subscription_form',

          // Description of this Theme Widget
            'description' => 'Adds a subscription form to your site.'

        );

      // Widget ID
        $widget_id = 'theme_subscription_form';

      // Widget Title
        $widget_title = 'Subscription Form';

      // Default settings
        $this->defaults = $theme_subscription_widget_defaults;

      // Widget Constructor
        parent::__construct($widget_id, $widget_title, $widget_ops);

    }

      /**
       * Outputs the HTML for this widget.
       *
       * @param array $args An array of standard parameters for widgets in this theme
       * @param array $instance An array of settings for this widget instance
       * @return void Echoes it's output
       **/
    function widget($args, $instance) {
      extract($args, EXTR_SKIP);
      echo $before_widget;
      echo $before_title;
      echo ((!empty($instance['title']))?sanitize_text_field($instance['title']):'Get new posts by email!');
      echo $after_title;

      echo theme_subscription_widget_content($instance, false, true);

      echo $after_widget;
    }

      /**
       * Deals with the settings when they are saved by the admin. Here is
       * where any validation should be dealt with.
       *
       * @param array $new_instance An array of new settings as submitted by the admin
       * @param array $old_instance An array of the previous settings
       * @return array The validated and (if necessary) amended settings
       **/
    function update($new_instance, $old_instance) {
      // update logic goes here
      $updated_instance = $new_instance;
      return $updated_instance;
    }

      /**
       * Displays the form for this widget on the Widgets page of the WP Admin area.
       *
       * @param array $instance An array of the current settings for this widget
       * @return void Echoes it's output
       **/
    function form($instance) {

      // Final instance
      $defaults = array(
        'title' => 'Get new posts by email!',
        'placeholder' => 'Enter your email',
        'submit' => 'Subscribe me!'
      );
      $instance = wp_parse_args($instance, $defaults);

      // Current theme
      $theme = wp_get_theme();

      ?>
      <p>
        <?php $in = 'title'; $tid = $this->get_field_id($in); $tfn = $this->get_field_name($in); $tv = esc_attr($instance[$in]); ?>
        <label for="<?php echo $tid ?>"><?php echo 'Widget title:'; ?></label>
        <input id="<?php echo $tid ?>" name="<?php echo $tfn ?>" type="text" placeholder="<?php echo $defaults[$in]; ?>" value="<?php echo $tv ?>" />
      </p>
      <p>
        <?php $in = 'placeholder'; $tid = $this->get_field_id($in); $tfn = $this->get_field_name($in); $tv = esc_attr($instance[$in]); ?>
        <label for="<?php echo $tid ?>"><?php echo 'Email entry field:'; ?></label>
        <input id="<?php echo $tid ?>" name="<?php echo $tfn ?>" type="text" placeholder="<?php echo $defaults[$in]; ?>" value="<?php echo $tv ?>" />
      </p>
      <p>
        <?php $in = 'submit'; $tid = $this->get_field_id($in); $tfn = $this->get_field_name($in); $tv = esc_attr($instance[$in]); ?>
        <label for="<?php echo $tid ?>"><?php echo 'Submit button:'; ?></label>
        <input id="<?php echo $tid ?>" name="<?php echo $tfn ?>" type="text" placeholder="<?php echo $defaults[$in]; ?>" value="<?php echo $tv ?>" />
      </p>
      <p>
        <?php if (is_customize_preview()) { ?>
        <?php echo 'You can also place the subscription form via'; ?> <a href="#" class="theme_sub_goToS_s"><?php echo 'HTML code'; ?></a>.
        <?php } else {
        $url = get_site_url(null, '/wp-admin/customize.php?autofocus[section]=theme_subscription_form_settings');
        ?>
        <?php echo 'You can also place the subscription form via';?> <a href="<?php echo $url ?>" target="_blank"><?php echo 'HTML code'; ?></a>.
        <?php } ?>
      </p>
      <p>
        <span class="tsf-lowf"><?php echo 'By default the email provider is'; ?> <a href="https://follow.it/intro" target="_blank">follow.it</a><?php echo ', sending your subscribers notifications about new posts automatically (for free). To get access to your subscribers emails, please claim your feed. Enter your website url'; ?> <a href="https://follow.it/ni/#add-feature" target="_blank"><?php echo 'here'; ?></a> <?php echo 'to get started.'; ?></span>
      </p>
      <?php
    }

  }

    /**
     * Subscribe Widget Register
     */
  add_action('widgets_init', function () {
    register_widget('Theme_Subscription_Widget');
  });

}

  /**
   * Handle for menu & styles for subscription form
   */
add_action('wp_print_scripts', function () {
  ?>
  <style type="text/css">
    #available-widgets [class*="theme_subscription_"] .widget-title::before { content: "\f466" !important; }
    .sub-form { width: 100%; text-align: center; }
    .sub-form:not(.widgeted):not(._tsw) { min-width: 200px; max-height: 350px; width: 35%; margin: 0 auto; }
    .subscribe-input:not(.widgeted):not(._tsw), .subscribe-submit:not(.widgeted):not(._tsw) { width: 95%; margin: 0 auto; }
    .subscribe-input { margin-bottom: 5px !important; }
    .subscribe-input.widgeted, .subscribe-submit.widgeted { width: 100%; }
    .subscribe-submit { margin-top: 5px; transition: .3s all; }
    .theme_sub_f-cont { padding: 5px 22px; transition: all .3s; overflow: hidden; }
    .theme_sub_f-cont p { font-size: 10px; margin: 6px 0; }
    .tsf-black { color: black; }
    .tsf-lowf { font-size: 11px; display: block; line-height: 1.2; margin-top: 10px; }
    ._tsw .subscribe-input, ._tsw .subscribe-submit { width: 100%; }
    #customize-control-theme_sub_plain_text2 { margin-left: 2px; }
  </style>
  <script type="text/javascript">
    if (typeof getContrast === 'undefined') {
      function theme_getBtnColor(delay = 10) {
        setTimeout(() => {
          let $elems = document.getElementsByClassName('theme_subscription_form_');
          for (let i = 0; i < $elems.length; ++i) {
            let $elem = $elems[i];
            let $input = $elem.querySelector('input[type="email"]');
            let $button = $elem.querySelector('input[type="submit"]');
            let $colwrap = $elem.querySelector('.theme_color_wrapper');
            let rgb = window.getComputedStyle($button, null).getPropertyValue('background-color');
                rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
                rgb = (rgb && rgb.length === 4) ? "#" +
                      ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
                      ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
                      ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';

            let iw = $input.offsetWidth, bw = $button.offsetWidth;
            if (iw != bw) {
              if (iw > bw) $input.style.width = `calc(100% - ${iw - bw}px)`;
              else $button.style.width = `calc(100% - ${bw - iw}px)`;
            }

            $button.removeEventListener('mouseover', theme_recalculateColor);
            $button.removeEventListener('mouseout', theme_recalculateColor);
            $button.addEventListener('mouseover', theme_recalculateColor);
            $button.addEventListener('mouseout', theme_recalculateColor);
            $colwrap.style.color = theme_getContrast(rgb);
          }
        }, delay);
      };
      function theme_recalculateColor() {
        theme_getBtnColor(310);
        theme_getBtnColor();
      }
      function theme_getContrast(hexcolor) {
        if (hexcolor.slice(0, 1) === '#') hexcolor = hexcolor.slice(1);
        if (hexcolor.length === 3)  hexcolor = hexcolor.split('').map(function (hex) { return hex + hex; }).join('');

        let r = parseInt(hexcolor.substr(0,2),16),
            g = parseInt(hexcolor.substr(2,2),16),
            b = parseInt(hexcolor.substr(4,2),16);

        let yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
        return (yiq >= 128) ? 'rgba(0, 0, 0, 0.8)' : 'rgba(255, 255, 255, 0.8)';
      }
      theme_getBtnColor();
    }
  </script>
  <?php
  if (is_admin() && is_customize_preview()) {
  ?>
  <style media="screen">
    #theme_html_sub_section .customize-control-notifications-container {
      margin: 1px 0 4px 0 !important;
    }
    #theme_html_sub_section .customize-control-title {
      margin-bottom: 0 !important;
    }
    .tms_b {
      background: rgb(23, 55, 94);
      margin: 0 auto;
      padding: 7px 10px;;
      border: 0;
      border-radius: 0;
      width: 130px;
      font-size: 12px;
      color: white;
      margin-bottom: 10px;
      cursor: pointer;
    }
    .tms_b:hover {
      background: rgb(15, 46, 85);
    }
    .tms_b:active {
      background: rgb(10, 40, 80);
    }
    .tms_b:disabled {
      transition: .3s all;
      background: rgb(10, 40, 80);
      pointer-events: none;
      opacity: .8;
    }
    #theme_html_sub_section {
      overflow: hidden;
      max-height: 0px;
      opacity: 0;
      display: none;
    }
    #theme_chtml_ro {
      width: 100%;
      margin-top: 5px;
    }
  </style>
  <script type="text/javascript">
    if (typeof thzms_initiated === 'undefined') {
      var thzms_initiated = true;
      document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (e) {
          if (e.target && e.target.className.includes('theme_sub_goToW_s')) goToWidgets(e);
          if (e.target && e.target.className.includes('theme_sub_goToS_s')) goToSubFormMenu(e);
          if (e.target && e.target.className.includes('theme_open_cHTML')) showHTMLCopy(e);
          if (e.target && e.target.className.includes('theme_copy_cHTML')) copyHTML(e);
        });
        document.addEventListener('keyup', function (e) {
          if (['__theme_csb', '__theme_cph'].includes(e.target.id)) refreshTextToCopy();
        });

        function showHTMLCopy(e) {
          e.preventDefault();
          refreshTextToCopy();
          e.target.disabled = true;
          let $section = document.getElementById('theme_html_sub_section');
          $section.style.display = 'block';
          $section.style.maxHeight = '10000px';
          let height = $section.offsetHeight;
          $section.style.maxHeight = '0px';
          setTimeout(() => {
            $section.style.transition = '.3s all';
            $section.style.maxHeight = `${height}px`;
            $section.style.opacity = 1;
          }, 10);

          setTimeout(() => {
            $section.style.maxHeight = '100000px';
          }, 320);
        }

        function copyHTML(e) {
          if (e.target.innerText == 'Copied!') return;

          let origSelectionStart, origSelectionEnd;
          let target = document.getElementById('theme_chtml_ro');
          let currentFocus = document.activeElement;

          target.textContent = text;

          target.focus();
          target.setSelectionRange(0, target.value.length);

          let succeed;
          try { succeed = document.execCommand('copy'); }
          catch (e) { succeed = false; }

          if (currentFocus && typeof currentFocus.focus === 'function')
            currentFocus.focus();

          target.textContent = '';

          if (succeed) e.target.innerText = 'Copied!';
          else e.target.innerText = 'Copy falied :(';

          setTimeout(() => { e.target.innerText = 'Copy'; }, 1000);
          return succeed;
        }

        function e_(text) {
          text = `${text}`;
          return text
               .replace(/&/g, "&amp;")
               .replace(/</g, "&lt;")
               .replace(/>/g, "&gt;")
               .replace(/"/g, "&quot;")
               .replace(/'/g, "&#039;");
        }

        function refreshTextToCopy() {
          let $html = document.getElementById('theme_dummy_chtml').value.replace(/\s+/g, ' ').replace(/\>\ \</g, '><');
          $html = $html.replace('__SUBMIT__', e_(document.getElementById('__theme_csb').value));
          $html = $html.replace('__PLACEHOLDER__', e_(document.getElementById('__theme_cph').value));
          document.getElementById('theme_chtml_ro').value = $html;
        }

        function goToWidgets(e) {
          wp.customize.panel('widgets').expand();
          let $accrd = document.getElementById('sub-accordion-panel-widgets');
          let $lists = $accrd.querySelectorAll('.accordion-section.control-section');

          let isListed = false, is = 0;
          for (let i = 0; i < $lists.length; i++, is++) {
            let $list = $lists[i];
            if ($list.style.display != 'none') {
              isListed = $list.id;
              break;
            }
          }

          if (isListed != false) {
            if ($lists.length == 1) document.querySelectorAll('#accordion-panel-widgets')[0].querySelector('h3').click();
            if ($lists.length > 1) document.getElementById(isListed).querySelector('h3').click();
            document.querySelectorAll('.add-new-widget')[is].click();
            document.querySelectorAll('#widgets-search')[0].value = 'Subscription form';

            let $wdgs = document.querySelectorAll('.widget-tpl');
            for (let i = 0; i < $wdgs.length; i++) {
              let $wdg = $wdgs[i];
              if (!$wdg.className.includes('theme_subscription_form-'))
              $wdg.style.display = 'none';
            }
          }
        }
        function goToSubFormMenu(e) {
          e.preventDefault();
          wp.customize.section('theme_subscription_form_settings').expand();
        }
      });
    }
  </script>
  <?php }
});

  /**
   * Subscription form menu in Custimizer
   */
add_action('customize_register', function ($wp_customize) {

  // Current theme
  $theme = wp_get_theme();

  // Default options
  global $theme_subscription_widget_defaults;
  $defaults = $theme_subscription_widget_defaults;

  // Section name
  $section = 'theme_subscription_form_settings';

  // Custom HTML control
  class Theme_HTML_Control_No_Vars extends WP_Customize_Control {

    // Type name
    public $type = 'plain_text';

    /**
    * Render the control's content.
    */
    public function render_content() {
      echo $this->description;
    }

  }

  // Adding new section
  $wp_customize->add_section($section, array(
    'title' => 'Subscription form',
    'description' => 'Place a subscription form to update people automatically about new posts - increasing your traffic significantly!'
  ));

  // Buttons
  $via_widget = '<div><button type="button" class="tms_b theme_sub_goToW_s">' . 'Via Widget' . ' &gt;</button></div>';
  $via_html = '<div><button type="button" class="tms_b theme_open_cHTML">&nbsp;' . 'Via HTML code' . ' &gt;</button></div>';

  // Provider information
  $provider_info = '<span class="tsf-lowf">' . __('By default the email provider is', TH_TEXT_DOMAIN) . ' <a href="https://follow.it/intro" target="_blank">follow.it</a>' . __(', sending your subscribers notifications about new posts automatically (for free). To get access to your subscribers emails, please claim your feed. Enter your website url', TH_TEXT_DOMAIN) . ' <a href="https://follow.it/ni/#add-feature" target="_blank">' . __('here', TH_TEXT_DOMAIN) . '</a> ' . __('to get started.', TH_TEXT_DOMAIN) . '</span>';

  // HTML Section start
  $html_section = '<section id="theme_html_sub_section">';

  // Email text (placeholder)
  $html_section .= '<label class="customize-control-title">' . 'Email entry field' . '</label>';
  $html_section .= '<input id="__theme_cph" type="text" placeholder="' . $defaults['placeholder'] . '" value="' . $defaults['placeholder'] . '"><br><br>';

  // Button text (placeholder)
  $html_section .= '<label class="customize-control-title">' . 'Submit button' . '</label>';
  $html_section .= '<input id="__theme_csb" type="text" placeholder="' . $defaults['submit'] . '" value="' . $defaults['submit'] . '"><br><br>';

  // Copy and textarea header
  $html_section .= '<div>';
  $html_section .= '<label style="float: left;" class="customize-control-title">' . 'HTML Code' . '</label>';
  $html_section .= '<a style="float: right;font-size: 14px;font-weight: 500;line-height: 1.75;text-decoration:none;box-shadow:none!important;" href="#" class="theme_copy_cHTML">' . 'Copy' . '</a>';
  $html_section .= '</div>';

  // Textarea and section close
  $html_section .= '<div style="clear:both;"></div>';
  $html_section .= '<textarea id="theme_chtml_ro" readonly>(code)</textarea>';
  $html_section .= '<textarea id="theme_dummy_chtml" style="visibility: hidden; display: none;" hidden readonly>' . esc_html(theme_subscription_widget_content(array('submit' => '__SUBMIT__', 'placeholder' => '__PLACEHOLDER__'))) . '</textarea>';
  $html_section .= $provider_info;
  $html_section .= '</section>';

  // Main customizer display
  $wp_customize->add_setting('theme_sub_form_customizer_main', array('transport' => 'postMessage', 'sanitize_callback' => 'sanitize_text_field'));
  $wp_customize->add_control(new Theme_HTML_Control_No_Vars($wp_customize, 'theme_sub_form_customizer_main', array(
    'section' => $section,
    'description' => '<label class="customize-control-title" style="margin-bottom: 18px;">' . 'How do you want to place the form?' . '</label>'
    . '<div style="text-align: center;">' . $via_widget . $via_html . '</div><br>' . $html_section
  )));

});
