<?php
$fonts = get_sub_field('fonts');

if (!is_array($fonts) || !$fonts) {
  $fonts = [
    ['font_name' => 'Josefin Slab', 'font_family' => 'josefin-slab', 'font_category' => 'slab'],
    ['font_name' => 'Departure Mono', 'font_family' => 'departure-mono', 'font_category' => 'monospace'],
    ['font_name' => 'Alex Brush', 'font_family' => 'alex-brush', 'font_category' => 'cursive'],
    ['font_name' => 'Gluten', 'font_family' => 'gluten', 'font_category' => 'display'],
    ['font_name' => 'Chillax', 'font_family' => 'chillax', 'font_category' => 'sans-serif'],
    ['font_name' => 'Bullpen', 'font_family' => 'bullpen', 'font_category' => 'slab'],
  ];
}

$category_font_defaults = [
  'slab' => 'josefin-slab',
  'monospace' => 'departure-mono',
  'cursive' => 'alex-brush',
  'display' => 'gluten',
  'sans-serif' => 'chillax',
  'serif' => 'josefin-slab',
];
$font_families = ['josefin-slab', 'departure-mono', 'alex-brush', 'gluten', 'chillax', 'bullpen'];
?>
<div class="font-box-grid">
  <?php foreach ($fonts as $font) :
    if (!is_array($font)) {
      continue;
    }

    $font_name = isset($font['font_name']) ? trim($font['font_name']) : '';
    $font_category = isset($font['font_category']) ? sanitize_title($font['font_category']) : '';
    $font_family = isset($font['font_family']) ? sanitize_title($font['font_family']) : '';
    $website = isset($font['website']) && is_array($font['website']) ? $font['website'] : [];
    if (!in_array($font_family, $font_families, true)) {
      $font_family = $category_font_defaults[$font_category] ?? 'chillax';
    }

    if (!$font_name) {
      continue;
    }

    $website_url = !empty($website['url']) ? $website['url'] : add_query_arg('query', $font_name, 'https://fonts.google.com/');
    $website_target = !empty($website['target']) ? $website['target'] : '_self';
  ?>
    <a class="font-box" href="<?php echo esc_url($website_url); ?>" target="<?php echo esc_attr($website_target); ?>"<?php if ($website_target === '_blank') : ?> rel="noopener noreferrer"<?php endif; ?> aria-label="<?php echo esc_attr(sprintf(__('Explore the %s font website', 'projecttheme'), $font_name)); ?>" data-font-family="<?php echo esc_attr($font_family); ?>"<?php if ($font_category) : ?> data-font-category="<?php echo esc_attr($font_category); ?>"<?php endif; ?>>
      <h2 class="font-box__name">
        <?php echo esc_html($font_name); ?>
      </h2>
      <p class="font-box__sample" data-font-sample data-original-text="Aa">Aa</p>
    </a>
  <?php endforeach; ?>
</div>
