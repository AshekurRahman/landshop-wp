<?php

/**
 * Dashboard credentials tab template
 */

defined('ABSPATH') || die();

$credential_list = self::get_credentials();
// $credential_data = \Codexse_Addons\Elementor\Credentials_Manager::get_saved_credentials();
$credential_data = cx_get_credentials();
$has_pro = cx_has_pro();

?>
<div class="cx-dashboard-panel">
    <div class="cx-dashboard-panel__header">
        <div class="cx-dashboard-panel__header-content">
            <h2><?php esc_html_e('Codexse Credentials', 'codexse-elementor-addons'); ?></h2>
            <p class="f16"><?php printf(esc_html__('Here is the list of our all credentials. You can input credentials from here. %sAfter changing any input make sure to click the Save Changes button.%s', 'codexse-elementor-addons'), '<strong>', '</strong>'); ?></p>
        </div>
    </div>

    <div class="cx-dashboard-credentials">
        <?php
        foreach ($credential_list as $cred_key => $cred_data) :
            $title = isset($cred_data['title']) ? $cred_data['title'] : '';
            $help = isset($cred_data['help']) ? $cred_data['help'] : '';
            $icon = isset($cred_data['icon']) ? $cred_data['icon'] : '';
            $is_pro = isset($cred_data['is_pro']) && $cred_data['is_pro'] ? true : false;
            $is_placeholder = $is_pro && !cx_has_pro();
            $class_attr = 'cx-dashboard-credentials__item';

            $fields = isset($cred_data['fiels']) ? $cred_data['fiels'] : '';

            if ($is_pro) {
                $class_attr .= ' item--is-pro';
            }

            $checked = '';

            // if ( ! in_array( $cred_key, $inactive_features ) ) {
            //     $checked = 'checked="checked"';
            // }

            if ($is_placeholder) {
                $class_attr .= ' item--is-placeholder';
                $checked = 'disabled="disabled"';
            }
        ?>
            <div class="<?php echo $class_attr; ?>">
                <div class="cx-dashboard-credentials__item-title-wrap">
                    <?php if ($is_pro) : ?>
                        <span class="cx-dashboard-credentials__item-badge"><?php esc_html_e('Pro', 'codexse-elementor-addons'); ?></span>
                    <?php endif; ?>
                    <span class="cx-dashboard-credentials__item-icon"><i class="<?php echo $icon; ?>"></i></span>
                    <h3 class="cx-dashboard-credentials__item-title">
                        <label for="cx-widget-<?php echo $cred_key; ?>" <?php echo $is_placeholder ? 'data-tooltip="Get pro"' : ''; ?>>
                            <?php echo $title; ?>
                        </label>
                    </h3>
                </div>
                <div class="cx-dashboard-credentials__item-input-wrap">
                    <?php foreach ($fields as $key => $value) : ?>
                        <div class="cx-dashboard-credentials__item-input">
                            <label for="cx-widget-<?php echo $cred_key . '-' . $value['name']; ?>">
                                <?php echo esc_html($value['label']); ?>
                                <?php if (!empty($value['help'])) : ?>
                                    <a href="<?php echo esc_url($value['help']['link']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($value['help']['instruction']); ?></a>
                                <?php endif; ?>
                            </label>
                            <?php if ($value['type'] == 'textarea') : ?>
                                <textarea id="cx-widget-<?php echo $cred_key; ?>" <?php echo $checked; ?> class="cx-credential" name="credentials[<?php echo esc_attr($cred_key); ?>][<?php echo esc_attr($value['name']); ?>]" cols="30" rows="10"><?php echo esc_attr(isset($credential_data[$cred_key][$value['name']]) ? $credential_data[$cred_key][$value['name']] : ''); ?></textarea>
                            <?php else : ?>
                                <input id="cx-widget-<?php echo $cred_key . '-' . $value['name']; ?>" <?php echo $checked; ?> type="<?php echo esc_attr($value['type']); ?>" class="cx-credential" name="credentials[<?php echo esc_attr($cred_key); ?>][<?php echo esc_attr($value['name']); ?>]" value="<?php echo esc_attr(isset($credential_data[$cred_key][$value['name']]) ? $credential_data[$cred_key][$value['name']] : ''); ?>">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>

    <div class="cx-dashboard-panel__footer">
        <button disabled class="cx-dashboard-btn cx-dashboard-btn--save" type="submit"><?php esc_html_e('Save Settings', 'codexse-elementor-addons'); ?></button>
    </div>
</div>
