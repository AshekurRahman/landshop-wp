<div <?php post_class(get_post_type()); ?> >  
    <?php
        the_content();
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'maruncy' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span class="page-numbers" >',
            'link_after'  => '</span>',
            'next_or_number' => 'number',
            'nextpagelink'     => '<i class="mr-arrow-right-icon"></i>',
            'previouspagelink' => '<i class="mr-arrow-left-icon"></i>',
        ) );
    ?>
</div>