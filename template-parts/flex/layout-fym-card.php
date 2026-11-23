<?php
$cards = get_sub_field('cards');

if (!is_array($cards) || !$cards) {
  $legacy_font_name = get_sub_field('font_name') ?: '';
  $legacy_font_family = get_sub_field('font_family') ?: '';
  $legacy_numbers = get_sub_field('sample_numbers') ?: '';
  $legacy_letters = get_sub_field('sample_letters') ?: '';
  $legacy_image = get_sub_field('background_image');

  $has_custom_legacy_card = $legacy_font_name && (
    $legacy_font_name !== 'Moonhouse'
    || $legacy_font_family !== 'moonhouse'
    || $legacy_numbers !== '123'
    || $legacy_letters !== 'abc'
    || $legacy_image
  );

  $cards = [
    ['font_name' => 'Alex Brush', 'font_family' => 'alex-brush', 'sample_numbers' => '123', 'sample_letters' => 'abc', 'homepage' => 'https://www.1001fonts.com/alex-brush-font.html'],
    ['font_name' => 'Chillax', 'font_family' => 'chillax', 'sample_numbers' => '123', 'sample_letters' => 'abc', 'homepage' => 'https://www.fontshare.com/fonts/chillax'],
    ['font_name' => 'Gluten', 'font_family' => 'gluten', 'sample_numbers' => '123', 'sample_letters' => 'abc', 'homepage' => 'https://fonts.google.com/specimen/Gluten'],
    ['font_name' => 'Departure Mono', 'font_family' => 'departure-mono', 'sample_numbers' => '123', 'sample_letters' => 'abc', 'homepage' => 'https://departuremono.com/'],
    ['font_name' => 'FoglihtenNo04', 'font_family' => 'foglihten-no04', 'sample_numbers' => '123', 'sample_letters' => 'abc', 'homepage' => 'https://www.fontspace.com/foglihtenno04-font-f13878'],
    ['font_name' => 'TANKER', 'font_family' => 'tanker', 'sample_numbers' => '123', 'sample_letters' => 'ABC', 'homepage' => 'https://www.fontshare.com/fonts/tanker'],
    ['font_name' => 'Josefin Slab', 'font_family' => 'josefin-slab', 'sample_numbers' => '123', 'sample_letters' => 'abc', 'homepage' => 'https://www.1001fonts.com/josefin-slab-font.html'],
    ['font_name' => 'Bullpen', 'font_family' => 'bullpen', 'sample_numbers' => '123', 'sample_letters' => 'abc', 'homepage' => 'https://befonts.com/bullpen-font.html'],
  ];

  if ($has_custom_legacy_card) {
    $cards[0] = [
      'font_name' => $legacy_font_name,
      'font_family' => $legacy_font_family,
      'sample_numbers' => $legacy_numbers,
      'sample_letters' => $legacy_letters,
      'background_image' => $legacy_image,
    ];
  }
}

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
$rendered_cards = [];

foreach ($cards as $card) {
  if (!is_array($card)) {
    continue;
  }

  $font_name = isset($card['font_name']) ? trim($card['font_name']) : '';
  $font_family = isset($card['font_family']) ? sanitize_title($card['font_family']) : '';
  if (!$font_name) {
    continue;
  }

  if (!in_array($font_family, $font_families, true)) {
    $font_family = 'general-sans';
  }

  $rendered_cards[] = [
    'font_name' => $font_name,
    'font_family' => $font_family,
    'sample_numbers' => isset($card['sample_numbers']) ? $card['sample_numbers'] : '',
    'sample_letters' => isset($card['sample_letters']) ? $card['sample_letters'] : '',
    'homepage' => isset($card['homepage']) ? $card['homepage'] : '',
    'background_image' => isset($card['background_image']) ? $card['background_image'] : '',
  ];
}
?>
<div
  class="fym-card-module"
  data-fym-deck
  data-fym-completion-message="<?php echo esc_attr__('You have seen all the fonts.', 'projecttheme'); ?>"
>
  <div class="fym-card-stack">
    <?php foreach ($rendered_cards as $index => $card) : ?>
      <article
        class="fym-card"
        data-fym-card
        data-font-family="<?php echo esc_attr($card['font_family']); ?>"
        data-font-homepage="<?php echo esc_url($card['homepage']); ?>"
        <?php if ($index > 0) : ?>hidden<?php endif; ?>
      >
        <?php if ($card['background_image']) : ?>
          <?php echo wp_get_attachment_image($card['background_image'], 'large', false, ['class' => 'fym-card__background', 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async']); ?>
        <?php endif; ?>
        <div class="fym-card__content">
          <h2 class="fym-card__font-name"><?php echo esc_html($card['font_name']); ?></h2>
          <?php if ($card['sample_numbers'] !== '') : ?>
            <p class="fym-card__sample"><?php echo esc_html($card['sample_numbers']); ?></p>
          <?php endif; ?>
          <?php if ($card['sample_letters'] !== '') : ?>
            <p class="fym-card__sample"><?php echo esc_html($card['sample_letters']); ?></p>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

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
  <p class="fym-card-status" role="status" aria-live="polite"></p>
  <div class="fym-card-complete" data-fym-complete hidden>
    <button class="fym-card-restart" type="button" data-fym-restart><?php esc_html_e('Start again', 'projecttheme'); ?></button>
  </div>
</div>
