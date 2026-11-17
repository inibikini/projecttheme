<?php
$title = get_sub_field('title') ?: __('Share Fonts', 'projecttheme');
$required_note = get_sub_field('required_note') ?: __('You need to fill out all of the form fields marked with a star (*) to send your message.', 'projecttheme');
$submit_label = get_sub_field('submit_label') ?: __('Send', 'projecttheme');
$success_message = get_sub_field('success_message') ?: __('Thank you for sharing your font suggestion!', 'projecttheme');
$error_message = get_sub_field('error_message') ?: __('Your message could not be sent. Please check the required fields and try again.', 'projecttheme');
$status = isset($_GET['share_fonts_status']) && is_string($_GET['share_fonts_status'])
  ? sanitize_key(wp_unslash($_GET['share_fonts_status']))
  : '';
$input_id = function_exists('wp_unique_id') ? wp_unique_id('share-fonts-') : 'share-fonts-';
?>
<form class="share-fonts-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
  <input type="hidden" name="action" value="projecttheme_share_fonts_submission">
  <?php wp_nonce_field('projecttheme_share_fonts_submission'); ?>

  <div class="share-fonts-form__panel">
    <?php if ($title) : ?>
      <h1 class="share-fonts-form__title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <div class="share-fonts-form__fields">
      <div class="share-fonts-form__field">
        <label for="<?php echo esc_attr($input_id); ?>name"><?php esc_html_e('Name', 'projecttheme'); ?><span aria-hidden="true">*</span></label>
        <input id="<?php echo esc_attr($input_id); ?>name" name="name" type="text" placeholder="<?php esc_attr_e('Enter text ...', 'projecttheme'); ?>" autocomplete="given-name" required>
      </div>

      <div class="share-fonts-form__field">
        <label for="<?php echo esc_attr($input_id); ?>surname"><?php esc_html_e('Surname', 'projecttheme'); ?></label>
        <input id="<?php echo esc_attr($input_id); ?>surname" name="surname" type="text" placeholder="<?php esc_attr_e('Enter text ...', 'projecttheme'); ?>" autocomplete="family-name">
      </div>

      <div class="share-fonts-form__field">
        <label for="<?php echo esc_attr($input_id); ?>email"><?php esc_html_e('E-Mail', 'projecttheme'); ?><span aria-hidden="true">*</span></label>
        <input id="<?php echo esc_attr($input_id); ?>email" name="email" type="email" placeholder="<?php esc_attr_e('Enter text ...', 'projecttheme'); ?>" autocomplete="email" required>
      </div>

      <div class="share-fonts-form__field">
        <label for="<?php echo esc_attr($input_id); ?>phone"><?php esc_html_e('Phone Number', 'projecttheme'); ?></label>
        <input id="<?php echo esc_attr($input_id); ?>phone" name="phone" type="tel" placeholder="<?php esc_attr_e('Enter text ...', 'projecttheme'); ?>" autocomplete="tel">
      </div>

      <div class="share-fonts-form__field share-fonts-form__field--message">
        <label for="<?php echo esc_attr($input_id); ?>message"><?php esc_html_e('Message', 'projecttheme'); ?><span aria-hidden="true">*</span></label>
        <textarea id="<?php echo esc_attr($input_id); ?>message" name="message" placeholder="<?php esc_attr_e('Enter text ...', 'projecttheme'); ?>" rows="2" required></textarea>
      </div>
    </div>
  </div>

  <div class="share-fonts-form__submit-panel">
    <p class="share-fonts-form__notice">
      <?php echo esc_html($required_note); ?>
      <?php if ($status === 'success') : ?>
        <span class="share-fonts-form__feedback" role="status"><?php echo esc_html($success_message); ?></span>
      <?php elseif ($status === 'invalid' || $status === 'error') : ?>
        <span class="share-fonts-form__feedback" role="alert"><?php echo esc_html($error_message); ?></span>
      <?php endif; ?>
    </p>
    <button class="share-fonts-form__button" type="submit">
      <?php echo esc_html($submit_label); ?>
    </button>
  </div>
</form>
