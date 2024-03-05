<?php
/**
 * Dashboard pro tab template
 */

defined( 'ABSPATH' ) || die();
?>
<div class="cx-dashboard-panel">
    <div class="cx-home-banner">
        <div class="cx-home-banner__content">
            <h2><span><?php esc_html_e('What\'s Inside ', 'codexse-elementor-addons'); ?></span><br><?php esc_html_e('CodexseAddons Pro', 'codexse-elementor-addons'); ?></h2>
        </div>
    </div>
    <div class="cx-home-body">
        <div class="cx-row cx-py-5 cx-align-items-center cx-align-center">
            <div class="cx-col cx-col-12">
                <div class="cx-badge"><?php esc_html_e('PRO', 'codexse-elementor-addons'); ?></div>
                <h2 class="cx-section-title cx-text-primary"><?php esc_html_e('Features', 'codexse-elementor-addons'); ?></h2>
            </div>
        </div>

        <div class="cx-row cx-py-5 cx-pt-0 cx-align-items-center">
            <div class="cx-col cx-col-6">
                <img class="cx-img-fluid cx-title-icon-size" src="<?php echo CODEXSE_ADDONS_ASSETS; ?>imgs/admin/cross-domain.svg" alt="">
                <h3 class="cx-feature-title"><?php esc_html_e('Cross Domain Copy Paste', 'codexse-elementor-addons'); ?></h3>
                <p class="f18"><?php esc_html_e('Do Cross-Domain Widget Copy Paste within different websites!
                    You can easily copy any widgets from your previously designed website and paste it to your newly created website.', 'codexse-elementor-addons'); ?></p>
            </div>
            <div class="cx-col cx-col-6">
                <img class="cx-img-fluid cx-pl-2" src="<?php echo CODEXSE_ADDONS_ASSETS; ?>imgs/admin/pa-1.png" alt="">
            </div>
        </div>

        <div class="cx-row cx-py-5 cx-pt-0 cx-align-items-center">
            <div class="cx-col cx-col-6">
                <img class="cx-img-fluid cx-pr-2" src="<?php echo CODEXSE_ADDONS_ASSETS; ?>imgs/admin/pa-2.png" alt="">
            </div>
            <div class="cx-col cx-col-6">
                <img class="cx-img-fluid cx-title-icon-size" src="<?php echo CODEXSE_ADDONS_ASSETS; ?>imgs/admin/preset.svg" alt="">
                <h3 class="cx-feature-title"><?php esc_html_e('Preset', 'codexse-elementor-addons'); ?></h3>
                <p class="f16"><?php esc_html_e('400+ Preset Library for Widgets with Drop Down facility. Experience the Instagram Photo Editing like experience in Elementor!', 'codexse-elementor-addons'); ?></p>
            </div>
        </div>

        <div class="cx-row cx-py-5 cx-pt-0 cx-align-items-center">
            <div class="cx-col cx-col-6">
                <img class="cx-img-fluid cx-title-icon-size" src="<?php echo CODEXSE_ADDONS_ASSETS; ?>imgs/admin/nesting.svg" alt="">
                <h3 class="cx-feature-title"><?php esc_html_e('Unlimited Section Nesting', 'codexse-elementor-addons'); ?></h3>
                <p class="f18"><?php esc_html_e('Don’t you wish to use multiple sections at the same time in Elementor? With CodexseAddons, now you can. Create as many sections as you want and organize your elements more effectively.', 'codexse-elementor-addons'); ?></p>
            </div>
            <div class="cx-col cx-col-6">
                <img class="cx-img-fluid cx-pl-2" src="<?php echo CODEXSE_ADDONS_ASSETS; ?>imgs/admin/pa-3.png" alt="">
            </div>
        </div>

        <div class="cx-row cx-py-5 cx-pt-0 cx-align-items-center cx-align-center">
            <div class="cx-col cx-col-12">
                <div class="cx-badge"><?php esc_html_e('PRO', 'codexse-elementor-addons'); ?></div>
                <h2 class="cx-section-title cx-text-primary"><?php esc_html_e('Widgets', 'codexse-elementor-addons'); ?></h2>
            </div>
        </div>

        <div class="cx-row cx-py-5 cx-pt-0 cx-align-items-center cx-align-center">
            <?php
            $pro_widgets = \Codexse_Addons\Elementor\Widgets_Manager::get_pro_widget_map();

            foreach ( $pro_widgets as $widget ) :
                $title = isset( $widget['title'] ) ? $widget['title'] : 'Widget Title';
                $icon = isset( $widget['icon'] ) ? $widget['icon'] : 'cx cx-codexseaddons';
                $demo = isset( $widget['demo'] ) ? $widget['demo'] : 'https://codexseaddons.com/go/get-pro';
                ?>
                <div class="cx-col cx-col-4">
                    <a class="cx-pro-widget" href="<?php echo esc_url( $demo ); ?>" target="_blank" rel="noopener"><i class="<?php echo $icon; ?>"></i> <?php echo $title; ?></a>
                </div>
                <?php
            endforeach;
            ?>
        </div>

        <hr>

        <div class="cx-row cx-py-5 cx-pt-0- cx-align-items-center cx-align-center">
            <div class="cx-col cx-col-12">
                <h2 class="cx-feature-title cx-mb-3"><?php esc_html_e('Get Pro and Experience all those exciting features and widgets', 'codexse-elementor-addons'); ?></h2>
                <a style="padding: 20px 40px" class="cx-btn cx-btn-secondary" target="_blank" rel="noopener" href="https://codexseaddons.com/go/get-pro"><?php esc_html_e('GET PRO', 'codexse-elementor-addons'); ?></a>
            </div>
        </div>

    </div>
</div>
