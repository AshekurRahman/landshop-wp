<?php
/**
 * Dashboard main template
 */

defined( 'ABSPATH' ) || die();
?>
<div class="wrap">
    <h1 class="screen-reader-text"><?php esc_html_e( 'Codexse', 'codexse-elementor-addons' ); ?></h1>
    <form class="cx-dashboard" id="cx-dashboard-form">
        <div class="cx-dashboard-tabs" role="tablist">
            <div class="cx-dashboard-tabs__nav">
                <?php
                $tab_count = 1;
                foreach ( self::get_tabs() as $slug => $data ) :
                    $slug = esc_attr( strtolower( $slug ) );
                    $class = 'cx-dashboard-tabs__nav-item cx-dashboard-tabs__nav-item--' . $slug;

                    if ( empty( $data['renderer'] ) || ! is_callable( $data['renderer'] ) ) {
                        $class .= ' nav-item-is--link';
                    }

                    if ( $tab_count === 1 ) {
                        $class .= ' tab--is-active';
                    }

                    if ( ! empty( $data['href'] ) ) {
                        $href = esc_url( $data['href'] );
                    } else {
                        $href = '#' . $slug;
                    }

                    printf( '<a href="%1$s" aria-controls="tab-content-%2$s" id="tab-nav-%2$s" class="%3$s" role="tab">%4$s</a>',
                        $href,
                        $slug,
                        $class,
                        isset( $data['title'] ) ? $data['title'] : sprintf( esc_html__( 'Tab %s', 'codexse-elementor-addons' ), $tab_count )
                    );

                    ++$tab_count;
                endforeach;
                ?>

                <button disabled class="cx-dashboard-tabs__nav-btn cx-dashboard-btn cx-dashboard-btn--lg cx-dashboard-btn--save" type="submit"><?php esc_html_e( 'Save Settings', 'codexse-elementor-addons' ); ?></button>
            </div>
            <div class="cx-dashboard-tabs__content">
                <?php
                $tab_count = 1;
                foreach ( self::get_tabs() as $slug => $data ) :
                    if ( empty( $data['renderer'] ) || ! is_callable( $data['renderer'] ) ) {
                        continue;
                    }

                    $class = 'cx-dashboard-tabs__content-item';
                    if ( $tab_count === 1 ) {
                        $class .= ' tab--is-active';
                    }

                    $slug = esc_attr( strtolower( $slug ) );
                    ?>
                    <div class="<?php echo $class; ?>" id="tab-content-<?php echo $slug; ?>" role="tabpanel" aria-labelledby="tab-nav-<?php echo $slug; ?>">
                        <?php call_user_func( $data['renderer'], $slug, $data ); ?>
                    </div>
                    <?php
                    ++$tab_count;
                endforeach;
                ?>
            </div>
        </div>
    </form>
</div>
