<?php
$font_name = get_sub_field('font_name') ?: __('Moonhouse', 'projecttheme');
$font_family = get_sub_field('font_family') ?: 'moonhouse';
$sample_numbers = get_sub_field('sample_numbers') ?: '123';
$sample_letters = get_sub_field('sample_letters') ?: 'abc';
$background_image = get_sub_field('background_image');
$font_families = [
  'general-sans',
  'moonhouse',
  'foglihten-no04',
  'tanker',
  'josefin-slab',
  'departure-mono',
  'alex-brush',
  'gluten',
  'chillax',
  'bullpen',
];

if (!in_array($font_family, $font_families, true)) {
  $font_family = 'moonhouse';
}
?>
<div class="fym-card-module">
  <article class="fym-card" data-font-family="<?php echo esc_attr($font_family); ?>">
    <?php if ($background_image) : ?>
      <?php echo wp_get_attachment_image($background_image, 'large', false, ['class' => 'fym-card__background', 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async']); ?>
    <?php endif; ?>
    <div class="fym-card__content">
      <h2 class="fym-card__font-name"><?php echo esc_html($font_name); ?></h2>
      <?php if ($sample_numbers) : ?>
        <p class="fym-card__sample"><?php echo esc_html($sample_numbers); ?></p>
      <?php endif; ?>
      <?php if ($sample_letters) : ?>
        <p class="fym-card__sample"><?php echo esc_html($sample_letters); ?></p>
      <?php endif; ?>
    </div>
  </article>
  <div class="fym-card-actions" role="group" aria-label="<?php echo esc_attr__('Choose whether you like this font', 'projecttheme'); ?>">
    <button class="fym-card-actions__button fym-card-actions__button--reject" type="button" aria-label="<?php echo esc_attr__('Skip this font', 'projecttheme'); ?>" data-fym-action="reject">
      <svg viewBox="0 0 48 48" aria-hidden="true" focusable="false">
        <path d="M13 13L35 35M35 13L13 35" />
      </svg>
    </button>
    <button class="fym-card-actions__button fym-card-actions__button--like" type="button" aria-label="<?php echo esc_attr__('Like this font', 'projecttheme'); ?>" data-fym-action="like">
      <svg viewBox="0 0 48 48" aria-hidden="true" focusable="false">
        <path d="M24 41S5 29 5 16.5C5 9.5 13.5 5.5 20 12l4 4 4-4c6.5-6.5 15-2.5 15 4.5C43 29 24 41 24 41Z" />
      </svg>
    </button>
  </div>
</div>
