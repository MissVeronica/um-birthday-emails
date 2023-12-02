<?php
/**
 * Plugin Name:     Ultimate Member - Birthday emails integration
 * Description:     Extension to Ultimate Member for Birthday emails plugin integration with UM.
 * Version:         1.0.0
 * Requires PHP:    7.4
 * Author:          Miss Veronica
 * License:         GPL v2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Author URI:      https://github.com/MissVeronica
 * Text Domain:     ultimate-member
 * Domain Path:     /languages
 * UM version:      2.7.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 
if ( ! class_exists( 'UM' ) ) return;

Class UM_Birthday_Emails {

    function __construct() {

        add_action( 'um_registration_set_extra_data', array( $this, 'save_cjl_birthday_fields_on_registration' ), 10, 3 );
    }

    public function save_cjl_birthday_fields_on_registration( $user_id, $args, $form_data ) {
        
        if ( isset( $args['birth_date'] ) && ! empty( $args['birth_date'] )) {

            $birth_date_time = strtotime( $args['birth_date'] );
            $cjl_birthday   = date_i18n( 'j', $birth_date_time );
            $cjl_birthmonth = date_i18n( 'n', $birth_date_time );

            update_user_meta( $user_id, 'cjl_birthday',   sanitize_meta( 'cjl_birthday',   $cjl_birthday,   'user' ) );
            update_user_meta( $user_id, 'cjl_birthmonth', sanitize_meta( 'cjl_birthmonth', $cjl_birthmonth, 'user' ) );
        }
    }

}

new UM_Birthday_Emails();
