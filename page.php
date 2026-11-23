<?php
/** Template: Default Page */
get_header(); ?>

<?php
$fym_background_video_url = '';
$fym_background_video_type = '';

if (is_page('find-your-match') && function_exists('get_field')) {
  $home_page_id = (int) get_option('page_on_front');
  $home_modules = $home_page_id ? get_field('page_modules', $home_page_id) : [];

  foreach ((array) $home_modules as $module) {
    if (!is_array($module) || !isset($module['acf_fc_layout']) || $module['acf_fc_layout'] !== 'header') {
      continue;
    }

    $background_video = isset($module['background_video']) ? $module['background_video'] : null;

    if (is_array($background_video) && !empty($background_video['url'])) {
      $fym_background_video_url = $background_video['url'];
      $fym_background_video_type = !empty($background_video['mime_type']) ? $background_video['mime_type'] : '';
    } elseif (is_numeric($background_video)) {
      $fym_background_video_url = wp_get_attachment_url($background_video);
      $fym_background_video_type = get_post_mime_type($background_video);
    } elseif (is_string($background_video)) {
      $fym_background_video_url = $background_video;
    }

    if ($fym_background_video_url) {
      break;
    }
  }
}
?>

<?php if ($fym_background_video_url) : ?>
  <div class="fym-page-background" aria-hidden="true">
    <video autoplay muted loop playsinline preload="metadata" tabindex="-1">
      <source src="<?php echo esc_url($fym_background_video_url); ?>"<?php if ($fym_background_video_type) : ?> type="<?php echo esc_attr($fym_background_video_type); ?>"<?php endif; ?>>
    </video>
  </div>
<?php endif; ?>

<main id="main" class="site-main">
  <?php
  if (have_posts()) : while (have_posts()) : the_post();

    // ACF Flexible Content vorhanden?
    if (function_exists('have_rows') && have_rows('page_modules')) {
      // Rendert alle Module der Seite
      get_template_part('templates/render', 'page-modules');
    } else {
      // Fallback: klassischer Editor-Inhalt
      echo '<section class="section py-5"><div class="container-lg">';
        the_title('<h1 class="mb-4">','</h1>');
        the_content();
      echo '</div></section>';
    }

  endwhile; endif;
  ?>
</main>

<?php get_footer(); ?>