<?php

function projecttheme_share_fonts_redirect($status) {
  $referer = wp_get_referer();
  $fallback = home_url('/share-fonts/');
  $redirect = wp_validate_redirect($referer ?: $fallback, $fallback);
  $redirect = remove_query_arg('share_fonts_status', $redirect);

  wp_safe_redirect(add_query_arg('share_fonts_status', $status, $redirect));
  exit;
}

function projecttheme_handle_share_fonts_submission() {
  $nonce = isset($_POST['_wpnonce']) && is_string($_POST['_wpnonce'])
    ? sanitize_text_field(wp_unslash($_POST['_wpnonce']))
    : '';

  if (!wp_verify_nonce($nonce, 'projecttheme_share_fonts_submission')) {
    wp_die(esc_html__('Your session has expired. Please reload the form and try again.', 'projecttheme'), '', ['response' => 403]);
  }

  $text_fields = ['name', 'surname', 'phone'];
  $submission = [];

  foreach ($text_fields as $field) {
    $value = isset($_POST[$field]) && is_string($_POST[$field]) ? wp_unslash($_POST[$field]) : '';
    $submission[$field] = sanitize_text_field($value);
  }

  $email_value = isset($_POST['email']) && is_string($_POST['email']) ? wp_unslash($_POST['email']) : '';
  $message_value = isset($_POST['message']) && is_string($_POST['message']) ? wp_unslash($_POST['message']) : '';
  $submission['email'] = sanitize_email($email_value);
  $submission['message'] = sanitize_textarea_field($message_value);

  if (!$submission['name'] || !$submission['email'] || !$submission['message'] || !is_email($submission['email'])) {
    projecttheme_share_fonts_redirect('invalid');
  }

  $recipient = sanitize_email(get_option('admin_email'));
  if (!$recipient) {
    projecttheme_share_fonts_redirect('error');
  }

  $subject = sprintf(
    __('[%s] New font suggestion', 'projecttheme'),
    wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES)
  );
  $body = sprintf(
    "Name: %s\nSurname: %s\nE-Mail: %s\nPhone Number: %s\n\nMessage:\n%s",
    $submission['name'],
    $submission['surname'],
    $submission['email'],
    $submission['phone'],
    $submission['message']
  );

  if (!wp_mail($recipient, $subject, $body, ['Reply-To: ' . $submission['email']])) {
    projecttheme_share_fonts_redirect('error');
  }

  projecttheme_share_fonts_redirect('success');
}

add_action('admin_post_projecttheme_share_fonts_submission', 'projecttheme_handle_share_fonts_submission');
add_action('admin_post_nopriv_projecttheme_share_fonts_submission', 'projecttheme_handle_share_fonts_submission');
