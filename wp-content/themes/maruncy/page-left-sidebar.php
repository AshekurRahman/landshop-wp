<?php
/**
Template Name: Page Left Sidebar
**/
    get_header();
    $remove_header = get_post_meta( get_the_ID(), '_producta_page_header', true );
    $onepage = get_post_meta( get_the_ID(), '_producta_one_page_template', true );
    $remove_page_container = get_post_meta( get_the_ID(), '_producta_remove_page_container', true );
    if( $remove_header != 'on' ){
        get_template_part('components/layouts/site_header');
    }
?>
<!-- Post_List_Area-Start -->
<?php if( have_posts() ){ ?>
<section class="<?php echo ( ($onepage != 'on') ? 'single_page_area section_padding' : '' ); ?> page-section">
    <div class="<?php echo ( ($onepage != 'on') && ($remove_page_container != 'on') ? 'container' : '' ); ?>">
        <div class="row flex-row-reverse">
            <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-8 pr-lg-5' : '' ); ?>">
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
                        if ( get_post_type() && comments_open() || get_comments_number() and $onepage != 'on' ) :
                            comments_template();
                        endif;
                    }
                ?>
            </div>
            <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-4 mt-5 mt-lg-0' : '' ); ?>">
                <?php get_sidebar(); ?>
            </div>
        </div>
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