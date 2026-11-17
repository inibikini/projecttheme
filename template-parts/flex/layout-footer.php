<?php
$use_options = isset($args['source']) && $args['source'] === 'options';
$wordmark = $use_options ? get_field('footer_wordmark', 'option') : get_sub_field('wordmark');
$copyright = $use_options ? get_field('footer_copyright', 'option') : get_sub_field('copyright');
$wordmark = $wordmark ?: __("WHAT'S YOUR TYPE?", 'projecttheme');
$copyright = $copyright ?: __('© Tanja Kobler. All rights reserved.', 'projecttheme');
$footer_menu = wp_nav_menu([
  'theme_location' => 'menu-footer',
  'menu_id' => 'menu-footer',
  'menu_class' => 'footer-menu',
  'container' => false,
  'fallback_cb' => false,
  'echo' => false,
]);
?>
<div class="footer-main">
  <p class="footer-wordmark"><?php echo esc_html($wordmark); ?></p>
  <div class="footer-meta">
    <?php if ($footer_menu) : ?>
      <nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer', 'projecttheme'); ?>">
        <?php echo wp_kses_post($footer_menu); ?>
      </nav>
    <?php endif; ?>
    <p class="footer-copyright"><?php echo esc_html($copyright); ?></p>
  </div>
</div>
