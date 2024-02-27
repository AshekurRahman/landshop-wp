<div class="error_page section__padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-7">
                <figure class="error_image">
                    <img src="<?php echo get_theme_file_uri('assets/images/404.png'); ?>" alt="<?php esc_attr_e('Empty Space','landshop'); ?>">
                </figure>
                <h2 class="error-title"><?php esc_html_e('Nothing Found','landshop'); ?></h2>
                <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                <div class="error-desc col-lg-9"><?php printf( esc_html__( 'Ready to publish your first post? ', 'landshop' ).'<a href="%1$s">'.esc_html__('Get started','landshop').'</a>', esc_url( admin_url( 'post-new.php' ) ) ); ?></div>
                <?php elseif ( is_search() ) : ?>
                <div class="error-desc"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'landshop' ); ?></div>
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <?php else : ?>
                <div class="error-desc"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'landshop' ); ?></div>
                <?php get_search_form(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>