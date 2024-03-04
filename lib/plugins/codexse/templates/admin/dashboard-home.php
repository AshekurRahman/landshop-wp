<?php
/**
 * Dashboard home tab template
 */

defined( 'ABSPATH' ) || die();
?>
<div class="cx-dashboard-panel">
	<?php if ( file_exists(CODEXSE_ADDONS_DIR_PATH.'assets/imgs/admin/promo_banner.jpg') && ! cx_has_pro() ) : ?>
    <div class="cx-home-banner" style="<?php echo 'background-image: url('.CODEXSE_ADDONS_ASSETS.'imgs/admin/promo_banner.jpg)'; ?>">
        <div class="cx-home-banner__content">
			<style>
				.cx-home-banner-promo-button {
					margin-left: auto;
					color: #292D2B;
					background: #FF931F;
					font-size: 24px;
					font-weight: 800;
					padding: 15px 20px;
					border-radius: 5px;
					text-decoration: none;
				}
				.cx-home-banner-promo-button:hover {
					color: #292D2B;
					background: #FFFFFF;
				}
			</style>
			<a class="cx-home-banner-promo-button" target="_blank" href="https://codexseaddons.com/pricing/">Claim Yours</a>
        </div>
    </div>
	<?php else: ?>
    <div class="cx-home-banner">
        <div class="cx-home-banner__content">
            <h2><?php esc_html_e('Thanks a lot ', 'codexse-elementor-addons'); ?><br><span><?php esc_html_e('for choosing CodexseAddons', 'codexse-elementor-addons'); ?></span></h2>
        </div>
    </div>
	<?php endif; ?>
</div>
