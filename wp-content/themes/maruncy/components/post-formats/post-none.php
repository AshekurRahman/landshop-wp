<div class="empty-space-page section_padding">
    <div class="container">
        <img class="empty-element empty-element-1" src="<?php echo get_theme_file_uri('assets/images/empty-element-1.png'); ?>" alt="<?php esc_attr_e('Empty Element','maruncy'); ?>">
        <img class="empty-element empty-element-2" src="<?php echo get_theme_file_uri('assets/images/empty-element-2.png'); ?>" alt="<?php esc_attr_e('Empty Element','maruncy'); ?>">
        <img class="empty-element empty-element-3" src="<?php echo get_theme_file_uri('assets/images/empty-element-3.png'); ?>" alt="<?php esc_attr_e('Empty Element','maruncy'); ?>">
        <figure class="empty-image">
            <img src="<?php echo get_theme_file_uri('assets/images/empty-space.png'); ?>" alt="<?php esc_attr_e('Empty Space','maruncy'); ?>">
        </figure>
        <h2 class="empty-title"><?php esc_html_e('Nothing Found','maruncy'); ?></h2>                
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<div class="empty-desc"><?php printf( esc_html__( 'Ready to publish your first post? ', 'maruncy' ).'<a href="%1$s">'.esc_html__('Get started here','maruncy').'</a>', esc_url( admin_url( 'post-new.php' ) ) ); ?></div>
		<?php elseif ( is_search() ) : ?>
			<div class="empty-desc"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'maruncy' ); ?></div>
            <form role="search" method="get" class="empty-search-form" action="<?php esc_url(home_url("/")); ?>">
                <input type="search" name="s" class="form_control" placeholder="<?php _e("Type your keywords","maruncy"); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
                <button type="submit" class="search_submit primary_button"><?php _e("Search Now","maruncy"); ?></button>
            </form>
		<?php else : ?>
			<div class="empty-desc"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'maruncy' ); ?></div>
            <form role="search" method="get" class="empty-search-form" action="<?php esc_url(home_url("/")); ?>">
                <input type="search" name="s" class="form_control" placeholder="<?php _e("Type your keywords","maruncy"); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
                <button type="submit" class="search_submit primary_button"><?php _e("Search Now","maruncy"); ?></button>
            </form>
		<?php endif; ?>
    </div>
</div>