<?php
$categories = get_sub_field('filter_categories') ?: [
  ['label' => 'Cursive', 'value' => 'cursive'],
  ['label' => 'Display', 'value' => 'display'],
  ['label' => 'Monospace', 'value' => 'monospace'],
  ['label' => 'Sans Serif', 'value' => 'sans-serif'],
  ['label' => 'Serif', 'value' => 'serif'],
  ['label' => 'Slab', 'value' => 'slab'],
];
$default_mode = get_sub_field('default_mode') ?: 'dark';
$filter_id = function_exists('wp_unique_id') ? wp_unique_id('font-filter-') : 'font-filter';
?>
<section class="filter-section" data-default-mode="<?php echo esc_attr($default_mode); ?>" aria-label="<?php esc_attr_e('Font filters', 'projecttheme'); ?>">
  <div class="filter-section__inner">
    <div class="filter-section__categories" role="group" aria-label="<?php esc_attr_e('Filter fonts by category', 'projecttheme'); ?>">
      <?php foreach ($categories as $category) :
        $label = isset($category['label']) ? trim($category['label']) : '';
        $value = isset($category['value']) ? sanitize_title($category['value']) : '';
        if (!$label || !$value) {
          continue;
        }
      ?>
        <button class="filter-section__category" type="button" data-filter-value="<?php echo esc_attr($value); ?>" aria-pressed="false">
          <?php echo esc_html($label); ?>
        </button>
      <?php endforeach; ?>
    </div>

    <label class="filter-section__mode" for="<?php echo esc_attr($filter_id); ?>">
      <span><?php esc_html_e('Dark Mode', 'projecttheme'); ?></span>
      <input class="filter-section__mode-input" id="<?php echo esc_attr($filter_id); ?>" type="checkbox" role="switch" aria-label="<?php esc_attr_e('Use light mode', 'projecttheme'); ?>">
      <span class="filter-section__mode-track" aria-hidden="true"></span>
      <span><?php esc_html_e('Light Mode', 'projecttheme'); ?></span>
    </label>
  </div>
</section>
