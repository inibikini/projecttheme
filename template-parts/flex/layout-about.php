<?php
/**
 * Partial: About
 * ACF-Felder: title (text), description (wysiwyg)
 */

$title = get_sub_field('title');
$description = get_sub_field('description');

$title = $title ?: __("About", 'projecttheme');
?>
<div class="about-module">
  <h2 class="about-module__title"><?php echo esc_html($title); ?></h2>

  <?php if ($description): ?>
    <div class="about-module__description rte">
      <?php echo wp_kses_post($description); ?>
    </div>
  <?php endif; ?>
</div>
