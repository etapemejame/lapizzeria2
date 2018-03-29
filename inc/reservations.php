<?php

  function lapizzeria1_save_reservation() {
    global $wpdb;
    if(isset($_POST['reservation']) && $_POST['hidden'] == "1") {
        $name = sanitize_text_field( $_POST['name'] );
        $date = sanitize_text_field( $_POST['date'] );
        $email= sanitize_email( $_POST['email'] );
        $phone = sanitize_text_field( $_POST['phone'] );
        $message = sanitize_text_field( $_POST['message'] );

        $table = $wpdb->prefix . 'reservations';

        $data = array(
          'name' => $name,
          'date' => $date,
          'email' => $email,
          'phone' => $phone,
          'message' => $message
        );

        $format = array(
          '%s',
          '%s',
          '%s',
          '%s',
          '%s'
        );
        $wpdb->insert($table, $data, $format );

        $url = get_page_by_title('Thanks for your reservation!');
        wp_redirect( get_permalink($url) );
        exit();
    }
  }
  add_action('init', 'lapizzeria1_save_reservation');
?>
