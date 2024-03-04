<?php
namespace Codexse_Addons\Elementor;

defined( 'ABSPATH' ) || die();

class Review_Us {

    public static function init() {
        add_action( 'admin_init', [__CLASS__, 'cx_void_check_installation_time'] );
        add_action( 'admin_init', [__CLASS__, 'cx_void_spare_me'], 5 );
    }

    //check if review notice should be shown or not
    public static function cx_void_check_installation_time() {

        $nobug = get_option( 'cx__spare_me', "0");

        if ($nobug == "1" || $nobug == "3") {
            return;
        }

        $install_date = get_option( 'codexse_addons_activation_time', strtotime("now") );
        $past_date    = strtotime( '-10 days' );
        
        $remind_time = get_option( 'cx__remind_me', strtotime("now"));
        $remind_due  = strtotime( '+15 days', $remind_time );
        $now         = strtotime( "now" );

        if ($now >= $remind_due) {
            add_action( 'admin_notices', [__CLASS__, 'cx_void_grid_display_admin_notice']);
        }
        else if (($past_date >= $install_date) &&  $nobug !== "2") {
            add_action( 'admin_notices', [__CLASS__, 'cx_void_grid_display_admin_notice']);
        }
    }

    /**
     * Display Admin Notice, asking for a review
     **/
    public static function cx_void_grid_display_admin_notice() {
        // wordpress global variable
        global $pagenow;

        $exclude = [ 'themes.php', 'users.php', 'tools.php', 'options-general.php', 'options-writing.php', 'options-reading.php', 'options-discussion.php', 'options-media.php', 'options-permalink.php', 'options-privacy.php', 'edit-comments.php', 'upload.php', 'media-new.php', 'admin.php', 'import.php', 'export.php', 'site-health.php', 'export-personal-data.php', 'erase-personal-data.php' ];

        if ( ! in_array( $pagenow, $exclude ) ) {
            $dont_disturb = esc_url( add_query_arg( 'spare_me', '1', self::cx_current_admin_url() ) );
            $remind_me    = esc_url( add_query_arg( 'remind_me', '1', self::cx_current_admin_url() ) );
            $rated        = esc_url( add_query_arg( 'cx_rated', '1', self::cx_current_admin_url() ) );
            $reviewurl    = esc_url( 'https://wordpress.org/support/plugin/codexse-elementor-addons/reviews/?rate=5#new-post' );

            printf( __( '<div class="notice cx-review-notice cx-review-notice--extended">
                <div class="cx-review-notice__aside">
                    <div class="cx-review-notice__icon-wrapper"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PGcgZmlsbD0iI0ZGRiI+PHBhdGggZD0iTTI4LjYgNy44aC44Yy41IDAgLjktLjUuOC0xIDAtLjUtLjUtLjktMS0uOC0zLjUuMy02LjgtMS45LTcuOC01LjMtLjEtLjUtLjYtLjctMS4xLS42cy0uNy42LS42IDEuMWMxLjIgMy45IDQuOSA2LjYgOC45IDYuNnoiLz48cGF0aCBkPSJNMzAgMTEuMWMtLjMtLjYtLjktMS0xLjYtMS0uOSAwLTEuOSAwLTIuOC0uMi00LS44LTctMy42LTguNC03LjEtLjMtLjYtLjktMS4xLTEuNi0xQzguMyAxLjkgMS44IDcuNC45IDE1LjEuMSAyMi4yIDQuNSAyOSAxMS4zIDMxLjIgMjAgMzQuMSAyOSAyOC43IDMwLjggMTkuOWMuNy0zLjEuMy02LjEtLjgtOC44em0tMTEuNiAxLjFjLjEtLjUuNi0uOCAxLjEtLjdsMy43LjhjLjUuMS44LjYuNyAxLjFzLS42LjgtMS4xLjdsLTMuNy0uOGMtLjQtLjEtLjgtLjYtLjctMS4xek0xMC4xIDExYy4yLTEuMSAxLjQtMS45IDIuNS0xLjYgMS4xLjIgMS45IDEuNCAxLjYgMi41LS4yIDEuMS0xLjQgMS45LTIuNSAxLjYtMS0uMi0xLjgtMS4zLTEuNi0yLjV6bTE0LjYgMTAuNkMyMi44IDI2IDE3LjggMjguNSAxMyAyN2MtMy42LTEuMi02LjItNC41LTYuNS04LjItLjEtMSAuOC0xLjcgMS43LTEuNmwxNS40IDIuNWMuOSAwIDEuNCAxIDEuMSAxLjl6Ii8+PHBhdGggZD0iTTE3LjEgMjIuOGMtMS45LS40LTMuNy4zLTQuNyAxLjctLjIuMy0uMS43LjIuOS42LjMgMS4yLjUgMS45LjcgMS44LjQgMy43LjEgNS4xLS43LjMtLjIuNC0uNi4yLS45LS43LS45LTEuNi0xLjUtMi43LTEuN3oiLz48L2c+PC9zdmc+"></div>
                </div>
                <div class="cx-review-notice__content">
                    <h3>Enjoying Codexse?</h3>
                    <p>Thank you for choosing Codexse. If you have found our plugin useful and makes you smile, please consider giving us a 5-star rating on WordPress.org. It would mean the world to us.</p>
                    <div class="cx-review-notice__actions">
                        <a href="%s" class="cx-review-button cx-review-button--cta" target="_blank"><span>👍 Yes, You Deserve It!</span></a>
                        <a href="%s" class="cx-review-button cx-review-button--cta cx-review-button--outline"><span>🙌 Already Rated!</span></a>
                        <a href="%s" class="cx-review-button cx-review-button--cta cx-review-button--outline"><span>🔔 Remind Me Later</span></a>
                        <a href="%s" class="cx-review-button cx-review-button--cta cx-review-button--error cx-review-button--outline"><span>💔 No Thanks</span></a>
                    </div>
                </div>
            </div>' ), $reviewurl, $rated, $remind_me, $dont_disturb );
        }
    }

    // remove the notice for the user if review already done or if the user does not want to
    public static function cx_void_spare_me() {
        if ( isset( $_GET['spare_me'] ) && ! empty( $_GET['spare_me'] ) ) {
            $spare_me = absint($_GET['spare_me']);
            if ( 1 == $spare_me ) {
                update_option( 'cx__spare_me', "1" );
            }
        }

        if ( isset( $_GET['remind_me'] ) && ! empty( $_GET['remind_me'] ) ) {
            $remind_me = absint($_GET['remind_me']);
            if ( 1 == $remind_me ) {
                $get_activation_time = strtotime( "now" );
                update_option( 'cx__remind_me', $get_activation_time );
                update_option( 'cx__spare_me', "2" );
            }
        }

        if ( isset( $_GET['cx_rated'] ) && ! empty( $_GET['cx_rated'] ) ) {
            $cx_rated = absint($_GET['cx_rated']);
            if ( 1 == $cx_rated ) {
                update_option( 'cx__rated', 'yes' );
                update_option( 'cx__spare_me', "3" );
            }
        }
    }

    protected static function cx_current_admin_url() {
        $uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
        $uri = preg_replace( '|^.*/wp-admin/|i', '', $uri );

        if ( ! $uri ) {
            return '';
        }
        return remove_query_arg( [ '_wpnonce', '_wc_notice_nonce', 'wc_db_update', 'wc_db_update_nonce', 'wc-hide-notice' ], admin_url( $uri ) );
    }
}

Review_Us::init();
