<?php
$title = get_sub_field('title') ?: __('Details', 'projecttheme');
$images = get_sub_field('images');
$download_link = get_sub_field('download_font');
$download_url = is_array($download_link) ? ($download_link['url'] ?? '') : '';
$download_title = is_array($download_link) ? ($download_link['title'] ?? '') : '';
$download_target = is_array($download_link) && !empty($download_link['target']) ? $download_link['target'] : '_self';

if (!is_array($images)) {
  $images = [];
}
?>
<div class="font-details">
  <?php if ($title) : ?>
    <h2 class="font-details__title"><?php echo esc_html($title); ?></h2>
  <?php endif; ?>

  <?php if ($images) : ?>
    <div class="font-details__gallery">
      <?php foreach (array_slice($images, 0, 4) as $image) :
        $image_id = is_array($image) ? ($image['image'] ?? 0) : $image;
        $image_id = is_array($image_id) ? ($image_id['ID'] ?? 0) : $image_id;
        if (!$image_id) {
          continue;
        }
      ?>
        <figure class="font-details__item">
          <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'font-details__image', 'loading' => 'lazy', 'decoding' => 'async']); ?>
        </figure>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="font-details__actions">
    <?php if ($download_url) : ?>
      <a class="font-details__button" href="<?php echo esc_url($download_url); ?>" target="<?php echo esc_attr($download_target); ?>"<?php if ($download_target === '_blank') : ?> rel="noopener noreferrer"<?php endif; ?>>
        <?php echo esc_html($download_title ?: __('Download Font', 'projecttheme')); ?>
      </a>
    <?php else : ?>
      <span class="font-details__button font-details__button--disabled" aria-disabled="true">
        <?php esc_html_e('Download Font', 'projecttheme'); ?>
      </span>
    <?php endif; ?>
  </div>
</div>
