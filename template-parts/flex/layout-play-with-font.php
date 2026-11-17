<?php
$sample_text = get_sub_field('sample_text') ?: 'moonhouse';
$font_family = get_sub_field('font_family') ?: 'moonhouse';
$font_families = ['moonhouse', 'foglihten-no04', 'tanker'];

if (!in_array($font_family, $font_families, true)) {
  $font_family = 'moonhouse';
}

$control_labels = [
  'spacing' => get_sub_field('spacing_label') ?: __('increase letter spacing', 'projecttheme'),
  'size' => get_sub_field('size_label') ?: __('make bigger', 'projecttheme'),
  'look' => get_sub_field('look_label') ?: __('change look', 'projecttheme'),
];
?>
<div class="play-with-font" data-play-with-font>
  <div class="play-with-font__preview">
    <h2
      class="play-with-font__sample font-card--<?php echo esc_attr($font_family); ?>"
      data-play-with-font-sample
      data-original-text="<?php echo esc_attr($sample_text); ?>"
    ><?php echo esc_html($sample_text); ?></h2>
    <div class="play-with-font__controls" role="group" aria-label="<?php esc_attr_e('Font preview controls', 'projecttheme'); ?>">
      <?php foreach ($control_labels as $control => $label) : ?>
        <button class="play-with-font__control" type="button" data-play-with-font-control="<?php echo esc_attr($control); ?>" aria-pressed="false">
          <span class="play-with-font__indicator" aria-hidden="true"></span>
          <span><?php echo esc_html($label); ?></span>
        </button>
      <?php endforeach; ?>
    </div>
  </div>
</div>
