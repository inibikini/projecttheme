<?php
/**
 * Font Section
 * Felder: Font Name, Description, Explore Font (URL), Download Font (URL)
 */


$font_name = get_sub_field('font_name');
$description   = get_sub_field('description');
$explore_font = get_sub_field('explore_font');
$download_font    = get_sub_field('download_font');
?>
<div class="row align-items-center g-5">
  <div class="col-md-6">
    <?php if ($font_name): ?><h1 class="display-5 fw-bold"><?php echo esc_html($font_name); ?></h1><?php endif; ?>
    <?php if ($description): ?><h2 class="mb-3"><?php echo esc_html($description); ?></h2><?php endif; ?>
    <?php if ($explore_font): ?><a href="<?php echo esc_url($explore_font); ?>" class="btn btn-primary" target="_blank">Explore Font</a><?php endif; ?>
    <?php if ($download_font): ?><a href="<?php echo esc_url($download_font); ?>" class="btn btn-primary" target="_blank">Download Font</a><?php endif; ?>
  </div>
</div>
