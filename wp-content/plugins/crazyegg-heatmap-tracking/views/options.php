<div class="wrap">
  <h1>Crazy Egg for WordPress</h1>
  <p>Grab your Crazy Egg tracking script <a href="https://app.crazyegg.com/instructions" target="_blank">here</a>, and paste it below.</p>
  <form action="options.php" method="post">
    <?php
      settings_fields( 'crazy-egg-options' );
      do_settings_sections( 'crazy-egg' );
     ?>
     <table class="form-table">
        <tr valign="top">
        <th>Your Tracking Script:</th>
        <td>
          <textarea name="crazy_egg_tracking_script" rows="8" cols="80"><?php echo esc_attr( get_option('crazy_egg_tracking_script') ); ?></textarea>
        </td>
        </tr>
    </table>
     <?php submit_button(); ?>
  </form>
</div>
