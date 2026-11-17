<?php
$placeholder = get_sub_field('placeholder') ?: __('Enter your own text ...', 'projecttheme');
$default_text = get_sub_field('default_text');
$input_id = function_exists('wp_unique_id') ? wp_unique_id('font-sample-') : 'font-sample';
?>
<div class="enter-text" data-default-text="<?php echo esc_attr($default_text); ?>">
  <div class="enter-text__inner">
    <input
      class="enter-text__input"
      id="<?php echo esc_attr($input_id); ?>"
      type="text"
      value="<?php echo esc_attr($default_text); ?>"
      placeholder="<?php echo esc_attr($placeholder); ?>"
      autocomplete="off"
      aria-label="<?php echo esc_attr($placeholder); ?>"
      data-font-sample-input
    >
  </div>
</div>
