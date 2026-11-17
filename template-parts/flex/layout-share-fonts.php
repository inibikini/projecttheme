<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$prompt = get_sub_field('prompt');
$cta = get_sub_field('cta');

$cta_url = is_array($cta) && !empty($cta['url']) ? $cta['url'] : home_url('/share-fonts/');
$cta_title = is_array($cta) && !empty($cta['title']) ? $cta['title'] : __('Share Fonts', 'projecttheme');
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
?>
<div class="share-fonts">
  <div class="share-fonts__copy">
    <?php if ($title) : ?>
      <h2 class="share-fonts__title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($description) : ?>
      <div class="share-fonts__description">
        <?php echo wp_kses_post(wpautop($description)); ?>
      </div>
    <?php endif; ?>

    <?php if ($prompt) : ?>
      <p class="share-fonts__prompt"><?php echo esc_html($prompt); ?></p>
    <?php endif; ?>
  </div>

  <?php if ($cta_url) : ?>
    <a class="share-fonts__button" href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>"<?php if ($cta_target === '_blank') : ?> rel="noopener noreferrer"<?php endif; ?>>
      <?php echo esc_html($cta_title); ?>
    </a>
  <?php endif; ?>
</div>
