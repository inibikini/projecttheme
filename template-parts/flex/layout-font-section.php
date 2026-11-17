<?php
$font_name = get_sub_field('font_name');
$description = get_sub_field('description');
$font_family = get_sub_field('font_family') ?: 'general-sans';
$font_category = get_sub_field('font_category');
$background_image = get_sub_field('background_image');
$explore_link = get_sub_field('explore_font');
$download_link = get_sub_field('download_font');
$sample_text = apply_filters('projecttheme_font_sample_text', '');

$font_classes = [
  'general-sans' => 'font-card--general-sans',
  'moonhouse' => 'font-card--moonhouse',
  'foglihten-no04' => 'font-card--foglihten-no04',
  'tanker' => 'font-card--tanker',
];
$category_defaults = [
  'moonhouse' => 'display',
  'foglihten-no04' => 'serif',
  'tanker' => 'sans-serif',
];
$font_class = isset($font_classes[$font_family]) ? $font_classes[$font_family] : $font_classes['general-sans'];
$font_category = $font_category ?: ($category_defaults[$font_family] ?? '');
$explore_url = is_array($explore_link) ? ($explore_link['url'] ?? '') : (is_string($explore_link) ? $explore_link : '');
$explore_title = is_array($explore_link) ? ($explore_link['title'] ?? '') : '';
$explore_target = is_array($explore_link) && !empty($explore_link['target']) ? $explore_link['target'] : '_self';
$download_url = is_array($download_link) ? ($download_link['url'] ?? '') : (is_string($download_link) ? $download_link : '');
$download_title = is_array($download_link) ? ($download_link['title'] ?? '') : '';
$download_target = is_array($download_link) && !empty($download_link['target']) ? $download_link['target'] : '_self';
?>
<article class="font-card <?php echo esc_attr($font_class); ?>"<?php if ($font_category) : ?> data-font-category="<?php echo esc_attr($font_category); ?>"<?php endif; ?>>
  <?php if ($background_image) : ?>
    <?php echo wp_get_attachment_image($background_image, 'large', false, ['class' => 'font-card__background', 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async']); ?>
  <?php endif; ?>
  <div class="font-card__content">
    <?php if ($font_name) : ?>
      <h2 class="font-card__name" data-font-sample data-original-text="<?php echo esc_attr($font_name); ?>">
        <?php echo esc_html($sample_text !== '' ? $sample_text : $font_name); ?>
      </h2>
    <?php endif; ?>

    <?php if ($description) : ?>
      <p class="font-card__description"><?php echo esc_html($description); ?></p>
    <?php endif; ?>

    <?php if ($explore_url || $download_url) : ?>
      <div class="font-card__actions">
        <?php if ($explore_url) : ?>
          <a class="font-card__button font-card__button--primary" href="<?php echo esc_url($explore_url); ?>" target="<?php echo esc_attr($explore_target); ?>"<?php if ($explore_target === '_blank') : ?> rel="noopener noreferrer"<?php endif; ?>>
            <?php echo esc_html($explore_title ?: __('Explore Font', 'projecttheme')); ?>
          </a>
        <?php endif; ?>
        <?php if ($download_url) : ?>
          <a class="font-card__button font-card__button--secondary" href="<?php echo esc_url($download_url); ?>" target="<?php echo esc_attr($download_target); ?>"<?php if ($download_target === '_blank') : ?> rel="noopener noreferrer"<?php endif; ?>>
            <?php echo esc_html($download_title ?: __('Download Font', 'projecttheme')); ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</article>
