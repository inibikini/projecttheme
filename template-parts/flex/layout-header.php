<?php
$greeting = get_sub_field('greeting');
$title = get_sub_field('title');
$text = get_sub_field('text');
$background_video = get_sub_field('background_video');
$background_video_url = is_array($background_video) && !empty($background_video['url']) ? $background_video['url'] : '';
$background_video_type = is_array($background_video) && !empty($background_video['mime_type']) ? $background_video['mime_type'] : '';
$cta = get_sub_field('cta');

$cta_url = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '';
$cta_title = is_array($cta) && !empty($cta['title']) ? $cta['title'] : '';
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>
<div class="page-header">
  <?php if ($background_video_url) : ?>
    <video class="page-header__video" autoplay muted loop playsinline preload="metadata" aria-hidden="true" tabindex="-1">
      <source src="<?php echo esc_url($background_video_url); ?>"<?php if ($background_video_type) : ?> type="<?php echo esc_attr($background_video_type); ?>"<?php endif; ?>>
    </video>
  <?php endif; ?>
  <div class="page-header__content">
    <?php if ($greeting) : ?>
      <p class="page-header__greeting"><?php echo esc_html($greeting); ?></p>
    <?php endif; ?>

    <?php if ($title) : ?>
      <h1 class="page-header__title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <?php if ($text) : ?>
      <div class="page-header__text"><?php echo wp_kses_post($text); ?></div>
    <?php endif; ?>

    <?php if ($cta_url) : ?>
      <a class="page-header__cta" href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>" rel="<?php echo esc_attr($cta_rel); ?>">
        <?php echo esc_html($cta_title ?: __('Get Started', 'projecttheme')); ?>
      </a>
    <?php endif; ?>
  </div>
</div>
