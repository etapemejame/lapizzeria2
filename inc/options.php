<?php
function lapizzeria1_options() {
  add_menu_page('La Pizzeria1', 'La Pizzeria1 Options', 'administrator', 'lapizzeria1_options', 'lapizzeria1_adjustments', '', 20 );

  add_submenu_page( 'lapizzeria1_options', 'Reservations', 'Reservations', 'administrator', 'lapizzeria1_reservations', 'lapizzeria1_reservations' );
}
add_action( 'admin_menu', 'lapizzeria1_options');

function lapizzeria1_settings() {
  //Google Maps group
  register_setting('lapizzeria1_options_gmaps', 'lapizzeria1_gmap_latitude');
  register_setting('lapizzeria1_options_gmaps', 'lapizzeria1_gmap_longitude');
  register_setting('lapizzeria1_options_gmaps', 'lapizzeria1_gmap_zoom');
  register_setting('lapizzeria1_options_gmaps', 'lapizzeria1_gmap_apikey');

  //Information group

  register_setting('lapizzeria1_options_info', 'lapizzeria1_location');
  register_setting('lapizzeria1_options_info', 'lapizzeria1_phonenumber');
}
add_action( 'init', 'lapizzeria1_settings');

function lapizzeria1_adjustments() { ?>

  <div class="wrap">
    <h1>La Pizzeria1 Adjustments</h1>
    <form action="options.php" method="post">
      <?php
      settings_fields('lapizzeria1_options_gmaps');
      do_settings_sections('lapizzeria1_options_gmaps');
      ?>
      <h2>Google Maps</h2>
      <table class="form-table">

        <tr valign="top">
          <th scope="row">Latitude: </th>
          <td>
            <input type="text" name="lapizzeria1_gmap_latitude" value="<?php echo esc_attr(get_option('lapizzeria1_gmap_latitude')); ?> ">
          </td>
        </tr>

        <tr valign="top">
          <th scope="row">Longitude: </th>
          <td>
            <input type="text" name="lapizzeria1_gmap_longitude" value="<?php echo esc_attr(get_option('lapizzeria1_gmap_longitude')); ?> ">
          </td>
        </tr>

        <tr valign="top">
          <th scope="row">Zoom Level: </th>
          <td>
            <input type="number" min=12 max=21 name="lapizzeria1_gmap_zoom" value="<?php echo esc_attr(get_option('lapizzeria1_gmap_zoom')); ?> ">
          </td>
        </tr>

        <tr valign="top">
          <th scope="row">Api Key: </th>
          <td>
            <input type="text" name="lapizzeria1_gmap_apikey" value="<?php echo esc_attr(get_option('lapizzeria1_gmap_apikey')); ?> ">
          </td>
        </tr>

      </table>

      <?php
      settings_fields('lapizzeria1_options_info');
      do_settings_sections('lapizzeria1_options_info');
      ?>
      <h2>Other Adjustments</h2>
    <table class="form-table">
      <tr valign="top">
        <th scope="row">Location: </th>
        <td>
          <input type="text" name="lapizzeria1_location" value="<?php echo esc_attr(get_option('lapizzeria1_location')); ?> ">
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Phone Number: </th>
        <td>
          <input type="text" name="lapizzeria1_phonenumber" value="<?php echo esc_attr(get_option('lapizzeria1_phonenumber')); ?> ">
        </td>
      </tr>

    </table>

      <?php submit_button(); ?>
    </form>
  </div>


<?php }

function lapizzeria1_reservations() { ?>

  <div class="wrap">
    <h1>Reservations</h1>
    <table class="wp-list-table widefat striped">
      <thead>
        <tr>
          <th class="manage-column">ID</th>
          <th class="manage-column">Name</th>
          <th class="manage-column">Date of Reservation</th>
          <th class="manage-column">Email</th>
          <th class="manage-column">Phone Number</th>
          <th class="manage-column">Message</th>
        </tr>
      </thead>
      <tbody>
        <?php
          global $wpdb;
          $table = $wpdb->prefix . 'reservations';
          $reservations = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
          foreach($reservations as $reservation): ?>
            <tr>
              <td><?php echo $reservation['id']; ?></td>
              <td><?php echo $reservation['name']; ?></td>
              <td><?php echo $reservation['date']; ?></td>
              <td><?php echo $reservation['email']; ?></td>
              <td><?php echo $reservation['phone']; ?></td>
              <td><?php echo $reservation['message']; ?></td>
            </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>


<?php }


?>
