<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Radio
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_security extends CSFramework_Options {
/*
  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }
*/
  public function output(){

    echo $this->element_before();

    global $wpdb;
    $prefix = $wpdb->prefix;
    $user_info = get_userdata(1);
    $admin_username = $user_info->user_login;
    $admin_nickname = $user_info->nickname;
    $current_version = get_core_updates();

    $prefix_danger = ( $prefix === 'wp_' ) ? true: false;
    $auth_key_danger = ( strlen( AUTH_KEY ) < 40 ) ? true: false;
    $admin_login_danger = ( $user_info->user_login == 'admin' ) ? true: false;
    $admin_nick_danger = ( $user_info->user_login === $user_info->nickname ) ? true: false;
    $wordpress_version_danger = ( $current_version[0]->response != 'latest' ) ? true: false;

    function prefix_danger_alert() {
      ?>
      <div class="error notice">
        <?php esc_html_e('Please change the WordPress Database Prefix to improve security.'); ?><br>
        <?php esc_html_e('More info'); ?>: <a href="https://digwp.com/2010/10/change-database-prefix/" target="_blank"> https://digwp.com/2010/10/change-database-prefix/</a
      </div>
      <?php
    }

    ?>
    <table class="codestar-security-field">
      <tr>
        <td class="label"><?php esc_html_e('Why?'); ?></td><td class="text-output info"><a href="https://www.wpwhitesecurity.com/wordpress-security/targeted-non-targeted-wordpress-hack-attacks/">What are Targeted and Non-Targeted WordPress Hack Attacks</a></td>
      </tr>
      <tr>
        <td class="label"><?php esc_html_e('Datebank prefix'); ?></td><td class="text-output <?php echo ( $prefix_danger ) ? 'danger' : 'good'; ?>"><?php echo $prefix; ?></td>
      </tr>
      <?php
      /*
       * INFO about WP DB prefix
       */
      if ( $prefix_danger ) : ?>
      <tr>
        <td></td><td class="info">
          <p>
            <strong><?php esc_html_e('Please change the WordPress Database Prefix to improve security.'); ?></strong><br>
            <?php esc_html_e('Attackers can target database with automated scripts, SQL injection and other malicious code.'); ?>
          </p>
          <p>
            <?php esc_html_e('More info'); ?>: <a href="https://digwp.com/2010/10/change-database-prefix/" target="_blank">https://digwp.com/2010/10/change-database-prefix/</a><br>
            <?php esc_html_e( 'Change with plugin'); ?>: <a href="https://wordpress.org/plugins/all-in-one-wp-security-and-firewall/" target="_blank">https://wordpress.org/plugins/all-in-one-wp-security-and-firewall/</a>
          </p>
        </td>
      </tr>
      <?php endif; ?>
      <tr>
        <td class="label"><?php esc_html_e('Auth key'); ?></td><td class="text-output <?php echo ( $auth_key_danger ) ? 'danger' : 'good'; ?>"><?php echo htmlspecialchars( AUTH_KEY ); ?></td>
      </tr>
      <?php
      /*
       * INFO about WP security keys
       */
      if ( $auth_key_danger ) : ?>
      <tr>
        <td></td><td class="info">
          <p>
            <strong><?php esc_html_e('Please change the WordPress security keys to a random one.'); ?></strong><br>
          <?php esc_html_e('These security keys makes it harder to crack your password.'); ?>
        </p>
        <p>
          <?php esc_html_e('More info'); ?>: <a href="http://www.wpbeginner.com/beginners-guide/what-why-and-hows-of-wordpress-security-keys/" target="_blank">http://www.wpbeginner.com/beginners-guide/what-why-and-hows-of-wordpress-security-keys/</a><br>
          <?php esc_html_e( 'Generator'); ?>: <a href="https://api.wordpress.org/secret-key/1.1/salt/" target="_blank">https://api.wordpress.org/secret-key/1.1/salt/</a>
        </p>
        </td>
      </tr>
      <?php endif; ?>
      <tr>
        <td class="label"><?php esc_html_e('Admin username'); ?></td><td class="text-output <?php echo ( $admin_login_danger ) ? 'danger' : 'good'; ?>"><?php echo $user_info->user_login; ?></td>
      </tr>
      <?php
      /*
       * INFO about WP admin name
       */
      if ( $admin_login_danger ) : ?>
      <tr>
        <td></td><td class="info">
          <p>
            <strong><?php esc_html_e('Please change default admin username.'); ?></strong><br>
            <?php esc_html_e('Prevent brutal force or guessing authentication attacks.'); ?>
          </p>
          <p>
            <?php esc_html_e('More info'); ?>: <a href="https://www.enginethemes.com/wordpress-tip-change-admin-username/" target="_blank">https://www.enginethemes.com/wordpress-tip-change-admin-username/</a><br>
            <?php esc_html_e( 'Change with plugin'); ?>: <a href="https://wordpress.org/plugins/wpvn-username-changer" target="_blank">https://wordpress.org/plugins/wpvn-username-changer/</a>
          </p>
      </td>
      </tr>
      <?php endif; ?>
      <tr>
        <td class="label"><?php esc_html_e('Admin nickname'); ?></td><td class="text-output <?php echo ( $admin_nick_danger ) ? 'danger' : 'good'; ?>"><?php echo $user_info->nickname; ?><td></td>
      </tr>
      <?php
      /*
       * INFO about WP admin nickname
       */
      if ( $admin_nick_danger ) : ?>
      <tr>
        <td></td><td class="info">
          <p>
            <strong><a href="profile.php"><?php esc_html_e("Admin username and nickname/display name shouldn't be the same."); ?></a></strong><br>
            <?php esc_html_e('Make difficult for an attacker to penetrate.'); ?>
          </p>
          <p>
            <?php esc_html_e('More info'); ?>: <a href="https://www.wpwhitesecurity.com/wordpress-security/hide-wordpress-usernames-improve-wordpress-security/" target="_blank">https://www.wpwhitesecurity.com/wordpress-security/hide-wordpress-usernames-improve-wordpress-security/</a><br>
            <?php esc_html_e('How to'); ?>: <a href="https://en.support.wordpress.com/change-your-username/" target="_blank">https://en.support.wordpress.com/change-your-username/</a><br>
          </p>
      </td>
      </tr>
      <?php endif; ?>
      <tr>
        <td class="label"><?php esc_html_e('WP version'); ?></td><td class="text-output <?php echo ( $wordpress_version_danger ) ? 'danger' : 'good'; ?>"><?php echo bloginfo('version') . ' -> ' . $current_version[0]->response; ?><td></td>
      </tr>
      <?php
      /*
       * INFO about WP admin nickname
       */
      if ( $wordpress_version_danger ) : ?>
      <tr>
        <td></td><td class="info">
          <p>
            <strong><a href="update-core.php"><?php esc_html_e("Please update WordPress to the lastest version."); ?></a></strong><br>
            <?php esc_html_e('New releases has security updates, bug fixes, new features, improve performance and enhance features to keep up with the new industry standards.'); ?>
          </p>
          <p>
            <?php esc_html_e('More info'); ?>: <a href="http://www.wpbeginner.com/beginners-guide/why-you-should-always-use-the-latest-version-of-wordpress/" target="_blank">http://www.wpbeginner.com/beginners-guide/why-you-should-always-use-the-latest-version-of-wordpress/</a><br>
          </p>
      </td>
      </tr>
      <?php endif; ?>
    </table>
    <?php

    echo $this->element_after();

  }

}
