<?php
$title = get_sub_field('title') ?: __('Find Your Match!', 'projecttheme');
$description = get_sub_field('description');
?>
<?php if ($title || $description) : ?>
  <div class="fym-heading">
    <?php if ($title) : ?>
      <h1 class="fym-heading__title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>
    <?php if ($description) : ?>
      <div class="fym-heading__description">
        <?php echo wp_kses_post($description); ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
