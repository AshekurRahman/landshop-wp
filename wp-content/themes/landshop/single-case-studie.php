<?php
    get_header();
    $remove_header = get_post_meta( get_the_ID(), '_codexse_remove_page_header', true );
    $elementor_ready = get_post_meta( get_the_ID(), '_codexse_ready_for_elementor', true );
    if( $remove_header === 'yes' ){
        get_template_part('components/layouts/site_header');
    }
?>
<!-- Post_List_Area-Start -->
<?php if( have_posts() ){ ?>
<section class="<?php echo ( ($elementor_ready === 'no') ? 'single_page_area section-padding' : '' ); ?> page-section">
    <div class="<?php echo ( ($elementor_ready === 'no') ? 'container' : '' ); ?>">
        <?php                               
           // Start the loop.
            while(have_posts()){
                the_post();                                    
                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'components/post-formats/post', 'page' );
                 // End the loop.
                /* If comments are open or we have at least one comment, load up the comment template.*/
                if ( get_post_type() && comments_open() || get_comments_number() and $elementor_ready === 'no' ) :
                    comments_template();
                endif;
            }                        
        ?>
    </div>
</section>
<?php
    }else{
        // If no content, include the "No posts found" template.
        get_template_part( 'components/post-formats/post', 'none' );
    }
?>
<!-- Post_List_Area-End -->
<?php get_footer();