<?php get_header(); ?>
<?php get_template_part('components/layouts/site_header'); ?>
<!-- Post_List_Area-Start -->
<?php  if( have_posts() ){ ?>
<section class="posts_list-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 <?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'col-lg-8' : '' ); ?>">
                <div class="<?php echo ( is_active_sidebar( 'main_sidebar' ) ? 'pe-lg-4' : '' ); ?>">
                    <div class="posts_list">                           
                       <?php                           
                           // Start the loop.
                            while(have_posts()){
                                the_post();                                    
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'components/post-formats/post', get_post_format() );
                                 // End the loop.
                            }                      
                        ?>
                    </div>						
                    <?php
                         // Previous/next page navigation.
                        the_posts_pagination(array(
                            'prev_text' => '<i class="fal fa-angle-double-left"></i>',
                            'next_text' => '<i class="fal fa-angle-double-right"></i>',
                            'screen_reader_text' => ' '
                        ));
                    ?>
                </div>
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