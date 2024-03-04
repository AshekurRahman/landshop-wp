<?php
/**
 * Dashboard features tab template
 */

defined( 'ABSPATH' ) || die();

$features = self::get_features();
$inactive_features = \Codexse_Addons\Elementor\Extensions_Manager::get_inactive_features();
$has_pro = cx_has_pro();

$total_features_count = count( $features );
?>
<div class="cx-dashboard-panel">
    <div class="cx-dashboard-panel__header">
        <div class="cx-dashboard-panel__header-content">
            <h2><?php esc_html_e( 'Codexse Features', 'codexse-elementor-addons' ); ?></h2>
            <p class="f16"><?php printf( esc_html__( 'Here is the list of our all %s features. You can enable or disable features from here to optimize loading speed and Elementor editor experience. %sAfter enabling or disabling any feature make sure to click the Save Changes button.%s', 'codexse-elementor-addons' ), $total_features_count, '<strong>', '</strong>' ); ?></p>

            <div class="cx-action-list">
                <button type="button" class="cx-action--btn" data-action="enable_feature"><?php esc_html_e( 'Enable All', 'codexse-elementor-addons' ); ?></button>
                <button type="button" class="cx-action--btn" data-action="disable_feature"><?php esc_html_e( 'Disable All', 'codexse-elementor-addons' ); ?></button>
            </div>
        </div>
    </div>

    <div class="cx-dashboard-widgets">
        <?php
        foreach ( $features as $feature_key => $feature_data ) :
            $title = isset( $feature_data['title'] ) ? $feature_data['title'] : '';
            $icon = isset( $feature_data['icon'] ) ? $feature_data['icon'] : '';
            $is_pro = isset( $feature_data['is_pro'] ) && $feature_data['is_pro'] ? true : false;
            $demo_url = isset( $feature_data['demo'] ) && $feature_data['demo'] ? $feature_data['demo'] : '';
            $is_placeholder = $is_pro && ! cx_has_pro();
            $class_attr = 'cx-dashboard-widgets__item';

            if ( $is_pro ) {
                $class_attr .= ' item--is-pro';
            }

            $checked = '';

            if ( ! in_array( $feature_key, $inactive_features ) ) {
                $checked = 'checked="checked"';
            }

            if ( $is_placeholder ) {
                $class_attr .= ' item--is-placeholder';
                $checked = 'disabled="disabled"';
            }
            ?>
            <div class="<?php echo $class_attr; ?>">
                <?php if ( $is_pro ) : ?>
                    <span class="cx-dashboard-widgets__item-badge"><?php esc_html_e( 'Pro', 'codexse-elementor-addons' ); ?></span>
                <?php endif; ?>
                <span class="cx-dashboard-widgets__item-icon"><i class="<?php echo $icon; ?>"></i></span>
                <h3 class="cx-dashboard-widgets__item-title">
                    <label for="cx-widget-<?php echo $feature_key; ?>" <?php echo $is_placeholder ? 'data-tooltip="Get pro"' : ''; ?>><?php echo $title; ?></label>
                    <?php if ( $demo_url ) : ?>
                        <a href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener" data-tooltip="<?php esc_attr_e( 'Click to view demo', 'codexse-elementor-addons' ); ?>" class="cx-dashboard-widgets__item-preview"><i aria-hidden="true" class="eicon-device-desktop"></i></a>
                    <?php endif; ?>
                </h3>
                <div class="cx-dashboard-widgets__item-toggle cx-toggle">
                    <input id="cx-widget-<?php echo $feature_key; ?>" <?php echo $checked; ?> type="checkbox" class="cx-toggle__check cx-feature" name="features[]" value="<?php echo $feature_key; ?>">
                    <b class="cx-toggle__switch"></b>
                    <b class="cx-toggle__track"></b>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>

    <div class="cx-dashboard-panel__footer">
        <button disabled class="cx-dashboard-btn cx-dashboard-btn--save" type="submit"><?php esc_html_e( 'Save Settings', 'codexse-elementor-addons' ); ?></button>
    </div>
</div>
